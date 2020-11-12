<?php /* Smarty version 2.6.13, created on 2006-04-18 22:14:23
         compiled from admin_options.tpl */ ?>
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
				<table summary="" width="100%" border="0" cellpadding="6" cellspacing="2" class="white">
					<tr>
						<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['template_options']; ?>
</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal"><?php echo $this->_tpl_vars['lang']['current_template']; ?>
</td>
						<td width="64%">
							<?php echo $this->_tpl_vars['form_data']['siteTheme']['html']; ?>
&nbsp;&nbsp;[ <a href="index.php?cmd=8" class="mouseOverDark"><?php echo $this->_tpl_vars['lang']['edit_stylesheet']; ?>
</a> ]
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal"><?php echo $this->_tpl_vars['lang']['category_display']; ?>
</td>
						<td width="64%">
							<?php echo $this->_tpl_vars['form_data']['category_display']['html']; ?>
&nbsp;<br /><?php echo $this->_tpl_vars['lang']['choose_tree_to_edit_categories']; ?>

						</td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['global_user_settings']; ?>
</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['allow_users_to_upload_pictures']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['allow_picture_uploads']['html']; ?>

					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['maximum_picture_size']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['max_picture_size']['html']; ?>
&nbsp;KB</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['maximum_picture_dimensions_in_pixels']; ?>
</td>
						<td>
							<?php echo $this->_tpl_vars['form_data']['max_picture_width']['html']; ?>
&nbsp;x&nbsp;
							<?php echo $this->_tpl_vars['form_data']['max_picture_height']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['lang']['pixels']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['always_hide_user_email']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['hide_user_emails']['html']; ?>
&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['member_counter_activation']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['allow_member_counter']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['member_counter_email_notify']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['enable_member_mail_notify']['html']; ?>
&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['auto_approve_posts']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['auto_approve']['html']; ?>
&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['allow_editing_of_posts']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['allow_edit']['html']; ?>
&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['allow_comments']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['allow_comments']['html']; ?>
&nbsp;</td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['admin_setting']; ?>
</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['e_mail']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['admin_email']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['name']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['admin_name']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['notify_of_new_submissions']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['admin_notify']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['login_name']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['admin_login_id']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['password']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['admin_password']['html'];  echo $this->_tpl_vars['lang']['leave_blank']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['confirm_password']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['admin_password1']['html']; ?>
&nbsp;</td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['page_options']; ?>
</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['items_per_page']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['items_per_page']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['comments_per_page']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['comments_per_page']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['site_title']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['site_title']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['site_footer']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['site_footer']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['terms_of_service']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['terms_of_service']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['date_format']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['date_format']['html']; ?>
&nbsp;<A HREF = 'javascript:ShowCodes()'><?php echo $this->_tpl_vars['lang']['codes']; ?>
</A></td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['mail_server_options']; ?>
</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['use_smtp']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['mailer_type']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['smtp_host']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['smtp_host']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['use_smtp_authentication']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['smtp_auth']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['smtp_username']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['smtp_username']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td><?php echo $this->_tpl_vars['lang']['smtp_password']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['smtp_password']['html']; ?>
</td>
					</tr>
					<tr class="normal">
						<td colspan="2" align="right"><br />
							<?php echo $this->_tpl_vars['form_data']['submit']['html']; ?>

						</td>
					</tr>

				</table>
			</td>
		</tr>
	</table>

</form>