<?PHP

if(!defined('IN_APP')) {
	die('Malicious request: <b>This process</b> could not be accessed directly!');
}

//if (isset($_SESSION['INSP']["USER"]) || isset($_SESSION['INSP']["UID"]) || isset($_SESSION['INSP']["UTYPE"])) {
//	header("Location: index.php");
//	exit;
//}

$intVars['content'] = '';

$gFrm = new HTML_QuickForm('loginForm','post');//default form object..pages may initialize additional objects
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

$gFrm->addElement('text','username',$lang['your_user_id'],'size="20"');
$gFrm->addRule('username',$lang['please_enter_a_username'],'required');
$gFrm->addRule('username',$lang['please_enter_a_username'],'required','','client');

$gFrm->addElement('password','password',$lang['your_password'],'size="20"');
$gFrm->addRule('password',$lang['please_enter_a_password'],'required');
$gFrm->addRule('password',$lang['please_enter_a_password'],'required','','client');
$gFrm->addElement('hidden','cmd',$act);
$gFrm->addElement('submit','submit',$lang['login']);

$msgTxt = '';

if(isset($_POST['form'])&&$_POST['form']=='login') {
	if($gFrm->validate()) {
		$username = addslashes($gFrm->exportValue('username'));
		$password = addslashes($gFrm->exportValue('password'));

		if ( trim( $username ) != "" && trim( $password ) != "" )	{
			// remove users for whom the login has expired
//			$db->query( "DELETE FROM ".dext('users')." WHERE expires < NOW()" );

			$exists = $db->getOne( "SELECT ID FROM ".dext('users')." WHERE login = '$username' AND pass = '".md5($password)."'" );
			$user_data = $db->getRow( "SELECT * FROM ".dext('users')." WHERE login = '$username' AND pass = '".md5($password)."'" );
			if ($user_data && $user_data['utype'] != "0" ){
				$isAdmin = true;
				$user_data['utype']=1;
			}elseif ($user_data && $user_data['utype'] == "0" ) {
				$isAdmin = false;
			}

			if ( $exists || $isAdmin ) {
				// set session vars and redirect to home page
				$_SESSION['INSP']["USER"] = $username;
				$_SESSION['INSP']["UID"] = $user_data['ID'];
				$_SESSION['INSP']["UTYPE"] = $user_data['utype'];
				$_SESSION['INSP']["ISADMIN"] = $isAdmin;
				
				if ( $isAdmin ) {
					header( "Location: ".HOME."admin.php" );
				}else {
					header( "Location: ".HOME."member.php" );
				}
				exit;
			} else {
				$msgTxt = "<span class=normalRed>".$lang['your_login_information_could_not_be_found']."<a href=index.php?cmd=2>".$lang['click_here_to_register']."</a>.</span><br />";
			}
		}

	}
}
$gFrm->accept($gFrmR);

$t->assign('login_form_data',$gFrmR->toArray());

$gFrm = new HTML_QuickForm('retForm','post');//default form object..pages may initialize additional objects
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

$gFrm->addElement('text','email','','size="40"');
$gFrm->addRule('email',$lang['please_enter_your_email'],'required');
$gFrm->addRule('email',$lang['please_enter_your_email'],'required','','client');
$gFrm->addRule('email',$lang['please_enter_valid_email_your'],'email','','client');
$gFrm->addElement('hidden','cmd',$act);
$gFrm->addElement('submit','submit',$lang['ok']);

if(isset($_POST['form'])&&$_POST['form']=='ret') {
	if($gFrm->validate()) {
		$email = $gFrm->exportValue('email');
		// get the user name and ID by means of email address
		$qry = "SELECT login FROM ".dext('users')." WHERE upper(email)=upper('".$email."')";
		$loginID = $db->getOne( "$qry" );
		$validEmail = validEmail( $email );
		$admin_user = $db->getRow("SELECT * FROM ".dext('users')." WHERE utype='9'" );

		//generate new password
		$new_pass = (uniqid(rand(), true));
		$new_pass = substr($new_pass, 0, 5);
		$md5_pass = md5($new_pass);

		if ( $loginID == "") {
			$msgTxt .= "<span class=normalRed>".$lang['login_information_could_not_be_found']."<a href=\"index.php?cmd=2\">".$lang['re_register']."</a>".$lang['to_use_this_system']."</span><br />";
		}elseif ( $validEmail ) {

			$gMail->IsHTML(false);
			$gMail->SetLanguage("en", INCLUDE_DIR ."/phpmailer/language/");

			$gMail->AddAddress($email, "");
			$gMail->From     = $admin_user['email'];
			$gMail->FromName = $admin_user['name'];
			$gMail->Subject = $lang['your_login_information_for'].$gConf['site_title'];

			$gMail->Body = $lang['your_new_login_information_is']."\n\n".$lang['user_id'].$loginID."\n".$lang['new_password'].$new_pass."\n\n";

			if(!$gMail->Send()){
				$msgTxt .= "<span class=normalRed>".$lang['there_has_been_a_mail_error_sending_to'] . $email. ": {$gMail->ErrorInfo}</span>";
			}else {
				$db->query('UPDATE '.dext('users').' SET pass="'.$md5_pass.'" WHERE login="'.$loginID.'"');
				$msgTxt .= "<span class=normalRed>".$lang['new_login_password']."</span><br />";
			}
		}elseif ( !$validEmail ) {
			// this will probably never be executed
			$msgTxt .= "<span class=normalRed>".$lang['email_address_contains_invalid_syntax']."</span><br />";
		}
	}
}
$gFrm->accept($gFrmR);
$t->assign('ret_form_data',$gFrmR->toArray());



/*
echo '<pre>';
print_r($gFrmR->toArray());
//*/

$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('login.tpl');
?>