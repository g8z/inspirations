<?php /* Smarty version 2.6.13, created on 2006-11-22 19:11:41
         compiled from admin_users.tpl */ ?>
<?php if ($this->_tpl_vars['form_data']['javascript']):  echo $this->_tpl_vars['form_data']['javascript'];  endif; ?>
<form <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
	<?php echo $this->_tpl_vars['form_data']['hidden']; ?>

	<input type="hidden" name="userID" value="<?php echo $this->_tpl_vars['user_id']; ?>
" />
	<?php if ($this->_tpl_vars['user_id'] == 0): ?>
		<input type="hidden" name="form" value="first" />
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
							<td colspan="2" class="formHeader"><?php echo $this->_tpl_vars['lang']['edit_or_remove_a_user']; ?>
</td>
						</tr>
						<tr> 
							<td width="47%" class="normal"><?php echo $this->_tpl_vars['lang']['choose_a_user_by_username']; ?>
</td>
							<td width="53%"><?php echo $this->_tpl_vars['form_data']['userID1']['html']; ?>
</td>
						</tr>
						<tr> 
							<td class="normal"><?php echo $this->_tpl_vars['lang']['choose_a_user_by_email']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_data']['userID2']['html']; ?>
</td>
						</tr>
						<tr> 
							<td>&nbsp;</td>
							<td><?php echo $this->_tpl_vars['form_data']['submit']['html']; ?>
</td>
						</tr>
						<tr> 
							<td colspan="2" class="normal"><?php echo $this->_tpl_vars['lang']['to_add_a_user']; ?>
<br /><br /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?php else: ?>
		<input type="hidden" name="form" value="second" />
		<table summary="" width="100%" border="1" cellpadding="1" cellspacing="0" class="white">
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
							<td colspan="2" class="formHeader"><?php echo $this->_tpl_vars['lang']['edit_or_remove_this_user']; ?>
</td>
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
<br /> <?php echo $this->_tpl_vars['lang']['please_leave_field_blank']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_data']['password']['html']; ?>
</td>
						</tr>
						<?php if ($this->_tpl_vars['form_data']['removeadmin']['html'] != ""): ?>
							<tr>
								<td class="normal"><?php echo $this->_tpl_vars['lang']['remove_admin_privileges']; ?>
</td>
								<td><?php echo $this->_tpl_vars['form_data']['removeadmin']['html']; ?>
</td>
							</tr>	
						<?php endif; ?>
						<?php if ($this->_tpl_vars['form_data']['makeadmin']['html'] != ""): ?>
							<tr>
								<td class="normal"><?php echo $this->_tpl_vars['lang']['grant_this_user_admin_privileges']; ?>
</td>
								<td><?php echo $this->_tpl_vars['form_data']['makeadmin']['html']; ?>
</td>
							</tr>
						<?php endif; ?>
						<tr>
							<td class="normal"><?php echo $this->_tpl_vars['lang']['email_notification_sent_to_this_user']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_data']['sendmail']['html']; ?>
</td>
						</tr>
						<tr>
							<td class="normal"><?php echo $this->_tpl_vars['lang']['remove_all_submissions']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_data']['removeSubmissions']['html']; ?>
</td>
						</tr>
						<tr>
							<td width="46%" class="normal"><?php echo $this->_tpl_vars['lang']['if_this_password_expires']; ?>
</td>
							<td width="54%"><?php echo $this->_tpl_vars['form_data']['expire']['html'];  echo $this->_tpl_vars['form_data']['setExpire']['html']; ?>
<span class="normal"><?php echo $this->_tpl_vars['lang']['update_expiration_date']; ?>
</span></td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="right">
								<?php echo $this->_tpl_vars['form_data']['submit']['html']; ?>

								<?php echo $this->_tpl_vars['form_data']['remove']['html']; ?>

								<?php echo $this->_tpl_vars['form_data']['reset']['html']; ?>

								<?php echo $this->_tpl_vars['form_data']['back']['html']; ?>

								</div><br />
							</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>

	<?php endif; ?>
</form>