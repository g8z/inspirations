<?PHP
/*
* Program entry point
* Acts as switcher/interface for calls to application
*/
if(!defined('IN_APP')) {
	define('IN_APP',1);
}

// Gather configuration parameters && Gather initialization code
require_once('./config.php');

$dbHost = DB_HOST;
if(isset($dbHost) == false||$dbHost=='{DB_HOST}') { //no installation done
	$inst_dir = INSTALL_DIR;
	require_once('./index_install.php');
	exit;
}

/* Include all iitialization parameters */
require_once(INCLUDE_DIR.'init.php');


$vars = array('25|auto_approve|N', '26|allow_edit|Y');
foreach ($vars as $var) {
	$v = explode("|",$var);
	$row = $db->getOne('SELECT vvalue FROM '.get_db_ext('sysvars').' WHERE vname="'.$v[1].'"');
	if ($row == "") {
		echo "<b>".$v[1]."</b> variable: <b>inserted</b><br />";
		$sql1 = "INSERT INTO ".get_db_ext('sysvars')." VALUES('".$v[0]."','".$v[1]."','".$v[2]."')";
		mysql_query($sql1) or die(mysql_error());
	} else
		echo "<b>".$v[1]."</b> variable: already exists<br />";
}
echo "<br />";
die("Database Upgraded to Version: v3.pd.1, hope you have replaced the files! Remove this script and enjoy the changes :)");

?>
