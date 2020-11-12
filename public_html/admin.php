<?PHP
/*
* Program entry point
* Acts as switcher/interface for calls to application
*/
if(!defined('IN_APP')) {
	define('IN_APP',1);
}


// Gather configuration parameters && Gather initialization code
require_once('config.php');
require_once(INCLUDE_DIR . 'init.php');
$cmd = isset($cmd)?(int)$cmd:3;


if(!checkSession(1)) {
	header( "Location: ".HOME . "index.php?cmd=3" );
	exit;
}

if(@opendir(INSTALL_DIR)) {	
	//installation done, refuse working while install folder is still present
	$t->assign('security_warning','1');
}

$act = isset($_GET['cmd'])?(int)$_GET['cmd']:0;
$act = isset($_POST['cmd'])?(int)$_POST['cmd']:$act;

$tplFile = 'index.tpl';
$intVars  = array();
$intVars['category'] = isset($_GET['cat'])?(int)$_GET['cat']:0;
$intVars['category'] = isset($_POST['search_cat'])?(int)$_POST['search_cat']:$intVars['category'];
$intVars['cur_page'] = abs(isset($_GET['paging'])?(int)$_GET['paging']:0);

$intVars['cmd'] = $act;
$intVars['logged'] = (int)(isset($_SESSION['INSP']['UID'])&&$_SESSION['INSP']['UID']!=0);
$intVars['uid'] = $_SESSION['INSP']['UID'];
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
require_once(APP_DIR.'menu.php');
require_once(APP_DIR.'search.php');

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
		require_once('login.php');
	break;
	case 4: //logout
		$intVars['logged'] = 0;
		require_once('logout.php');
	break;
	case 5: //account
		require_once('account.php');
	break;
	case 6: //user management
		require_once('users.php');
	break;
	case 7: //options
		require_once('options.php');
	break;
	case 8: //stylesheet
		require_once('stylesheet.php');
	break;
	case 9: //manage tree
		require_once('manage_tree.php');
	break;
	case 10: //contribute
		require_once('contribute.php');
	break;
	case 11: //review
		require_once('review.php');
	break;
	case 12: //add suggested category
		require_once('manage_cat.php');
		exit;//popup window
	break;
	case 13: //manage inspirations
		require_once('manage_item.php');
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
	case 19: //change passwords
		require_once('change_pass.php');
	break;
	case 20: //edit inspirations
		require_once('manage_item.php');
	break;
	case 21: //view comments
		require_once('comments.php');
	break;
	case 22: //add comments
		require_once('comments_manage.php');
	break;
	case 23: //modify comments
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

$t->assign('gPaths',$gPaths);
$t->display($tplFile);

?>