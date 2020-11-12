<?PHP
/**
* Database page
*/
require_once('./data/pars.php');
$proceed = false;


//form is submitted
$conn = 0;
$page_str = '';
if(isset($_POST['db_host'])) {
  $_SESSION['INST']['DB_HOST'] = isset($_POST['db_host'])?$_POST['db_host']:'';
  $_SESSION['INST']['DB_USER'] = isset($_POST['db_user'])?$_POST['db_user']:'';
  $_SESSION['INST']['DB_PASS'] = isset($_POST['db_pass'])?$_POST['db_pass']:'';
  $_SESSION['INST']['DB_NAME'] = isset($_POST['db_name'])?$_POST['db_name']:'';
  $_SESSION['INST']['DB_PFX'] = isset($_POST['db_pfx'])?$_POST['db_pfx']:'';
  if(@mysql_connect($_SESSION['INST']['DB_HOST'],$_SESSION['INST']['DB_USER'],$_SESSION['INST']['DB_PASS'])
   &&@mysql_select_db($_SESSION['INST']['DB_NAME']) ) {
   $proceed = true;		
   $conn = 1;
   $page_str = 'Database connection established.. &nbsp;&nbsp;<font color=green>Press Next to continue</font>';   	
  }else {
   $conn = 2;
   $page_str = 'Database connection failed..<br />'.mysql_error();   	
  }
}

?>

<table summary="" style="width:100%; height:100%" border="0" cellspacing="10">
  <tr>
    <td class="pane_header">Database settings</td>
  </tr>
  <tr>
    <td class="pane_desc">Please provide your database connectivity details.</td>
  </tr>
  <tr>
    <td height="100%" valign="top" style="padding:2px,0px,2px,10px">
    <table summary="" style="width:100%; height:100%">
        <?php
        if($conn!='') {
        	?>
        <tr style="height:30px">
          <td colspan="2" class="container_info" align="center">
            <?php
              if($conn==1) {
              echo $page_str;
              }elseif($conn==2) {
              ?>
              <span style="color:red"><?php echo $page_str?></span>            
              <?php
              }
              
            ?>
            
          </td>
        </tr>
          
          <?php
        }
        ?>
        <tr style="height:30px">
          <td class="cell_header" width="25%">Database Host</td>
          <td class="cell_header" width="100%">
            <input type="text" name="db_host" value="<?php echo (isset($_SESSION['INST']['DB_HOST'])?$_SESSION['INST']['DB_HOST']:((isset($_POST['db_host']))?$_POST['db_host']:'localhost'))?>" />
          </td>
        </tr>
        <tr style="height:30px">
          <td class="cell_header" >Username</td>
          <td class="cell_header" >
            <input type="text" name="db_user" value="<?php echo (isset($_SESSION['INST']['DB_USER'])?$_SESSION['INST']['DB_USER']:((isset($_POST['db_user']))?$_POST['db_user']:''))?>" />
          </td>
        </tr>
        <tr style="height:30px">
          <td class="cell_header" >Password</td>
          <td class="cell_header" >
            <input type="password" name="db_pass" value="<?php echo (isset($_SESSION['INST']['DB_PASS'])?$_SESSION['INST']['DB_PASS']:((isset($_POST['db_pass']))?$_POST['db_pass']:''))?>" />
          </td>
        </tr>
        <tr style="height:30px">
          <td class="cell_header" >Database Name</td>
          <td class="cell_header" >
            <input type="text" name="db_name" value="<?php echo (isset($_SESSION['INST']['DB_NAME'])?$_SESSION['INST']['DB_NAME']:((isset($_POST['db_name']))?$_POST['db_name']:''))?>" />
          </td>
        </tr>
        <tr style="height:30px">
          <td class="cell_header" >Table Prefix</td>
          <td class="cell_header" >
            <input type="text" name="db_pfx" value="<?php echo (isset($_SESSION['INST']['DB_PFX'])?$_SESSION['INST']['DB_PFX']:((isset($_POST['db_pfx']))?$_POST['db_pfx']:'insp_'))?>" />
          </td>
        </tr>
        <tr>
          <td height="100%" nowrap colspan="2">&nbsp;</td>
        </tr>
    </table>
    </td>
  </tr>
</table>
