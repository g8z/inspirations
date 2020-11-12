<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>Member Account</b> could not be accessed directly!');
}
if(!(isset($_SESSION['INSP']['UID'])&&isset($_SESSION['INSP']['UTYPE'])&&$_SESSION['INSP']['UTYPE']==0)) {
	$intVars['content'] = $lang['access_denied'];
}

$intVars['content'] = '';
$msgTxt = '';

$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('account_member.tpl');

?>