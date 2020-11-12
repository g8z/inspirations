{if $form_data.javascript}{$form_data.javascript}{/if}
{if $form_item}

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
							<td colspan="2" class = "formHeader">{$lang.id}{$item_data.ID} {$lang.edit_or_remove_item}</td>
						</tr>

						<tr class="normal">
							<td>{$lang.inspiration_title} </td>
							<td>{$form_item.myTitle.html}</td>
						</tr>
						<tr class="normal">
							<td>{$lang.inspiration_text} </td>
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
							<td align=right colspan=2>{$form_item.submit.html}{$form_item.reset.html}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>

{else}
	{if $top_message}
		{$top_message}
	{/if}
{/if}