<?PHP
if(!defined('IN_APP')) {
  define('IN_APP',1);	
}

require_once('config.php');
require_once(INCLUDE_DIR.'init.php');

$t->display(SITEPATH.'mysql_date_codes.tpl');
?>
