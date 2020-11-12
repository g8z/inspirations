<?PHP
/*
* Program entry point
* Acts as switcher/interface for calls to application
*/
if(!defined('IN_APP')) {
	define('IN_APP',1);
}

// Gather configuration parameters && Gather initialization code
if (file_exists('./config.php')) {
	require_once('./config.php');
	$dbHost = DB_HOST;
} else {
	$handle = fopen("config.php", "w");
	fclose($handle);
}

if( isset($dbHost) == false || $dbHost == 'DB_HOST' ||$dbHost=='{DB_HOST}') { //no installation done
	$app_url = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
	header('Location: '.$app_url.'install/index.php');
	exit;
}

/* Include all iitialization parameters */
require_once(INCLUDE_DIR.'init.php');


if(@opendir( INSTALL_DIR )) {	//installation done, refuse working while install folder is still present
	$t->assign('security_warning','1');
}

$act = isset($_GET['cmd'])?(int)$_GET['cmd']:0;
$act = isset($_POST['cmd'])?(int)$_POST['cmd']:$act;

//common commands
$comComms = array_flip(array(1,15,16,17));

//check out if user is logged..if yes then transfer to respective program
if(checkSession(1) && isset($comComms[$act])==false) {
	$iget = '';
	foreach($_GET as $key=>$val) {
		$iget .= $key.'='.$val.'&';
	}
	header('Location: '.HOME.'admin.php?'.$iget);
	//require_once(dirname(__FILE__).'/users/admin/index.php');
	exit;
}elseif(checkSession(0) && isset($comComms[$act])==false) {
	$iget = '';
	foreach($_GET as $key=>$val) {
		$iget .= $key.'='.$val.'&';
	}
	header('Location: '.HOME.'member.php?'.$iget);
	//require_once(dirname(__FILE__).'/users/member/index.php');
	exit;
}


$tplFile = 'index.tpl';
$intVars = array();
$intVars['category'] = isset($_GET['cat'])?(int)$_GET['cat']:0;
$intVars['category'] = isset($_POST['search_cat'])? (int)$_POST['search_cat']: $intVars['category'];
$intVars['cur_page'] = abs(isset($_GET['paging'])?(int)$_GET['paging']:0);
$intVars['cmd'] = $act;
$intVars['logged'] = (int)(isset($_SESSION['INSP']['UID'])&&$_SESSION['INSP']['UID']!=0);
$intVars['uid'] = $_SESSION['INSP']['UID']; //some problem accessing uid, so added a variable
$user = $_SESSION['INSP']['USER']; //Added a variable user
$intVars['utype'] = (isset($_SESSION['INSP']['UTYPE'])&&$_SESSION['INSP']['UTYPE']!=0)?1:0;
$intVars['content'] = '{Place Holder}';
$intVars['conf'] = $gConf;
foreach($gVars as $key=>$val) {
	$intVars[$key] = $val;
}

//language select (Gary_Star)
$gFrmL = new HTML_QuickForm('langForm','post');
$gFrmL->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

$opts['style'] = '';
$opts_c['onChange']="javascript:window.document.location='".$cale."lang='+this.options[this.selectedIndex].value+'".$parm."'";
$gFrmL->addElement('select','select_lang','',$lang_array,$opts+$opts_c);
$defaults = array();
$defaults['select_lang']=$opt_lang;
$gFrmL->setDefaults($defaults);
$gFrmL->accept($gFrmR);
$t->assign('form_lang',$gFrmR->toArray());
//end language select


//generate needed menu

require_once(APP_DIR.'/menu.php');


//generate search bar
require_once(APP_DIR.'/search.php');




$tplVars['Page'] = array('credits'=>$gCredits,'internal'=>$intVars);
foreach($tplVars as $key=>$val) {
	$t->assign($key,$val);
}



switch($act) {
	case 1:
		require_once('inspirations.php');
	break;
	case 2: //register
		require_once('register.php');
	break;
	case 3: //login
		require_once("login.php");
	break;
	case 4: //logout
		$intVars['logged'] = 0;
		require_once('logout.php');
	break;
	case 5: //account
		require_once('account.php');
	break;
	case 10: //contribute
		require_once('contribute.php');
	break;
	case 15: //print
		require_once('print.php');
		exit;
	break;
	case 16: //send mail
		require_once('email.php');
		exit;
	break;
	case 17: //counter
		require_once('counter.php');
		exit;
	break;
	case 21: //view comments
		require_once('comments.php');
	break;
	case 22: //add comments
		require_once('comments_manage.php');
	break;
	default:
		require_once('inspirations.php');
	break;
}

/*
* Render templates
*/
$tplVars['Page'] = array('credits'=>$gCredits,'internal'=>$intVars);
foreach($tplVars as $key=>$val) {
	$t->assign($key,$val);
}
//print_r ($intVars['content']);

$t->assign('gPaths',$gPaths);
$t->display($tplFile);

?>