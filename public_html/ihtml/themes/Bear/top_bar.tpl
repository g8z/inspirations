<a href="{$smarty.const.HOME}index.php?cmd=1">{$lang.home}</a> | 
<a href="{$smarty.const.HOME}index.php?cmd=10{if $Page.internal.category}&amp;cat={$Page.internal.category}{/if}" class="mouseOverDark">{$lang.contribute}</a> |
{if $Page.internal.logged}
	{if $Page.internal.utype==1}
		<a href="{$smarty.const.HOME}index.php?cmd=5">{$lang.admin_panel}</a> | 
	{else}
		<a href="{$smarty.const.HOME}index.php?cmd=5">{$lang.account}</a> | 
	{/if}
	<a href="{$smarty.const.HOME}index.php?cmd=4">{$lang.logout}{if $user} {$user}{/if}</a>
{else}
	<a href="{$smarty.const.HOME}index.php?cmd=2" class="mouseOverDark">{$lang.register}</a>  |
	<a href="{$smarty.const.HOME}index.php?cmd=3">{$lang.login}</a>
{/if}


