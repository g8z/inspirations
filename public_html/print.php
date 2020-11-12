<?PHP
if(!defined('IN_APP')) {
	die($lang['malicious_request_invalid_access']);
}

//$intVars['content'] = '';

if(isset($_GET['ID'])&&$_GET['ID']) {
	if($item = $db->getAll('SELECT * FROM '.dext('items').' WHERE confirmed=1 AND ID="'.(int)$_GET['ID'].'" ORDER BY created DESC,id DESC')) {
		list($item) = $item;
		$item['user_data'] = $db->getRow('SELECT * FROM '.dext('users').' WHERE login="'.$item['user'].'"');
		$item['created'] = date(str_replace("%","",$gConf['date_format']),strtotime($item['created']));
		$t->assign('item_data',$item);
		$t->assign('auto_print',$autoPrint);
		$t->display('print.tpl');
	}
}

/*
echo '<pre>';
print_r($gFrmR->toArray());
//*/
//$intVars['content'] = $t->fetch('search.tpl');
?>