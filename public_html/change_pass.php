<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}

$intVars['content'] = '';

$gFrm = new HTML_QuickForm('loginForm','post'); //default form object..pages may initialize additional objects
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

$gFrm->addElement('password','passwordold',$lang['enter_your_old_password'],'size="20" maxlength="12"');
$gFrm->addRule('passwordold',$lang['please_enter_your_old_password'],'required','','client');
$gFrm->addRule('passwordold',$lang['your_password_must_be_at_least_4'],'minlength','4');
$gFrm->addRule('passwordold',$lang['your_password_must_be_at_least_4'],'minlength','4','client');

$gFrm->addElement('password','passwordnew',$lang['choose_a_password_4_12'],'size="20" maxlength="12"');
$gFrm->addRule('passwordnew',$lang['please_enter_your_password'],'required','','client');
$gFrm->addRule('passwordnew',$lang['your_password_must_be_at_least_4'],'minlength','4');
$gFrm->addRule('passwordnew',$lang['your_password_must_be_at_least_4'],'minlength','4','client');

$gFrm->addElement('password','passwordnew1',$lang['confirm_password'],'size="20" maxlength="12"');
$gFrm->addRule('passwordnew1',$lang['please_confirm_your_password'],'required','','client');
$gFrm->addRule('passwordnew1',$lang['your_password_must_be_at_least_4'],'minlength','4');
$gFrm->addRule('passwordnew1',$lang['your_password_must_be_at_least_4'],'minlength','4','client');


$gFrm->addElement('hidden','cmd',$act);
$gFrm->addElement('hidden','not_match',$lang['password_confirmation_does_not_match']);
$gFrm->addElement('submit','submit',$lang['submit_changes']);

$msgTxt = '';


function chkOldPass($password) {
    global $db;
    $row = $db->getOne('SELECT pass FROM '.dext('users').' WHERE id="'.$_SESSION['INSP']['UID'].'"');
	if($row) {
		return $row == md5($password) ? true : false;
	} else {
		$msgTxt = $lang['error_accessing_database.'];
		return false;
	}
}

if ( !chkOldPass( $_POST['passwordold'] ) && $_POST['passwordold'] != '' ) {
	//$t->assign( 'oldPassInvalid', true );

	$msgTxt = '<span class=normalRed>'.$lang['old_password_does_not_seem_to_be_correct'].'</span>';
	$gFrm->setDefaults($defaults);
}
else if ( $_POST['passwordold'] ) {
	$qry = 'UPDATE '.dext('users').' SET pass = "'.md5($gFrm->exportValue('passwordnew')).'" WHERE id="'.$_SESSION['INSP']['UID'].'"';
	$query = $db->query("$qry");
	if (DB::isError ($query)) {
		$msgTxt = $lang['error_accessing_database.'];
	}
	else {
		$msgTxt = '<span class=normalRed>'.$lang['your_password_has_been_changed'].'</span>';
	}
}


$gFrm->accept($gFrmR);

$t->assign('form_data',$gFrmR->toArray());

/*
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('change_pass.tpl');
?>