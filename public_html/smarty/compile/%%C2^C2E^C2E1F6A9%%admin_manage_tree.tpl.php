<?php /* Smarty version 2.6.13, created on 2006-04-21 21:49:37
         compiled from admin_manage_tree.tpl */ ?>
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
				<table summary="" width="100%" border="0" cellpadding="5" cellspacing="2" class="white">
					<tr>
						<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['manage_category_tree']; ?>
</b></td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal"><?php echo $this->_tpl_vars['form_data']['list1']['label']; ?>
<br /><?php echo $this->_tpl_vars['form_data']['list1']['html']; ?>
</td>
						<td class="normal"><?php echo $this->_tpl_vars['form_data']['list2']['label']; ?>
<br /><?php echo $this->_tpl_vars['form_data']['list2']['html']; ?>
</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" ><?php echo $this->_tpl_vars['form_data']['inputc']['label']; ?>
<br /><?php echo $this->_tpl_vars['form_data']['inputc']['html']; ?>
</td>
						<td class="normal" ><?php echo $this->_tpl_vars['form_data']['list3']['label']; ?>
<br /><?php echo $this->_tpl_vars['form_data']['list3']['html']; ?>
</td>
					</tr>
					<tr class="normal">
						<td colspan="2" align="right"><br />
							<?php echo $this->_tpl_vars['form_data']['submit']['html']; ?>
&nbsp;
							<?php echo $this->_tpl_vars['form_data']['update']['html']; ?>
&nbsp;
							<?php echo $this->_tpl_vars['form_data']['remove']['html']; ?>
&nbsp;
							<?php echo $this->_tpl_vars['form_data']['move']['html']; ?>
&nbsp;
							<?php echo $this->_tpl_vars['form_data']['approve']['html']; ?>
&nbsp;
							<?php echo $this->_tpl_vars['form_data']['reject']['html']; ?>
&nbsp;
						</td>
					</tr>

					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							<?php echo $this->_tpl_vars['lang']['to_add_node']; ?>
<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							<?php echo $this->_tpl_vars['lang']['to_edit_node']; ?>
<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							<?php echo $this->_tpl_vars['lang']['to_delete_node']; ?>
<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							<?php echo $this->_tpl_vars['lang']['to_move_node']; ?>
<br />
						</td>
					</tr>
					<tr class="normal" valign="top">
						<td class="normal" colspan=2>
							<?php echo $this->_tpl_vars['lang']['to_approve_node']; ?>
<br />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>