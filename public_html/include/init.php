<?php
if(!defined('IN_APP')) {
	die('Hacking attempt..');
}

error_reporting(E_ALL - E_NOTICE);

if( !function_exists( 'html_entity_decode' ) )
{
   function html_entity_decode( $string, $quote_style = ENT_QUOTES ) {
	   // replace numeric entities
	   $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
	   $string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
	   // replace literal entities
	   $trans_tbl = get_html_translation_table(HTML_ENTITIES);
	   $trans_tbl = array_flip($trans_tbl);
	   return strtr($string, $trans_tbl);
       }
}

//by Gary_Star
if ($_GET['sort']!= '') {$comments_sort=$_GET['sort'];  unset($_GET['sort']);}
elseif ($_SESSION['comments_sort'] != '') {$comments_sort=$_SESSION['comments_sort'];}
elseif ($_COOKIE['comments_sort'] != '') {$comments_sort=$_COOKIE['comments_sort'];}
else {$comments_sort='0'; }
if ($comments_sort != '0' AND $comments_sort != 1) $comments_sort = '0';
$_SESSION['comments_sort'] = $comments_sort;
setcookie('comments_sort',$comments_sort,time()+60*60*24*365);

//language by Gary_Star
if ($_GET['lang']!= '') {$opt_lang=$_GET['lang'];  unset($_GET['lang']);}
elseif ($_SESSION['opt_lang'] != '') {$opt_lang=$_SESSION['opt_lang'];}
elseif ($_COOKIE['opt_lang'] != '') {$opt_lang=$_COOKIE['opt_lang'];}
else {$opt_lang=DEFAULT_LANG; }

if (!array_key_exists($opt_lang,$language_files))
	$opt_lang = DEFAULT_LANG;

$langfile = LANG_DIR.$language_files[$opt_lang];
require_once $langfile;

$_SESSION['opt_lang'] = $opt_lang;
setcookie('opt_lang',$opt_lang,time()+60*60*24*365);

$cale = HOME.'index.php?';
$parm = '';
foreach ($_GET as $keys => $vals)
	{ $parm .= '&'.$keys.'='.$vals;}



// end language

$gVars['charset'] = $lang['encoding'];

require_once(INCLUDE_DIR.'functions.php');

if(!MODE_DEVEL) {
	error_reporting(E_ERROR);
}

/*
* Get all necassary includes
*/
require_once(PEAR_DIR.'PEAR.php');
require_once(PEAR_DIR.'DB.php');
require_once(PEAR_DIR.'HTML/QuickForm.php');
require_once(PEAR_DIR.'HTML/QuickForm/Renderer/ArraySmarty.php');
require_once(SMARTY_DIR.'Smarty.class.php');
require_once(INCLUDE_DIR.'phpmailer/class.phpmailer.php');
include_once(APPIHTML.'common/HTML_TreeMenuXL/TreeMenuXL.php');


/*
* Hook error handler
*/
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'ehndl');
function ehndl($err) {
	if(MODE_DEVEL) {
		echo '<br />'.$err->message.'<pre>';
		print_r($err);
		exit;
	}else {
		die(mysql_error() . '<br />' . $err->message);
	}
}

//db abstraction layer
$db = DB::connect('mysql://'.DB_USER.':'.DB_PASSWORD.'@'.DB_HOST.'/'.DB_NAME.'');
$db->setFetchMode(DB_FETCHMODE_ASSOC);
$dbPrefix = DB_PREFIX;

$gConf = array();
foreach($db->getAll('SELECT vname,vvalue FROM '.dext('sysvars').'') as $row) {
	$gConf[$row['vname']] = $row['vvalue'];
}

$siteTheme = $gConf['siteTheme'];


define ('SITETHEME',	$gConf['siteTheme']);
define ('SITEPATH', 	APPIHTML.'themes/'.SITETHEME.'/');
define ('SITE', 		str_replace(" ","%20",IHTML.'themes/'.SITETHEME.'/'));
//set current template dir
$gPaths['tpl'] = SITE;

$t = new Smarty();

//variables for the language passed to smarty
$t->assign( 'cale', $cale );
$t->assign( 'parm', $parm );
$t->assign( 'lang', $lang );


$t->template_dir = SITEPATH;
$t->plugins_dir = array(INCLUDE_DIR, SMARTY_DIR.'/plugins/');
$t->compile_dir = COMPILE_DIR;
$t->cache_dir = APP_DIR.'smarty/cache/';
$t->request_use_auto_globals = true;
$t->force_compile = true;

//LoadImage Function
$t->register_function("LoadImage", "sm_LoadImage");
function sm_LoadImage($params) {
	return LoadImage($params['name'],$params['src']);
}

//paths should be available in all templates
$t->assign('gPaths',$gPaths);
$t->assign('siteTheme', $siteTheme);

//setup quick form
$gFrm = new HTML_QuickForm('myForm','post');

$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);

//default form object..pages may initialize additional objects
$gFrmR = new HTML_QuickForm_Renderer_ArraySmarty($t);
$gFrmR->setRequiredTemplate(
	 '{$label}
			 {if $required}
					 <span style="color:#FF0000;"><sup>*</sup></span>
				{/if}
				'
		);

$gFrmR->setErrorTemplate(
	 '{$html}
		{if $error}
				 <br clear="all" /><span style="color:#FF0000;">{$error}</span><br />
		{/if}'
);

//setup mailer
$gMail = new PHPMailer();
SetUpMailer($gMail);

session_start();

$cssFile = SITEPATH.'stylesheet.css';

$matches = GetModifyableStyles($cssFile);

// Replace Modifyable styles with values from database

$file = @fopen($cssFile, "rb");
if ($file){
	$content = fread($file, filesize($cssFile));
	fclose($file);
}
for ($i = 0; $i < count($matches[0]); $i++){
	$styleName = $matches[3][$i];
	$styleType = $matches[1][$i];
	$que = "SELECT value FROM {$dbPrefix}styles WHERE name = '".$styleName."' AND type = '".$styleType."' AND  theme = '".SITETHEME."' LIMIT 1";
	if ($style = $db->getRow($que)){
		$value = $style['value'];
		$content = str_replace($matches[0][$i], "\n$styleType: $value; /** \{$styleName:$styleType\} */", $content);
	}
}
$content = str_replace("images/", SITE."images/", $content);

$t->assign( 'css', '<style type=text/css>' . $content . '</style>' );

?>