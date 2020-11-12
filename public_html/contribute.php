<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}
/* If contribution is allowed without login, bypass this */
if ($allowContributionWithoutLogin != true ) {
	if(!$_SESSION['INSP']["USER"]) {
		header( "Location: ".HOME. "index.php?cmd=3" );
		exit;
	}
}

$intVars['content'] = '';

if(isset($_GET['cat'])) {
	$_POST = array();
}

$gFrm = new HTML_QuickForm('myForm','post');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');
$msgTxt = '';

//create new rule
$gFrm->registerRule('frm_img_dims','callback','frm_img_dims');
function frm_img_dims($pars) {
	global $gConf;
	if($pars['size']!=0) {
		$image_params = @getimagesize($pars['tmp_name']);
		if ($image_params[0] > $gConf['max_picture_width'] || $image_params[1] > $gConf['max_picture_height']) {
			return false;
		}
	}
	return true;
}
$gFrm->addElement('hidden','cmd',$act);

$defaults = array();
$defaults['cats'] = $intVars['category'];
$list = buildTree();
foreach($list as $key=>$val) {
	$list[$key] = str_replace('*','&#8226;&nbsp;',$val);
}
$list = array(""=>$lang['select_category']) + $list;
$opts['style'] = 'width:250px;';
$gFrm->addElement('select','cats',$lang['category'],$list,$opts);

$gFrm->addElement('text','new_cat',$lang['category_please_suggest_one'],$opts);
$gFrm->addElement('text','myTitle',$lang['inspiration_title'],$opts);
$gFrm->addRule('myTitle',$lang['please_enter_inspiration_title'],'required','','client');
$gFrm->addElement('text','contributerName',$lang['authored_by'],$opts);
$gFrm->addRule('contributerName',$lang['please_enter_your_name'],'required','','client');
$defaults['contributerName'] = $db->getOne('SELECT name FROM '.dext('users').' WHERE id="'.$_SESSION['INSP']['UID'].'"');

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'hide_email', 'Yes/No');
$radio = array();
$defaults['hide_email'] = $gConf['hide_user_emails'];

$file = $gFrm->addElement('file','image',$lang['image_optional'],$opts);
$gFrm->addRule('image',$lang['selected_file_exceeds_the_maximum_size'].$gConf['max_picture_size'].' Kb','maxfilesize',$gConf['max_picture_size']*1024);
$gFrm->addRule('image',$lang['selected_file_type_is_unsupported'],'mimetype',array_slice($mime_types,0));
$gFrm->addRule('image',$lang['picture_dimensions_exceed_the_maximum_allowed_size'].$gConf['max_picture_width'].' / '.$gConf['max_picture_height'].'','frm_img_dims',array($gConf['max_picture_width'],$gConf['max_picture_height']));

$gFrm->addElement('select','image_align',$lang['image_alignment'],array('align="right"'=>$lang['right'],'align="left"'=>$lang['left']),$opts);

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'allow_comments', 'Yes/No');
$radio = array();
$defaults['allow_comments'] = 'Y';

$gFrm->addElement('textarea','text',$lang['inspiration_text'],' style="width:100%" rows=8');
$gFrm->addRule('text',$lang['please_enter_inspiration_text'],'required');
$gFrm->addRule('text',$lang['please_enter_inspiration_text'],'required','','client');

$no_form = 0;

$gFrm->addElement('submit','submit',$lang['submit'],'');
// Changed by Swaroop(PHP Duo) #3 v3.pd.1 Ref #3
// Major bug, while validating, the submit button wouldn't appear if there was an error.

if($gFrm->validate()) {
	$no_form = 1;
	$gFrm->process('process_data',1);
}else {
	$gFrm->setDefaults($defaults);
}

