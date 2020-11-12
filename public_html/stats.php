<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>This Program</b> could not be accessed directly!');
}

if(!checkSession(0)) {
	header( "Location: ".HOME."index.php?cmd=3" );
	exit;
}


$intVars['content'] = '';
$msgTxt = '';

$items = array();
foreach($db->getAll("SELECT ID,title,category FROM ".dext('items')." WHERE user='".$_SESSION['INSP']['USER']."'") as $row) {
	$row['cat_name'] = $db->getOne("SELECT name FROM ".dext('categories')." WHERE ID='".$row['category']."'");
	$row['num'] = $db->getOne("SELECT COUNT(*) FROM ".dext('view_ip')." WHERE item_id='".$row['ID']."'");
	$row['comments'] = $db->getOne("SELECT COUNT(*) FROM ".dext('comments')." WHERE item='".$row['ID']."'");
	$items[] = $row;
}

$t->assign('top_message',$msgTxt);

$t->assign('items',$items);
$intVars['content'] = $t->fetch('member_stats.tpl');

?>