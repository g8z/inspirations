<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> Invalid access </b> could not be accessed directly!');
}
/* If comments are not allowed go home */
if ($gConf['allow_comments'] != 'Y' ) {
	header( "Location: ".HOME."index.php?cmd=1" );
	exit;
}

$intVars['content'] = '';

if(isset($_POST['ID'])&&$_POST['ID']) {
	$_GET['ID'] = $_POST['ID'];
}
/* If not item ID, go home */
if(!$_GET['ID'] AND !$_GET['sID']) {
	header( "Location: ".HOME."index.php?cmd=1" );
	exit;
}

if(isset($_GET['sID'])) { // disable comments for an item and return to item with comments
	$db->query('UPDATE '.dext('items').' SET allow_comments = "N" WHERE id="'.(int)$_GET['sID'].'"');
	header( "Location: ".HOME."index.php?cmd=21&ID=".(int)$_GET['sID'] );
	exit;
}


$cur_page = $intVars['cur_page'];
$comments_per_page = (int)$gConf['comments_per_page'];

//set up paging
$paging = array();
$paging['items_total'] = $db->getOne('SELECT COUNT(*) FROM '.dext('comments').' WHERE item="'.(int)$_GET['ID'].'"');

if($paging['items_total']>($cur_page+$comments_per_page)) {
	$paging['item_next'] = $cur_page+$comments_per_page;	
}else {
	$paging['item_next'] = -1;
}
if(($cur_page-$comments_per_page)>=0) {
	$paging['item_prev'] = $cur_page-$comments_per_page;	
}else {
	$paging['item_prev'] = -1;
}
$paging['item_cur'] = $cur_page;

$paging['page_start'] = ($cur_page/$comments_per_page)*$comments_per_page+1;
$paging['page_end'] = $paging['page_start'] + $comments_per_page - 1;
$paging['page_end']  = $paging['page_end']<=$paging['items_total']?$paging['page_end']:$paging['items_total'];
$paging['comments_end']  = ($paging['page_end']+$comments_per_page)>$paging['items_total']?($paging['items_total'] - $paging['page_end']):$comments_per_page;


//$item = array();
$item = $db->getRow('SELECT * FROM '.dext('items').' WHERE confirmed=1 AND ID="'.(int)$_GET['ID'].'"');
$item['created'] = date(str_replace("%","",$gConf['date_format']),strtotime($item["created"]));
$item['text']=nl2br($item['text']);
$item['title']=html_entity_decode($item['title']);
$item['text']=html_entity_decode($item['text']);
$item['user_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="'.$item['user'].'"');
if ($item['user_data']['ID']== $intVars['uid'] OR checkSession(1) OR checkSession(9)) {
	$item['stop_comments'] = true;
	if (getVar("allow_edit")=="Y") $item['edit'] = true;
}

$comments_sort_ar = array('0'=>'ASC','1'=>'DESC');
$comments = array();
foreach($db->getAll('SELECT * FROM '.dext('comments').' WHERE item="'.(int)$_GET['ID'].'" ORDER BY created '.$comments_sort_ar[$comments_sort].',id '.$comments_sort_ar[$comments_sort].' LIMIT '.$cur_page.','.$comments_per_page.'') as $key=>$row) {
	$row['text']=nl2br($row['text']);
	$row['title']=html_entity_decode($row['title']);
	$row['text']=html_entity_decode($row['text']);
	$row['created'] = date(str_replace("%","",$gConf['date_format']),strtotime($row['created']));
	$comments[$key] = $row;
	$comments[$key]['user_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE ID="'.$row['user_id'].'"');
	if ($comments[$key]['user_data']['ID']== $intVars['uid'] OR checkSession(1) OR checkSession(9)) $comments[$key]['edit'] = true;
	}
	
 $paging['comments_sort'] = $lang['comments_order'][$comments_sort]." - <a href='".$cale."sort=".abs((int)$comments_sort - 1).str_replace('&','&amp;',$parm)."'>".$lang['comments_order']['2']."</a>";

$t->assign('item',$item);
$t->assign('comments',$comments);
$t->assign('paging',$paging);
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('comments.tpl');

?>