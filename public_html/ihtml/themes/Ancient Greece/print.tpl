<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>{$Page.credits.application}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$Page.internal.charset}" />
	{$css}
</head>

<body class = white {if $auto_print}onLoad="javascript:window.print();"{/if}>

	<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" style="width:500px">
	<tbody>
		<tr class="headerBackground">
			<td class="inspirationHeader">{$item_data.title}</td>
			<td class="normalSmall" align="right" nowrap></td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="normal">{if $item_data.image_data}<img src="{$smarty.const.HTML}include/get_image.php?ID={$item_data.ID}" {$item_data.image_align} alt="" />{/if}{$item_data.text}</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table summary="" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><span class="normal">{$lang.author}: {if $item_data.author}{$item_data.author}{else}{$lang.anonymous}{/if}</span></td>
						<td align="right">
							<span class="normal">{$lang.contributed_by} { if $item_data.hide_email=="Y"}{$item_data.user}{else}<a class="contributor_link" href="mailto:{$item_data.user_data.email}">{$item_data.user}</a>{/if} {$lang.on} {$item_data.created}</span>
						</td>
					</tr>
				</tbody>
				</table>
			</td>
		</tr>
	</tbody>
	</table>
	<br />

</body>
</html>
