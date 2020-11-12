<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
  <title>{$Page.credits.application}</title>
  <meta http-equiv="Content-Type" content="text/html; charset={$Page.internal.charset}" />
  <meta name="description" content="FW4 DW4 HTML" />
  {$css}
<script src="{$smarty.const.IHTML}common/js/javascript.js" language="JavaScript" type="text/javascript"></script>
<script src="{$smarty.const.IHTML}common/js/validation.js" language="JavaScript" type="text/javascript"></script>
<script src="{$smarty.const.IHTML}common/js/picker.js" language="JavaScript" type="text/javascript"></script>
<script src="{$smarty.const.IHTML}common/HTML_TreeMenuXL/TreeMenu.js" language="JavaScript" type="text/javascript"></script>

{literal}
<script language="JavaScript" type="text/javascript">
function cat_manage_finish(){
	if (opener != null) 
		opener.location.reload(true);
    setTimeout('window.close()',500);
}
function get_value(){
  if(document.forms.myForm.list.selectedIndex){
    new_text = document.forms.myForm.list.options[document.forms.myForm.list.selectedIndex].text;
    document.forms.myForm.inputc.value=new_text.substring(2);
  }else{
    document.forms.myForm.inputc.value="";
  }
}
</script>
{/literal}
</head>
<body onLoad="document.forms.myForm.inputc.focus();" style="margin:0" class="white" >
<form {$form_data.attributes}>
{$form_data.hidden}
<table summary="" align="center" width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td class="formHeader" colspan="2" align=center><b>{$lang.create_or_approve_a_category}</b></td>
</tr>
<tr class="normal" valign=top> 
<td>{$form_data.inputc.label}</td>
<td>{$form_data.inputc.html}<br />[<a href="#" onClick="get_value();"  class="mouseOverDark">{$lang.copy_value}</a>]</td>
</tr><tr class="normal"> 
<td colspan = 2><b>{$lang.or}</b></td>
</tr>
<tr class="normal"> 
  <td nowrap>{$form_data.list.label}</td>
  <td>{$form_data.list.html}</td>
</tr>
<tr>
  <td colspan = 2 align="right">
  <table summary="" border=0 cellspacing="2" cellpadding="2">
  <tr valign="middle">
  	<td width="100%">{$top_message}</td>
  	<td nowrap>{$form_data.submit.html}&nbsp;{$form_data.cancel.html}</td>
  </tr>
  </table>
  </td>
</tr>
</table>
</form>

</body>
</html>