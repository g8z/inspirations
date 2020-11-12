<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>Search</b> could not be accessed directly!');
}

//$intVars['content'] = '';

if(isset($_GET['cat'])) {
	$_POST['search_cat'] = (int)$_GET['cat'];
}

if(isset($_GET['search_key'])) {
	$_POST['search_key'] = strtr($_GET['search_key'],array_flip(get_html_translation_table(HTML_ENTITIES)));;
}

if(isset($_GET['search_type'])) {
	$_POST['search_type'] = $_GET['search_type'];
}

if(isset($_GET['search_match_type'])) {
	$_POST['search_match_type'] = $_GET['search_match_type'];
}

$gFrm = new HTML_QuickForm('searchForm','post');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

$gFrm->addElement('hidden','cmd',1);
$gFrm->addElement('hidden','search_submitted',1);
$defaults = array();


$list_raw = $list = buildTree();
foreach($list as $key=>$val) {
	$list[$key] = str_replace('*','&#8226;&nbsp;',$val);	
	//$list[$key] .= ' ('.(int)$db->getOne('SELECT COUNT(ID) FROM '.dext('items').' WHERE category = '.$key.' AND confirmed = 1').')';	
}

$list = array("0"=>$lang['all_categories']) + $list;
$opts['style'] = '';
$gFrm->addElement('select','search_cat','',$list,$opts);
$gFrm->addElement('select','search_type','',array("all"=>$lang['all_sections'],'title'=>$lang['title'],'text'=>$lang['text'],'author'=>$lang['author']),$opts);
$gFrm->addElement('select','search_match_type','',array('any'=>$lang['any_word'],'all'=>$lang['all_words'],'exact'=>$lang['exact_match']),$opts);
$gFrm->addElement('text','search_key','','size=30');
$gFrm->addElement('submit','submit',$lang['search'],'');


if($gFrm->validate()) {
	//$gFrm->freeze();
	$gFrm->process('process_search',false);
}else {
	$gFrm->setDefaults($defaults);	
}
function process_search($values) {
	global $t,$intVars;
	$values['submitted'] = (isset($_POST['search_submitted'])||isset($_GET['search_submitted']))?1:0;
	$t->assign('search',$values);
	$intVars['search'] = $values;
}

$gFrm->accept($gFrmR);
$t->assign('form_search',$gFrmR->toArray());

//language select (Gary_Star)
$gFrmL = new HTML_QuickForm('langForm','post');
$gFrmL->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

if (!$intVars['uid']) $intVars['uid'] = '0';
$user = $db->getOne('SELECT login FROM '.dext('users').' WHERE id='.$intVars['uid'].'');
$t->assign('user',$user);


/*
echo '<pre>';
print_r($gFrmR->toArray());
//*/
//$intVars['content'] = $t->fetch('search.tpl');
?>