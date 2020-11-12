<?PHP

/*
A Replica of manage_item.php to allow users to edit their inspirations if allowed.
I didn't edit manage_item.php because it would complicated the script.
There might be a few parts of manage_item.php which neednt be here as they hold no use, you may freely remove them at your risk!
I shall try to make it cleaner in the next release.
--
Swaroop (PHP Duo)
Created for Inspiration V3.pd.1 #5, Ref #5
*/

if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}


$intVars['content'] = '';
$msgTxt = '';

$found=true;
if (getVar("allow_edit")=="N")
{
	$msgTxt = '<span class="normalRed">'.$lang['you_cannot_edit_inspirations'].'</span>';
	$found=false;
}
else
{

$_GET += $_POST;

if(isset($_POST['item_id'])) {
	$_GET['list_items'] = $_POST['item_id'];
	//$_GET['inputc'] = $_POST['item_id'];
}
if(isset($_GET['inputc'])&&$_GET['inputc']!=""&&(!isset($_POST['category']))) {
	if($it=$db->getAll('SELECT category,user FROM '.dext('items').' WHERE id="'.(int)$_GET['inputc'].'"')) {
		$_GET['list'] = $it;
		$_GET['list_items'] = $_GET['inputc'];
	}else {
		$msgTxt = '<span class="normalRed">'.$lang['item_not_found'].'</span>';
		$_GET['list'] = '';
		$_GET['list_items'] = '';
	}
}

if (strtolower($it[0]['user'])!=strtolower($user))
{
	$msgTxt = '<span class="normalRed">'.$lang['item_not_found'].'</span>';
	$found=false;
}
}
if ($found)
{
$gFrm1 = new HTML_QuickForm('myForm1','get');
$gFrm1->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm1->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');
$gFrm = new HTML_QuickForm('myForm','post');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');


$gFrm1->addElement('hidden','cmd',$act);
$gFrm->addElement('hidden','cmd',$act);



$defaults = array();
$list_raw = $list = buildTree();
foreach($list as $key=>$val) {
	$list[$key] = str_replace('*','&#8226;&nbsp;',$val);	
	$list[$key] .= ' ('.(int)$db->getOne('SELECT COUNT(ID) FROM '.dext('items').' WHERE category = '.$key.' AND confirmed = 1').')';	

}

$list = array(""=>$lang['select_category']) + $list;
$opts['style'] = 'width:250px;';
$opts_c['onchange'] = "javascript:window.document.location='index.php?cmd=$act&list='+this.options[this.selectedIndex].value;";
$gFrm1->addElement('select','list','',$list,$opts+$opts_c);
$list_items = array();
if($it = $gFrm1->exportValue('list')) {
	foreach($db->getAll('SELECT ID,title FROM '.dext('items').' WHERE category="'.$it.'" AND confirmed=1') as $row) {
		$list_items[$row['ID']] = stripslashes(html_entity_decode($row['title'],ENT_QUOTES));
	}
}
$list_items = array(""=>$lang['select_contribution']) + $list_items;
$gFrm1->addElement('select','list_items','',$list_items,$opts);

$gFrm1->addElement('text','inputc','',$opts);

$gFrm1->setDefaults($defaults);

$gFrm1->addElement('submit','submit',$lang['locate'],'');


$item_id = 0;
if(isset($_POST['list_items'])&&$_POST['list_items']) {
	$item_id = (int) $_POST['list_items'];
}
if(isset($_GET['list_items'])&&$_GET['list_items']) {
	$item_id = (int) $_GET['list_items'];
}
if(isset($_POST['inputc'])&&$_POST['inputc']) {
	$item_id = (int) $_POST['inputc'];
}
if(isset($_GET['inputc'])&&$_GET['inputc']) {
	$item_id = (int) $_GET['inputc'];
}

$defaults = array();

if($row = $db->getRow('SELECT * FROM '.dext('items').' WHERE ID="'.$item_id.'"')) {
	$list = buildTree();
	foreach($list as $key=>$val) {
		$list[$key] = str_replace('*','&#8226;&nbsp;',$val);	
	}
	$list = array(""=>$lang['select_category']) + $list;
	$opts['style'] = 'width:250px;';
	//$opts_c['onchange'] = "javascript:window.document.location='index.php?cmd=$act&list='+this.options[this.selectedIndex].value;";
	$gFrm->addElement('select','category','',$list,$opts);
	//$gFrm->addRule('category',$lang['please_select_category'],'required');
	//$gFrm->addRule('category',$lang['please_select_category'],'required','','client');
	$gFrm->addElement('text','myTitle',$lang['inspiration_title'],$opts);
	$gFrm->addRule('myTitle',$lang['please_enter_inspiration_title'],'required');
	$gFrm->addRule('myTitle',$lang['please_enter_inspiration_title'],'required','','client');
	$gFrm->addElement('textarea','text',$lang['inspiration_text'],' style="width:100%" rows=8');
	$gFrm->addRule('text',$lang['please_enter_inspiration_text'],'required');
	$gFrm->addRule('text',$lang['please_enter_inspiration_text'],'required','','client');
	$gFrm->addElement('hidden','list',$gFrm1->exportValue('list'));
	$gFrm->addElement('hidden','list_items',$gFrm1->exportValue('list_items'));
	$gFrm->addElement('hidden','inputc',$gFrm1->exportValue('inputc'));
	$gFrm->addElement('hidden','item_id',$item_id);
	$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['yes'], 'Y');
	$radio[] = HTML_QuickForm::createElement('radio', null, null, $lang['no'], 'N');
	$gFrm->addGroup($radio, 'allow_comments', 'Yes/No');
	$radio = array();
	
	$gFrm->addElement('submit','submit',$lang['submit_changes'],'');
	$gFrm->addElement('button','remove',$lang['permanently_remove'],array('onClick'=>'if(confirm(\''.$lang['are_you_sure'].'\')){document.location.href = \''.HOME.'admin.php?cmd='.$act.'&rID='.$row['ID'].'\'}'));
	$gFrm->addElement('reset','reset',$lang['reset'],'');

	$defaults['text'] = html_entity_decode($row['text'],ENT_QUOTES);
	$defaults['myTitle'] = html_entity_decode($row['title'],ENT_QUOTES);
	$defaults['category'] = $row['category'];
	$defaults['allow_comments'] = $row['allow_comments'];
	$row['created'] = date(str_replace("%","",$gConf['date_format']),strtotime($row['created']));

	$t->assign('item_data',$row);
}else {
	$item_id = 0;
}

