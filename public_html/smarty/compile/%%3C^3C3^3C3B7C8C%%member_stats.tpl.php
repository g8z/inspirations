<?php /* Smarty version 2.6.13, created on 2006-04-15 14:51:50
         compiled from member_stats.tpl */ ?>
<table summary="" border=0 cellpadding=1 cellspacing=0 width="100%" class="border">
	<tr>
		<td>
			<table summary="" class="white" width="100%" border="0" cellspacing="0" cellpadding="4" width="100%">
				<tr class="formHeader">
					<td width="25%"><?php echo $this->_tpl_vars['lang']['posted_inspirations']; ?>
</td>
					<td width="25%"></td>
					<td width="25%"></td>
					<td width="25%"></td>
				</tr>
				<tr class="normal">
					<td align="center" style="font-weight:bold"><?php echo $this->_tpl_vars['lang']['inspiration_title']; ?>
</td>
					<td align="center" style="font-weight:bold"><?php echo $this->_tpl_vars['lang']['inspiration_category']; ?>
</td>
					<td align="center" style="font-weight:bold"><?php echo $this->_tpl_vars['lang']['number_of_views']; ?>
</td>
					<td align="center" style="font-weight:bold"><?php echo $this->_tpl_vars['lang']['number_of_comments']; ?>
</td>
				</tr>
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
				<tr class="normal">
						<td align="center"><?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['title']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['cat_name']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['num']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['items'][$this->_sections['k']['index']]['comments']; ?>
</td>
				</tr>
				<?php endfor; endif; ?>
			</table>
		</td>
	</tr>
</table>