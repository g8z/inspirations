<?php /* Smarty version 2.6.13, created on 2006-04-21 20:49:57
         compiled from comments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'comments.tpl', 17, false),)), $this); ?>
<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
	<?php if ($this->_tpl_vars['top_message']): ?>
		<tr>
			<td class="white" style="padding-bottom:10px;"><?php echo $this->_tpl_vars['top_message']; ?>
</td>
		</tr>
	
	<?php endif; ?>
			<tr>
				<td class="border">
					<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" width="100%">
					<tbody>
						<tr class="headerBackground">
							<td class="inspirationHeader"><?php echo $this->_tpl_vars['item']['title']; ?>
</td>
							<td class="inspirationHeader" style="text-align:right; font-weight: normal;" nowrap>
							<a href="index.php?cmd=15&amp;ID=<?php echo $this->_tpl_vars['item']['ID']; ?>
" target="printWindow"><?php echo $this->_tpl_vars['lang']['print']; ?>
</a> | 
							<a href="javascript:SendEmail('<?php echo $this->_tpl_vars['item']['ID']; ?>
');"><?php echo $this->_tpl_vars['lang']['email']; ?>
</a>
							<?php if ($this->_tpl_vars['item']['edit']): ?> | <a href="index.php?cmd=20&amp;inputc=<?php echo $this->_tpl_vars['item']['ID']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['edit'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a><?php endif; ?>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<span class="normal"><?php if ($this->_tpl_vars['item']['image_data']): ?><img src="<?php echo @HOME; ?>
include/get_image.php?ID=<?php echo $this->_tpl_vars['item']['ID']; ?>
" <?php echo $this->_tpl_vars['item']['image_align']; ?>
 alt="Image" /><?php endif;  echo $this->_tpl_vars['item']['text']; ?>
</span>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table summary="" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td><span class="normal"><?php echo $this->_tpl_vars['lang']['author']; ?>
: <?php if ($this->_tpl_vars['item']['author']):  echo $this->_tpl_vars['item']['author'];  else:  echo $this->_tpl_vars['lang']['anonymous'];  endif; ?></span></td>
										<td align="right">
											<span class="normal"><?php echo $this->_tpl_vars['lang']['contributed_by']; ?>
 <?php if ($this->_tpl_vars['item']['hide_email'] == 'Y'):  echo $this->_tpl_vars['item']['user'];  else: ?><a class="contributor_link" href="mailto:<?php echo $this->_tpl_vars['item']['user_data']['email']; ?>
"><?php echo $this->_tpl_vars['item']['user']; ?>
</a><?php endif; ?> <?php echo $this->_tpl_vars['lang']['on']; ?>
 <?php echo $this->_tpl_vars['item']['created']; ?>
</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
<?php if ($this->_tpl_vars['Page']['internal']['conf']['allow_comments'] == 'Y'): ?>
			<tr>
				<td class="normal">
					<br />
					<table summary="" class="white" border="0" cellpadding="3" cellspacing="0" width="100%">
					<tbody>
						<tr class="headerBackground">
							<td class="inspirationHeader"><?php echo $this->_tpl_vars['lang']['comments']; ?>
 <?php if ($this->_tpl_vars['item']['allow_comments'] == 'N'): ?><span class="normal">(<?php echo $this->_tpl_vars['lang']['add_disabled']; ?>
)</span><?php endif; ?></td>
							<td class="inspirationHeader" style="text-align:right; font-weight: normal;">
								<?php if ($this->_tpl_vars['item']['allow_comments'] == 'Y'): ?><a href="index.php?cmd=22&amp;ID=<?php echo $this->_tpl_vars['item']['ID']; ?>
"><?php echo $this->_tpl_vars['lang']['add_a_comment']; ?>
</a><?php if ($this->_tpl_vars['item']['stop_comments']): ?> | <a href="index.php?cmd=21&amp;sID=<?php echo $this->_tpl_vars['item']['ID']; ?>
"><?php echo $this->_tpl_vars['lang']['stop_comments']; ?>
</a><?php endif;  endif; ?></td>
						</tr>
		<?php if ($this->_tpl_vars['comments']): ?> 
					<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['comments']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<td class="normal"><b><?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['title']; ?>
</b>
								<br />
								<i><?php echo $this->_tpl_vars['lang']['by']; ?>
 <?php if ($this->_tpl_vars['comments'][$this->_sections['k']['index']]['author']):  if ($this->_tpl_vars['comments'][$this->_sections['k']['index']]['hide_email'] == 'Y'):  echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['author'];  else: ?><a class="contributor_link" href="mailto:<?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['email']; ?>
"><?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['author']; ?>
</a><?php endif;  else:  echo $this->_tpl_vars['lang']['anonymous'];  endif; ?>
							<?php if ($this->_tpl_vars['comments'][$this->_sections['k']['index']]['user_data']['login']): ?>(<?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['user_data']['login']; ?>
)<?php endif; ?> <?php echo $this->_tpl_vars['lang']['on']; ?>
 <?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['created']; ?>
</i>
							</td>
							<td class="normal" align="right">
							<?php if ($this->_tpl_vars['comments'][$this->_sections['k']['index']]['edit']): ?><a href="index.php?cmd=23&amp;ID=<?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['ID']; ?>
"><?php echo $this->_tpl_vars['lang']['edit']; ?>
</a><?php endif; ?>
							</td>
						</tr>
						<tr>
							<td class="bottom-border" colspan="2">
								<?php echo $this->_tpl_vars['comments'][$this->_sections['k']['index']]['text']; ?>

							</td>
						</tr>
					<?php endfor; endif; ?>
		<?php endif; ?>
					</table>
				</td>
			</tr>
<?php endif; ?>
</table>
<?php if ($this->_tpl_vars['paging']['item_prev'] != -1 || $this->_tpl_vars['paging']['item_next'] != -1): ?>
<table summary="" class="headerBackground" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td align="left">
				<?php if ($this->_tpl_vars['paging']['item_prev'] != -1): ?>
					<a href="index.php?paging=<?php echo $this->_tpl_vars['paging']['item_prev']; ?>
&amp;ID=<?php echo $this->_tpl_vars['item']['ID']; ?>
&amp;cmd=21"><?php echo $this->_tpl_vars['lang']['previous']; ?>
 <?php echo $this->_tpl_vars['Page']['internal']['conf']['comments_per_page']; ?>
</a>
				<?php endif; ?>
			</td>
			<td align="right">
				<?php if ($this->_tpl_vars['paging']['item_next'] != -1): ?>
					<a href="index.php?paging=<?php echo $this->_tpl_vars['paging']['item_next']; ?>
&amp;ID=<?php echo $this->_tpl_vars['item']['ID']; ?>
&amp;cmd=21"><?php echo $this->_tpl_vars['lang']['next']; ?>
 <?php echo $this->_tpl_vars['paging']['comments_end']; ?>
</a>
				<?php endif; ?>
			</td>
		</tr>
	</tbody>
</table>
<?php endif; ?>
<table summary="" class="normal" border="0" cellpadding="0" cellspacing="1" width="100%">
<tr>
	<td>
<?php if ($this->_tpl_vars['paging']['item_prev'] != -1 || $this->_tpl_vars['paging']['item_next'] != -1): ?>
		<?php echo $this->_tpl_vars['paging']['items_total']; ?>
 <?php echo $this->_tpl_vars['lang']['comments_were_found']; ?>

		<?php echo $this->_tpl_vars['lang']['now_showing']; ?>
  <?php if ($this->_tpl_vars['paging']['page_start'] == $this->_tpl_vars['paging']['page_end']):  echo $this->_tpl_vars['paging']['page_end'];  else:  echo $this->_tpl_vars['paging']['page_start']; ?>
 <?php echo $this->_tpl_vars['lang']['through']; ?>
  <?php echo $this->_tpl_vars['paging']['page_end'];  endif; ?>.
<?php else: ?>&nbsp;
<?php endif; ?>
	</td>
	<td align="right">
<?php if ($this->_tpl_vars['paging']['items_total'] > 1): ?>
		<?php echo $this->_tpl_vars['paging']['comments_sort']; ?>

<?php else: ?>&nbsp;
<?php endif; ?>
	</td>
</tr>
</table>
