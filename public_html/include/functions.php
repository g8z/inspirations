<?php
function getVar($inVarName) {
	global $db;
	return $db->getOne('SELECT vvalue FROM '.get_db_ext('sysvars').' WHERE vname="'.$inVarName.'"');
}

function setVar($inVarName, $inVarValue) {
	global $db;
	return $db->query('UPDATE '.get_db_ext('sysvars').' SET vvalue="'.addslashes($inVarValue).'" WHERE vname="'.$inVarName.'"');
}

function dext($inTable) {
	return get_db_ext($inTable);
}

function get_db_ext($inTable) {
	$tbl = DB_PREFIX . $inTable;
	return $tbl;
}

function GetModifyableStyles($cssFile = '')
{
	global $gPaths;
	$cssFile = ($cssFile!='')?$cssFile:SITEPATH.'stylesheet.css';
	$file = @fopen($cssFile, "rb");
	if ($file)
	{
		$content = fread($file, filesize($cssFile));
		fclose($file);
	}
	preg_match_all('/\s*(.*?):\s*(.*?)\s*;\s*\/\*\* \{([^\}]*?)\} \*\//i', $content, $matches);
	return $matches;
}

function LoadImage($name, $src)
{
   $src = str_replace(" ", "%20", $src);
	return "<IMG ALIGN = \"middle\" NAME = \"$name\" SRC=\"$src\" BORDER=0 ALT=\"\"".
//	 ONERROR = \"if (!document.all) this.src='$src'\"
	 "/>";

	/*
	if($size = getimagesize(str_replace(' ','%20',$src))) {
		return "<IMG ALIGN = \"absmiddle\" NAME = \"$name\" SRC=\"$src\" WIDTH=\"$size[0]\" HEIGHT=\"$size[1]\" BORDER=0 ALT=\"\" ONERROR = \"if (!document.all) this.src='$src'\">";
	}
	*/
}
function validateVersion($inVer) {
	if(strcmp($inVer, phpversion()) > 0) {
		return false;
	}else {
		return true;
	}
}
if(!validateVersion('4.2')) {
	function is_a($anObject, $aClass) {
		 return get_class($anObject) == strtolower($aClass)
			 or is_subclass_of($anObject, $aClass);
	}
}

/** A platform-safe email checker, but does NOT check DNS records, only email syntax. */
function validEmail( $email ) {
	if ( eregi( "^[0-9a-z]([-_.]?[0-9a-z]*)*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]*$", $email, $check ) )
	{
		if ( strstr( $check[0], "@" ) )
			return true;
	}
	return false;
}

function SetUpMailer(&$mail) {
	global $gConf, $db;
	$mail->Mailer = $gConf['mailer_type'];
	$email = $db->getOne('SELECT email FROM ' . DB_PREFIX . 'users WHERE ID=1 or utype=9 limit 1');
	$mail->Sender = $email;

	if ($mail->Mailer == "smtp")
	{
		$mail->Host = $gConf['smtp_host'];
		if ($gConf['smtp_auth'] == "true")
		{
			$mail->SMTPAuth = true;
			$mail->Username = $gConf['smtp_username'];
			$mail->Password = $gConf['smtp_password'];
		}
	}
}

function MakeStyleInput($styleName, $styleType, $initialValue) {
	global $gPaths;

	$styleType = strtolower($styleType);
	$fieldName = "$styleName:$styleType";
	$styleInputStrings = array(
		"color" => '<input type=text size = 8 name="{FIELDNAME}" value="{INITIALVALUE}" />
			<a href="javascript:TCP.popup(document.forms[\'optionsForm\'].elements[\'{FIELDNAME}\'],1)"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" src="'.SITE.'images/sel.gif'.'" /></a>',
		"background-color" => '<input type=text size = 8 name="{FIELDNAME}" value="{INITIALVALUE}" />
			<a href="javascript:TCP.popup(document.forms[\'optionsForm\'].elements[\'{FIELDNAME}\'],1)"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" src="'.SITE.'images/sel.gif'.'" /></a>',
		"background" => '<input type=text size = 8 name="{FIELDNAME}" value="{INITIALVALUE}" />
			<a href="javascript:TCP.popup(document.forms[\'optionsForm\'].elements[\'{FIELDNAME}\'],1)"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" src="'.SITE.'images/sel.gif'.'" /></a>',
		"font-family" => '<input size = 40 type=text name="{FIELDNAME}" value="{INITIALVALUE}" />',
		);
	$options = array(
			'Arial, Helvetica, sans-serif',
			'Verdana, Arial, Helvetica',
			'Tahoma, Arial, Helvetica'
	);
	$styleInputStrings["font-family"] = MakeList($fieldName, $options, $options, $initialValue);

	$options = array();
	for ($i = 8; $i < 20; $i++)
	{
		$options[] = "{$i}px";
	}
	$styleInputStrings["font-size"] = MakeList($fieldName, $options, $options, $initialValue);

	$options = array("none", "underline", "overline", "line-through", "blink");
	$styleInputStrings["text-decoration"] = MakeList($fieldName, $options, $options, $initialValue);

	$options = array("normal","bold","bolder","lighter","100","200","300","400","500","600","700","800","900");
	$styleInputStrings["font-weight"] = MakeList($fieldName, $options, $options, $initialValue);

	$options = array();
	for ($i = 0; $i < 17; $i++)
	{
		$options[] = "{$i}px";
	}
	$styleInputStrings["padding-top"] = MakeList($fieldName, $options, $options, $initialValue);
	$styleInputStrings["padding-bottom"] = MakeList($fieldName, $options, $options, $initialValue);
	$styleInputStrings["padding-left"] = MakeList($fieldName, $options, $options, $initialValue);
	$styleInputStrings["padding-right"] = MakeList($fieldName, $options, $options, $initialValue);

	$options = array("left", "right", "center");
	$styleInputStrings["text-align"] = MakeList($fieldName, $options, $options, $initialValue);

	$options = array("baseline","sub","super","top","text-top","middle","bottom","text-bottom");
	$styleInputStrings["vertical-align"] = MakeList($fieldName, $options, $options, $initialValue);

	$string = str_replace("{FIELDNAME}", $fieldName, $styleInputStrings[$styleType]);
	$string = str_replace("{INITIALVALUE}", $initialValue, $string);
	return $string;
}

