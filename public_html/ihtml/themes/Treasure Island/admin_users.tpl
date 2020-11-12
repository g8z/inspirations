{if $form_data.javascript}{$form_data.javascript}{/if}
<form {$form_data.attributes}>
	{$form_data.hidden}
	<input type="hidden" name="userID" value="{$user_id}" />
	{if $user_id==0}
		<input type="hidden" name="form" value="first" />
		<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
		{if $top_message}
			<tr>
				<td class="white" style="padding-bottom:10px;">{$top_message}</td>
			</tr>
		{/if}
			<tr>
				<td class="border">
					<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
						<tr> 
							<td colspan="2" class="formHeader">{$lang.edit_or_remove_a_user}</td>
						</tr>
						<tr> 
							<td width="47%" class="normal">{$lang.choose_a_user_by_username}</td>
							<td width="53%">{$form_data.userID1.html}</td>
						</tr>
						<tr> 
							<td class="normal">{$lang.choose_a_user_by_email}</td>
							<td>{$form_data.userID2.html}</td>
						</tr>
						<tr> 
							<td>&nbsp;</td>
							<td>{$form_data.submit.html}</td>
						</tr>
						<tr> 
							<td colspan="2" class="normal">{$lang.to_add_a_user}<br /><br /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	{else}
		<input type="hidden" name="form" value="second" />
		<table summary="" width="100%" border="1" cellpadding="1" cellspacing="0" class="white">
			{if $top_message}
				<tr>
					<td class="white" style="padding-bottom:10px;">{$top_message}</td>
				</tr>
			{/if}
			<tr>
				<td class="border">
					<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
						<tr>
							<td colspan="2" class="formHeader">{$lang.edit_or_remove_this_user}</td>
						</tr>
						<tr>
							<td width="46%" class="normal">{$form_data.fullname.label}</td>
							<td width="54%">{$form_data.fullname.html}</td>
						</tr>
						<tr>
							<td class="normal">{$form_data.email.label}</td>
							<td>{$form_data.email.html}</td>
						</tr>
						<tr>
							<td class="normal" nowrap>{$form_data.username.label}</td>
							<td>{$form_data.username.html}</td>
						</tr>
						<tr>
							<td class="normal">{$form_data.password.label}<br /> {$lang.please_leave_field_blank}</td>
							<td>{$form_data.password.html}</td>
						</tr>
						{ if $form_data.removeadmin.html != "" }
							<tr>
								<td class="normal">{$lang.remove_admin_privileges}</td>
								<td>{$form_data.removeadmin.html}</td>
							</tr>	
						{/if}
						{ if $form_data.makeadmin.html != "" }
							<tr>
								<td class="normal">{$lang.grant_this_user_admin_privileges}</td>
								<td>{$form_data.makeadmin.html}</td>
							</tr>
						{/if}
						<tr>
							<td class="normal">{$lang.email_notification_sent_to_this_user}</td>
							<td>{$form_data.sendmail.html}</td>
						</tr>
						<tr>
							<td class="normal">{$lang.remove_all_submissions}</td>
							<td>{$form_data.removeSubmissions.html}</td>
						</tr>
						<tr>
							<td width="46%" class="normal">{$lang.if_this_password_expires}</td>
							<td width="54%">{$form_data.expire.html}{$form_data.setExpire.html}<span class="normal">{$lang.update_expiration_date}</span></td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="right">
								{$form_data.submit.html}
								{$form_data.remove.html}
								{$form_data.reset.html}
								{$form_data.back.html}
								</div><br />
							</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>

	{/if}
</form>