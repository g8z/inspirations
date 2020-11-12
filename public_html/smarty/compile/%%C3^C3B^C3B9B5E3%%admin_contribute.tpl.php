<?php /* Smarty version 2.6.13, created on 2006-11-22 19:19:43
         compiled from admin_contribute.tpl */ ?>
<?php if ($this->_tpl_vars['form_data']['javascript']):  echo $this->_tpl_vars['form_data']['javascript'];  endif; ?>
<form <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
	<?php echo $this->_tpl_vars['form_data']['hidden']; ?>

	<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
		<?php if ($this->_tpl_vars['top_message']): ?>
			<tr>
				<td class="normalRed" style="padding-bottom:10px;"><?php echo $this->_tpl_vars['top_message']; ?>
</td>
			</tr>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['no_form'] == 0): ?>
			<tr>
				<td class="border">
					<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
						<tr>
							 <td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['contribute_an_inspiration']; ?>
</b></td>
						</tr>
						<tr class="normal">
							<td width="36%"><?php echo $this->_tpl_vars['form_data']['cats']['label']; ?>
</td>
							<td width="64%"><?php echo $this->_tpl_vars['form_data']['cats']['html']; ?>
</td>
						</tr>
						<tr class="normal">
							<td width="36%"><?php echo $this->_tpl_vars['form_data']['new_cat']['label']; ?>
</td>
							<td width="64%"><?php echo $this->_tpl_vars['form_data']['new_cat']['html']; ?>
</td>
						</tr>
						<tr class="normal">
							<td><?php echo $this->_tpl_vars['form_data']['myTitle']['label']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_data']['myTitle']['html']; ?>
</td>
						</tr>
						<tr class=normal>
							<td><?php echo $this->_tpl_vars['form_data']['contributerName']['label']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_data']['contributerName']['html']; ?>
</td>
						</tr>
						<tr class="normal">
							<td><?php echo $this->_tpl_vars['lang']['hide_email']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_data']['hide_email']['html']; ?>
</td>
						</tr>
						<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_picture_uploads'] == 'Y'): ?>
							<tr class="normal">
								<td><?php echo $this->_tpl_vars['lang']['image_optional']; ?>
</td>
								<td><?php echo $this->_tpl_vars['form_data']['image']['html']; ?>
</td>
							</tr>
							<tr class="normal">
								<td><?php echo $this->_tpl_vars['form_data']['image_align']['label']; ?>
</td>
								<td><?php echo $this->_tpl_vars['form_data']['image_align']['html']; ?>
</td>
							</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_comments'] == 'Y'): ?>
							<tr class="normal">
								<td><?php echo $this->_tpl_vars['lang']['allow_comments']; ?>
</td>
								<td><?php echo $this->_tpl_vars['form_data']['allow_comments']['html']; ?>
</td>
							</tr>
						<?php endif; ?>
						<tr class="normal">
							<td><?php echo $this->_tpl_vars['form_data']['text']['label']; ?>
</td>
							<td></td>
						</tr>
						<tr class="normal">
							<td colspan=2><?php echo $this->_tpl_vars['form_data']['text']['html']; ?>
</td>
						</tr>
						<tr class=normal>
							<td colspan=2>
								<?php echo $this->_tpl_vars['lang']['remember']; ?>
<br /><br />
							</td>
						</tr>

						<tr class="normal">
							<td colspan=2><?php echo $this->_tpl_vars['form_data']['requirednote']; ?>
</td>
						</tr>

						<tr class="normal">
							<td colspan="2" align="right"><br />
								<?php echo $this->_tpl_vars['form_data']['submit']['html']; ?>

							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php endif; ?>
	</table>
</form>