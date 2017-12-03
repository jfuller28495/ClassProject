<?php
if(isset($_POST['submit'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "jeannetta.fuller@hotmail.com";
    $email_subject = "'$firstname' has contacted PTG!";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['firstname']) ||
        !isset($_POST['lastname']) ||
        !isset($_POST['emailfrom']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['address1']))
        !isset($_POST['address2']) ||
        !isset($_POST['city']) ||
        !isset($_POST['state']) ||
		!isset($_POST['zip']) ||

		{
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $firstname = $_POST['firstname']; // required
    $lastname = $_POST['lastname']; // required
    $emailfrom = $_POST['emailfrom']; // required
    $phone = $_POST['phone']; // not required
    $address1 = $_POST['address1']; // required
	$address2 = $_POST['address2']; // required
	$city = $_POST['city']; // required
	$state = $_POST['state']; // required
	$zip = $_POST['zip']; // required


 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$emailfrom)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$firstname)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$lastname)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($address1) < 2) {
    $error_message .= 'The address you entered does not appear to be valid.<br />';
  }
  if(strlen($address2) < 2) {
    $error_message .= 'The address you entered does not appear to be valid.<br />';
  }
  if(strlen($city) < 2) {
    $error_message .= 'The city you entered does not appear to be valid.<br />';
  }
  if(strlen($state) > 2) {
    $error_message .= 'The state you entered does not appear to be valid.<br />';
  }
   if(strlen($zip) > 5) {
    $error_message .= 'The Zip Code you entered does not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($firstname)."\n";
    $email_message .= "Last Name: ".clean_string($lastname)."\n";
    $email_message .= "Email: ".clean_string($emailfrom)."\n";
    $email_message .= "phone: ".clean_string($phone)."\n";
    $email_message .= "address1: ".clean_string($address1)."\n";
	$email_message .= "address2: ".clean_string($address2)."\n";
	$email_message .= "city: ".clean_string($city)."\n";
    $email_message .= "state: ".clean_string($state)."\n";
    $email_message .= "zip: ".clean_string($zip)."\n";

 
// create email headers
$headers = 'From: '.$emailfrom."\r\n".
'Reply-To: '.$emailfrom."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers, '-fjeannetta.fuller@hotmail.com');  
?>
 
<!-- include your own success html here -->
 
<h1>Thank you for contacting us. We will be in touch with you very soon.</h1>
 
<?php
 
}
?>