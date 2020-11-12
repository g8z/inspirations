<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>This procedure</b> could not be accessed directly!');
}
if(!(isset($_SESSION['INSP']['UID'])&&isset($_SESSION['INSP']['UTYPE'])&&$_SESSION['INSP']['UTYPE']==1)) {
	$intVars['content'] = $lang['access_denied'];
}

$intVars['content'] = '';
$msgTxt = '';
die("change admin");
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('changepass.tpl');
?>