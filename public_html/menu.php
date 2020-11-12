<?PHP


if(!defined('IN_APP')) {
	die('Malicious request: <b>Menu</b> could not be accessed directly!');
}
$intVars['content'] = '';

$intVars['content'] = $t->fetch('register.tpl');


if($gConf['category_display'] == "DHTML Menu") {
	ob_start();
	print "<script type='text/javascript'>function Go(){return}</script>\n";
	print "<script type='text/javascript' src='".IHTML."/common/js/menu_var.js'></script>";
	// Retrieve categories


	print '
	<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
	<!--
	  var categories = new Array();
	';
	$tmp = SetUpMenu(0,"", true, 18);

	$tmp = explode(",", $tmp);
	$subcategory_sidebar_width = $tmp[0];
	$nummenuitems = $tmp[1];
	print "StartTop=235;\n";
	print "var Arrws=['".IHTML."common/images/green_arrow.gif',9,10,'tridown.gif',10,5,'trileft.gif',5,10];	// Arrow source, width and height\n";
	print'
	//-->
	</SCRIPT>';
	print "<script type='text/javascript' src='".IHTML."common/js/menu_com.js'></script>";
	  $tplVars['Menu'] = ob_get_contents();
	ob_end_clean();


}else {
	$menu00  = new HTML_TreeMenuXL();
	$node0 = new HTML_TreeNodeXL('<span style="height:19px;" onMouseOver="javascript:style.cursor=\'hand\'">'.$lang['all_categories'].'</span>', "index.php?cat=0", array());
	buildMenu($node0);
	$menu00->addItem($node0);

	if ($gConf['category_display'] == "DHTML Tree"){
		$example010 = new HTML_TreeMenu_DHTMLXL($menu00, array("expanded"=>true,"images"=>SITE."images/TMimagesAlt2"));
	}elseif 	($gConf['category_display'] == "HTML Tree"){
		$example010 = new HTML_TreeMenu_DHTMLXL($menu00, array("isDynamic"=>false,"images"=>SITE."images/TMimages"));
	}elseif 	($gConf['category_display'] == "Bulleted HTML Tree"){
		$example010 = new HTML_TreeMenu_RigidXL($menu00, array("expanded"=>true,"images"=>SITE."images/TMimagesRigid"));
	}

	$tplVars['Menu'] = $example010->toHTML();
}

?>