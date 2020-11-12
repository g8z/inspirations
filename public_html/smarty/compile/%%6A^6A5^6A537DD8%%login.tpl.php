<?php /* Smarty version 2.6.13, created on 2006-11-22 19:11:29
         compiled from login.tpl */ ?>
<?php if ($this->_tpl_vars['login_form_data']['javascript']):  echo $this->_tpl_vars['login_form_data']['javascript'];  endif; ?>
<?php if ($this->_tpl_vars['ret_form_data']['javascript']):  echo $this->_tpl_vars['ret_form_data']['javascript'];  endif; ?>
<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	<?php if ($this->_tpl_vars['top_message']): ?>
		<tr>
			<td class="white" style="padding-bottom:10px;"><?php echo $this->_tpl_vars['top_message']; ?>
</td>
		</tr>

	<?php endif; ?>  
	<tr>
		<td class="border">
			<form <?php echo $this->_tpl_vars['login_form_data']['attributes']; ?>
>
				<?php echo $this->_tpl_vars['login_form_data']['hidden']; ?>

				<input type="hidden" name="form" value="login" />
			<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
			<tr class="normal">
				<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['login_here']; ?>
 </b></td>
			</tr>
			<tr class="normal" valign="top">
				<td width="20%" nowrap><?php echo $this->_tpl_vars['login_form_data']['username']['label']; ?>
</td>
				<td width="80%"><?php echo $this->_tpl_vars['login_form_data']['username']['html']; ?>
</td>
			</tr>
			<tr class="normal" valign="top">
				<td width="20%" nowrap><?php echo $this->_tpl_vars['login_form_data']['password']['label']; ?>
</td>
				<td width="80%"><?php echo $this->_tpl_vars['login_form_data']['password']['html']; ?>
</td>
			</tr>
			<tr class="normal">
				<td width="20%"></td>
				<td width="80%"><?php echo $this->_tpl_vars['login_form_data']['submit']['html']; ?>
</td>
			</tr>
			<tr class="normal">
				<td colspan=2><?php echo $this->_tpl_vars['login_form_data']['requirednote']; ?>
</td>
			</tr>
			</table>
			</form>
			<form <?php echo $this->_tpl_vars['ret_form_data']['attributes']; ?>
>
			<?php echo $this->_tpl_vars['ret_form_data']['hidden']; ?>

			<input type="hidden" name="form" value="ret" />
			<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
			<tr>
				<td colspan="2" align=left>&nbsp;</td>
			</tr>
			<tr>
				<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['forgot_your_login']; ?>
 </b></td>
			</tr>
			<tr class="normal">
				<td colspan="2" class="normal"><?php echo $this->_tpl_vars['lang']['enter_your_email_address_to_have_your_user']; ?>
 </td>
			</tr>
			<tr class="normal">
				<td colspan="2"><?php echo $this->_tpl_vars['ret_form_data']['email']['html'];  echo $this->_tpl_vars['ret_form_data']['submit']['html']; ?>

				</td>
			</tr>
			<tr class="normal">
				<td colspan="2"><span class=normal><?php echo $this->_tpl_vars['lang']['if_you_do_not_have_a_login_id']; ?>
  <a href="index.php?cmd=2"><?php echo $this->_tpl_vars['lang']['click_here_to_get_one']; ?>
 </a>.</span><br /><br />
				</td>
			</tr>
			</table>
			</form>
		</td>
	</tr>
</table>