function process_data($values) {
	global $db,$HTTP_POST_FILES,$gPaths,$gConf,$mime_types,$msgTxt,$gMail, $no_form, $disp_msg,$lang;
	$user = $_SESSION['INSP']['USER'];
	$image_data = '';
	$image_mime_type = '';

	$userFullName = $db->getOne( "SELECT name FROM ".dext('users')." WHERE login = '$user'" );
	//if ($HTTP_POST_FILES['image']['tmp_name'] != "none") {
	if ($HTTP_POST_FILES['image']['size'] != 0){
		if (!($image_params = @getimagesize($HTTP_POST_FILES['image']['tmp_name']))) {
			$msgTxt .= "<span class=normalRed>".$lang['file_does_not_appear_to_be_an_allowed_image_format']."</span><br />";
		} elseif ($image_params[0] > $gConf['max_picture_width'] || $image_params[1] > $gConf['max_picture_height']) {
			// Nothing needed

		} else {
			// Load the picture data for storage
			if (!($file = fopen($HTTP_POST_FILES['image']['tmp_name'], "rb"))) {
				$msgTxt .= "<span class=normalRed>".$lang['unable_to_open_the_uploaded_picture_file']."</span><br />";
			} else {
				if (($image_mime_type = $mime_types[$image_params[2]]) == "") {
					$msgTxt .= "<span class=normalRed>".$lang['image_type_not_supported']."</span><br />";
				}
				$image_data = addslashes(fread($file, filesize($HTTP_POST_FILES['image']['tmp_name'])));
			}
		}
	}
	/* Ensure that either the category is selected or a new category is suggested
	*/
	if ($values['cats']=="" &&  $values['new_cat'] == "") {
		$msgTxt=$lang['category_must_be_selected'];
		$no_form=0;
	}

	if ($msgTxt == "") {
		// add the new inspiration and then redirect to category page

		$today = date( "Y-m-d" );
		$newCategory = $values['new_cat'];
		if ( $newCategory ) {
			$db->query('INSERT INTO '.dext('categories').'(name) VALUES("'.$newCategory.'")');
		}
		$category = ($newCategory)?$db->getOne('SELECT id FROM '.dext('categories').' WHERE name="'.$newCategory.'"'):$values['cats'];
		$contributerName = $values['contributerName'];
		$myTitle = $values['myTitle'];
		$text = $values['text'];

		$text = htmlentities($text,ENT_QUOTES);
		$text=str_replace("  ","&nbsp;&nbsp;",$text);
		$myTitle = htmlentities($myTitle,ENT_QUOTES);

		$image_align = $values['image_align'];
		$hide_email = $values['hide_email'];
		$allow_comments = $values['allow_comments'];

		// Added by Swaroop(PHP Duo) #4 v3.pd.1 Ref #4
		// If admin has enabled, auto-approve posts,

		$confirmed = (getVar("auto_approve")=='Y') ? 1 : 0;

		$que = "INSERT INTO ".dext('items')."(category,user,author,title,text ,created,image_data,image_mime_type ,image_align ,hide_email, confirmed,allow_comments) VALUES('$category','$user','$contributerName','$myTitle','$text','$today','$image_data','$image_mime_type','$image_align','$hide_email', '$confirmed','$allow_comments')";

		$db->query($que);


		if ($confirmed>0)
		$msgTxt = "<span class=subtitleBold>".$lang['thanks_for_your_submission']."</span><br /><br /><span class=normal>".$lang['your_contribution_will_be_up_in_a_moment']."</span><br /><br />\n";
		else
			$msgTxt = "<span class=subtitleBold>".$lang['thanks_for_your_submission']."</span><br /><br /><span class=normal>".$lang['your_contribution_will_be_reviewed']."</span><br /><br />\n";

		$msgTxt .= "<a href=\"index.php\">".$lang['return_to_home']."</a>\n";

		$msgTxt = "<table summary=\"\" cellspacing=0 cellpadding=3><tr><td>\n" . $msgTxt . "\n</td></tr></table>\n";

		// if the administrator wishes to be notified of new submissions, send them an email now
		if ( $gConf['admin_notify']=="Y" ) {

			$admin_user = $db->getRow("SELECT * FROM ".dext('users')." WHERE utype='9'" );
			$gMail->IsHTML(false);
			$gMail->SetLanguage("en", INCLUDE_DIR ."/phpmailer/language/");

			$myTitle = stripslashes( $myTitle );
			$text = stripslashes( html_entity_decode($text ));

			$gMail->AddAddress($admin_user['email'], "");
			$gMail->From     = $admin_user['email'];
			$gMail->FromName = $admin_user['name'];
			$gMail->Subject = $lang['a_new_submission_has_been_made'].$gConf['site_title']."";

			$gMail->Body = $lang['dear'].$gConf['site_title']." ".$lang['administrator_automatic_notification_new_submission']." \n\n".$lang['title'].": ". $myTitle."\n".$lang['user_id'].": ".$user."\n".$lang['text'].": ".$text."";

			if(!$gMail->Send()){
				$msgTxt .= "<span class=normalRed>".$lang['there_has_been_a_mail_error_sending_to'] . $admin_user['email']. ": {$gMail->ErrorInfo}</span>";
			}else {
				if ($_SESSION['INSP']['UTYPE'] > 0 ) {
					header( "Location: ".HOME."admin.php" );
				} else {
					// Changed by Swaroop(PHP Duo) #2 v3.pd.1 Ref #2
					// People requested that a message be shown to the users that the submission was made
					//header( "Location: ".HOME."member.php" );
				}
				//exit;
			}
		}
	}
}



$gFrm->accept($gFrmR);
$t->assign('no_form',$no_form);
$t->assign('form_data',$gFrmR->toArray());


/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('admin_contribute.tpl');
?>