{if $form_data.javascript}{$form_data.javascript}{/if}
<form {$form_data.attributes}>
	{$form_data.hidden}
	<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
		{if $top_message}
			<tr>
				<td class="normalRed" style="padding-bottom:10px;">{$top_message}</td>
			</tr>

		{/if}
		{if $no_form==0}
			<tr>
				<td class="border">
					<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
						<tr>
							 <td class="formHeader" colspan="2" align=left><b>{$lang.contribute_an_inspiration}</b></td>
						</tr>
						<tr class="normal">
							<td width="36%">{$form_data.cats.label}</td>
							<td width="64%">{$form_data.cats.html}</td>
						</tr>
						<tr class="normal">
							<td width="36%">{$form_data.new_cat.label}</td>
							<td width="64%">{$form_data.new_cat.html}</td>
						</tr>
						<tr class="normal">
							<td>{$form_data.myTitle.label}</td>
							<td>{$form_data.myTitle.html}</td>
						</tr>
						<tr class=normal>
							<td>{$form_data.contributerName.label}</td>
							<td>{$form_data.contributerName.html}</td>
						</tr>
						<tr class="normal">
							<td>{$lang.hide_email}</td>
							<td>{$form_data.hide_email.html}</td>
						</tr>
						{if $Page.internal.conf.allow_picture_uploads=="Y"}
							<tr class="normal">
								<td>{$lang.image_optional}</td>
								<td>{$form_data.image.html}</td>
							</tr>
							<tr class="normal">
								<td>{$form_data.image_align.label}</td>
								<td>{$form_data.image_align.html}</td>
							</tr>
						{/if}
						{if $Page.internal.conf.allow_comments=="Y"}
							<tr class="normal">
								<td>{$lang.allow_comments}</td>
								<td>{$form_data.allow_comments.html}</td>
							</tr>
						{/if}
						<tr class="normal">
							<td>{$form_data.text.label}</td>
							<td></td>
						</tr>
						<tr class="normal">
							<td colspan=2>{$form_data.text.html}</td>
						</tr>
						<tr class=normal>
							<td colspan=2>
								{$lang.remember}<br /><br />
							</td>
						</tr>

						<tr class="normal">
							<td colspan=2>{$form_data.requirednote}</td>
						</tr>

						<tr class="normal">
							<td colspan="2" align="right"><br />
								{$form_data.submit.html}
							</td>
						</tr>
					</table>
				</td>
			</tr>
		{/if}
	</table>
</form>
