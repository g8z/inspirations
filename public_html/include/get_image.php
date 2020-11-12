<?PHP
if(!defined('IN_APP')) {
	define('IN_APP',1);	
}

// Gather configuration parameters && Gather initialization code
require_once("./../config.php");
require_once(INCLUDE_DIR."init.php");
	
$ID = isset($_GET['ID'])?(int)$_GET['ID']:0;
$query = "SELECT image_data, image_mime_type FROM ".dext('items')." WHERE ID = '".$ID."'";
$record = $db->getRow($query);
$image_data = $record['image_data'];
$image_mime_type = $record['image_mime_type'];
	
header ("Content-Type: $image_mime_type");
echo $image_data;
?>