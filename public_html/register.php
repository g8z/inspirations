<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>Invalid Access,</b> could not be accessed directly!');
}

$intVars['content'] = '';

function cmpPass($fields) {
	global $lang;
	if (strlen($fields['password']) && strlen($fields['password1']) && $fields['password'] != $fields['password1']) {
		return array('password' => $lang['passwords_are_not_the_same']);
	}
	return true;
}

$gFrm = new HTML_QuickForm('loginForm','post');//default form object..pages may initialize additional objects
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

$gFrm->addElement('text','fullname',$lang['your_name'],'size="30"');
$gFrm->addRule('fullname',$lang['please_enter_your_name'],'required');
$gFrm->addRule('fullname',$lang['please_enter_your_name'],'required','','client');

$gFrm->addElement('text','email',$lang['your_email_address'],'size="30" maxlength="100"');
$gFrm->addRule('email',$lang['please_enter_an_email_address'],'required');
$gFrm->addRule('email',$lang['please_enter_an_email_address'],'required','','client');
//this is the error message that shows
$gFrm->addRule('email',$lang['please_enter_valid_email'],'email','','client');

$gFrm->addElement('text','username',$lang['choose_a_login_name_4_12'],'size="20" maxlength="12"');
$gFrm->addRule('username',$lang['please_enter_your_username'],'required','','client');
$gFrm->addRule('username',$lang['your_login_name_must_be_at_least_4'],'minlength','4');
//error message
$gFrm->addRule('username',$lang['your_login_name_must_be_at_least_4'],'minlength','4','client');

$gFrm->addElement('password','password',$lang['choose_a_password_4_12'],'size="20" maxlength="12"');
$gFrm->addRule('password',$lang['please_enter_your_password'],'required','','client');
$gFrm->addRule('password',$lang['your_password_must_be_at_least_4'],'minlength','4');
//error message
$gFrm->addRule('password',$lang['your_password_must_be_at_least_4'],'minlength','4','client');

$gFrm->addElement('password','password1',$lang['confirm_password'],'size="20" maxlength="12"');
$gFrm->addRule('password1',$lang['please_confirm_your_password'],'required','','client');
$gFrm->addRule('password1',$lang['your_password_must_be_at_least_4'],'minlength','4');
//error message
$gFrm->addRule('password1',$lang['your_password_must_be_at_least_4'],'minlength','4','client');
$gFrm->addFormRule('cmpPass');

$gFrm->addElement('checkbox','sendmail','','','checked');

$gFrm->addElement('checkbox','termsAgree');
$gFrm->addRule('termsAgree',$lang['you_must_consent_to_the_terms_of_service'],'required');
$gFrm->addRule('termsAgree',$lang['you_must_consent_to_the_terms_of_service'],'required','','client');

$gFrm->addElement('hidden','cmd',$act);
$gFrm->addElement('submit','submit',$lang['submit_registration']);

$msgTxt = '';

if($gFrm->validate()) {
	$username = $gFrm->exportValue('username');
	$mypass = $gFrm->exportValue('password');
	$fullname = $gFrm->exportValue('fullname');
	$email = $gFrm->exportValue('email');
	$sendmail = $gFrm->exportValue('sendmail');

	if ( $username && $mypass ) {
		$formSubmitted = true;

		// check to see if the user name exists!
		if($exists = $db->getOne( "SELECT ID FROM ".dext('users')." WHERE upper(login) = upper('".$username."') or upper(email) = upper('".$email."')" )) {
			$msgTxt = "<span class=normalRed>".$lang['the_login_id_or_email_is_already_in_use']." ($username ".$lang['or'] ." $email)</span><br />";
		}

		if(!($validEmail = validEmail( $email ))) {
			$msgTxt = "<span class=normalRed>" .$lang['email_address_contains_invalid_syntax']." ($email). ".$lang['please_check_your_entry']."</span><br />";
		}
		if ( !$exists && $validEmail ) {
			$today = date( "Y-m-d" );
			// expires in about 400 years (i.e., never)..
			$expires = "2500-1-1";

			$db->query( "INSERT INTO ".dext('users')."(login,pass,name,email,created,expires) VALUES('$username','".md5($mypass)."','$fullname','$email', '$today', '$expires')" );

			if ($_POST['sendmail'] == '1') {
				// send an email to this user with the new registration informationi
				if ( $sendmail ) {
					$admin_user = $db->getRow("SELECT * FROM ".dext('users')." WHERE utype='9'" );
					$gMail->IsHTML(false);
					$gMail->SetLanguage("en", INCLUDE_DIR."phpmailer/language/");

					$gMail->AddAddress($email, "");
					$gMail->From     = $admin_user['email'];
					$gMail->FromName = $admin_user['name'];
					$gMail->Subject = $lang['your_login_information_for'].$gConf['site_title']."";

					$gMail->Body = $lang['thank_you_for_registering_with'].$gConf['site_title'].". ".$lang['your_login_information_is']."\n\n".$lang['name'].$fullname."\n".$lang['login_id'].$username."\n".$lang['password'].$mypass."\n\n".$lang['please_hold_on_to_this_email'];

					if(!$gMail->Send()){
						$msgTxt = "<span class=normalRed>".$lang['there_has_been_a_mail_error_sending_to'] . $email. ": {$gMail->ErrorInfo}</span>";
					}else {
						$msgTxt = "<span class=normal>".$lang['notification_was_sent_to'] . $email. "</span>";
					}
				}
			}
				// redirect to account page
			$_SESSION['INSP']["USER"] = $username;
			$_SESSION['INSP']["UID"] = $db->getOne('SELECT id FROM '.dext('users').' WHERE login="'.$username.'"');
			$_SESSION['INSP']["UTYPE"] = 0;
			header( "Location: ".HOME."member.php?cmd=5" );
			exit;
		}
	}
}


$gFrm->accept($gFrmR);

$t->assign('form_data',$gFrmR->toArray());


/*
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('register.tpl');
?>