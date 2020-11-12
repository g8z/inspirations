<?php /* Smarty version 2.6.13, created on 2006-11-22 19:19:57
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'LoadImage', 'index.tpl', 24, false),array('modifier', 'cat', 'index.tpl', 24, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="<?php echo $this->_tpl_vars['Page']['internal']['charset']; ?>
" <?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $this->_tpl_vars['Page']['credits']['HTML_Title']; ?>
</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['Page']['internal']['charset']; ?>
" />
	<meta name="description" content="<?php echo $this->_tpl_vars['Page']['credits']['HTML_Description']; ?>
" />
  	<?php echo $this->_tpl_vars['css']; ?>

	<script src="<?php echo @IHTML; ?>
common/js/javascript.js" language="JavaScript" type="text/javascript"></script>
	<script src="<?php echo @IHTML; ?>
common/js/validation.js" language="JavaScript" type="text/javascript"></script>
	<script src="<?php echo @IHTML; ?>
common/js/picker.js" language="JavaScript" type="text/javascript"></script>
	<script src="<?php echo @IHTML; ?>
common/HTML_TreeMenuXL/TreeMenu.js" language="JavaScript" type="text/javascript"></script>

</head>

<body style="margin: 0" class="background">

	<table summary="" border="0" cellpadding="0" cellspacing="0" width="750">
		<tr>
			<td height="34">&nbsp;</td>
			<td height="34" align=center>
				<a href="index.php"><?php echo sm_LoadImage(array('name' => 'inspirationsTitle','src' => ((is_array($_tmp=@SITE)) ? $this->_run_mod_handler('cat', true, $_tmp, "images/inspirationsTitle.gif") : smarty_modifier_cat($_tmp, "images/inspirationsTitle.gif"))), $this);?>
</a>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
		<tr>
			<td width="132" height="89" valign=top>
				<table summary="" width="100%" border="0" cellspacing="0" cellpadding="2">
					<tr>
						<!-- Title picture for the category sidebar is inserted here -->
						<td><?php echo sm_LoadImage(array('name' => 'categoriesTitle','src' => ((is_array($_tmp=@SITE)) ? $this->_run_mod_handler('cat', true, $_tmp, "images/categoriesTitle.gif") : smarty_modifier_cat($_tmp, "images/categoriesTitle.gif"))), $this);?>
</td>
					</tr>
					<tr>
						<td style = 'padding:7px'>
							<!-- Category Sidebar is inserted here -->
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "side_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</td>
					</tr>
				</table>
			</td>
			<td width="668" valign="top">
				<table summary="" border=0 cellpadding=5 cellspacing=0 width=100%>
					<tr>
						<td valign=top>
							<!-- Content Page is inserted here -->
							<?php if ($this->_tpl_vars['security_warning']): ?>
								<table summary="" border=0 width="100%" style="border:1px solid red;">
									<tr>
										<td class="normalRed" style="font-weight:bold;" align="center"><?php echo $this->_tpl_vars['lang']['security_alert']; ?>
</td>
									</tr>
									<tr>
										<td class="normalRed"><?php echo $this->_tpl_vars['lang']['attention']; ?>
</td>
									</tr>
								</table>
								<br />
							<?php endif; ?>
							<?php echo $this->_tpl_vars['Page']['internal']['content']; ?>

						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="right" class="normal"><br /><?php echo $this->_tpl_vars['lang']['select_language'];  echo $this->_tpl_vars['form_lang']['select_lang']['html']; ?>
</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align=center>
				<table summary="" width=100% border=0 cellpadding=4 cellspacing=0>
					<tr>
						<td align=center>
							<!-- Page Footer is defined here -->
							<span class=normal><?php echo $this->_tpl_vars['Page']['internal']['conf']['site_footer']; ?>
</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align=center>
			<a target="_blank" href="http://www.tufat.com/inspirations.php">Powered by Inspirations</a>
			</td>
		</tr>
	</table>
</body>
</html>