<?php /* Smarty version 2.6.13, created on 2006-11-22 19:19:57
         compiled from search.tpl */ ?>
<?php if ($this->_tpl_vars['form_search']['javascript']):  echo $this->_tpl_vars['form_search']['javascript'];  endif; ?>
<form action="index.php" method=post name=searchForm>
	<?php echo $this->_tpl_vars['form_search']['hidden']; ?>

	<table summary="" width="400" border="0" align="center" cellpadding="4" cellspacing="0">
		<tr>
			<td height="22" nowrap>
				<div align="center">
					<span class="normal"><?php echo $this->_tpl_vars['lang']['search_word_or_phrase']; ?>
</span><span class="subtitleBold">&nbsp;</span>
					<?php echo $this->_tpl_vars['form_search']['search_key']['html']; ?>

				</div>
			</td>
		</tr>
		<tr>
			<td class=normal nowrap><?php echo $this->_tpl_vars['lang']['search_parameters']; ?>
 <?php echo $this->_tpl_vars['form_search']['search_cat']['html']; ?>
 <?php echo $this->_tpl_vars['form_search']['search_type']['html']; ?>
  <?php echo $this->_tpl_vars['form_search']['search_match_type']['html']; ?>

			<?php echo $this->_tpl_vars['form_search']['submit']['html']; ?>

			</td>
		</tr>
		<tr>
			<td nowrap>
				<div align="center"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
			</td>
		</tr>
	</table>
</form>