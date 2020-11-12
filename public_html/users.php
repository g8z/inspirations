<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>This Program</b> could not be accessed directly!');
}
if(!checkSession(1)) {
	header( "Location: ".HOME."index.php?cmd=3" );
	exit;
}

$intVars['content'] = '';

$gFrm = new HTML_QuickForm('myForm','post');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');
$msgTxt = '';

$gFrm->addElement('hidden','cmd',$act);

function make_first() {
	global $db,$gFrm,$lang;
	$usersByName = array(""=>$lang['select']);
	foreach($rows = $db->getAll("SELECT ID, login FROM ".dext('users')." WHERE utype<>9 ORDER BY login ASC") as $row) {
		$usersByName[$row['ID']] = $row['login'];
	}
	$usersByEmail = array(""=>$lang['select']);
	foreach($db->getAll("SELECT ID, email FROM ".dext('users')." WHERE utype<>9 ORDER BY email ASC") as $row) {
		$usersByEmail[$row['ID']] = $row['email'];
	}
	$gFrm->addElement('select','userID1','',$usersByName);
	$gFrm->addElement('select','userID2','',$usersByEmail);
	$gFrm->addElement('submit','submit',$lang['continue']);
}

function make_second($user_id) {
	global $db,$gFrm,$gPaths,$lang;

	if(!$user_data = $db->getRow('SELECT * FROM '.dext('users').' WHERE ID="'.$user_id.'"')) {
		header( "Location: ".HOME."admin.php?cmd=6" );
		exit;
	}

	$gFrm->addElement('text','fullname',$lang['real_name:'],'size="30" value="'.$user_data['name'].'"');
	$gFrm->addRule('fullname',$lang['please_enter_name'],'required');
	$gFrm->addRule('fullname',$lang['please_enter_name'],'required','','client');

	$gFrm->addElement('text','email',$lang['user_email_address'],'size="30" maxlength="100" value="'.$user_data['email'].'"');
	$gFrm->addRule('email',$lang['please_enter_an_email_address'],'required');
	$gFrm->addRule('email',$lang['please_enter_an_email_address'],'required','','client');
	$gFrm->addRule('email',$lang['please_enter_valid_email'],'email','','client');

	$gFrm->addElement('text','username',$lang['login_id'],'size="20" maxlength="12" value="'.$user_data['login'].'"');
	$gFrm->addRule('username',$lang['please_enter_username'],'required','','client');
	$gFrm->addRule('username',$lang['your_login_name_must_be_at_least_4'],'minlength','4');
	$gFrm->addRule('username',$lang['your_login_name_must_be_at_least_4'],'minlength','4','client');

	$gFrm->addElement('password','password',$lang['password'],'size="20" maxlength="12"');
	$gFrm->addRule('password',$lang['your_password_must_be_at_least_4'],'minlength','4');
	$gFrm->addRule('password',$lang['your_password_must_be_at_least_4'],'minlength','4','client');
	if ($user_data['utype'] > 0) {
		$gFrm->addElement('checkbox','removeadmin',$lang['remove_admin'],'','');
	} else {
		$gFrm->addElement('checkbox','makeadmin',$lang['make_as_admin'],'','');	
	}
	$gFrm->addElement('checkbox','sendmail','','','');
	$gFrm->addElement('checkbox','removeSubmissions');
	$gFrm->addElement('checkbox','setExpire','','');
	
	$gFrm->setDefaults(array('expire'=>array('d'=>date("d"),'M'=>date("M"),'Y'=>date("Y")+1)));
	$gFrm->addElement('date','expire','',array('language'=>'en','format'=>'dMY','minYear'>date("Y"),'maxYear'=>date("Y")+10));

	$gFrm->addElement('submit','submit',$lang['update']);
	$gFrm->addElement('submit','remove',$lang['remove']);
	$gFrm->addElement('button','back',$lang['back'],array('onClick'=>'javascript:window.document.location=\''.HOME.'admin.php?cmd=6\';'));
	$gFrm->addElement('reset','reset',$lang['reset']);
}

if(isset($_POST['form'])==false||$_POST['form']!='second') {
	make_first();
}


