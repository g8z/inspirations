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
    <td class="pane_header">Welcome!</td>
  </tr>
  <tr>
    <td class="pane_desc">Welcome to the <b><?php echo $pars['app_name']?></b> <?php echo ($pars['app_upgrade'])?'upgrade':'installation'?> wizard!<br /><br />This wizard will guide you through the rest of the setup process.<br /><br />Please press <b>Next</b> to continue.</td>
  </tr>
  <tr style="height:100%">
    <td valign="top" style="padding:2px,0px,2px,10px">
    <?php echo $pars['page1']['explanation']?>
    </td>
  </tr>
</table>
