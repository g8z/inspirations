{if $login_form_data.javascript}{$login_form_data.javascript}{/if}
{if $ret_form_data.javascript}{$ret_form_data.javascript}{/if}
<table summary="" width="100%" border="0" cellpadding="1" cellspacing="0" class="white">
{if $top_message}
  <tr>
    <td class="white" style="padding-bottom:10px;">{$top_message}</td>
  </tr>

{/if}  
<tr>
    <td class="border">
<form {$login_form_data.attributes}>
{$login_form_data.hidden}
<input type="hidden" name="form" value="login" />
      <table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
        <tr class="normal">
          <td class="formHeader" colspan="2" align=left><b>{$lang.login_here} </b></td>
        </tr>
        <tr class="normal" valign="top">
          <td width="20%" nowrap>{$login_form_data.username.label}</td>
          <td width="80%">{$login_form_data.username.html}</td>
        </tr>
        <tr class="normal" valign="top">
          <td width="20%" nowrap>{$login_form_data.password.label}</td>
          <td width="80%">{$login_form_data.password.html}</td>
        </tr>
        <tr class="normal">
          <td width="20%"></td>
          <td width="80%">{$login_form_data.submit.html}</td>
        </tr>
        <tr class="normal">
          <td colspan=2>{$login_form_data.requirednote}</td>
        </tr>
        <tr>
          <td colspan="2" align=left>&nbsp;</td>
        </tr>
        <tr>
          <td class="formHeader" colspan="2" align=left><b>{$lang.forgot_your_login} </b></td>
        </tr>
        <tr class="normal">
          <td colspan="2" class="normal">{$lang.enter_your_email_address_to_have_your_user} </td>
        </tr>
	  </table>
</form>
<form {$ret_form_data.attributes}>
{$ret_form_data.hidden}
<input type="hidden" name="form" value="ret" />
      <table summary="" width="100%" border="0" cellpadding="2" cellspacing="2" class="white">
        <tr class="normal">
          <td colspan="2">{$ret_form_data.email.html}{$ret_form_data.submit.html}
          </td>
        </tr>
        <tr class="normal">
          <td colspan="2"><span class=normal>{$lang.if_you_do_not_have_a_login_id}  <a href="index.php?cmd=2">{$lang.click_here_to_get_one} </a>.</span><br /><br />
          </td>
        </tr>
      </table>
</form>        
		</td>
	</tr>
</table>
