{if $form_data.javascript}{$form_data.javascript}{/if}
<form {$form_data.attributes}>
{$form_data.hidden}
<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
<tr>
  <td class="border"><table summary="" width="100%" border="0" cellpadding="4" cellspacing="2" class="white">
    <tr>
    <td class="formHeader" colspan="3" align=left><b>{$lang.template_stylesheet}</b></td>
    </tr>
    {section name=k loop=$styles}
    {if $smarty.section.k.index && $styles[k].name}
    <tr class="normal"><td colspan = 3><hr /></td></tr>
    {/if}
    <tr class="normal">
      <td class="normal"><b>{$styles[k].name}&nbsp;</b></td>
      <td class="normal">{$styles[k].type}</td>
      <td width="64%">{$styles[k].input}</td>
    </tr>
    {/section}

     <tr class="normal">
    <td colspan="3" align="right">{$form_data.submit.html}&nbsp;{$form_data.reset.html}</td>
    </tr>
  </table>
</td></tr>
</table>
</form>