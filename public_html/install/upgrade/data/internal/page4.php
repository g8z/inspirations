<?PHP
/**
* Variables page
*/
require_once('./data/pars.php');
$proceed = false;


//check if form is submitted
$page_str = '';
if(isset($_POST['vars'])) {
  foreach($_POST['vars'] as $k=>$v) {
    $_SESSION['INST']['VARS'][$k] = $v;	
  }
  $page_str = 'Variables have been saved...Press Next to continue.';
  $proceed = true;	
}

?>

<table summary="" style="width:100%; height:100%" border="0" cellspacing="10">
  <tr>
    <td class="pane_header">Internal variables</td>
  </tr>
  <tr>
    <td class="pane_desc">Set internal variables required by <?php echo $pars['app_name']?>.</td>
  </tr>
  <tr>
    <td height="100%" valign="top" style="padding:2px,0px,2px,10px">
    <table summary="" style="width:100%; height:100%">
        <?php
        if($page_str!='') {
        	?>
        <tr style="height:30px">
          <td colspan="2" class="container_info" align="center">
            <?php echo $page_str?>
          </td>
        </tr>
          <?php
        }
        foreach($pars['vars'] as $v) {
        	?>
        <tr style="height:30px">
          <td class="cell_header" width="25%"><?php echo $v['CAPTION']?></td>
          <td class="cell_header" width="100%">
            <input type="text" name="vars[<?php echo $v['NAME']?>]" value="<?php echo (isset($_SESSION['INST']['VARS'][$v['NAME']])?$_SESSION['INST']['VARS'][$v['NAME']]:((isset($_POST['vars'][$v['NAME']]))?$_POST['vars'][$v['NAME']]:$v['DEFAULT']))?>" />
          </td>
        </tr>
        <?php if ($v['EXPLANATION']) { ?>
        <tr style="height:30px">
          <td colspan="2" class="container"  style="padding-left:5px;">
          <?php echo $v['EXPLANATION']?>
          </td>
        </tr>
          <?php
        } // end explanation
        }
        ?>
        <tr>
          <td height="100%" nowrap colspan="2">&nbsp;</td>
        </tr>
    </table>
    </td>
  </tr>
</table>
