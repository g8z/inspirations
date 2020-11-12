<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>This Program</b> could not be accessed directly!');
}

if(!checkSession(1)) {
	header( "Location: ".HOME."index.php?cmd=3" );
	exit;
}


$intVars['content'] = '';
$msgTxt = '';

function process_data($values) {
	global $db,$gMail,$gConf,$gPaths,$msgTxt,$lang;
	$f = $values;
	if($row = $db->getRow('SELECT * FROM '.dext('items').' WHERE id="'.$values['frmID'].'"')) {
		$row['author_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="'.$row['user'].'"');
		$row["created"] = date(str_replace("%","",$gConf['date_format']),strtotime($row["created"]));
		$text=$f['text'.'_'.$row['ID']];
		$text=str_replace('&nbsp;'," ",$text);
		$text=htmlentities($f['text'.'_'.$row['ID']],ENT_QUOTES);
		$text=str_replace('  ','&nbsp;&nbsp;',$text);

		$que = 'UPDATE '.dext('items').' SET category="'.$f['cats'.'_'.$row['ID']].'",author="'.$f['contributerName'.'_'.$row['ID']].'",hide_email="'.$f['hide_email'.'_'.$row['ID']].'",title="'.htmlspecialchars($f['myTitle'.'_'.$row['ID']],ENT_QUOTES).'",text="'.$text.'",confirmed=1 WHERE id="'.$row['ID'].'"';

		$db->query($que);
		if ( isset($f['sendmail'.'_'.$row['ID']])&&$f['sendmail'.'_'.$row['ID']]&&isset($row['author_data']['email'])) {
			$admin_user = $db->getRow("SELECT * FROM ".dext('users')." WHERE utype='9'" );
			$gMail->IsHTML(false);
			$gMail->SetLanguage("en", INCLUDE_DIR."phpmailer/language/");
			$myTitle = html_entity_decode( $row['title'],ENT_QUOTES );
//			$text = html_entity_decode( $row['text'],ENT_QUOTES );

			$gMail->AddAddress($row['author_data']['email'], "");
			$gMail->From		 = $admin_user['email'];
			$gMail->FromName = $admin_user['name'];
			$gMail->Subject = $lang['your_submission_to'].$gConf['site_title'].$lang['has_been_approved']."!";	
			$gMail->Body = $lang['congratulations']."\n\n".$lang['your_submission_to'].$gConf['site_title'].$lang['has_been_approved'].$lang['for_inclusion_in_our_database'].$lang['if_you_would_like_to_see']."\n\n" . HOME . "";
			if(!$gMail->Send()){
				$msgTxt .= "<span class=normalRed>".$lang['there_has_been_a_mail_error_sending_to'] . $row['author_data']['email']. ": {$gMail->ErrorInfo}</span>";
			}

		}
		
	}


}

if(isset($_GET['rID'])) {
	if($row = $db->getRow('SELECT * FROM '.dext('items').' WHERE id="'.(int)$_GET['rID'].'"')) {
		$row['author_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="'.$row['user'].'"');

		$que = 'DELETE FROM '.dext('items').' WHERE id="'.(int)$_GET['rID'].'"';
		$db->query($que);
		if ( isset($_GET['notify'])&&$_GET['notify']=="true"&&isset($row['author_data']['email'])) {
			$admin_user = $db->getRow("SELECT * FROM ".dext('users')." WHERE utype='9'" );
			$gMail->IsHTML(false);
			$gMail->SetLanguage("en", INCLUDE_DIR."phpmailer/language/");
			$myTitle = html_entity_decode( $row['title'],ENT_QUOTES );
			$text = html_entity_decode( $row['text'],ENT_QUOTES );

			$gMail->AddAddress($row['author_data']['email'], "");
			$gMail->From		 = $admin_user['email'];
			$gMail->FromName = $admin_user['name'];
			$gMail->Subject = $lang['your_submission_to'].$gConf['site_title'].$lang['could_not_be_approved'];
			$gMail->Body = $lang['we_re_sorry'].$gConf['site_title'].$lang['could_not_be_approved'].$lang['for_inclusion_in_our_database'].$lang['if_you_would_like_to_re_submit']."\n\n" . HOME . "\n\n".$lang['if_you_feel_that_your_submission'].$admin_user['email']."";
			if(!$gMail->Send()){
				$msgTxt .= "<span class=normalRed>".$lang['there_has_been_a_mail_error_sending_to'] . $row['author_data']['email']. ": {$gMail->ErrorInfo}</span>";
			}

		}
		
	}
}


$frms = array();

