<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>Account</b> could not be accessed directly!');
}
if(!(isset($_SESSION['INSP']['UID'])&&isset($_SESSION['INSP']['UTYPE']))) {
	header( "Location: ".HOME );
	exit;
}

if($_SESSION['INSP']['UTYPE'] != 0) {
	require_once('account_admin.php');	
}else {
	require_once('account_member.php');	
}

?>