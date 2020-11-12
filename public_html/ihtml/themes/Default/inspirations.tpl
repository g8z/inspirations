<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	{if $top_message}
		<tr>
			<td class="white" style="padding-bottom:10px;">{$top_message}</td>
		</tr>
	
	{/if}
	{if $paging.items_total}
		{section name=k loop=$items}
			<tr>
				<td class="border">
					<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" width="100%">
					<tbody>
						<tr class="headerBackground">
							<td class="inspirationHeader">{$items[k].title}</td>
							<td class="inspirationHeader" style="text-align:right; font-weight: normal;" nowrap>
							<a href="index.php?cmd=15&amp;ID={$items[k].ID}" target="printWindow">{$lang.print}</a> | 
							<a href="javascript:SendEmail('{$items[k].ID}');">{$lang.email}</a>
							{ if $items[k].edit } | <a href="index.php?cmd=20&amp;inputc={$items[k].ID}">{$lang.edit|lower}</a>{/if}
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<span class="normal">{if $items[k].image_data}<img src="{$smarty.const.HOME}include/get_image.php?ID={$items[k].ID}" {$items[k].image_align} alt="Image" />{/if}{$items[k].text}</span>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table summary="" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td><span class="normal">{$lang.author}: {if $items[k].author}{$items[k].author}{else}{$lang.anonymous}{/if}</span></td>
										<td align="right">
											<span class="normal">{$lang.contributed_by} { if $items[k].hide_email=="Y"}{$items[k].user}{else}<a class="contributor_link" href="mailto:{$items[k].user_data.email}">{$items[k].user}</a>{/if} {$lang.on} {$items[k].created}</span>
										</td>
									</tr>
								</table>
								<br />
								{if $Page.internal.conf.allow_member_counter == 'Y' OR $Page.internal.conf.allow_comments == 'Y'} 
								<table summary="" width="100%" class="white">
									<tr>
										<td>
											{if $Page.internal.conf.allow_member_counter == 'Y'}<a href="javascript:Vote('{$items[k].ID}');">{$lang.i_have_read_this_post}</a>{else}&nbsp;{/if}
										</td>
										<td align="right" nowrap class="normal">
											{if $Page.internal.conf.allow_comments == 'Y'}<a href="index.php?cmd=21&amp;ID={$items[k].ID}">{$lang.comments} ({$comments[k].total})</a>{else}&nbsp;{/if}
										</td>
									</tr>
								</table>
								{/if}
							</td>
						</tr>
					</table>
				</td>
			</tr>
		{if $smarty.section.k.index != $paging.items_total - 1}
			<tr>
				<td class="normal">
					<br />
				</td>
			</tr>
		{/if}
		{/section}
	{else}
		<tr>
			<td class="border">
				<table summary="" class="white" border="0" cellpadding="3" cellspacing="5" width="100%">
					<tr>
						<td>
							<span class="normal">

							{if $search.submitted}
								{$lang.no_results_returned}
							{else}
								{$lang.no_inspirations}<br /><br />{$lang.why_not} <a href="index.php?cmd=10">{$lang.contribute|lower}</a> {$lang.one}
							{/if}
							</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	{/if}
</table>
{if $paging.items_total>$Page.internal.conf.items_per_page}
	{if $search.search_key}
		{assign var=search_crit value="&amp;search_submitted="|cat:$search.submitted|cat:"&amp;search_key="|cat:$search.search_key|cat:"&amp;search_cat="|cat:$search.search_cat|cat:"&amp;search_type="|cat:$search.search_type|cat:"&amp;search_match_type="|cat:$search.search_match_type}
	{else}
		{assign var=search_crit value=""}
	{/if}
	<table summary="" class="headerBackground" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td align="left">
				{if $paging.item_prev!=-1}
					<a href="index.php?paging={$paging.item_prev}&amp;cat={$Page.internal.category}{$search_crit}">{$lang.previous} {$Page.internal.conf.items_per_page}</a>
				{/if}
			</td>
			<td align="right">
				{if $paging.item_next!=-1}
					<a href="index.php?paging={$paging.item_next}&amp;cat={$Page.internal.category}{$search_crit}">{$lang.next} {$paging.items_end}</a>
				{/if}
			</td>
		</tr>
	</tbody>
	</table>
	<span class="normal">{$paging.items_total} {$lang.contributions_were_found} </span> 
	<span class="normal">
		{$lang.now_showing}  {if $paging.page_start==$paging.page_end}{$paging.page_end}{else}{$paging.page_start} {$lang.through}  {$paging.page_end}{/if}.
	</span>
{/if}
