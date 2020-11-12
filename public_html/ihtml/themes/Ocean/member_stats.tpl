<table summary="" border=0 cellpadding=1 cellspacing=0 width="100%" class="border">
	<tr>
		<td>
			<table summary="" class="white" width="100%" border="0" cellspacing="0" cellpadding="4" width="100%">
				<tr class="formHeader">
					<td width="25%">{$lang.posted_inspirations}</td>
					<td width="25%"></td>
					<td width="25%"></td>
					<td width="25%"></td>
				</tr>
				<tr class="normal">
					<td align="center" style="font-weight:bold">{$lang.inspiration_title}</td>
					<td align="center" style="font-weight:bold">{$lang.inspiration_category}</td>
					<td align="center" style="font-weight:bold">{$lang.number_of_views}</td>
					<td align="center" style="font-weight:bold">{$lang.number_of_comments}</td>
				</tr>
				{section name=k loop=$items}
				<tr class="normal">
						<td align="center">{$items[k].title}</td>
						<td align="center">{$items[k].cat_name}</td>
						<td align="center">{$items[k].num}</td>
						<td align="center">{$items[k].comments}</td>
				</tr>
				{/section}
			</table>
		</td>
	</tr>
</table>