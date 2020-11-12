<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}

$intVars['content'] = '';
$msgTxt = '';

//do house keeping...remove items which are not binded to categories
$ids = array();
foreach($db->getAll('SELECT DISTINCT(ID) FROM '.dext('categories').'') as $row) {
	$ids[] = $row['ID'];
}
if(count($ids)) {
	$db->query('DELETE FROM '.dext('items').' WHERE category NOT IN("'.implode('","',$ids).'")');
}

//remove comments which are not binded to inspirations
$ids = array();
foreach($db->getAll('SELECT DISTINCT(ID) FROM '.dext('items').'') as $row) {
	$ids[] = $row['ID'];
}
if(count($ids)) {
	$db->query('DELETE FROM '.dext('comments').' WHERE item NOT IN("'.implode('","',$ids).'")');
}


$cat = $intVars['category'];
$cur_page = $intVars['cur_page'];
$items_per_page = (int)$gConf['items_per_page'];
$search = isset($intVars['search'])?$intVars['search']:array();

$que = 'SELECT {ITEM} FROM '.dext('items').' WHERE confirmed=1 ';
if(isset($search['search_key'])) {
	$search['search_key'] = addslashes($search['search_key']);
}
if(count($search)!=0&&$search['submitted']==1) {
	$s_que = array();

	if($search['search_cat']) {//category is definged where to search
		$s_que[] = 'category="'.$cat.'"';
	}
	
	if($search['search_match_type']=='exact') {// no need to explode by word
		$sword = trim($search['search_key']);
		switch($search['search_type']) {
			case 'title':
				$s_que[] = '( title LIKE "%'.$sword.'%" )';
			break;
			case 'text':
				$s_que[] = '( text LIKE "%'.$sword.'%" )';
			break;
			case 'author':
				$s_que[] = '( author LIKE "%'.$sword.'%" )';
			break;
			default:
				$s_que[] = '( text LIKE "%'.$sword.'%" )';
				$s_que[count($s_que)-1] .= ' OR ( author LIKE "%'.$sword.'%" )';
				$s_que[count($s_que)-1] .= ' OR ( title LIKE "%'.$sword.'%" )';
			break;
		}
	}else {
		$swords = explode(" ",$search['search_key']);
		if(count($swords)!=0) {
			$connector = ($search['search_match_type']=='any')?'OR':'AND';
			$sphrase = '';
			foreach($swords as $sword) {
				if(trim($sword)) {
					switch($search['search_type']) {
						case 'title':
							$sphrase .= ' ( title LIKE "%'.$sword.'%" ) '.$connector;
						break;
						case 'text':
							$sphrase .= ' ( text LIKE "%'.$sword.'%" ) '.$connector;
						break;
						case 'author':
							$sphrase .= ' ( author LIKE "%'.$sword.'%" ) '.$connector;
						break;
						default:
							$sphrase .= ' ( text LIKE "%'.$sword.'%" OR author LIKE "%'.$sword.'%" OR title LIKE "%'.$sword.'%") '.$connector;
						break;
					}        	
				}
			}
			if(trim($sphrase)!="") {
				$s_que[] = str_replace($connector.'|',' ',$sphrase.'|');
			}
		}
	}
	$s_que = trim(implode(') AND (',$s_que));
	if(trim($s_que)!="") {
		$que .= ' AND ('.$s_que.')';
	}
}else {
	if($cat!=0) {
		$que .= ' AND category="'.$cat.'"';
	}
}

$que_raw = $que;
$que .= 'ORDER BY created DESC,id DESC LIMIT '.$cur_page.','.$items_per_page;

//set up paging
$paging = array();
$paging['items_total'] = $db->getOne(str_replace('{ITEM}','COUNT(*)',$que_raw));

if($paging['items_total']>($cur_page+$items_per_page)) {
	$paging['item_next'] = $cur_page+$items_per_page;	
}else {
	$paging['item_next'] = -1;
}
if(($cur_page-$items_per_page)>=0) {
	$paging['item_prev'] = $cur_page-$items_per_page;	
}else {
	$paging['item_prev'] = -1;
}
$paging['item_cur'] = $cur_page;

$paging['page_start'] = ($cur_page/$items_per_page)*$items_per_page+1;
$paging['page_end'] = $paging['page_start'] + $items_per_page - 1;
$paging['page_end']  = $paging['page_end']<=$paging['items_total']?$paging['page_end']:$paging['items_total'];
$paging['items_end']  = ($paging['page_end']+$items_per_page)>$paging['items_total']?($paging['page_end'] - $paging['page_start']):$items_per_page;


$comments = array();
$items = array();
foreach($db->getAll(str_replace('{ITEM}','*',$que)) as $key=>$row) {
	$row['text']=nl2br($row['text']);
	$row['title']=html_entity_decode($row['title']);
	$row['text']=html_entity_decode($row['text']);
	$row["created"] = date(str_replace("%","",$gConf['date_format']),strtotime($row["created"]));
	$items[$key] = $row;
	$items[$key]['user_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="'.$row['user'].'"');
	// Added by Swaroop(PHP Duo) #5 v3.pd.1 Ref #5
	// A popular request to add the option for user to edit inspirations.
	if (($items[$key]['user_data']['ID']== $intVars['uid'] OR checkSession(1) OR checkSession(9))
	     AND getVar("allow_edit")=="Y") $items[$key]['edit'] = true;

	$comments[$key]['total'] = $db->getOne('SELECT COUNT(*) FROM '.dext('comments').' WHERE item='.$row['ID'].'');
    
}



$t->assign('items',$items);

$t->assign('top_message',$msgTxt);
$t->assign('paging',$paging);
$t->assign('comments',$comments);
$intVars['content'] = $t->fetch('inspirations.tpl');
?>