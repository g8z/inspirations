<?PHP
if(!defined('IN_APP')) {
	die('Malicious request: <b> This program </b> could not be accessed directly!');
}
$ID = isset($_GET['ID'])?(int)$_GET['ID']:0;
$ID = isset($_POST['ID'])?(int)$_POST['ID']:$ID;

$intVars['content'] = '';
$defaults = array();
$gFrm = new HTML_QuickForm('loginForm','post');//default form object..pages may initialize additional objects
$gFrm->setJsWarnings($lang['invalid_information_entered'],$lang['please_correct_this_fields']);
$gFrm->setRequiredNote('<span style="color:#ff0000;">*</span><span style="">'.$lang['denotes_required_field'].'</span>');

$gFrm->addElement('text','fullname',$lang['your_name'],'size="30"');
$gFrm->addRule('fullname',$lang['please_enter_your_name'],'required');
$gFrm->addRule('fullname',$lang['please_enter_your_name'],'required','','client');

$gFrm->addElement('text','email',$lang['your_email_address'],'size="30" maxlength="100"');
$gFrm->addRule('email',$lang['please_enter_your_email_address'],'required');
$gFrm->addRule('email',$lang['please_enter_your_email_address'],'required','','client');
$gFrm->addRule('email',$lang['please_enter_valid_email_your'],'email','','client');

$gFrm->addElement('text','temail',$lang['friend_email'],'size="30" maxlength="100"');
$gFrm->addRule('temail',$lang['please_enter_friend_email_address'],'required');
$gFrm->addRule('temail',$lang['please_enter_friend_email_address'],'required','','client');
$gFrm->addRule('temail',$lang['please_enter_valid_email_friend'],'email','','client');

$gFrm->addElement('textarea','msg',$lang['your_message'],'rows="5" style="width:100%"');

$gFrm->addElement('hidden','cmd',$act);
$gFrm->addElement('hidden','ID',$ID);

$gFrm->addElement('submit','submit',$lang['send_inspiration']);
$gFrm->addElement('button','close',$lang['close'],array('onClick'=>'window.close();'));


$msgTxt = '';

if($gFrm->validate()) {
	//$gFrm->freeze();
	$to = $recipient = $gFrm->exportValue('temail');
	$temail = $recipient = $gFrm->exportValue('temail');
	$from = $gFrm->exportValue('email');
	$name = $from_name = $gFrm->exportValue('fullname');
	$message = $gFrm->exportValue('msg');

	if($row=$db->getRow("SELECT author, title, image_mime_type, image_data, image_align, text FROM ".dext('items')." WHERE ID = '".$ID."'")) {
		// execute query and loop through result set
		$inspAuthor = $row['author'];
		$inspTitle = $row['title'];
		$image_mime_type = $row['image_mime_type'];
		$image_data = $row['image_data'];
		$image_align = $row['image_align'];
		$inspBody = $row['text'];

//		list( $inspAuthor, $inspTitle, $image_mime_type, $image_data, $image_align, $inspBody ) = $row;

		$message = stripslashes( $message );
		$inspTitle = stripslashes( $inspTitle );
		$inspBody = stripslashes( nl2br($inspBody) );
		$inspAuthor = stripslashes( $inspAuthor );


		$gMail->AddAddress($recipient, "");
		$gMail->From     = $from;
		$gMail->FromName = $from_name;


		$gMail->IsHTML(true);
		$gMail->SetLanguage("en", INCLUDE_DIR."phpmailer/language/");

		$gMail->Body = nl2br($message)."<br /><br /><br />";

		$gMail->Body .= $inspTitle . "<br /><br />";
		if ($image_mime_type != ""){
			$extension = explode("/", $image_mime_type);
			$extension = $extension[1];
			$gMail->AddEmbeddedImageString($image_data, "my-attach", "image", "base64", $image_mime_type);
			$gMail->Body .= '<img alt="embedded image" src="cid:my-attach" '.$image_align.'>';
		}
		$gMail->Body .= $inspBody . "<br /><br />";
		$gMail->Body .= $lang['by'] . $inspAuthor;
		$gMail->Body .= "<br /><br />".$lang['view_more_inspirations_like_this_one']."<a href='" . HOME."'>".HOME."</a>";

		// Use plain text for clients that do not read HTML
		$gMail->AltBody = "$message\n\n\n";

		$gMail->AltBody .= $inspTitle . "\n\n";
		$gMail->AltBody .= $inspBody . "\n\n";
		$gMail->AltBody .= $lang['by'] . $inspAuthor;
		$gMail->AltBody .= "\n\n".$lang['view_more_inspirations_like_this_one'] . HOME;

		$gMail->Subject = $lang['an_inspiration_sent_to_you_by']. $name;

		if(!$gMail->Send()){
			$popupMsgTxt .= $lang['there_has_been_a_mail_error_sending_to'] . $temail. ": {$gMail->ErrorInfo}";
		}else {
			$popupMsgTxt = $lang['inspiration_was_sent_to'] . $temail;
		}
		$t->assign( 'popup_msg_text', $popupMsgTxt );

		// Clear all addresses and attachments for next loop
		$gMail->ClearAddresses();
		$gMail->ClearAttachments();
	}
}else {
	$gFrm->setDefaults($defaults);
}

$gFrm->accept($gFrmR);
$t->assign('form_data',$gFrmR->toArray());


/*
echo '<pre>';
print_r($gFrmR->toArray());
//*/
$t->assign('top_message',$msgTxt);
$t->display('email.tpl');
?>