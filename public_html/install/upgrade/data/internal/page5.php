<?PHP
/**
* Welcome page
*/
require_once('./data/pars.php');
$proceed = false;


$page_str = array();

//run database queries
  mysql_connect($_SESSION['INST']['DB_HOST'],
                 $_SESSION['INST']['DB_USER'],
                   $_SESSION['INST']['DB_PASS']);
  mysql_select_db($_SESSION['INST']['DB_NAME']);
$proceed = true;  
$no_upgrade = false;
//gather info about previous installation
if($res = mysql_query('SELECT COUNT(*) FROM '.$_SESSION['INST']['DB_PPFX'].'categories')) {
  $row = mysql_fetch_row($res);
  $page_str[] = array('str'=>'Probing table: '.$_SESSION['INST']['DB_PPFX'].'categories',
                      'res'=>''.$row[0].' row(s)');	
}else {
  $page_str[] = array('str'=>'Probing table: '.$_SESSION['INST']['DB_PPFX'].'categories',
                      'res'=>'<span style="color:red">[not found]</span>');	
  $proceed = false;
	$no_upgrade = true;
}
if($res = mysql_query('SELECT COUNT(*) FROM '.$_SESSION['INST']['DB_PPFX'].'sysvars ')) {
  $row = mysql_fetch_row($res);
  $page_str[] = array('str'=>'Probing table: '.$_SESSION['INST']['DB_PPFX'].'sysvars ',
                      'res'=>''.$row[0].' row(s)');	
}else {
  $page_str[] = array('str'=>'Probing table: '.$_SESSION['INST']['DB_PPFX'].'sysvars ',
                      'res'=>'<span style="color:red">[not found]</span>');	
  $proceed = false;
	$no_upgrade = true;
}

if($no_upgrade) {
	$page_str = array();
  $page_str[] = array('str'=>'You have latest sources already installed. No need for an upgrade.',
                      'res'=>'<span style="color:red">[halted]</span>');	
	$proceed = false;
}elseif($proceed == false) {
  $page_str[] = array('str'=>'Previous Installation not found',
                      'res'=>'<span style="color:red">[halted]</span>');	
  $proceed = false;
}else {
  $page_str[] = array('str'=>'Previous Installation found',
                      'res'=>'[upgrade started]');	
}

if($proceed) {
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
      }elseif(!(strpos(strtoupper($query),'DROP TABLE')===false)) {
        $table_name = explode(' ',trim(substr($query,0,strpos($query,' '))));
        $table_name = preg_split ("/[\s,]+/", trim($query)); 
        $table_name = $table_name[count($table_name)-1];
        $query = str_replace($table_name,$_SESSION['INST']['DB_PFX'].$table_name,$query);
        //$page_str[] = array('str'=>'Drop Previous Table: '.$table_name,'res'=>'[done]');	
      }elseif(!(strpos(strtoupper($query),'INSERT INTO')===false)) {
        $table_name = explode(' ',trim(substr($query,0,strpos(strtoupper($query),'VALUES'))));
        $table_name = $table_name[count($table_name)-1];
        $query = str_replace($table_name,$_SESSION['INST']['DB_PFX'].$table_name,$query);
        //$page_str[] = array('str'=>'Data Insert:'.$table_name,'res'=>'[done]');	
      }
      
      if(@mysql_query($query)) {
      }else {
      	$page_str[] = array('str'=>'Query:'.substr($query,0,25),
                            'res'=>'<span style="color:red">['.mysql_error().']</span>');	
      }
    }
  }
}