function MakeList($name, $options, $values, $initialValue)
{
	$list = "<SELECT NAME = '$name'>\n";
	for ($i = 0; $i < count($values); $i++)
	{
		$list .= "<OPTION VALUE = '{$values[$i]}' " .($values[$i] == $initialValue ? "SELECTED" : ""). ">{$options[$i]}</OPTION>\n";
	}
	$list .= "</SELECT>\n";
	return $list;
}

function buildTree($pid = 0, $dims = 0, $conf = 1) {
	global $db;
	$out = array();
	$dims++;
	$que = 'SELECT ID,PID,name FROM '.dext('categories').' WHERE confirmed="'.$conf.'" AND PID="'.$pid.'" ORDER BY name';
	foreach($db->getAll($que) as $row) {
		$out[$row['ID']] = str_pad($row['name'],$dims+strlen($row['name']),'*',STR_PAD_LEFT);
		$out += buildTree($row['ID'],$dims,$conf);
	}
	$dims--;
	return $out;
}

function getParent($id) {
	global $db;
	return $db->getOne('SELECT PID FROM '.dext('categories').' WHERE ID="'.$id.'"');
}

function getParents($id) {
		for ($ids[] = $id; $id = getParent($id); $ids[] = $id);
		 return array_reverse($ids);
}

function getChildren($id) {
	global $db;
	$id = (int)$id;
	$out = array();
	foreach($db->getAll('SELECT ID,name FROM '.dext('categories').' WHERE PID="'.$id.'"') as $row) {
		$out[$row['ID']] = $row['name'];
		$out += getChildren($row['ID']);
	}
	return $out;
}

function removeNode($id) {
	global $db;
	//get depth
	if($dp = $db->getAll('SELECT * FROM '.dext('categories').' GROUP BY PID')) {
		$dp = count($dp);
	}else {
		$dp = 1;
	}
	//remove node
	$db->query('DELETE FROM	'.dext('categories').' WHERE ID="'.$id.'"');
	//remove immediate children
	$db->query('DELETE FROM	'.dext('categories').' WHERE PID="'.$id.'"');
	//remove all unassigned rows
	for($i=0; $i<$dp; $i++) {
		foreach($db->getAll('SELECT ID,PID FROM '.dext('categories').' WHERE PID<>0') as $row) {
			if(!$db->getOne('SELECT ID FROM '.dext('categories').' WHERE ID="'.$row['PID'].'"')) {//parent not existing
				$db->query('DELETE FROM	'.dext('categories').' WHERE ID="'.$row['ID'].'"');
			}
		}

	}
}

function checkSession($utype) {
	//global $_SESSION;
	return (bool)(
		isset($_SESSION['INSP']['UID'])
		&&isset($_SESSION['INSP']['UTYPE'])
		&&isset($_SESSION['INSP']['USER'])
		&&($_SESSION['INSP']['UTYPE'] == $utype));
}

function buildMenu(&$node0, $pid=0, $dims=0) {
	global $db,$gConf;
	$nodeProperties = array();
	$dims++;
	$que = 'SELECT ID,PID,name FROM '.dext('categories').' WHERE confirmed="1" AND PID="'.$pid.'" ORDER by name ASC';
	foreach($db->getAll($que) as $row) {
		if($gConf['category_display'] == "Bulleted HTML Tree") {
			$pad_s = str_pad('',$dims,'*', STR_PAD_LEFT);
			$row['name'] = str_replace('*','&#8226;&nbsp;',$pad_s).$row['name'];
		}
		$nx = &$node0->addItem(new HTML_TreeNodeXL($row['name'], "index.php?cat=".$row['ID'], $nodeProperties));
		buildMenu($nx,$row['ID'],$dims);
	}
}

function SetUpMenu($id, $menuid, $toplevel = false, $maxwidth = 0) {
	global $db, $gPaths;
	$ccount = count(getChildren($id));
	if ($toplevel == true)
		print "NoOffFirstLineMenus = ".$db->getOne('SELECT COUNT(*) FROM '.dext('categories').' WHERE confirmed="1" AND PID=0').";\n";

	$query = "SELECT * FROM ".dext('categories')." WHERE confirmed='1' AND PID = $id order by name";
	$maxwidth2 = $maxwidth;
	$i = 1;
	foreach($db->getAll($query) as $row) {
		if (strlen($row['name']) > $maxwidth2) {
			$maxwidth2 = strlen($row['name']);
		}
		$count = count(getChildren($row['ID']));
		print "Menu{$menuid}{$i}=new Array(\"".addslashes($row['name'])."\",\"index.php?cat=".$row['ID']."\",\"\",".$db->getOne('SELECT COUNT(*) FROM '.dext('categories').' WHERE confirmed="1" AND PID='.$row['ID']).",20,".($maxwidth * 8).");\n";
		if($count>0) {
			SetUpMenu($row['ID'], $menuid.$i.'_', false, $maxwidth2);
		}
		$i++;
	}
	return ($maxwidth2 * 8).",".$ccount;
}

?>