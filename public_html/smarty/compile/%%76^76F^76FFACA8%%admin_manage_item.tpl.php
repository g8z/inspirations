<?php /* Smarty version 2.6.13, created on 2006-04-17 22:43:42
         compiled from admin_manage_item.tpl */ ?>
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
						<td colspan="2" class = "formHeader">
							<?php echo $this->_tpl_vars['lang']['edit_or_remove_an_item']; ?>

						</td>
					</tr>
					<tr>
						<td colspan="2" class = "normal">
							<?php echo $this->_tpl_vars['lang']['confirmed_items_are_editable']; ?>

						</td>
					</tr>
					<tr>
						<td width="60%" class="normal"><?php echo $this->_tpl_vars['lang']['choose_the_category']; ?>
</td>
						<td width="40%"><?php echo $this->_tpl_vars['form_data']['list']['html']; ?>
</td>
					</tr>
					<tr>
						<td width="60%" class="normal"><?php echo $this->_tpl_vars['lang']['select_the_item_to_edit']; ?>
</td>
						<td width="40%"><?php echo $this->_tpl_vars['form_data']['list_items']['html']; ?>
</td>
					</tr>
					<tr>
						<td class="normal"><b><?php echo $this->_tpl_vars['lang']['or']; ?>
</b></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="normal"><?php echo $this->_tpl_vars['lang']['if_you_know_the_id']; ?>
</td>
						<td><?php echo $this->_tpl_vars['form_data']['inputc']['html']; ?>
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
	</table>
</form>

<?php if ($this->_tpl_vars['form_item']): ?>
<br />
	<?php if ($this->_tpl_vars['form_item']['javascript']):  echo $this->_tpl_vars['form_item']['javascript'];  endif; ?>
	<form <?php echo $this->_tpl_vars['form_item']['attributes']; ?>
>
		<?php echo $this->_tpl_vars['form_item']['hidden']; ?>

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
							<td colspan="2" class = "formHeader"><?php echo $this->_tpl_vars['lang']['id']; ?>
 <?php echo $this->_tpl_vars['item_data']['ID']; ?>
 <?php echo $this->_tpl_vars['lang']['edit_or_remove_item']; ?>
</td>
						</tr>

						<tr class="normal">
							<td width="36%"><?php echo $this->_tpl_vars['lang']['category']; ?>
: </td>
							<td width="64%"><?php echo $this->_tpl_vars['form_item']['category']['html']; ?>
</td>
						</tr>
						<tr class="normal">
							<td><?php echo $this->_tpl_vars['lang']['inspiration_title']; ?>
: </td>
							<td><?php echo $this->_tpl_vars['form_item']['myTitle']['html']; ?>
</td>
						</tr>
						<tr class="normal">
							<td><?php echo $this->_tpl_vars['lang']['inspiration_text']; ?>
: </td>
							<td>&nbsp;</td>
						</tr>
						<tr class="normal">
							<td colspan="2"><?php echo $this->_tpl_vars['form_item']['text']['html']; ?>
</td>
						</tr>
						<tr class="normal">
							<td><?php echo $this->_tpl_vars['lang']['allow_comments']; ?>
</td>
							<td><?php echo $this->_tpl_vars['form_item']['allow_comments']['html']; ?>
</td>
						</tr>
						<?php if ($this->_tpl_vars['item_data']['author'] && $this->_tpl_vars['item_data']['created']): ?>
							<tr class="normal">
								<td colspan="2" align=right nowrap>
									<span class=normal><?php echo $this->_tpl_vars['lang']['submitted_by']; ?>
 <?php echo $this->_tpl_vars['item_data']['author']; ?>
 <?php echo $this->_tpl_vars['lang']['on']; ?>
 <?php echo $this->_tpl_vars['item_data']['created']; ?>
</span>
								</td>
							</tr>
						<?php endif; ?>
						<tr class="normal">
							<td align=right colspan=2><?php echo $this->_tpl_vars['form_item']['submit']['html'];  echo $this->_tpl_vars['form_item']['remove']['html'];  echo $this->_tpl_vars['form_item']['reset']['html']; ?>
</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>


<?php endif; ?>