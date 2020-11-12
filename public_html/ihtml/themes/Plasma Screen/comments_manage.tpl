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
					<td class="formHeader" colspan="2" align=left><b>{if $cmd == 22}{$lang.add_a_comment}{else}{$lang.modify_a_comment}{/if}</b></td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap">{$form_data.myTitle.label}</td>
					<td width="99%">{$form_data.myTitle.html}</td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap">{$form_data.contributerName.label}</td>
					<td>{$form_data.contributerName.html}</td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap">{$form_data.email.label}</td>
					<td>{$form_data.email.html}</td>
				</tr>
				<tr class="normal">
					 <td nowrap="nowrap">{$form_data.hide_email.label}</td>
					 <td>{$form_data.hide_email.html}</td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap">{$form_data.text.label}</td>
					<td>{$form_data.text.html}</td>
				</tr>
				<tr class="normal">
					<td colspan=2>{$form_data.requirednote}</td>
				</tr>
				<tr class="normal">
					<td colspan="2" align="right"><br />
						{$form_data.submit.html}
				{if $modify}	{$form_data.remove.html} {/if}
						{$form_data.reset.html}
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>

