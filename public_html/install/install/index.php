<?php

error_reporting(E_ALL - E_NOTICE);

session_start();
require_once('./data/pars.php');

function echo_steps($steps) {
	$o_str = '<table summary="" style="width:100%; height:100%"><tr class="container"><td width="50%" nowrap class="cell_header">&nbsp;</td>';
	foreach($steps as $step) {
		$o_str .= '<td class="container"><img src="./data/internal/s'.$step[1].'.gif" border=0 alt="" /></td>
							 <td class="cell_header" style="width:65px" nowrap align="center">'.$step[0].'</td>
							 ';
	}
	$o_str .= '<td width="50%" nowrap class="cell_header">&nbsp;</td></tr></table>';
	echo $o_str;
}

//get page
$page = isset($_GET['p'])?(int)$_GET['p']:1;

$page_str = '&nbsp;';
$proceed = false; //proceed only if included script validates step as complete
//get page information
if(file_exists('./data/internal/page'.$page.'.php')) {
	ob_start();
	include_once('./data/internal/page'.$page.'.php');
	$page_str = ob_get_contents();
	ob_end_clean();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> QuickInstall </title>
<link href="./data/internal/css.css" type="text/css" rel=STYLESHEET />
</head>

<body bgcolor="#ffffff" style="margin:0" class="background">
<form method=post action="">
<center>
<br />
<br />
<br />
<br />
<table summary="" style="width:300px; height:400px" border=0 cellpadding=0 cellspacing=0>
<tr>
	<td height="100%" class="container" nowrap>
		<table summary="" style="width:100%; height:100%">
		<tr valign="middle" style="height:30px">
			<td valign="middle" nowrap
			class="button_normal"
			title="Back"
			onMouseOver="javascript:style.cursor='hand';this.className='button_hover';" onMouseOut="javascript:this.className='button_normal'" onClick="javascript:document.forms[0].action='index.php?p=<?php echo ($page!=1)?$page-1:1?>';document.forms[0].submit();">Back</td>
			<td style="width:100%" class="container" nowrap valign="bottom">
			<?php
			$steps = array();
			$steps[] = array('Welcome',($page==1)?1:(($page<1)?0:2));
			$steps[] = array('Diagnostics',($page==2)?1:(($page<2)?0:2));
			$steps[] = array('Database',($page==3)?1:(($page<3)?0:2));
			$steps[] = array('Variables',($page==4)?1:(($page<4)?0:2));
			$steps[] = array('Process',($page==5)?1:(($page<5)?0:2));
			$steps[] = array('Finish',($page==6)?1:(($page<6)?0:2));
			echo_steps($steps);
			if(isset($proceed)&&$proceed==true) {
				$next_page = 'javascript:document.forms[0].action=\'index.php?p='.(($page!=6)?$page+1:6).'\';document.forms[0].submit();';
			}else {
				$next_page = 'javascript:document.forms[0].action=\'index.php?p='.$page.'\';document.forms[0].submit();';
			}
			if($page==6&&isset($self_uri)&&$self_uri) {
				$next_page = 'javascript:document.forms[0].action=\''.$self_uri.'\';document.forms[0].submit();';
			}
			?>
			</td>
			<td valign="middle" nowrap
			class="button_normal"
			title="Next"
			onMouseOver="javascript:style.cursor='hand';this.className='button_hover';" onMouseOut="javascript:this.className='button_normal'" onClick="<?php echo $next_page?>">Next</td>
		</tr>
		<tr valign="top">
			<td style="height:100%" class="container" nowrap colspan="3">
			<?php echo $page_str?>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</center>
</form>
</body>
</html>
