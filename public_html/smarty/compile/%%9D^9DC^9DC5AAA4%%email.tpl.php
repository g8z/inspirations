<?php /* Smarty version 2.6.13, created on 2006-04-14 03:30:38
         compiled from email.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title><?php echo $this->_tpl_vars['Page']['credits']['application']; ?>
 - <?php echo $this->_tpl_vars['lang']['send_to_a_friend']; ?>
</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['Page']['internal']['charset']; ?>
" />
	<?php echo $this->_tpl_vars['css']; ?>

</head>

<body class = white style="margin:0px;">
	<div align=left>
	<?php if ($this->_tpl_vars['top_message']): ?>
		<span class = 'white'><?php echo $this->_tpl_vars['top_message']; ?>
<br />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['form_data']['javascript']):  echo $this->_tpl_vars['form_data']['javascript'];  endif; ?>
	<form <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
		<?php echo $this->_tpl_vars['form_data']['hidden']; ?>

		<table summary="" align="center" width="100%" cellspacing="2" cellpadding="2" border="0">
			<tr> 
				<td class="formHeader" colspan="2" align=center><b><?php echo $this->_tpl_vars['lang']['send_to_a_friend']; ?>
</b></td>
			</tr>
			<tr class="normal"> 
				<td><?php echo $this->_tpl_vars['form_data']['fullname']['label']; ?>
</td>
				<td><?php echo $this->_tpl_vars['form_data']['fullname']['html']; ?>
</td>
			</tr>
			<tr class="normal"> 
				<td><?php echo $this->_tpl_vars['form_data']['email']['label']; ?>
</td>
				<td><?php echo $this->_tpl_vars['form_data']['email']['html']; ?>
</td>
			</tr>
			<tr class="normal" valign="top"> 
				<td><?php echo $this->_tpl_vars['form_data']['msg']['label']; ?>
</td>
				<td><?php echo $this->_tpl_vars['form_data']['msg']['html']; ?>
</td>
			</tr>
			<tr class="normal"> 
				<td><?php echo $this->_tpl_vars['form_data']['temail']['label']; ?>
</td>
				<td><?php echo $this->_tpl_vars['form_data']['temail']['html']; ?>
</td>
			</tr>
			<tr class="normal"> 
				<td colspan="2" align="left"><?php echo $this->_tpl_vars['form_data']['requirednote']; ?>
</td>
			</tr>
			<tr class="normal"> 
				<td colspan="2" align="center"><?php echo $this->_tpl_vars['form_data']['submit']['html'];  echo $this->_tpl_vars['form_data']['close']['html']; ?>

			</td>
			</tr>
		</table>
	</form>
</div>
<?php if ($this->_tpl_vars['popup_msg_text']): ?>
	<script language="Javascript" type="text/javascript">
		alert("<?php echo $this->_tpl_vars['popup_msg_text']; ?>
");
	</script>
<?php endif; ?>
</body>
</html>