foreach($db->getAll('SELECT * FROM '.dext('items').' WHERE confirmed=0 ORDER BY created DESC') as $row) {
	$processed = false;
	if(isset($gFrm)) {
		unset($gFrm);
	}
	$gFrm = new HTML_QuickForm('myForm'.$row['ID'],'POST');
	$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
	$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

	$gFrm->addElement('hidden','cmd',$act);

	$defaults = array();
	$list = buildTree();
	foreach($list as $key=>$val) {
	$list[$key] = str_replace('*','&#8226;&nbsp;',$val);	
	}
	$list = array(""=>$lang['select_category']) + $list;
	$opts['style'] = 'width:250px;';
	$gFrm->addElement('select','cats'.'_'.$row['ID'],$lang['category'],$list,$opts);
	$defaults['cats'.'_'.$row['ID']] = $row['category'];
	$gFrm->addRule('cats'.'_'.$row['ID'],$lang['category_is_required_field'],'required');
	$gFrm->addRule('cats'.'_'.$row['ID'],$lang['category_is_required_field'],'required','','client');
	
	$gFrm->addElement('text','new_cat'.'_'.$row['ID'],$lang['this_user_has_suggested'],$opts);
	if($db->getOne('SELECT confirmed FROM '.dext('categories').' WHERE ID="'.$row['category'].'"')==0) {
		$defaults['new_cat'.'_'.$row['ID']] = $db->getOne('SELECT name FROM '.dext('categories').' WHERE ID="'.$row['category'].'"');
	}else {
		$defaults['new_cat'.'_'.$row['ID']] = '';
	}
	
	$gFrm->addElement('text','myTitle'.'_'.$row['ID'],$lang['inspiration_title'],$opts);
	$defaults['myTitle'.'_'.$row['ID']] = html_entity_decode($row['title'],ENT_QUOTES);
	$gFrm->addRule('myTitle'.'_'.$row['ID'],$lang['please_enter_inspiration_title'],'required','','client');

	$gFrm->addElement('text','contributerName'.'_'.$row['ID'],$lang['authored_by'],$opts);
	$defaults['contributerName'.'_'.$row['ID']] = $row['author'];
	$gFrm->addRule('contributerName'.'_'.$row['ID'],$lang['please_enter_your_name'],'required','','client');

	$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
	$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
	$gFrm->addGroup($radio, 'hide_email'.'_'.$row['ID'], 'Yes/No');
	$radio = array();
	$defaults['hide_email'.'_'.$row['ID']] = ($row['hide_email']=="Y")?"Y":"N";

	$gFrm->addElement('textarea','text'.'_'.$row['ID'],$lang['inspiration_text'],' style="width:100%" rows=8');
	$gFrm->addRule('text'.'_'.$row['ID'],$lang['please_enter_inspiration_text'],'required');
	$gFrm->addRule('text'.'_'.$row['ID'],$lang['please_enter_inspiration_text'],'required','','client');
	$defaults['text'.'_'.$row['ID']] = html_entity_decode($row['text'],ENT_QUOTES);

	$gFrm->addElement('checkbox','sendmail'.'_'.$row['ID'],'',$lang['send_notification_upon_approval_or_rejection'],'checked');
	
	$gFrm->addElement('submit','submit',$lang['confirm'],'');
	$gFrm->addElement('button','reject',$lang['reject'],array('onClick'=>'document.location.href = \''.HOME.'admin.php?cmd='.$act.'&rID='.$row['ID'].'&notify=\'+document.forms.myForm'.$row['ID'].'.sendmail_'.$row['ID'].'.checked+\'\''));
	$gFrm->addElement('reset','reset',$lang['reset'],'');

	$row['author_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="'.$row['user'].'"');

	if(isset($_POST['frmID'])&&$_POST['frmID']==$row['ID']&&$gFrm->validate()) {
		$gFrm->freeze();
		$gFrm->process('process_data',1);
		$processed = true;
	}else {
		//$gFrm->addElement('submit','submit',$lang['submit'],'');
		$gFrm->setDefaults($defaults);	
	}
	
	if(!$processed) {
		$gFrm->accept($gFrmR);
		$frms[] = $gFrmR->toArray();
		$frms[count($frms)-1]['ID'] = $row['ID'];
		$frms[count($frms)-1]['raw'] = $row;
	}
}
	$t->assign('forms',$frms);

if(count($frms)==0) {
	if ($msgTxt) {$msgTxt .= "<br /><br />";}
	$msgTxt .= "<span class=normal>".$lang['there_have_been_no_new_submissions']."</span>";
}
	
/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('admin_review.tpl');
?>