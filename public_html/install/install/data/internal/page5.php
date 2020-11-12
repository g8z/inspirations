<?PHP
/**
* Welcome page
*/
require_once('./data/pars.php');
$proceed = false;


$page_str = array();

//run database queries
mysql_connect(	$_SESSION['INST']['DB_HOST'],
				$_SESSION['INST']['DB_USER'],
                $_SESSION['INST']['DB_PASS']
             );
mysql_select_db($_SESSION['INST']['DB_NAME']);
$ques = array();
$content = implode("",file($files['sql']));
$content = preg_replace('/^#.*/mi', '', $content);    		
$content = preg_replace('/^(\r\n|\r|\n)/mi', '', $content);    		
$ques = preg_split("/;(\r\n|\r|\n)/si",$content);
$page_str[] = array('str'=>'Setting up application database..','res'=>'[started]');	

foreach($ques as $query) {
	if(trim($query)!='') {
	  	$table_name = '';
	  	if(!(strpos(strtoupper($query),'CREATE TABLE')===false)) {
			$table_name = explode(' ',trim(substr($query,0,strpos($query,'('))));
			$table_name = $table_name[count($table_name)-1];
			$query = str_replace($table_name,$_SESSION['INST']['DB_PFX'].$table_name,$query);
			$page_str[] = array('str'=>'Table Creation: '.$table_name,'res'=>'[done]');	
	  	} elseif(!(strpos(strtoupper($query),'DROP TABLE')===false)) {
			$table_name = explode(' ',trim(substr($query,0,strpos($query,' '))));
			$table_name = preg_split ("/[\s,]+/", trim($query)); 
			$table_name = $table_name[count($table_name)-1];
			$query = str_replace($table_name,$_SESSION['INST']['DB_PFX'].$table_name,$query);
			//$page_str[] = array('str'=>'Drop Previous Table: '.$table_name,'res'=>'[done]');	
	  	} elseif(!(strpos(strtoupper($query),'INSERT INTO')===false)) {
			$table_name = explode(' ',trim(substr($query,0,strpos(strtoupper($query),'VALUES'))));
			$table_name = $table_name[count($table_name)-1];
			$query = str_replace($table_name,$_SESSION['INST']['DB_PFX'].$table_name,$query);
			/* Put md5 of password for admin */
			$query = str_replace('md5(pass)',md5(pass),$query);
			//$page_str[] = array('str'=>'Data Insert:'.$table_name,'res'=>'[done]');	
		}

	  	if(@mysql_query($query)) {
	  	} else {
			$page_str[] = array('str'=>'Query:'.substr($query,0,25),
						'res'=>'<span style="color:red">['.mysql_error().']</span>');	
		}
	}
}

//create configuration file out of template
if($fp = @file($files['conf_in'])) {
	$conf_str = implode("",$fp);	
	foreach($_SESSION['INST']['VARS'] as $k=>$v) {
		$conf_str = str_replace($k,$v,$conf_str);	
	}
    $conf_str = str_replace('{HTML_Title}',$_SESSION['INST']['HTML_Title'],$conf_str);
    $conf_str = str_replace('{HTML_Description}',$_SESSION['INST']['HTML_Description'],$conf_str);
	$conf_str = str_replace('{DB_HOST}',$_SESSION['INST']['DB_HOST'],$conf_str);
	$conf_str = str_replace('{DB_USER}',$_SESSION['INST']['DB_USER'],$conf_str);
	$conf_str = str_replace('{DB_PASS}',$_SESSION['INST']['DB_PASS'],$conf_str);
	$conf_str = str_replace('{DB_NAME}',$_SESSION['INST']['DB_NAME'],$conf_str);
	$conf_str = str_replace('{DB_PFX}',$_SESSION['INST']['DB_PFX'],$conf_str);
	$fp = @fopen($files['conf_out'],"w+");
	if(@fwrite($fp,$conf_str)) {
		$page_str[] = array('str'=>'Write configuration file','res'=>'[done]');
	}else {
  		$page_str[] = array('str'=>'Unable to write configuration files',
					  'res'=>'<span style="color:red">[operation halted]</span>');
	}
	fclose($fp);
}else {
	$page_str[] = array('str'=>'Probing output configuration file..',
					'res'=>'<span style="color:red">[write test failed]</span>');	
}



$proceed = true;
?>

<table summary="" style="width:100%; height:100%" border="0" cellspacing="10">
	<tr>
		<td class="pane_header">Process</td>
  	</tr>
  	<tr>
    	<td class="pane_desc">You are almost done..</td>
  	</tr>
  	<tr>
    	<td height="100%" valign="top" style="padding:2px,0px,2px,10px">
      		<table summary="" style="width:100%; height:100%" cellpadding="3">
      			<?php foreach($page_str as $str) { ?>
        		<tr>
          			<td class="cell_header" width="65%"><?php echo $str['str']?></td>
          			<td class="container" width="35%" align="center"><?php echo $str['res']?></td>
        		</tr>
        		<?php } ?>
        		<tr>
          			<td height="100%" nowrap colspan="2">&nbsp;</td>
        		</tr>
      		</table>
    	</td>
  	</tr>
</table>
