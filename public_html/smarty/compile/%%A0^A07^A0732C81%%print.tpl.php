<?php /* Smarty version 2.6.13, created on 2006-04-14 03:30:55
         compiled from print.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title><?php echo $this->_tpl_vars['Page']['credits']['application']; ?>
</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['Page']['internal']['charset']; ?>
" />
	<?php echo $this->_tpl_vars['css']; ?>

</head>

<body class = white>

	<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" style="width:500px">
	<tbody>
		<tr class="headerBackground">
			<td class="inspirationHeader"><?php echo $this->_tpl_vars['item_data']['title']; ?>
</td>
			<td class="normalSmall" align="right" nowrap></td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="normal"><?php if ($this->_tpl_vars['item_data']['image_data']): ?><img src="<?php echo @HTML; ?>
include/get_image.php?ID=<?php echo $this->_tpl_vars['item_data']['ID']; ?>
" <?php echo $this->_tpl_vars['item_data']['image_align']; ?>
 alt="" /><?php endif;  echo $this->_tpl_vars['item_data']['text']; ?>
</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table summary="" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><span class="normal"><?php echo $this->_tpl_vars['lang']['author']; ?>
: <?php if ($this->_tpl_vars['item_data']['author']):  echo $this->_tpl_vars['item_data']['author'];  else:  echo $this->_tpl_vars['lang']['anonymous'];  endif; ?></span></td>
						<td align="right">
							<span class="normal"><?php echo $this->_tpl_vars['lang']['contributed_by']; ?>
 <?php if ($this->_tpl_vars['item_data']['hide_email'] == 'Y'):  echo $this->_tpl_vars['item_data']['user'];  else: ?><a class="contributor_link" href="mailto:<?php echo $this->_tpl_vars['item_data']['user_data']['email']; ?>
"><?php echo $this->_tpl_vars['item_data']['user']; ?>
</a><?php endif; ?> <?php echo $this->_tpl_vars['lang']['on']; ?>
 <?php echo $this->_tpl_vars['item_data']['created']; ?>
</span>
						</td>
					</tr>
				</tbody>
				</table>
			</td>
		</tr>
	</tbody>
	</table>
	<br />

</body>
</html>