<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}
if(!isset($inst_dir)) {
	$inst_dir = '';
}
?>
<?xml version="1.0" encoding="{$Page.internal.charset}" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Inspirations</title>
  <meta http-equiv="Content-Type" content="text/html; charset={$Page.internal.charset}" />
  <meta name="description" content="FW4 DW4 HTML" />
  <link href="<?PHP echo $inst_dir;?>/install/data/internal/css.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#ffffff" sryle="margin: 0" class="background">
<br />
<br />
<br />
<table summary="" border=0>
	<tr>
		<td style="width:300px" nowrap>&nbsp;</td>
		<td class="titleBold">
			<?php echo $lang['inspirations']; ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td class="normal">
			<?php echo $lang['please select']; ?><br /><a href="<?PHP echo $inst_dir;?>/install/"><?php echo $lang['clean_install']; ?></a><br /><a href="<?PHP echo $inst_dir;?>/upgrade/"><?php echo $lang['upgrade']; ?></a><br />	
		</td>
	</tr>
</table>
</body>
</html>