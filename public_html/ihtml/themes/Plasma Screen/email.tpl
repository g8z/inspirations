<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>{$Page.credits.application} - {$lang.send_to_a_friend}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$Page.internal.charset}" />
	{$css}
</head>

<body class = white style="margin:0px;">
	<div align=left>
	{if $top_message}
		<span class = 'white'>{$top_message}<br />
	{/if}
	{if $form_data.javascript}{$form_data.javascript}{/if}
	<form {$form_data.attributes}>
		{$form_data.hidden}
		<table summary="" align="center" width="100%" cellspacing="2" cellpadding="2" border="0">
			<tr> 
				<td class="formHeader" colspan="2" align=center><b>{$lang.send_to_a_friend}</b></td>
			</tr>
			<tr class="normal"> 
				<td>{$form_data.fullname.label}</td>
				<td>{$form_data.fullname.html}</td>
			</tr>
			<tr class="normal"> 
				<td>{$form_data.email.label}</td>
				<td>{$form_data.email.html}</td>
			</tr>
			<tr class="normal" valign="top"> 
				<td>{$form_data.msg.label}</td>
				<td>{$form_data.msg.html}</td>
			</tr>
			<tr class="normal"> 
				<td>{$form_data.temail.label}</td>
				<td>{$form_data.temail.html}</td>
			</tr>
			<tr class="normal"> 
				<td colspan="2" align="left">{$form_data.requirednote}</td>
			</tr>
			<tr class="normal"> 
				<td colspan="2" align="center">{$form_data.submit.html}{$form_data.close.html}
			</td>
			</tr>
		</table>
	</form>
</div>
{if $popup_msg_text}
	<script language="Javascript" type="text/javascript">
		alert("{$popup_msg_text}");
	</script>
{/if}
</body>
</html>