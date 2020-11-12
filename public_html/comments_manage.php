<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> Invalid access </b> could not be accessed directly!');
}
if(isset($_POST['ID'])&&$_POST['ID']) {
	$_GET['ID'] = $_POST['ID'];
}

/* If not item ID, go home */
if(!isset($_GET['ID']) AND !isset($_GET['rID'])) {
	header( "Location: ".HOME."index.php?cmd=1" );
	exit;
}

$intVars['content'] = '';
if(isset($_GET['rID'])) { // delete a comment and return to item with comments
	$item_id = $db->getOne('SELECT item FROM '.dext('comments').' WHERE ID="'.(int)$_GET['rID'].'"');
	$db->query('DELETE FROM '.dext('comments').' WHERE id="'.(int)$_GET['rID'].'"');
	header( "Location: ".HOME."index.php?cmd=21&ID=".$item_id );
	exit;
}

$que = 'SELECT * FROM '.dext('comments').' WHERE ID="'.(int)$_GET['ID'].'"';

if ($act == '22') $modify = false;
if ($act == '23') $modify = true;

if (!$modify) $que = str_replace('ID=','item=',$que);

$comment = $db->getRow($que);
$comment['text']=nl2br($comment['text']);
$comment['title']=html_entity_decode($comment['title']);
$comment['text']=html_entity_decode($comment['text']);
$comment['user_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE ID="'.$comment['user_id'].'"');

if ($modify) {
	$id_item = (int)$comment['item'];
} else {
	$id_item = (int)$_GET['ID'];
}

$item = $db->getRow('SELECT * FROM '.dext('items').' WHERE confirmed=1 AND ID="'.$id_item.'"');
$item['text']=nl2br($item['text']);
$item['title']=html_entity_decode($item['title']);
$item['text']=html_entity_decode($item['text']);
$item['user_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="'.$item['user'].'"');

/* If comments are not allowed don't show add form */
if (!$modify)
	if ($item['allow_comments'] == 'N') {
		header( "Location: ".HOME."index.php?cmd=21&ID=".(int)$_GET['ID'] );
		exit;
	} 

$gFrm = new HTML_QuickForm('myForm','post');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');
$msgTxt = '';

$gFrm->addElement('hidden','cmd',$act);
$gFrm->addElement('hidden','ID',(int)$_GET['ID']);
$defaults = array();
$opts['style'] = 'width:250px;';

$gFrm->addElement('text','myTitle',$lang['comment_title'],$opts);
$gFrm->addRule('myTitle',$lang['please_enter_comment_title'],'required','','client');

$gFrm->addElement('text','contributerName',$lang['authored_by'],$opts);
$gFrm->addRule('contributerName',$lang['please_enter_your_name'],'required','','client');
$defaults['contributerName'] = $db->getOne('SELECT name FROM '.dext('users').' WHERE id="'.$_SESSION['INSP']['UID'].'"');

$gFrm->addElement('text','email',$lang['your_email_address'],'size="30" maxlength="100" value="'.$user_data['email'].'"');
$gFrm->addRule('email',$lang['please_enter_an_email_address'],'required');
$gFrm->addRule('email',$lang['please_enter_an_email_address'],'required','','client');
$gFrm->addRule('email',$lang['please_enter_valid_email'],'email','','client');
$defaults['email'] = $db->getOne('SELECT email FROM '.dext('users').' WHERE id="'.$_SESSION['INSP']['UID'].'"');

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'hide_email', $lang['hide_email']);
$radio = array();
$defaults['hide_email'] = 'N';

$gFrm->addElement('textarea','text',$lang['comment'],' style="width:99%" rows=3');
$gFrm->addRule('text',$lang['please_enter_comment'],'required');
$gFrm->addRule('text',$lang['please_enter_comment'],'required','','client');

if ($modify) { 
  $defaults['myTitle'] = $comment['title'];
  $defaults['contributerName'] = $comment['author'];
  $defaults['email'] = $comment['email'];
  $defaults['hide_email'] = $comment['hide_email'];
  $defaults['text'] = $comment['text'];
}
$no_form = 0;

$gFrm->addElement('submit','submit',$lang['submit'],'');
$gFrm->addElement('button','remove',$lang['permanently_remove'],array('onClick'=>'if(confirm(\''.$lang['are_you_sure'].'\')){document.location.href = \''.HOME.'index.php?cmd='.$act.'&rID='.(int)$_GET['ID'].'\'}'));
$gFrm->addElement('reset','reset',$lang['reset'],'');

if($gFrm->validate()) {
	$no_form = 1;
	$gFrm->process('process_data',1);
	header( "Location: ".HOME."index.php?cmd=21&ID=".$id_item );
	exit;
}else {
	$gFrm->setDefaults($defaults);
}

$gFrm->accept($gFrmR);
$t->assign('no_form',$no_form);
$t->assign('form_data',$gFrmR->toArray());

$t->assign('cmd',$act);
$t->assign('item',$item);
$t->assign('comment',$comment);
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('comments_manage.tpl');


function process_data($values) {
	global $db,$gPaths,$gConf,$msgTxt,$gMail, $no_form, $disp_msg,$lang,$modify;
   
	$contributerName = $values['contributerName'];
	$email = $values['email'];
	$hide_email = $values['hide_email'];
	$myTitle = $values['myTitle'];
	$myTitle = htmlentities($myTitle,ENT_QUOTES);
	$text = $values['text'];
	$text = htmlentities($text,ENT_QUOTES);
	$text = str_replace("  ","&nbsp;&nbsp;",$text);
	$today = date('Y-m-d');
	$confirmed = 1;
	

	if ($values['cmd'] == '23') {$modify = true;} else {$modify = false;}
	
	if ($modify) {
		
		$db->query('UPDATE '.dext('comments').' SET text="'.$text.'",title="'.$myTitle.'",author="'.$contributerName.
		'",email="'.$email.'",hide_email="'.$hide_email.'" WHERE id="'.(int)$_GET['ID'].'"');

	} else 
	if ($msgTxt == "") {
		// add the new comment and then redirect to the page with all the comments
		$user = $db->getRow('SELECT * FROM '.dext('users').' WHERE ID = "'.$_SESSION['INSP']['UID'].'"' );
		$item = $db->getRow('SELECT * FROM '.dext('items').' WHERE ID = "'.(int)$_GET['ID'].'"');

		$que = "INSERT INTO ".dext('comments')."(ID,item,user_id,author,email,hide_email,title,text,created,confirmed)
		       VALUES(NULL,'".$_GET['ID']."','".$user['ID']."','$contributerName','$email','$hide_email','$myTitle','$text','$today','$confirmed')";
		$db->query($que);

		}
	} //end msgTxt

?>