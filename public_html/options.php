<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>This program</b> could not be accessed directly!');
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

$tpls = array();
$d = dir(APPIHTML.'themes');
while (false !== ($entry = $d->read())) {
	if($entry!='.'&&$entry!='..') {
		$tpls[$entry] = $entry;
	}
}
$d->close();

$display_types = array("DHTML Tree"=>$lang['dhtml_tree'], "HTML Tree"=>$lang['html_tree'], "Bulleted HTML Tree"=>$lang['bulleted_html_tree'], "DHTML Menu"=>$lang['dhtml_menu']);

$gFrm->addElement('select','siteTheme','',$tpls,' style="width:200px;"');
$gFrm->addElement('select','category_display','',$display_types,'style="width:200px;"');

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'allow_picture_uploads', 'Yes/No');
$radio = array();

$gFrm->addElement('text','max_picture_size','','size="5"');

$gFrm->addElement('text','max_picture_width','','size="5"');
$gFrm->addRule('max_picture_width',$lang['please_enter_picture_width'],'required');
$gFrm->addRule('max_picture_width',$lang['please_enter_picture_width'],'required','','client');

$gFrm->addElement('text','max_picture_height','','size="5"');
$gFrm->addRule('max_picture_height',$lang['please_enter_picture_height'],'required');
$gFrm->addRule('max_picture_height',$lang['please_enter_picture_height'],'required','','client');

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'hide_user_emails', 'Yes/No');
$radio = array();

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['enabled'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['disabled'], 'N');
$gFrm->addGroup($radio, 'allow_member_counter', 'Yes/No');
$radio = array();

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['enabled'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['disabled'], 'N');
$gFrm->addGroup($radio, 'enable_member_mail_notify', 'Yes/No');
$radio = array();

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'admin_notify', 'Yes/No');
$radio = array();

// Added by Swaroop(PHP Duo) #4 & #5  v3.pd.1 Ref #4 & #5
// Having admin options to auto approve posts and allowing people to edit their contributions.

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'auto_approve', 'Yes/No');
$radio = array();

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'allow_edit', 'Yes/No');
$radio = array();

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'allow_comments', 'Yes/No');
$radio = array();

$gFrm->addElement('text','admin_name','','size="30"');
$gFrm->addRule('admin_name',$lang['please_enter_name'],'required');
$gFrm->addRule('admin_name',$lang['please_enter_name'],'required','','client');

$gFrm->addElement('text','admin_email','','size="30" maxlength="100"');
$gFrm->addRule('admin_email',$lang['please_enter_an_email_address'],'required');
$gFrm->addRule('admin_email',$lang['please_enter_an_email_address'],'required','','client');
$gFrm->addRule('admin_email',$lang['please_enter_valid_email'],'email','','client');

$gFrm->addElement('text','admin_login_id','','size="20" maxlength="12"');
$gFrm->addRule('admin_login_id',$lang['please_enter_username'],'required','','client');
$gFrm->addRule('admin_login_id',$lang['your_login_name_must_be_at_least_4'],'minlength','4');
$gFrm->addRule('admin_login_id',$lang['your_login_name_must_be_at_least_4'],'minlength','4','client');



// the function checks whether the passwords are the same
function cmpPass($fields){
	global $lang;
		if (strlen($fields['admin_password1']) && strlen($fields['admin_password']) &&
				$fields['admin_password1'] != $fields['admin_password']) {
				return array('admin_password1' => $lang['passwords_are_not_the_same']);
		}
		return true;
}
$gFrm->addElement('password','admin_password','','size="20" maxlength="12"');
$gFrm->addRule('admin_password',$lang['your_admin_password_must_be_at_least_4'],'minlength','4');
$gFrm->addRule('admin_password',$lang['your_admin_password_must_be_at_least_4'],'minlength','4','client');

$gFrm->addElement('password','admin_password1','','size="20" maxlength="12"');
$gFrm->addRule('admin_password1',$lang['your_admin_password_must_be_at_least_4'],'minlength','4');
$gFrm->addRule('admin_password1',$lang['your_admin_password_must_be_at_least_4'],'minlength','4','client');

$gFrm->addFormRule('cmpPass');

if($admin_data = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="admin"')) {
	$gConf['admin_email'] = $admin_data['email'];	
	$gConf['admin_name'] = $admin_data['name'];	
	$gConf['admin_login_id'] = $admin_data['login'];	
	//$gConf['admin_password'] = $admin_data['email'];	
}else {
	$gConf['admin_email'] = '';	
	$gConf['admin_name'] = '';	
	$gConf['admin_login_id'] = '';	
	//$gConf['admin_password'] = $admin_data['email'];	
}

$gFrm->addElement('text','items_per_page','','size="5"');
$gFrm->addRule('items_per_page',$lang['please_enter_items_per_page'],'required');
$gFrm->addRule('items_per_page',$lang['please_enter_items_per_page'],'required','','client');

$gFrm->addElement('text','comments_per_page','','size="5"');
$gFrm->addRule('comments_per_page',$lang['please_enter_comments_per_page'],'required');
$gFrm->addRule('comments_per_page',$lang['please_enter_comments_per_page'],'required','','client');

$gFrm->addElement('text','site_title','','size="50"');
$gFrm->addElement('text','date_format','','size="25"');
$gFrm->addElement('textarea','site_footer','',' cols=60 rows=8');
$gFrm->addElement('textarea','terms_of_service','',' cols=60 rows=8');

$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'smtp');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'mail');
$gFrm->addGroup($radio, 'mailer_type', 'Yes/No');
$radio = array();
$gFrm->addElement('text','smtp_host','','size="25"');
$gFrm->addElement('text','smtp_username','','size="25"');
$gFrm->addElement('text','smtp_password','','size="25"');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
$gFrm->addGroup($radio, 'smtp_auth', 'Yes/No');
$radio = array();

$gFrm->addElement('submit','submit',$lang['update'],'');


if($gFrm->validate()) {
	foreach($gConf as $key=>$val) {
			setVar($key,$gFrm->exportValue($key));
	}
	if($it = $gFrm->exportValue('admin_name')) {
		$db->query('UPDATE '.dext('users').' SET name="'.$it.'" WHERE login="admin" ');
	}
	if($it = $gFrm->exportValue('admin_email')) {
		$db->query('UPDATE '.dext('users').' SET email="'.$it.'" WHERE login="admin" ');
	}
//	if($it = $gFrm->exportValue('admin_login_id')) {
//		$db->query('UPDATE '.dext('users').' SET login="'.$it.'" WHERE utype="1" ');
//	}
	if(($it = $gFrm->exportValue('admin_password'))&&$gFrm->exportValue('admin_password')!='') {
		$db->query('UPDATE '.dext('users').' SET pass="'.md5($it).'"	WHERE login="admin" ');
	}
	header( "Location: ".HOME."admin.php?cmd=7" );
	exit;
}

$gFrm->setDefaults($gConf);

$gFrm->accept($gFrmR);

$t->assign('form_data',$gFrmR->toArray());


	
/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('admin_options.tpl');
?>