<?php
include("global.inc.php");
$errors=0;
//$error="The following errors occured while processing your new input.<ul>";
pt_register('POST','name');
pt_register('POST','email');
//if($name=="" || $email==""){
//$errors=1;
//$error.="<li>You did not enter one or more of the required fields. Please go back and try again.</li>";
//}
//if(!eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" ."@"."([a-z0-9]+([\.-][a-z0-9]+)*)+"."\\.[a-z]{2,}"."$",$email)){
//$error.="<li>You entered an invalid email address.";
//$errors=1;
//}
if($errors==1) echo $error;
else{
$where_form_is="http".($HTTP_SERVER_VARS["HTTPS"]=="on"?"s":"")."://".$SERVER_NAME.strrev(strstr(strrev($PHP_SELF),"/"));
$message="Name: ".$name."
Email Address: ".$email."
";
$message = stripslashes($message);
$from_name = "comprehensivenet";
$email = "winner@comprehensivenet.com";
$headers = "From: {$from_name} <{$email}>";
mail("chani@adlibunlimited.com", "Comprehensivenet.com", $message, $headers);
mail($email, "Thank you for submitting your comments", "Thank your for your inquiry, we will be getting back to you shortly.", $headers);

header( 'refresh: 0; url=http://comprehensivenet.com' );
?>
<?php 
}
?>