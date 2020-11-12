<?php /* Smarty version 2.6.13, created on 2006-11-22 19:13:52
         compiled from account_member.tpl */ ?>
<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	<tr>
		<td class="border">
			<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
				<tr>
					<td class="formHeader"><b><?php echo $this->_tpl_vars['lang']['member_section']; ?>
</b></td>
				</tr>
				<tr>
					<td style="padding-top:15px;padding-left:15px;">
						<p class="normal"><a href="index.php?cmd=10"><?php echo $this->_tpl_vars['lang']['contribute_an_inspiration']; ?>
</a></p>
						<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_member_counter'] == 'Y'): ?>
							<p class="normal"><a href="index.php?cmd=18"><?php echo $this->_tpl_vars['lang']['view_your_rated_inspirations']; ?>
</a></p>
						<?php endif; ?>
							<p class="normal"><a href="index.php?cmd=19"><?php echo $this->_tpl_vars['lang']['change_your_password']; ?>
</a></p>
						<br /><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>