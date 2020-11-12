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
						<td colspan="2" class = "formHeader">
							{$lang.edit_or_remove_an_item}
						</td>
					</tr>
					<tr>
						<td colspan="2" class = "normal">
							{$lang.confirmed_items_are_editable}
						</td>
					</tr>
					<tr>
						<td width="60%" class="normal">{$lang.choose_the_category}</td>
						<td width="40%">{$form_data.list.html}</td>
					</tr>
					<tr>
						<td width="60%" class="normal">{$lang.select_the_item_to_edit}</td>
						<td width="40%">{$form_data.list_items.html}</td>
					</tr>
					<tr>
						<td class="normal"><b>{$lang.or}</b></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="normal">{$lang.if_you_know_the_id}</td>
						<td>{$form_data.inputc.html}</td>
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

{if $form_item}
<br />
	{if $form_item.javascript}{$form_item.javascript}{/if}
	<form {$form_item.attributes}>
		{$form_item.hidden}
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
							<td colspan="2" class = "formHeader">{$lang.id} {$item_data.ID} {$lang.edit_or_remove_item}</td>
						</tr>

						<tr class="normal">
							<td width="36%">{$lang.category}: </td>
							<td width="64%">{$form_item.category.html}</td>
						</tr>
						<tr class="normal">
							<td>{$lang.inspiration_title}: </td>
							<td>{$form_item.myTitle.html}</td>
						</tr>
						<tr class="normal">
							<td>{$lang.inspiration_text}: </td>
							<td>&nbsp;</td>
						</tr>
						<tr class="normal">
							<td colspan="2">{$form_item.text.html}</td>
						</tr>
						<tr class="normal">
							<td>{$lang.allow_comments}</td>
							<td>{$form_item.allow_comments.html}</td>
						</tr>
						{if $item_data.author&&$item_data.created}
							<tr class="normal">
								<td colspan="2" align=right nowrap>
									<span class=normal>{$lang.submitted_by} {$item_data.author} {$lang.on} {$item_data.created}</span>
								</td>
							</tr>
						{/if}
						<tr class="normal">
							<td align=right colspan=2>{$form_item.submit.html}{$form_item.remove.html}{$form_item.reset.html}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>


{/if}