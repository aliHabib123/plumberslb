<div align="center" style="width: auto">
    <table class="grid" style="width: 500px">
        <tr><th class="even" colspan=2>
            <?php echo $this->_tpl_vars['Title']; ?>
         </th></tr>
        <?php if ($this->_tpl_vars['Grid']->GetErrorMessage() != ''): ?>
        <tr><td class="odd grid_error_row" colspan=4>
            <div class="grid_error_message grid_message">
            <strong><?php echo $this->_tpl_vars['Captions']->GetMessageString('ErrorsDuringDeleteProcess'); ?>
</strong><br><br>
            <?php echo $this->_tpl_vars['Grid']->GetErrorMessage(); ?>

            </div>
        </td></tr>
        <?php endif; ?>
<?php unset($this->_sections['RowGrid']);
$this->_sections['RowGrid']['name'] = 'RowGrid';
$this->_sections['RowGrid']['loop'] = is_array($_loop=$this->_tpl_vars['ColumnCount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['RowGrid']['show'] = true;
$this->_sections['RowGrid']['max'] = $this->_sections['RowGrid']['loop'];
$this->_sections['RowGrid']['step'] = 1;
$this->_sections['RowGrid']['start'] = $this->_sections['RowGrid']['step'] > 0 ? 0 : $this->_sections['RowGrid']['loop']-1;
if ($this->_sections['RowGrid']['show']) {
    $this->_sections['RowGrid']['total'] = $this->_sections['RowGrid']['loop'];
    if ($this->_sections['RowGrid']['total'] == 0)
        $this->_sections['RowGrid']['show'] = false;
} else
    $this->_sections['RowGrid']['total'] = 0;
if ($this->_sections['RowGrid']['show']):

            for ($this->_sections['RowGrid']['index'] = $this->_sections['RowGrid']['start'], $this->_sections['RowGrid']['iteration'] = 1;
                 $this->_sections['RowGrid']['iteration'] <= $this->_sections['RowGrid']['total'];
                 $this->_sections['RowGrid']['index'] += $this->_sections['RowGrid']['step'], $this->_sections['RowGrid']['iteration']++):
$this->_sections['RowGrid']['rownum'] = $this->_sections['RowGrid']['iteration'];
$this->_sections['RowGrid']['index_prev'] = $this->_sections['RowGrid']['index'] - $this->_sections['RowGrid']['step'];
$this->_sections['RowGrid']['index_next'] = $this->_sections['RowGrid']['index'] + $this->_sections['RowGrid']['step'];
$this->_sections['RowGrid']['first']      = ($this->_sections['RowGrid']['iteration'] == 1);
$this->_sections['RowGrid']['last']       = ($this->_sections['RowGrid']['iteration'] == $this->_sections['RowGrid']['total']);
?>
        <tr class="<?php if (!(1 & $this->_sections['RowGrid']['index'])): ?>even<?php else: ?>odd<?php endif; ?>"<?php if ($this->_tpl_vars['RowCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)] != ''): ?> style="<?php echo $this->_tpl_vars['RowCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)]; ?>
"<?php endif; ?>>
            <td class="odd" style="padding-left:20px;"><b><?php echo $this->_tpl_vars['Columns'][$this->_sections['RowGrid']['index']]->GetCaption(); ?>
</b></td>
            <td class="even" style="padding-left:10px;">
                <?php echo $this->_tpl_vars['Row'][$this->_sections['RowGrid']['index']]; ?>

            </td>
        </tr>
<?php endfor; endif; ?>
        <tr height="40" class="editor_buttons"><td colspan=2 align=center valign=middle>
            <form name="deleteform" style="margin: 0px; padding: 0px;" enctype="multipart/form-data" method="POST" action="<?php echo $this->_tpl_vars['Grid']->GetEditPageAction(); ?>
">
<?php $_from = $this->_tpl_vars['HiddenValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['HiddenValueName'] => $this->_tpl_vars['HiddenValue']):
?>   
                <input type="hidden" name="<?php echo $this->_tpl_vars['HiddenValueName']; ?>
" value="<?php echo $this->_tpl_vars['HiddenValue']; ?>
" />
<?php endforeach; endif; unset($_from); ?>
                <input class="sm_button" type="submit" value="<?php echo $this->_tpl_vars['Captions']->GetMessageString('Delete'); ?>
" />
                <input class="sm_button" type="button" value="<?php echo $this->_tpl_vars['Captions']->GetMessageString('BackToList'); ?>
" onclick="window.location.href='<?php echo $this->_tpl_vars['Grid']->GetReturnUrl(); ?>
'"/>
            </form>
        </td></tr>
    </table>
</div>