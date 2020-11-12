<?xml version="1.0" encoding="{$Page.internal.charset}" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$Page.credits.HTML_Title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$Page.internal.charset}" />
	<meta name="description" content="{$Page.credits.HTML_Description}" />
  	{$css}
	<script src="{$smarty.const.IHTML}common/js/javascript.js" language="JavaScript" type="text/javascript"></script>
	<script src="{$smarty.const.IHTML}common/js/validation.js" language="JavaScript" type="text/javascript"></script>
	<script src="{$smarty.const.IHTML}common/js/picker.js" language="JavaScript" type="text/javascript"></script>
	<script src="{$smarty.const.IHTML}common/HTML_TreeMenuXL/TreeMenu.js" language="JavaScript" type="text/javascript"></script>

</head>

<body style="margin: 0" class="background">

	<table summary="" border="0" cellpadding="0" cellspacing="0" width="750">
		<tr>
			<td height="34">&nbsp;</td>
			<td height="34" align=center>
				<a href="index.php">{ LoadImage name="inspirationsTitle" src=$smarty.const.SITE|cat:"images/inspirationsTitle.gif" }</a>
				{include file="search.tpl"}
			</td>
		</tr>
		<tr>
			<td width="132" height="89" valign=top>
				<table summary="" width="100%" border="0" cellspacing="0" cellpadding="2">
					<tr>
						<!-- Title picture for the category sidebar is inserted here -->
						<td>{LoadImage name="categoriesTitle" src=$smarty.const.SITE|cat:"images/categoriesTitle.gif"}</td>
					</tr>
					<tr>
						<td style = 'padding:7px'>
							<!-- Category Sidebar is inserted here -->
							{include file="side_bar.tpl"}
						</td>
					</tr>
				</table>
			</td>
			<td width="668" valign="top">
				<table summary="" border=0 cellpadding=5 cellspacing=0 width=100%>
					<tr>
						<td valign=top>
							<!-- Content Page is inserted here -->
							{if $security_warning}
								<table summary="" border=0 width="100%" style="border:1px solid red;">
									<tr>
										<td class="normalRed" style="font-weight:bold;" align="center">{$lang.security_alert}</td>
									</tr>
									<tr>
										<td class="normalRed">{$lang.attention}</td>
									</tr>
								</table>
								<br />
							{/if}
							{$Page.internal.content}
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="right" class="normal"><br />{$lang.select_language}{$form_lang.select_lang.html}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align=center>
				<table summary="" width=100% border=0 cellpadding=4 cellspacing=0>
					<tr>
						<td align=center>
							<!-- Page Footer is defined here -->
							<span class=normal>{$Page.internal.conf.site_footer}</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align=center>
			<a target="_blank" href="http://www.tufat.com/inspirations.php">Powered by Inspirations</a>
			</td>
		</tr>
	</table>
</body>
</html>