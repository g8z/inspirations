{if $form_data.javascript}{$form_data.javascript}{/if}
<form {$form_data.attributes}>
{$form_data.hidden}
  <table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
{if $top_message}
  <tr>
    <td class="white" style="padding-bottom:10px;">{$top_message}</td>
  </tr>
{/if}<tr>
  <td class="border">
	<table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
	<tr>
	  <td class="formHeader" colspan="2" align=left><b>{$lang.change_your_password}</b></td>
	</tr>
	<tr>
	  <td class="normal">{$form_data.passwordold.label}</td>
	  <td>{$form_data.passwordold.html}</td>
	</tr>
	<tr>
	  <td class="normal" nowrap>{$form_data.passwordnew.label}</td>
	  <td>{$form_data.passwordnew.html}</td>
	</tr>
	<tr>
	  <td class="normal">{$form_data.passwordnew1.label}</td>
	  <td>{$form_data.passwordnew1.html}</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type=submit onclick="return cmpPass();" value="{$lang.submit_changes}" />{$form_data.close.html}<br /><br /></td>
	</tr>
	</table>
  </td>
</tr>
</table>
</form>

{literal}
<script language="Javascript" type="text/javascript">
function cmpPass() {
	
	var formObj = document.forms[1];
	
	if ( formObj.passwordnew.value != formObj.passwordnew1.value ) {
		alert( formObj.not_match.value );
		return false;
	}
	return true;
}
</script>
{/literal}