<?php
ini_set("memory_limit", "256M");
ini_set("display_errors","0");
ignore_user_abort(true);

if(isset($_POST['email'])) {
	$message  = urlencode($_POST['message']);
	$message  = ereg_replace("%5C%22", "%22", $message);
	$message  = urldecode($message);
	$message  = stripslashes($message);
	$subject  = stripslashes($_POST['subject']);
	$from     = $_POST['from'];
	$toemail  = $_POST['email'];
	
	$header  = 'MIME-Version: 1.0' . "\r\n";
	$header .= "From: ".$_POST['realname']." "." <".$_POST['from'].">\n";
	$header .= 'Content-type: text/html; charset=utf-8' . "\n";

	if (mail($toemail, $subject, $message, $header)) {
		echo("SEND\t $toemail");
	} else {
		echo("ERROR\t $toemail"); 
	}
} else {
	print '<h4>!PhpSend!</h4>';
}

	
?>