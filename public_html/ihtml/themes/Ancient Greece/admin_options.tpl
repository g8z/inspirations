{if $form_data.javascript}{$form_data.javascript}{/if}
<form {$form_data.attributes}>
	{$form_data.hidden}
	<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
		{if $top_message}
			<tr>
				<td class="white" style="padding-bottom:10px;">{$top_message}</td>
			</tr>
		{/if}  
		<tr>
			<td class="border">
				<table summary="" width="100%" border="0" cellpadding="6" cellspacing="2" class="white">
					<tr>
						<td class="formHeader" colspan="2" align=left><b>{$lang.template_options}</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal">{$lang.current_template}</td>
						<td width="64%">
							{$form_data.siteTheme.html}&nbsp;&nbsp;[ <a href="index.php?cmd=8" class="mouseOverDark">{$lang.edit_stylesheet}</a> ]
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal">{$lang.category_display}</td>
						<td width="64%">
							{$form_data.category_display.html}&nbsp;<br />{$lang.choose_tree_to_edit_categories}
						</td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b>{$lang.global_user_settings}</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.allow_users_to_upload_pictures}</td>
						<td>{$form_data.allow_picture_uploads.html}
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.maximum_picture_size}</td>
						<td>{$form_data.max_picture_size.html}&nbsp;KB</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.maximum_picture_dimensions_in_pixels}</td>
						<td>
							{$form_data.max_picture_width.html}&nbsp;x&nbsp;
							{$form_data.max_picture_height.html}&nbsp;{$lang.pixels}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.always_hide_user_email}</td>
						<td>{$form_data.hide_user_emails.html}&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.member_counter_activation}</td>
						<td>{$form_data.allow_member_counter.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.member_counter_email_notify}</td>
						<td>{$form_data.enable_member_mail_notify.html}&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.auto_approve_posts}</td>
						<td>{$form_data.auto_approve.html}&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.allow_editing_of_posts}</td>
						<td>{$form_data.allow_edit.html}&nbsp;</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.allow_comments}</td>
						<td>{$form_data.allow_comments.html}&nbsp;</td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b>{$lang.admin_setting}</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.e_mail}</td>
						<td>{$form_data.admin_email.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.name}</td>
						<td>{$form_data.admin_name.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.notify_of_new_submissions}</td>
						<td>{$form_data.admin_notify.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.login_name}</td>
						<td>{$form_data.admin_login_id.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.password}</td>
						<td>{$form_data.admin_password.html}{$lang.leave_blank}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.confirm_password}</td>
						<td>{$form_data.admin_password1.html}&nbsp;</td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b>{$lang.page_options}</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.items_per_page}</td>
						<td>{$form_data.items_per_page.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.comments_per_page}</td>
						<td>{$form_data.comments_per_page.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.site_title}</td>
						<td>{$form_data.site_title.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.site_footer}</td>
						<td>{$form_data.site_footer.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.terms_of_service}</td>
						<td>{$form_data.terms_of_service.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.date_format}</td>
						<td>{$form_data.date_format.html}&nbsp;<A HREF = 'javascript:ShowCodes()'>{$lang.codes}</A></td>
					</tr>
					<tr>
						<td class="formHeader" colspan="2" align=left><b>{$lang.mail_server_options}</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.use_smtp}</td>
						<td>{$form_data.mailer_type.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.smtp_host}</td>
						<td>{$form_data.smtp_host.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.use_smtp_authentication}</td>
						<td>{$form_data.smtp_auth.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.smtp_username}</td>
						<td>{$form_data.smtp_username.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td>{$lang.smtp_password}</td>
						<td>{$form_data.smtp_password.html}</td>
					</tr>
					<tr class="normal">
						<td colspan="2" align="right"><br />
							{$form_data.submit.html}
						</td>
					</tr>

				</table>
			</td>
		</tr>
	</table>

</form>