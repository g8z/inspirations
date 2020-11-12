<?php /* Smarty version 2.6.13, created on 2006-11-22 19:19:56
         compiled from register.tpl */ ?>
<?php if ($this->_tpl_vars['form_data']['javascript']):  echo $this->_tpl_vars['form_data']['javascript'];  endif; ?>
<form <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
	<?php echo $this->_tpl_vars['form_data']['hidden']; ?>

	<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
		<?php if ($this->_tpl_vars['top_message']): ?>
			<tr>
				<td class="white" style="padding-bottom:10px;"><?php echo $this->_tpl_vars['top_message']; ?>
</td>
			</tr>
		<?php endif; ?>
		<tr>
			<td class="border">
				<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
					<tr>
						<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['register_with_us']; ?>
</b></td>
					</tr>
					<tr>
						<td width="46%" class="normal"><?php echo $this->_tpl_vars['form_data']['fullname']['label']; ?>
</td>
						<td width="54%"><?php echo $this->_tpl_vars['form_data']['fullname']['html']; ?>
</td>
					</tr>
					<tr>
						<td class="normal"><?php echo $this->_tpl_vars['form_data']['email']['label']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['email']['html']; ?>
</td>
					</tr>
					<tr>
						<td class="normal" nowrap><?php echo $this->_tpl_vars['form_data']['username']['label']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['username']['html']; ?>
</td>
					</tr>
					<tr>
						<td class="normal"><?php echo $this->_tpl_vars['form_data']['password']['label']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['password']['html']; ?>
</td>
					</tr>
					<tr>
						<td class="normal"><?php echo $this->_tpl_vars['form_data']['password1']['label']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['password1']['html']; ?>
</td>
					</tr>
					<tr>
						<td class="normal"><?php echo $this->_tpl_vars['lang']['email_notification_with_the_login_info']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['sendmail']['html']; ?>
</td>
					</tr>
					<tr>
						<td class="normal" valign=top><?php echo $this->_tpl_vars['lang']['terms_of_service']; ?>
. <?php echo $this->_tpl_vars['lang']['you_must_read_and_consent_to_these_terms']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['termsAgree']['html']; ?>
<span class="normal"> <?php echo $this->_tpl_vars['lang']['i_agree_to_these_terms']; ?>
</span><br />
							<textarea name="terms" cols="60" rows="5" class = "normalSmall" id="terms"><?php echo $this->_tpl_vars['Page']['internal']['conf']['terms_of_service']; ?>
</textarea> 
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><?php echo $this->_tpl_vars['form_data']['submit']['html']; ?>
<br /><br /></td>
					</tr>
				</table>
			</TD>
		</TR>
	</TABLE>
</form>