<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}

if(!checkSession(1)) {
	header( "Location: ".HOME."index.php?cmd=3" );
	exit;
}


$intVars['content'] = '';

$gFrm = new HTML_QuickForm('myForm','get');
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');
$msgTxt = '';

$gFrm->addElement('hidden','cmd',$act);



$defaults = array();
if(isset($_GET['list1'])) {
	$defaults['list1'] = (int)$_GET['list1'];
}else {
	$defaults['list1'] = "";
}
$a = buildTree();
foreach($a as $key=>$val) {
$a[$key] = str_replace('*','&#8226;&nbsp;',$val);	
}

$list2 = $list1 = $a;

if(isset($list2[$defaults['list1']])) {
	unset($list2[$defaults['list1']]);	
}
$list1 = array(""=>$lang['select_category']) + $list1;
$list2 = array(""=>$lang['select_category'],0=>$lang['root_node']) + $list2;

$opts['style'] = 'width:250px;';
$opts_c['onchange'] = "javascript:window.document.location='index.php?cmd=$act&list1='+this.options[this.selectedIndex].value;";
$gFrm->addElement('select','list1',$lang['tree_1'],$list1,$opts+$opts_c);
$gFrm->addElement('select','list2',$lang['tree_2'],$list2,$opts);
$list3 = array();
foreach($db->getAll('SELECT ID,name FROM '.dext('categories').' WHERE confirmed=0 ORDER BY name') as $row) {
	$list3[$row['ID']] = $row['name'];
}
$list3 = array(""=>$lang['select_category']) + $list3;
$gFrm->addElement('select','list3',$lang['proposed_categories'],$list3,$opts);
$gFrm->addElement('text','inputc',$lang['node_name'],$opts+array('value'=>$db->getOne('SELECT name FROM '.dext('categories').' WHERE id="'.$defaults['list1'].'"')));

$gFrm->setDefaults($defaults);

$gFrm->addElement('submit','submit',$lang['create'],'');
$gFrm->addElement('submit','update',$lang['update'],'');
$extra = array('onclick'=>'return confirm(\''.$lang['are_you_sure'].'\')');
$gFrm->addElement('submit','remove',$lang['delete'],$extra);
$gFrm->addElement('submit','move',$lang['move_node'],'');
$gFrm->addElement('submit','approve',$lang['accept'],'');
$gFrm->addElement('submit','reject',$lang['reject'],'');


if($gFrm->validate()) {
	//print_r($gFrm->exportValues());
	$f = $gFrm->exportValues();
	if(isset($f['update'])) {
		if($f['inputc']!=""&&$f['list1']!="") {
			if($f['list1']) {
				$db->query('UPDATE '.dext('categories').' SET name="'.$f['inputc'].'" WHERE ID="'.$f['list1'].'"');
				header( "Location: ".HOME."admin.php?cmd=9&list1=".$f['list1']);
				exit;
			}
		}else {
			$msgTxt .= "<span class=\"normalRed\">".$lang['please_select_category_from_tree_1_and_update_textbox.']."</span><br />";
		}
	}elseif(isset($f['submit'])) {
		if($f['inputc']) {
			if($db->getOne('SELECT * FROM '.dext('categories').' WHERE name="'.$f['inputc'].'"')) {
				$msgTxt .= '<span class="normalRed">'.$lang['category_name_already_exists'].'</span><br />';
			}else {
				$db->query('INSERT INTO '.dext('categories').'(name,confirmed) VALUES("'.$f['inputc'].'","1")');
				header( "Location: ".HOME."admin.php?cmd=9&list1=".$db->getOne('SELECT MAX(ID) FROM '.dext('categories').' WHERE confirmed=1') );
				exit;
			}
		}else {
			$msgTxt .= '<span class="normalRed">'.$lang['category_name_is_empty.'].'</span><br />';
		}
	}elseif(isset($f['reject'])) {
		if($f['list3']) {
			$db->query('DELETE FROM '.dext('categories').' WHERE ID="'.$f['list3'].'"');
			header( "Location: ".HOME."admin.php?cmd=9");
			exit;
		}
	}elseif(isset($f['approve'])) {
		if($f['list3']) {
			if($db->getOne('SELECT * FROM '.dext('categories').' WHERE name="'.$db->getOne('SELECT name FROM '.dext('categories').' WHERE ID='.$f['list3']).'" and confirmed=1')) {
				$msgTxt .= '<span class="normalRed">'.$lang['category_name_already_exists'].'</span><br />';
			}else {
				$db->query('UPDATE '.dext('categories').' SET confirmed=1 WHERE ID="'.$f['list3'].'"');
				header( "Location: ".HOME."admin.php?cmd=9&list1=".$f['list3'] );
				exit;
			}
		}else {
			$msgTxt .= '<span class="normalRed">'.$lang['please_select_a_category_from_the'].'</span><br />';
		}
	}elseif(isset($f['remove'])) {
		if($f['list1']!="") {
			removeNode($f['list1']);
			header( "Location: ".HOME."admin.php?cmd=9");
			exit;
		}else {
			$msgTxt .= '<span class="normalRed">'.$lang['please_select_category_from_tree_1'].'</span><br />';
		}
	}elseif(isset($f['move'])) {
		if(!$id1 = $f['list1']) {
			$msgTxt .= '<span class="normalRed">'.$lang['please_select_category_to_move'].'</span><br />';
		}elseif(($id2 = $f['list2'])=="") {
			$msgTxt .= '<span class="normalRed">'.$lang['please_select_destination_category'].'</span><br />';
		}elseif($id1==$id2) {
			$msgTxt .= '<span class="normalRed">'.$lang['item_could_not_be_moved_into_itself'].'</span><br />';
		}else {
			$p = array_flip(getParents($id2));
			unset($p[$id2]);
			if(isset($p[$id1])) {
				$msgTxt .= '<span class="normalRed">'.$lang['parent_categories_could_not_be_moved_under'].'</span><br />';
			}else {
				$db->query('UPDATE '.dext('categories').' SET PID="'.$id2.'" WHERE id="'.$id1.'"');
				header( "Location: ".HOME."admin.php?cmd=9&list1={$f['list1']}" );
				exit;
			}
		}
		
	}
}

$gFrm->setDefaults($gConf);


/*
echo '<pre>';
print_r($gConf);
*/



$gFrm->accept($gFrmR);

$t->assign('form_data',$gFrmR->toArray());


	
/*/
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$intVars['content'] = $t->fetch('admin_manage_tree.tpl');
?>