if($proceed) {
	//transfer config table
  if($res = mysql_query('SELECT * FROM '.$_SESSION['INST']['DB_PPFX'].'sysvars')) {
  while ($row = mysql_fetch_assoc ($res))
	{
	$key = $row['vname'];
	$val = $row['vvalue'];
      if(trim($val)==='true') {
      	$val = 'Y';
      }elseif(trim($val)==='false') {
      	$val = 'N';
      }
    	mysql_query('UPDATE '.$_SESSION['INST']['DB_PFX'].'tmp_up_sysvars SET vvalue="'.addslashes(str_replace("<br>","<br />",$val)).'" WHERE vname="'.$key.'"') or die(mysql_error());
	}
  }  

  if($res = mysql_query('SELECT * FROM '.$_SESSION['INST']['DB_PPFX'].'categories')) {
    while($row = mysql_fetch_assoc($res)) {
      $new_row = array('ID'=>$row['ID'],'PID'=>'','name'=>$row['name'],'confirmed'=>$row['confirmed']);
      $que = 'SELECT ID FROM '.$_SESSION['INST']['DB_PPFX'].'categories WHERE FIND_IN_SET('.$row['ID'].',subcategory_ids)';
      if($r = mysql_query($que)) {
        if($rs = mysql_fetch_row($r)) {
          $new_row['PID'] = $rs[0];	
        }else {
        	$new_row['PID'] = '0';
        }
      }else {
        $new_row['PID'] = '0';
      }
      if ($row['PID'] != '0') { $new_row['PID'] = $row['PID']; }
      $que = 'INSERT INTO '.$_SESSION['INST']['DB_PFX'].'tmp_up_categories('.implode(',',array_keys($new_row)).') VALUES("'.implode('","',$new_row).'")';
      mysql_query($que);
    }
  }
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PPFX'].'users CHANGE pass pass VARCHAR(32)  NOT NULL';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PPFX'].'users ADD utype TINYINT(1)  DEFAULT "0" NOT NULL AFTER ID';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PPFX'].'items ADD allow_comments enum("Y","N") NOT NULL default "Y"';
  mysql_query($que);

  $usrs = mysql_query("SELECT login FROM ".$_SESSION['INST']['DB_PPFX'].'users'."  where login='admin'");
  $usr = mysql_fetch_row($usrs);
  if ($usr) {
	  $que ="UPDATE ".$_SESSION['INST']['DB_PPFX']."users SET utype='9' where login='admin'";
	  mysql_query($que);  
  } else {
	  $que = 'INSERT INTO '.$_SESSION['INST']['DB_PPFX'].'users VALUES("","9","admin","pass","Site Admin","admin@yourdomain.com","2005-05-26 00:00:00","2500-01-01 00:00:00")';
	  mysql_query($que);
	  $que ="UPDATE ".$_SESSION['INST']['DB_PPFX']."users SET pass=MD5(pass) where login='admin'";
	  mysql_query($que);
  }
  $que = 'DROP TABLE /*!32200 IF EXISTS*/ '.$_SESSION['INST']['DB_PPFX'].'categories';
  mysql_query($que);
  $que = 'DROP TABLE /*!32200 IF EXISTS*/ '.$_SESSION['INST']['DB_PPFX'].'sysvars';
  mysql_query($que);
  $que = 'DROP TABLE /*!32200 IF EXISTS*/ '.$_SESSION['INST']['DB_PPFX'].'comments';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PFX'].'tmp_up_categories RENAME '.$_SESSION['INST']['DB_PFX'].'categories';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PFX'].'tmp_up_comments RENAME '.$_SESSION['INST']['DB_PFX'].'comments';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PFX'].'tmp_up_sysvars RENAME '.$_SESSION['INST']['DB_PFX'].'sysvars';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PPFX'].'items RENAME '.$_SESSION['INST']['DB_PFX'].'items';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PPFX'].'styles RENAME '.$_SESSION['INST']['DB_PFX'].'styles';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PPFX'].'users RENAME '.$_SESSION['INST']['DB_PFX'].'users';
  mysql_query($que);
  $que = 'ALTER TABLE '.$_SESSION['INST']['DB_PPFX'].'view_ip RENAME '.$_SESSION['INST']['DB_PFX'].'view_ip';
  mysql_query($que);

  $page_str[] = array('str'=>'Database Tables Upgraded',
                      'res'=>'[done]');	
}
if ($proceed == false && $no_upgrade) {
	$usrs = mysql_query("SELECT login FROM ".$_SESSION['INST']['DB_PPFX'].'users'."  where login='admin'");
	if ($usrs){$usr = mysql_fetch_row($usrs); }
  	if ($usr) {
	  	$que ="UPDATE ".$_SESSION['INST']['DB_PPFX']."users SET utype='9' where login='admin'";
	  	mysql_query($que);  
  	} else {
	  	$que = 'INSERT INTO '.$_SESSION['INST']['DB_PPFX'].'users VALUES("","9","admin","pass","Site Admin","admin@yourdomain.com","2005-05-26 00:00:00","2500-01-01 00:00:00")';
	  	mysql_query($que);
	  	$que ="UPDATE ".$_SESSION['INST']['DB_PPFX']."users SET pass=MD5(pass) where login='admin'";
	  	mysql_query($que);
  	}
}
//create configuration file out of template
if($proceed or ($proceed == false and  $no_upgrade)) {
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
    $fp = @fopen($files['conf_out'],"w+");;
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
}
  


  //$proceed = true;
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
          <td class="cell_headerd" colspan=2 width="65%">
						<?php 
							if($no_upgrade) {
								echo '<br /><center><a href="../install/">Click here</a> if you want to re-install the application.</center>';
							}
						?>
					</td>
        </tr>
        <tr>
          <td height="100%" nowrap colspan="2">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