if($gFrm->validate()) {
	//$gFrm->freeze();
	$gFrm->process('process_data',1);
}else {
	$gFrm->setDefaults($defaults);	
}


/*
echo '<pre>';
print_r($gConf);
*/




$gFrm1->accept($gFrmR);
$t->assign('form_data',$gFrmR->toArray());

if($item_id) {
  $gFrm->accept($gFrmR);
  $t->assign('form_item',$gFrmR->toArray());
}
}
function process_data($f) {
	global $db,$gFrm1,$list_raw,$act,$lang;
	$text = str_replace('&nbsp;'," ",$text);	
	$text = htmlentities($f['text'],ENT_QUOTES);
	$text = str_replace('  ','&nbsp;&nbsp;',$text);	
	$db->query('UPDATE '.dext('items').' SET text="'.$text.'",title="'.htmlentities($f['myTitle'],ENT_QUOTES).'",allow_comments="'.$f['allow_comments'].'" WHERE id="'.$f['item_id'].'"');
	$gFrm1->removeElement('list');
	$gFrm1->removeElement('list_items');
	$list = array();
	foreach($list_raw as $key=>$val) {
		$list[$key] = str_replace('*','&#8226;&nbsp;',$val);	
		$list[$key] .= ' ('.(int)$db->getOne('SELECT COUNT(ID) FROM '.dext('items').' WHERE category = '.$key.' AND confirmed = 1').')';	

	}

	$list = array(""=>$lang['select_item']) + $list;
	$opts['style'] = 'width:250px;';
	$opts_c['onchange'] = "javascript:window.document.location='index.php?cmd=$act&list='+this.options[this.selectedIndex].value;";
	$gFrm1->addElement('select','list','',$list,$opts+$opts_c);
	$list_items = array();
	if($it = $gFrm1->exportValue('list')) {
		foreach($db->getAll('SELECT ID,title FROM '.dext('items').' WHERE category="'.$it.'" AND confirmed=1') as $row) {
			$list_items[$row['ID']] = html_entity_decode($row['title'],ENT_QUOTES);
		}
	}
	$list_items = array(""=>$lang['select_item']) + $list_items;
	$gFrm1->addElement('select','list_items','',$list_items,$opts);


}
	
/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('edit_item.tpl');
?>