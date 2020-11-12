<?PHP
/**
* Welcome page
*/
require_once('./data/pars.php');
$proceed = false;

$proceed = true;
?>

<table summary="" style="width:100%; height:100%" border="0" cellspacing="10">
  <tr>
    <td class="pane_header">Finish</td>
  </tr>
  <tr>
    <td class="pane_desc">Thank you, the <?php echo ($pars['app_upgrade'])?'upgrade':'installation'?> is now complete!</td>
  </tr>
  <tr>
    <td height="100%" valign="top" style="padding:2px,0px,2px,10px">
		<span style="color:red;">Please delete the "install" folder, and change the configuration file (/config.php) permissions to non-writable.</span><br /><br />
		Your default administrative login:<br /><br /> 
		&nbsp;Username: admin<br />
		&nbsp;Password: pass<br />
		<br />
		<br />
    <?php
    if(isset($self_uri)&&$self_uri) {
    	echo '<a style="font-weight:bold;" href="'.$self_uri.'">Start '.$pars['app_name'].'</a>';
    }
    ?>
    </td>
  </tr>
</table>
