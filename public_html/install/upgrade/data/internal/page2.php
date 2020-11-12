<?PHP
/**
* Diagnostics page
*/
require_once('./data/pars.php');
$proceed = true;


$page_str = array();

//check sql file
if(!file_exists($files['sql'])) {
  $page_str[] = array('str' => 'Input SQL file: '.basename($files['sql']).'',
                      'res' => '<span style="color:red">[not found]</span>');
  $proceed = false;
}else {
  $page_str[] = array('str' => 'Input SQL file: '.basename($files['sql']).'',
                      'res' => '[ok]');
}

//check input configuration file
if(!file_exists($files['conf_in'])) {
  $page_str[] = array('str' => 'Input configuration file: '.basename($files['conf_in']).'',
                      'res' => '<span style="color:red">[not found]</span>');
  $proceed = false;
}else {
  $page_str[] = array('str' => 'Input configuration file: '.basename($files['conf_in']).'',
                      'res' => '[ok]');
}

//check output configuration file
if(@fopen($files['conf_out'],'w')) {
  $page_str[] = array('str' => 'Output configuration file: /'.basename($files['conf_out']).'',
                      'res' => '[write test ok]');
}else {
  $page_str[] = array('str' => 'Output configuration file: /'.basename($files['conf_out']).'',
                      'res' => '<span style="color:red">[write test failed]</span>');
}

//check if smarty compile folder is writable
if($fp = @fopen($files['smarty'].'temp','w')) {
  $page_str[] = array('str' => 'Smarty Compile Directory (/smarty/compile) probing..',
                      'res' => '[write test ok]');
  @unlink($files['smarty'].'temp');
}else {
  $page_str[] = array('str' => 'Smarty Compile Directory (/smarty/compile) probing..',
                      'res' => '<span style="color:red">[write test failed]</span>');
  $proceed = false;
}

//check php version
if(strcmp(MIN_PHP_VERSION, phpversion()) > 0) {
  $page_str[] = array('str' => 'PHP version detected: '.phpversion().' (Required: '.MIN_PHP_VERSION.')',
                      'res' => '<span style="color:red">[halted]</span>');
  $proceed = false;
}else {
  $page_str[] = array('str' => 'PHP version detected: '.phpversion().' (Required: '.MIN_PHP_VERSION.')',
                      'res' => '[ok]');
}

//check mysql version
if(strcmp(MIN_MYSQL_CLIENT_VERSION, mysql_get_client_info()) > 0) {
  $page_str[] = array('str' => 'PHP version detected: '.mysql_get_client_info().' (Required: '.MIN_MYSQL_CLIENT_VERSION.')',
                      'res' => '<span style="color:red">[halted]</span>');
  $proceed = false;
}else {
  $page_str[] = array('str' => 'PHP version detected: '.mysql_get_client_info().' (Required: '.MIN_MYSQL_CLIENT_VERSION.')',
                      'res' => '[ok]');
}

if($proceed&&1==2) {
    $page_str[] = array('str' => '/data/sql.sql',
                        'res' => '[exists]');
    $page_str[] = array('str' => '/data/conf.xml',
                        'res' => '[exists]');
    $page_str[] = array('str' => $pars['paths']['out_conf'],
                        'res' => '[exists]');
    $page_str[] = array('str' => '[PHP version detected: '.phpversion().']',
                        'res' => '[ok]');

}

?>

<table summary="" style="width:100%; height:100%" border="0" cellspacing="10">
  <tr>
    <td class="pane_header">Diagnostics</td>
  </tr>
  <tr>
    <td class="pane_desc">Wizard checks whether all neccessary files exist and respective permissins are set.</td>
  </tr>
  <tr>
    <td height="100%" valign="top" style="padding:2px,0px,2px,10px">
      <table summary="" style="width:100%; height:100%" cellpadding="3">
      <?php
      foreach($page_str as $str) {
      	?>
        <tr>
          <td class="cell_header" width="65%"><?php echo $str['str']?></td>
          <td class="container" width="35%" align="center"><?php echo $str['res']?></td>
        </tr>
        <?php
      }
      ?>
        <tr>
          <td height="100%" nowrap colspan="2">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
