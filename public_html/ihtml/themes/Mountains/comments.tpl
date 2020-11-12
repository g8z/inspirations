<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	{if $top_message}
		<tr>
			<td class="white" style="padding-bottom:10px;">{$top_message}</td>
		</tr>
	
	{/if}
			<tr>
				<td class="border">
					<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" width="100%">
					<tbody>
						<tr class="headerBackground">
							<td class="inspirationHeader">{$item.title}</td>
							<td class="inspirationHeader" style="text-align:right; font-weight: normal;" nowrap>
							<a href="index.php?cmd=15&amp;ID={$item.ID}" target="printWindow">{$lang.print}</a> | 
							<a href="javascript:SendEmail('{$item.ID}');">{$lang.email}</a>
							{ if $item.edit } | <a href="index.php?cmd=20&amp;inputc={$item.ID}">{$lang.edit|lower}</a>{/if}
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<span class="normal">{if $item.image_data}<img src="{$smarty.const.HOME}include/get_image.php?ID={$item.ID}" {$item.image_align} alt="Image" />{/if}{$item.text}</span>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table summary="" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td><span class="normal">{$lang.author}: {if $item.author}{$item.author}{else}{$lang.anonymous}{/if}</span></td>
										<td align="right">
											<span class="normal">{$lang.contributed_by} { if $item.hide_email=="Y"}{$item.user}{else}<a class="contributor_link" href="mailto:{$item.user_data.email}">{$item.user}</a>{/if} {$lang.on} {$item.created}</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
{if $Page.internal.conf.allow_comments == 'Y'}
			<tr>
				<td class="normal">
					<br />
					<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" width="100%">
					<tbody>
						<tr class="headerBackground">
							<td class="inspirationHeader">{$lang.comments} {if $item.allow_comments == 'N'}<span class="normal">({$lang.add_disabled})</span>{/if}</td>
							<td class="inspirationHeader" style="text-align:right; font-weight: normal;">
								{if $item.allow_comments == 'Y'}<a href="index.php?cmd=22&amp;ID={$item.ID}">{$lang.add_a_comment}</a>{if $item.stop_comments} | <a href="index.php?cmd=21&amp;sID={$item.ID}">{$lang.stop_comments}</a>{/if}{/if}</td>
						</tr>
		{if $comments} 
					{section name=k loop=$comments}
						<tr>
							<td class="normal"><b>{$comments[k].title}</b>
								<br />
								<i>{$lang.by} {if $comments[k].author}{if $comments[k].hide_email=="Y"}{$comments[k].author}{else}<a class="contributor_link" href="mailto:{$comments[k].email}">{$comments[k].author}</a>{/if}{else}{$lang.anonymous}{/if}
							{if $comments[k].user_data.login}({$comments[k].user_data.login}){/if} {$lang.on} {$comments[k].created}</i>
							</td>
							<td class="normal" align="right">
							{if $comments[k].edit}<a href="index.php?cmd=23&amp;ID={$comments[k].ID}">{$lang.edit}</a>{/if}
							</td>
						</tr>
						<tr>
							<td class="bottom-border" colspan="2">
								{$comments[k].text}
							</td>
						</tr>
					{/section}
		{/if}
					</table>
				</td>
			</tr>
{/if}
</table>
{if $paging.item_prev!=-1 OR $paging.item_next!=-1}
<table summary="" class="headerBackground" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td align="left">
				{if $paging.item_prev!=-1}
					<a href="index.php?paging={$paging.item_prev}&amp;ID={$item.ID}&amp;cmd=21">{$lang.previous} {$Page.internal.conf.comments_per_page}</a>
				{/if}
			</td>
			<td align="right">
				{if $paging.item_next!=-1}
					<a href="index.php?paging={$paging.item_next}&amp;ID={$item.ID}&amp;cmd=21">{$lang.next} {$paging.comments_end}</a>
				{/if}
			</td>
		</tr>
	</tbody>
</table>
{/if}
<table summary="" class="normal" border="0" cellpadding="0" cellspacing="1" width="100%">
<tr>
	<td>
{if $paging.item_prev!=-1 OR $paging.item_next!=-1}
		{$paging.items_total} {$lang.comments_were_found}
		{$lang.now_showing}  {if $paging.page_start==$paging.page_end}{$paging.page_end}{else}{$paging.page_start} {$lang.through}  {$paging.page_end}{/if}.
{else}&nbsp;
{/if}
	</td>
	<td align="right">
{if $paging.items_total > 1}
		{$paging.comments_sort}
{else}&nbsp;
{/if}
	</td>
</tr>
</table>

