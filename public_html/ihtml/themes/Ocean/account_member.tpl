<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	<tr>
		<td class="border">
			<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
				<tr>
					<td class="formHeader"><b>{$lang.member_section}</b></td>
				</tr>
				<tr>
					<td style="padding-top:15px;padding-left:15px;">
						<p class="normal"><a href="index.php?cmd=10">{$lang.contribute_an_inspiration}</a></p>
						{if $Page.internal.conf.allow_member_counter=="Y"}
							<p class="normal"><a href="index.php?cmd=18">{$lang.view_your_rated_inspirations}</a></p>
						{/if}
							<p class="normal"><a href="index.php?cmd=19">{$lang.change_your_password}</a></p>
						<br /><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
