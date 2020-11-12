<?PHP
//global vars
	
	$pars['app_name'] = 'Inspirations';
	$pars['app_upgrade'] = false;

define('MIN_PHP_VERSION', "4.0.5");
define('MIN_MYSQL_CLIENT_VERSION', "3.23.39");

$files = array();
$files['conf_in'] = './data/conf.php';
$files['conf_out'] = './../../config.php';
$files['sql'] = './data/sql.sql';
$files['smarty'] = './../../smarty/compile/';


//welcome screen
$pars['page1']['explanation']=<<<EOD

EOD;

//variables screen
$vars = array();
$d_path = '';
if(isset($last_ch)&&($last_ch=="\\"||$last_ch=='/')) {
	$d_path = $_ENV['HTTP_HOST'].substr(dirname($_ENV['REQUEST_URI']),0,-1);	
}else {
	$d_path = $_ENV['HTTP_HOST'].dirname($_ENV['REQUEST_URI']);	
}
$d_path = dirname($d_path);
$d_path = '/'.$pars['app_name'];

if(isset($_SERVER['HTTP_REFERER'])) {
	$self_uri = dirname($_SERVER['HTTP_REFERER']);	
}else {
	$self_uri = '';
}

$self_uri = explode('/',$self_uri);
if(count($self_uri)) {
	$self_uri = implode('/',array_slice($self_uri,0,count($self_uri)-2));	
}

$vars[1] = array(
							'CAPTION'=>'Application URL',
							'EXPLANATION'=>'Please specify application <b>URL</b> without trailing slash.',
							'NAME'=>'{APP_URL}',
							'DEFAULT'=>$self_uri);
$vars[2] = array(
							'CAPTION'=>'HTML Title',
							'EXPLANATION'=>'',
							'NAME'=>'{HTML_Title}',
							'DEFAULT'=>$pars['app_name']);
$vars[3] = array(
							'CAPTION'=>'HTML Description',
							'EXPLANATION'=>'',
							'NAME'=>'{HTML_Description}',
							'DEFAULT'=>'FW4 DW4 HTML');
$pars['vars'] = $vars;

?>
