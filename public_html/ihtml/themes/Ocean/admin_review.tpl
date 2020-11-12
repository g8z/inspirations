<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white" style="margin-bottom:3px">
	<tr>
		<td class="border">
			<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
				<tr>
					<td class="formHeader" colspan="2" align=left><b>{$lang.new_inspiration_submissions}</b></td>
				</tr>
				{if $top_message}
					<tr>
						<td class="normal" colspan="2" style="padding:8px;" align=left>{$top_message}</td>
					</tr>
				{/if}
			</table>
		</td>
	</tr>
</table>

{section name=k loop=$forms}
	{assign var=ID value=$forms[k].raw.ID}
	{assign var=cats value="cats_"|cat:$ID}
	{assign var=new_cat value="new_cat_"|cat:$ID}
	{assign var=myTitle value="myTitle_"|cat:$ID}
	{assign var=contributerName value="contributerName_"|cat:$ID}
	{assign var=hide_email value="hide_email_"|cat:$ID}
	{assign var=text value="text_"|cat:$ID}
	{assign var=sendmail value="sendmail_"|cat:$ID}


	{if $forms[k].javascript}{$forms[k].javascript}{/if}
	<form {$forms[k].attributes}>
		{$forms[k].hidden}
		<input type="hidden" name="frmID" value="{$ID}" />
		<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
			<tr>
				<td class="border">
					<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
						<tr>
							<td class="formHeader" colspan="2" align=left>
								<span class="normal">{$lang.id} {$ID} {$lang.submitted_by} <a style="text-decoration:none;" href="mailto:{$forms[k].raw.author_data.email}">{$forms[k].raw.author_data.name}</a> {$lang.on} {$forms[k].raw.created}</span>
							</td>
						</tr>
						<tr class="normal" valign="top">
							<td width="50%">{$forms[k][$cats].label}</td>
							<td>{$forms[k][$cats].html}</td>
						</tr>
						{if $forms[k][$new_cat].value}
							<tr class="normal" valign="top">
								<td>{$forms[k][$new_cat].label}</td>
								<td>{$forms[k][$new_cat].html}<br />[<a href="javascript:MakeSubcategory('{$forms[k][$cats].value[0]}');"  class="mouseOverDark"> {$lang.approve_suggested} </a>]</td>
							</tr>
						{/if}
						<tr class=normal>
							<td>{$forms[k][$myTitle].label}</td>
							<td>{$forms[k][$myTitle].html}</td>
						</tr>
						<tr class=normal>
							<td>{$forms[k][$contributerName].label}</td>
							<td>{$forms[k][$contributerName].html}</td>
						</tr>
						<tr class="normal" valign="top">
							<td>{$lang.hide_email}</td>
							<td>{$forms[k][$hide_email].html}
							</td>
						</tr>
						{if $Page.internal.conf.allow_picture_uploads=="Y"}
							<tr class="normal" valign="top">
								<td>{$lang.image}</td>
								<td>{if $forms[k].raw.image_data}<img src = "{$smarty.const.HOME}include/get_image.php?ID={$ID}"alt="" />{else}{$lang.no_image_supplied}{/if}</td>
							</tr>
						{/if}
						<tr class="normal" valign="top">
							<td>{$lang.inspiration_text}</td>
							<td></td>
						</tr>
						<tr class="normal" valign="top">
							<td colspan=2>{$forms[k][$text].html}</td>
						</tr>
						<tr class="normal" valign="top">
							<td width="100%">{$forms[k][$sendmail].html}</td>
							<td align="right" nowrap>
								{$forms[k].submit.html}&nbsp;
								{$forms[k].reject.html}&nbsp;
								{$forms[k].reset.html}&nbsp;
							</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
	</form>
{/section}
