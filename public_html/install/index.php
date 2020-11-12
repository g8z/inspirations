<?PHP
/*
* Program entry point
* Acts as switcher/interface for calls to application
*/
if(!defined('IN_APP')) {
	define('IN_APP',1);
}
error_reporting(E_ALL - E_NOTICE);

// Gather configuration parameters && Gather initialization code
require_once('./../config.php');
$inst_dir = '.';
// require_once('./../index_install.php');
// exit;
$css="./install/data/internal/css.css";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Inspirations</title>
  <meta http-equiv="Content-Type" content="text/html; charset=<?PHP echo($Page['internal']['charset'])?>" />
  <meta name="description" content="FW4 DW4 HTML" />
  <link href="<?PHP echo($css); ?>" rel="stylesheet" type="text/css" />

</head>
<body bgcolor="#ffffff" style="margin: 0" class="background">
<br />
<br />
<br />
<table summary="" border=0>
<tr>
	<td style="width:300px" nowrap>&nbsp;</td>
	<td class="titleBold">
		Inspirations
	</td>
</tr>
<tr>
	<td></td>
	<td class="normal">
		Please select:<br /><a href="<?PHP echo $inst_dir;?>/install/">Clean Install</a><br /><a href="<?PHP echo $inst_dir;?>/upgrade/">Upgrade from previous version</a><br />
	</td>
</tr>
</table>
</body>
</html>