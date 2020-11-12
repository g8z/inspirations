<?php /* Smarty version 2.6.13, created on 2006-11-22 19:19:57
         compiled from top_bar.tpl */ ?>
<a href="<?php echo @HOME; ?>
index.php?cmd=1"><?php echo $this->_tpl_vars['lang']['home']; ?>
</a> | 
<a href="<?php echo @HOME; ?>
index.php?cmd=10<?php if ($this->_tpl_vars['Page']['internal']['category']): ?>&amp;cat=<?php echo $this->_tpl_vars['Page']['internal']['category'];  endif; ?>" class="mouseOverDark"><?php echo $this->_tpl_vars['lang']['contribute']; ?>
</a> |
<?php if ($this->_tpl_vars['Page']['internal']['logged']): ?>
	<?php if ($this->_tpl_vars['Page']['internal']['utype'] == 1): ?>
		<a href="<?php echo @HOME; ?>
index.php?cmd=5"><?php echo $this->_tpl_vars['lang']['admin_panel']; ?>
</a> | 
	<?php else: ?>
		<a href="<?php echo @HOME; ?>
index.php?cmd=5"><?php echo $this->_tpl_vars['lang']['account']; ?>
</a> | 
	<?php endif; ?>
	<a href="<?php echo @HOME; ?>
index.php?cmd=4"><?php echo $this->_tpl_vars['lang']['logout'];  if ($this->_tpl_vars['user']): ?> <?php echo $this->_tpl_vars['user'];  endif; ?></a>
<?php else: ?>
	<a href="<?php echo @HOME; ?>
index.php?cmd=2" class="mouseOverDark"><?php echo $this->_tpl_vars['lang']['register']; ?>
</a>  |
	<a href="<?php echo @HOME; ?>
index.php?cmd=3"><?php echo $this->_tpl_vars['lang']['login']; ?>
</a>
<?php endif; ?>

