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
				<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
					<tr>
						<td class="formHeader" colspan="2" align=left><b>{$lang.register_with_us}</b></td>
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
						<td class="normal">{$form_data.password.label}</td>
						<td>{$form_data.password.html}</td>
					</tr>
					<tr>
						<td class="normal">{$form_data.password1.label}</td>
						<td>{$form_data.password1.html}</td>
					</tr>
					<tr>
						<td class="normal">{$lang.email_notification_with_the_login_info}</td>
						<td>{$form_data.sendmail.html}</td>
					</tr>
					<tr>
						<td class="normal" valign=top>{$lang.terms_of_service}. {$lang.you_must_read_and_consent_to_these_terms}</td>
						<td>{$form_data.termsAgree.html}<span class="normal"> {$lang.i_agree_to_these_terms}</span><br />
							<textarea name="terms" cols="60" rows="5" class = "normal" id="terms">{$Page.internal.conf.terms_of_service}</textarea> 
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>{$form_data.submit.html}<br /><br /></td>
					</tr>
				</table>
			</TD>
		</TR>
	</TABLE>
</form>