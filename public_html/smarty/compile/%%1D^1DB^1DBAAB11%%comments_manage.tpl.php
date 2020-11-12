<?php /* Smarty version 2.6.13, created on 2006-04-21 20:49:06
         compiled from comments_manage.tpl */ ?>
<?php if ($this->_tpl_vars['form_data']['javascript']):  echo $this->_tpl_vars['form_data']['javascript'];  endif; ?>
<form <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
<?php echo $this->_tpl_vars['form_data']['hidden']; ?>

<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	<?php if ($this->_tpl_vars['top_message']): ?>
		<tr>
			<td class="white" style="padding-bottom:10px;"><?php echo $this->_tpl_vars['top_message']; ?>
</td>
		</tr>
	
	<?php endif; ?>
	<tr>
		<td class="border">
			<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
				<tr>
					<td class="formHeader" colspan="2" align=left><b><?php if ($this->_tpl_vars['cmd'] == 22):  echo $this->_tpl_vars['lang']['add_a_comment'];  else:  echo $this->_tpl_vars['lang']['modify_a_comment'];  endif; ?></b></td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap"><?php echo $this->_tpl_vars['form_data']['myTitle']['label']; ?>
</td>
					<td width="99%"><?php echo $this->_tpl_vars['form_data']['myTitle']['html']; ?>
</td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap"><?php echo $this->_tpl_vars['form_data']['contributerName']['label']; ?>
</td>
					<td><?php echo $this->_tpl_vars['form_data']['contributerName']['html']; ?>
</td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap"><?php echo $this->_tpl_vars['form_data']['email']['label']; ?>
</td>
					<td><?php echo $this->_tpl_vars['form_data']['email']['html']; ?>
</td>
				</tr>
				<tr class="normal">
					 <td nowrap="nowrap"><?php echo $this->_tpl_vars['form_data']['hide_email']['label']; ?>
</td>
					 <td><?php echo $this->_tpl_vars['form_data']['hide_email']['html']; ?>
</td>
				</tr>
				<tr class="normal">
					<td nowrap="nowrap"><?php echo $this->_tpl_vars['form_data']['text']['label']; ?>
</td>
					<td><?php echo $this->_tpl_vars['form_data']['text']['html']; ?>
</td>
				</tr>
				<tr class="normal">
					<td colspan=2><?php echo $this->_tpl_vars['form_data']['requirednote']; ?>
</td>
				</tr>
				<tr class="normal">
					<td colspan="2" align="right"><br />
						<?php echo $this->_tpl_vars['form_data']['submit']['html']; ?>

				<?php if ($this->_tpl_vars['modify']): ?>	<?php echo $this->_tpl_vars['form_data']['remove']['html']; ?>
 <?php endif; ?>
						<?php echo $this->_tpl_vars['form_data']['reset']['html']; ?>

					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