$user_id = $userID1 = $userID2 = 0;
if(isset($_POST['form'])&&$_POST['form']=='first') {
	if($gFrm->validate()) {
		$userID1 = $gFrm->exportValue('userID1');
		$userID2 = $gFrm->exportValue('userID2');
		if($userID1||$userID2) {
			$t->assign('user_id',(($userID1?$userID1:$userID2)));
			$_POST['form'] = 'second';
			make_second((($userID1?$userID1:$userID2)));
		}
	}	
}elseif(isset($_POST['form'])&&$_POST['form']=='second') {
	$user_id = isset($_POST['userID'])?(int)$_POST['userID']:0;
	make_second($user_id);
	$t->assign('user_id',$user_id);

	if($gFrm->validate()) {
		$fEls = $gFrm->exportValues();
		//echo '<pre>';		print_r($fEls);
		if($user_data = $db->getRow('SELECT * FROM '.dext('users').' WHERE ID="'.$user_id.'"')) {
			if($user_data['login']==$fEls['fullname']&&$user_data['ID']!=$user_id) {
				$msgTxt = "<span class=normalRed>".$lang['the_login_id_that_you'] .$user_data['login'].$lang['is_already_in_use']. "</span><br />";
			}else {
				if(isset($fEls['submit'])) {
					$adminflag= "";
					if ($fEls['makeadmin'] && $user_data['utype'] == '0') {
						$adminflag = " , utype = '1' ";		
					} elseif ($fEls['removeadmin'] && $user_data['utype'] != '0') {
						$adminflag = " , utype = '0' ";		
					}
					$db->query( "UPDATE ".dext('users')." SET login = '".$fEls['username']."', name = '".$fEls['fullname']."', email = '".$fEls['email']."' ".$adminflag." WHERE ID = ".$user_id );
					if($fEls['password']) {
						$db->query( "UPDATE ".dext('users')." SET pass= '".md5($fEls['password'])."' WHERE ID = ".$user_id );
					}
					// update expiration, if specified
					list($day, $month, $year) = explode('/',implode('/',$fEls['expire']));
					if ( $month && $day && $year && isset($fEls['setExpire'])&&$fEls['setExpire']==1) {
						$expires = "$year-$month-$day";
						$db->query( "UPDATE ".dext('users')." SET expires = '$expires' WHERE ID = ".$user_id );
					}
					$msgTxt .= "<br /><span class=normal>".$lang['profile_updated']."</span>";
					// send an email to this user with the new registration informationi
					if ( isset($fEls['sendmail'])&&$fEls['sendmail']==1) {
						$admin_user = $db->getRow("SELECT * FROM ".dext('users')." WHERE utype='9'" );
						$gMail->IsHTML(false);
						$gMail->SetLanguage("en", INCLUDE_DIR."phpmailer/language/");

						$gMail->AddAddress($fEls['email'], "");
						$gMail->From		 = $admin_user['email'];
						$gMail->FromName = $admin_user['name'];
						$gMail->Subject = $lang['your_login_information_for'].$gConf['site_title']."";

						$gMail->Body = $lang['your_updated_login_information_for'].$gConf['site_title'].$lang['is']. "\n\n".$lang['name'].$fEls['fullname']."\n".$lang['login_id'].$fEls['username']."".($fEls['password']?"\n".$lang['password'].$fEls['password']. "":"")."\n\n".$lang['please_hold_on_to_this_email'];

						if(!$gMail->Send()){
							$msgTxt .= "<br /><span class=normalRed>".$lang['there_has_been_a_mail_error_sending_to'] . $fEls['email']. ": {$gMail->ErrorInfo}</span>";
						}else {
							$msgTxt .= "<br /><span class=normal>".$lang['notification_was_sent_to'] . $fEls['email']. "</span>";
						}
					}

				}elseif(isset($fEls['remove'])) {
					$db->query( "DELETE from ".dext('users')." WHERE ID = ".$user_id );
					if ( isset($fEls['removeSubmissions'])&&$fEls['removeSubmissions']==1 ){
						$db->query( "DELETE from ".dext('items')." WHERE user = '".$user_data['login']."'" );
					}
					header( "Location: ".HOME."admin.php?cmd=6");
					exit;
				}
			}
		}
	}
}



$gFrm->accept($gFrmR);

$t->assign('form_data',$gFrmR->toArray());

$t->assign('utype',$user_data['utype']);
	
/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('admin_users.tpl');
?>