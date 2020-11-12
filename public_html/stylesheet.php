<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b>This Program</b> could not be accessed directly!');
}
if(!checkSession(1)) {
	header( "Location: ".HOME."index.php?cmd=3" );
	exit;
}

$intVars['content'] = '';

$gFrm = new HTML_QuickForm('optionsForm','post');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');
$msgTxt = '';

$gFrm->addElement('hidden','cmd',$act);


$gFrm->addElement('submit','submit',$lang['update'],'');
$extra = array('onclick'=>'return confirm(\''.$lang['are_you_sure'].'\')');
$gFrm->addElement('submit','reset',$lang['defaults'],$extra);

$matches = GetModifyableStyles();
$styles = array();
$lastStyleName = "";
for ($i = 0; $i < count($matches[3]); $i++) {
	$styleName = $matches[3][$i];
	$styleType = $matches[1][$i];
	$styleValue = $matches[2][$i];

	if ($style = $db->getRow("SELECT value FROM ".dext('styles')." WHERE name = '$styleName' AND TYPE = '$styleType' AND theme = '".SITETHEME."'")) {
		$value = $style['value'];
	}else {
		$value = "";
	}
	$styles[$i]['name'] = ($lastStyleName != $styleName ? str_replace("_", " ", $styleName) : "");
	$styles[$i]['type'] = $styleType;
	$styles[$i]['input'] = MakeStyleInput($styleName, $styleType, ($value ? $value : $styleValue));

	$lastStyleName = $styleName;
}
/*
echo '<pre>';
print_r($gConf);
*/


if(isset($_POST['submit'])) {
	reset($matches);
	for ($i = 0; $i < count($matches[3]); $i++)	{
		$fieldName = "{$matches[3][$i]}:{$matches[1][$i]}";
		$result = $db->query("REPLACE INTO ".dext('styles')." SET name = '{$matches[3][$i]}', "
		. "type = '{$matches[1][$i]}', "
		. "theme = '".SITETHEME."', "
		. "value = '".$_POST[$fieldName]."'");
	}
	
	header( "Location: ".HOME."admin.php?cmd=8" );
	exit;
}elseif(isset($_POST['reset'])) {
	$result = $db->query("DELETE FROM ".dext('styles')." WHERE theme = '".SITETHEME."'");
	header( "Location: ".HOME."admin.php?cmd=8" );
	exit;
}


$gFrm->accept($gFrmR);

$t->assign('form_data',$gFrmR->toArray());
$t->assign('styles',$styles);


	
/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('admin_stylesheet.tpl');
?>