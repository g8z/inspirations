<?php /* Smarty version 2.6.13, created on 2006-04-16 20:12:01
         compiled from admin_review.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'admin_review.tpl', 20, false),)), $this); ?>
<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white" style="margin-bottom:3px">
	<tr>
		<td class="border">
			<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
				<tr>
					<td class="formHeader" colspan="2" align=left><b><?php echo $this->_tpl_vars['lang']['new_inspiration_submissions']; ?>
</b></td>
				</tr>
				<?php if ($this->_tpl_vars['top_message']): ?>
					<tr>
						<td class="normal" colspan="2" style="padding:8px;" align=left><?php echo $this->_tpl_vars['top_message']; ?>
</td>
					</tr>
				<?php endif; ?>
			</table>
		</td>
	</tr>
</table>

<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['forms']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
	<?php $this->assign('ID', $this->_tpl_vars['forms'][$this->_sections['k']['index']]['raw']['ID']); ?>
	<?php $this->assign('cats', ((is_array($_tmp='cats_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ID']))); ?>
	<?php $this->assign('new_cat', ((is_array($_tmp='new_cat_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ID']))); ?>
	<?php $this->assign('myTitle', ((is_array($_tmp='myTitle_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ID']))); ?>
	<?php $this->assign('contributerName', ((is_array($_tmp='contributerName_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ID']))); ?>
	<?php $this->assign('hide_email', ((is_array($_tmp='hide_email_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ID']))); ?>
	<?php $this->assign('text', ((is_array($_tmp='text_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ID']))); ?>
	<?php $this->assign('sendmail', ((is_array($_tmp='sendmail_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ID']))); ?>


	<?php if ($this->_tpl_vars['forms'][$this->_sections['k']['index']]['javascript']):  echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['javascript'];  endif; ?>
	<form <?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['attributes']; ?>
>
		<?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['hidden']; ?>

		<input type="hidden" name="frmID" value="<?php echo $this->_tpl_vars['ID']; ?>
" />
		<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
			<tr>
				<td class="border">
					<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
						<tr>
							<td class="formHeader" colspan="2" align=left>
								<span class="normal"><?php echo $this->_tpl_vars['lang']['id']; ?>
 <?php echo $this->_tpl_vars['ID']; ?>
 <?php echo $this->_tpl_vars['lang']['submitted_by']; ?>
 <a style="text-decoration:none;" href="mailto:<?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['raw']['author_data']['email']; ?>
"><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['raw']['author_data']['name']; ?>
</a> <?php echo $this->_tpl_vars['lang']['on']; ?>
 <?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['raw']['created']; ?>
</span>
							</td>
						</tr>
						<tr class="normal" valign="top">
							<td width="50%"><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['cats']]['label']; ?>
</td>
							<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['cats']]['html']; ?>
</td>
						</tr>
						<?php if ($this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['new_cat']]['value']): ?>
							<tr class="normal" valign="top">
								<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['new_cat']]['label']; ?>
</td>
								<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['new_cat']]['html']; ?>
<br />[<a href="javascript:MakeSubcategory('<?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['cats']]['value'][0]; ?>
');"  class="mouseOverDark"> <?php echo $this->_tpl_vars['lang']['approve_suggested']; ?>
 </a>]</td>
							</tr>
						<?php endif; ?>
						<tr class=normal>
							<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['myTitle']]['label']; ?>
</td>
							<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['myTitle']]['html']; ?>
</td>
						</tr>
						<tr class=normal>
							<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['contributerName']]['label']; ?>
</td>
							<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['contributerName']]['html']; ?>
</td>
						</tr>
						<tr class="normal" valign="top">
							<td><?php echo $this->_tpl_vars['lang']['hide_email']; ?>
</td>
							<td><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['hide_email']]['html']; ?>

							</td>
						</tr>
						<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_picture_uploads'] == 'Y'): ?>
							<tr class="normal" valign="top">
								<td><?php echo $this->_tpl_vars['lang']['image']; ?>
</td>
								<td><?php if ($this->_tpl_vars['forms'][$this->_sections['k']['index']]['raw']['image_data']): ?><img src = "<?php echo @HOME; ?>
include/get_image.php?ID=<?php echo $this->_tpl_vars['ID']; ?>
"alt="" /><?php else:  echo $this->_tpl_vars['lang']['no_image_supplied'];  endif; ?></td>
							</tr>
						<?php endif; ?>
						<tr class="normal" valign="top">
							<td><?php echo $this->_tpl_vars['lang']['inspiration_text']; ?>
</td>
							<td></td>
						</tr>
						<tr class="normal" valign="top">
							<td colspan=2><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['text']]['html']; ?>
</td>
						</tr>
						<tr class="normal" valign="top">
							<td width="100%"><?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']][$this->_tpl_vars['sendmail']]['html']; ?>
</td>
							<td align="right" nowrap>
								<?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['submit']['html']; ?>
&nbsp;
								<?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['reject']['html']; ?>
&nbsp;
								<?php echo $this->_tpl_vars['forms'][$this->_sections['k']['index']]['reset']['html']; ?>
&nbsp;
							</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
	</form>
<?php endfor; endif; ?>