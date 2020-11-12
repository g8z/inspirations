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
				<table summary="" width="100%" border="0" cellpadding="5" cellspacing="2" class="white">
					<tr>
						<td class="formHeader" colspan="2" align=left><b>{$lang.manage_category_tree}</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal">{$form_data.list1.label}<br />{$form_data.list1.html}</td>
						<td class="normal">{$form_data.list2.label}<br />{$form_data.list2.html}</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" >{$form_data.inputc.label}<br />{$form_data.inputc.html}</td>
						<td class="normal" >{$form_data.list3.label}<br />{$form_data.list3.html}</td>
					</tr>
					<tr class="normal">
						<td colspan="2" align="right"><br />
							{$form_data.submit.html}&nbsp;
							{$form_data.update.html}&nbsp;
							{$form_data.remove.html}&nbsp;
							{$form_data.move.html}&nbsp;
							{$form_data.approve.html}&nbsp;
							{$form_data.reject.html}&nbsp;
						</td>
					</tr>

					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							{$lang.to_add_node}<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							{$lang.to_edit_node}<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							{$lang.to_delete_node}<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							{$lang.to_move_node}<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							{$lang.to_approve_node}<br />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>