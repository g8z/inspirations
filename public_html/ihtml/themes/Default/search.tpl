{if $form_search.javascript}{$form_search.javascript}{/if}
<form action="index.php" method=post name=searchForm>
	{$form_search.hidden}
	<table summary="" width="400" border="0" align="center" cellpadding="4" cellspacing="0">
		<tr>
			<td height="22" nowrap>
				<div align="center">
					<span class="normal">{$lang.search_word_or_phrase}</span><span class="subtitleBold">&nbsp;</span>
					{$form_search.search_key.html}
				</div>
			</td>
		</tr>
		<tr>
			<td class=normal nowrap>{$lang.search_parameters} {$form_search.search_cat.html} {$form_search.search_type.html}  {$form_search.search_match_type.html}
			{$form_search.submit.html}
			</td>
		</tr>
		<tr>
			<td nowrap>
				<div align="center">{include file="top_bar.tpl"}</div>
			</td>
		</tr>
	</table>
</form>