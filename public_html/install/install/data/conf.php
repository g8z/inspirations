<?php
if(!defined('IN_APP')) {
	die('Hacking attempt..');
}

/*
* If set to true, then system works in devel mode (error reporting, template cashing etc)
*/
define('MODE_DEVEL',false);

//separator in GET string for XHTML compatibility
@ini_set('arg_separator.output','&amp;');
$gCredits = array();
$gCredits['HTML_Title'] = '{HTML_Title}';
$gCredits['HTML_Description'] = '{HTML_Description}';
$gCredits['application'] = 'Inspirations';
$gCredits['company'] = 'TUFaT.com';
$gCredits['version'] = '3.1';

/* Allow to contribute without logging into the system */
$allowContributionWithoutLogin = false;

/*
* Database
*/
define ('DB_USER', '{DB_USER}');
define('DB_PASSWORD','{DB_PASS}');
define('DB_HOST','{DB_HOST}');
define('DB_NAME','{DB_NAME}');
define('DB_PREFIX','{DB_PFX}');
$dbType = 'mysql';

/*
* Paths
*/
if (stristr($_ENV['OS'],"windows")) {
	$slash = "\\"; // for windows
} else {
	$slash = "/"; // for linux
}
/* Defined as constants . Also, kept in $gPaths for older versions compatability */
define('APP_DIR', realpath(dirname(__FILE__)).$slash);
define('HOME', '{APP_URL}'.'/');
define('IHTML', HOME.'ihtml/');
define('APPIHTML', APP_DIR.'ihtml/');
define('PEAR_DIR', APP_DIR.'pear/');
define('SMARTY_DIR', APP_DIR.'smarty/libs/');
define('COMPILE_DIR',APP_DIR.'smarty/compile/');
define('INSTALL_DIR', APP_DIR.'install/');
define('INCLUDE_DIR', APP_DIR.'include/');

$gPaths = array();
$gPaths['web'] = HOME;
$gPaths['ihtml'] = $gPaths['web'].'/ihtml';

$mime_types = array(1 => 'image/gif', 2 => 'image/jpeg', 3 => 'image/png', 6 => 'image/bmp','image/pjpeg');

$gVars['charset'] = 'iso-8859-1';

//by Gary_Star
/*  Define Language Options and Files */
define( 'LANG_DIR', APP_DIR . 'languages'.$slash );

$lang_array = array();
$d = dir(LANG_DIR);
while (false !== ($entry = $d->read())) {
	if($entry!='.'&&$entry!='..')
	   if (file_exists(LANG_DIR.$entry.$slash.'language.php')) {
		$lang_array[strtolower(str_replace(" ","_",$entry))] = $entry;
	   }
}
$d->close();

$language_files = array();
foreach ($lang_array as $key =>$value) {
   $language_files[$key] = $value.$slash.'language.php';
}

define( 'DEFAULT_LANG', 'english' );
// end language

?>