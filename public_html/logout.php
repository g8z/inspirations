<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>Invalid access, </b> could not be accessed directly!');
}

$intVars['content'] = '';

session_unregister( "INSP" );
$_SESSION = array();
@session_destroy();

	
/*
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$intVars['content'] = $t->fetch('logout.tpl');
header( "Location: ".HOME."index.php" );
exit;

?>