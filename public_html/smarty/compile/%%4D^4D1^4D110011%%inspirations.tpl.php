<?php /* Smarty version 2.6.13, created on 2006-11-22 19:19:57
         compiled from inspirations.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'inspirations.tpl', 19, false),array('modifier', 'cat', 'inspirations.tpl', 86, false),)), $this); ?>
<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	<?php if ($this->_tpl_vars['top_message']): ?>
		<tr>
			<td class="white" style="padding-bottom:10px;"><?php echo $this->_tpl_vars['top_message']; ?>
</td>
		</tr>
	
	<?php endif; ?>
	<?php if ($this->_tpl_vars['paging']['items_total']): ?>
		<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr>
				<td class="border">
					<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" width="100%">
					<tbody>
						<tr class="headerBackground">
							<td class="inspirationHeader"><?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['title']; ?>
</td>
							<td class="inspirationHeader" style="text-align:right; font-weight: normal;" nowrap>
							<a href="index.php?cmd=15&amp;ID=<?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['ID']; ?>
" target="printWindow"><?php echo $this->_tpl_vars['lang']['print']; ?>
</a> | 
							<a href="javascript:SendEmail('<?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['ID']; ?>
');"><?php echo $this->_tpl_vars['lang']['email']; ?>
</a>
							<?php if ($this->_tpl_vars['items'][$this->_sections['k']['index']]['edit']): ?> | <a href="index.php?cmd=20&amp;inputc=<?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['ID']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['edit'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a><?php endif; ?>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<span class="normal"><?php if ($this->_tpl_vars['items'][$this->_sections['k']['index']]['image_data']): ?><img src="<?php echo @HOME; ?>
include/get_image.php?ID=<?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['ID']; ?>
" <?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['image_align']; ?>
 alt="Image" /><?php endif;  echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['text']; ?>
</span>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table summary="" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td><span class="normal"><?php echo $this->_tpl_vars['lang']['author']; ?>
: <?php if ($this->_tpl_vars['items'][$this->_sections['k']['index']]['author']):  echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['author'];  else:  echo $this->_tpl_vars['lang']['anonymous'];  endif; ?></span></td>
										<td align="right">
											<span class="normal"><?php echo $this->_tpl_vars['lang']['contributed_by']; ?>
 <?php if ($this->_tpl_vars['items'][$this->_sections['k']['index']]['hide_email'] == 'Y'):  echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['user'];  else: ?><a class="contributor_link" href="mailto:<?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['user_data']['email']; ?>
"><?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['user']; ?>
</a><?php endif; ?> <?php echo $this->_tpl_vars['lang']['on']; ?>
 <?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['created']; ?>
</span>
										</td>
									</tr>
								</table>
								<br />
								<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_member_counter'] == 'Y' || $this->_tpl_vars['Page']['internal']['conf']['allow_comments'] == 'Y'): ?> 
								<table summary="" width="100%" class="white">
									<tr>
										<td>
											<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_member_counter'] == 'Y'): ?><a href="javascript:Vote('<?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['ID']; ?>
');"><?php echo $this->_tpl_vars['lang']['i_have_read_this_post']; ?>
</a><?php else: ?>&nbsp;<?php endif; ?>
										</td>
										<td align="right" nowrap class="normal">
											<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_comments'] == 'Y'): ?><a href="index.php?cmd=21&amp;ID=<?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['ID']; ?>
"><?php echo $this->_tpl_vars['lang']['comments']; ?>
 (<?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['total']; ?>
)</a><?php else: ?>&nbsp;<?php endif; ?>
										</td>
									</tr>
								</table>
								<?php endif; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php if ($this->_sections['k']['index'] != $this->_tpl_vars['paging']['items_total'] - 1): ?>
			<tr>
				<td class="normal">
					<br />
				</td>
			</tr>
		<?php endif; ?>
		<?php endfor; endif; ?>
	<?php else: ?>
		<tr>
			<td class="border">
				<table summary="" class="white" border="0" cellpadding="3" cellspacing="5" width="100%">
					<tr>
						<td>
							<span class="normal">

							<?php if ($this->_tpl_vars['search']['submitted']): ?>
								<?php echo $this->_tpl_vars['lang']['no_results_returned']; ?>

							<?php else: ?>
								<?php echo $this->_tpl_vars['lang']['no_inspirations']; ?>
<br /><br /><?php echo $this->_tpl_vars['lang']['why_not']; ?>
 <a href="index.php?cmd=10"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['contribute'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a> <?php echo $this->_tpl_vars['lang']['one']; ?>

							<?php endif; ?>
							</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	<?php endif; ?>
</table>
<?php if ($this->_tpl_vars['paging']['items_total'] > $this->_tpl_vars['Page']['internal']['conf']['items_per_page']): ?>
	<?php if ($this->_tpl_vars['search']['search_key']): ?>
		<?php $this->assign('search_crit', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="&amp;search_submitted=")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['search']['submitted']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['search']['submitted'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "&amp;search_key=") : smarty_modifier_cat($_tmp, "&amp;search_key=")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['search']['search_key']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['search']['search_key'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "&amp;search_cat=") : smarty_modifier_cat($_tmp, "&amp;search_cat=")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['search']['search_cat']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['search']['search_cat'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "&amp;search_type=") : smarty_modifier_cat($_tmp, "&amp;search_type=")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['search']['search_type']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['search']['search_type'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "&amp;search_match_type=") : smarty_modifier_cat($_tmp, "&amp;search_match_type=")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['search']['search_match_type']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['search']['search_match_type']))); ?>
	<?php else: ?>
		<?php $this->assign('search_crit', ""); ?>
	<?php endif; ?>
	<table summary="" class="headerBackground" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td align="left">
				<?php if ($this->_tpl_vars['paging']['item_prev'] != -1): ?>
					<a href="index.php?paging=<?php echo $this->_tpl_vars['paging']['item_prev']; ?>
&amp;cat=<?php echo $this->_tpl_vars['Page']['internal']['category'];  echo $this->_tpl_vars['search_crit']; ?>
"><?php echo $this->_tpl_vars['lang']['previous']; ?>
 <?php echo $this->_tpl_vars['Page']['internal']['conf']['items_per_page']; ?>
</a>
				<?php endif; ?>
			</td>
			<td align="right">
				<?php if ($this->_tpl_vars['paging']['item_next'] != -1): ?>
					<a href="index.php?paging=<?php echo $this->_tpl_vars['paging']['item_next']; ?>
&amp;cat=<?php echo $this->_tpl_vars['Page']['internal']['category'];  echo $this->_tpl_vars['search_crit']; ?>
"><?php echo $this->_tpl_vars['lang']['next']; ?>
 <?php echo $this->_tpl_vars['paging']['items_end']; ?>
</a>
				<?php endif; ?>
			</td>
		</tr>
	</tbody>
	</table>
	<span class="normal"><?php echo $this->_tpl_vars['paging']['items_total']; ?>
 <?php echo $this->_tpl_vars['lang']['contributions_were_found']; ?>
 </span> 
	<span class="normal">
		<?php echo $this->_tpl_vars['lang']['now_showing']; ?>
  <?php if ($this->_tpl_vars['paging']['page_start'] == $this->_tpl_vars['paging']['page_end']):  echo $this->_tpl_vars['paging']['page_end'];  else:  echo $this->_tpl_vars['paging']['page_start']; ?>
 <?php echo $this->_tpl_vars['lang']['through']; ?>
  <?php echo $this->_tpl_vars['paging']['page_end'];  endif; ?>.
	</span>
<?php endif; ?>