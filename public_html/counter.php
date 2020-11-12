<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>This process</b> could not be accessed directly!');
}
$ID = isset($_GET['ID'])?(int)$_GET['ID']:0;
$ID = isset($_POST['ID'])?(int)$_POST['ID']:$ID;



if($it=$db->getRow("SELECT email,name FROM ".dext('users')." WHERE login='".$db->getOne("SELECT user FROM ".dext('items')." WHERE ID='$ID'")."'")) {
	$email = $it['email'];
	$name = $it['name'];	
}
$msgTxt ='';
if($db->getOne("SELECT COUNT(*) FROM ".dext('view_ip')." WHERE item_id='$ID' AND value='{$_SERVER['REMOTE_ADDR']}'")) {
	$msgTxt = $lang['the_author_has_already_been_notified'];
}else {
	$db->query("INSERT INTO ".dext('view_ip')." VALUES('$ID','{$_SERVER['REMOTE_ADDR']}')");
	if($gConf['enable_member_mail_notify']=="Y") {
		$admin_user = $db->getRow("SELECT * FROM ".dext('users')." WHERE utype='9'" );
		$gMail->IsHTML(false);
		$gMail->SetLanguage("en", INCLUDE_DIR ."/phpmailer/language/");
		$gMail->AddAddress($email, $name);
		$gMail->From     = $admin_user['email'];
		$gMail->FromName = $admin_user['name'];
		$gMail->Subject = $lang['your_inspiration_was_read'];
		$gMail->Body = $lang['someone_has_read'].$gConf['site_title'].".\n\n".$lang['you_can_check_your_inspiration_status'];
		if(!$gMail->Send()){
			$msgTxt .= "<span class=normalRed>".$lang['there_has_been_a_mail_error_sending_to']. $email. ": {$gMail->ErrorInfo}</span>";
		}
	}
	$msgTxt .= '<h4>'.$lang['thank_you'].'</h4><br />'.$lang['the_author_of_this_post_has_been_notified'];
}

$t->assign('top_message',$msgTxt);
$t->display('counter.tpl');
?>