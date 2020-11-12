<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}

if(!checkSession(1)) {
	header( "Location: ".HOME."index.php?cmd=3" );
	exit;
}


$intVars['content'] = '';
$ID = isset($_GET['ID'])?(int)$_GET['ID']:0;

$gFrm = new HTML_QuickForm('myForm','get');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');
$msgTxt = '';

$gFrm->addElement('hidden','cmd',$act);



$defaults = array();
$list = buildTree(0,0,0);
foreach($list as $key=>$val) {
	$list[$key] = str_replace('*','&#8226;&nbsp;',$val);	
}

$list = array(""=>$lang['select_category']) + $list;

$opts['style'] = 'width:215px;';
$gFrm->addElement('select','list',$lang['suggested_category'],$list,$opts);
$gFrm->addElement('text','inputc',$lang['new_category'],$opts);
$defaults['list'] = $ID;
$gFrm->setDefaults($defaults);

$gFrm->addElement('submit','submit',$lang['create/approve'],'');
//$gFrm->addElement('button','cancel',$lang['cancel'],array('onClick'=>"javascript:window.close();"));
$gFrm->addElement('button','cancel',$lang['cancel'],array('onClick'=>"javascript:cat_manage_finish();"));

if($gFrm->validate()) {
	//print_r($gFrm->exportValues());
	$f = $gFrm->exportValues();
	if(isset($f['submit'])) {
		if($f['inputc']) {//create from text box
			if($db->getOne('SELECT * FROM '.dext('categories').' WHERE name="'.$f['inputc'].'"')) {
				$msgTxt .= '<span class="normalRed">'.$lang['category_name_already_exists'].'</span><br />';
			}else {
				$db->query('INSERT INTO '.dext('categories').'(name,confirmed) VALUES("'.$f['inputc'].'","1")');
			}
		}elseif($f['list']) {
			$db->query('UPDATE '.dext('categories').' SET confirmed="1" WHERE ID="'.$f['list'].'"');
		}
		if($msgTxt=="") {
			echo '<script>
						if (opener != null) 
							opener.location.reload(true);
							setTimeout(\'window.close()\',500);
						</script>';
			exit;
		}
	}
}

$gFrm->setDefaults($gConf);



$gFrm->accept($gFrmR);

$t->assign('form_data',$gFrmR->toArray());


	
/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$t->display('admin_manage_cat.tpl');
?>