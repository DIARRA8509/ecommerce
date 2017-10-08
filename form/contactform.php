<?php

// basic settings section
$sendto = 'bakarydiarra8509@gmail.com';
$subject = 'contact  via maboutique';
$iserrormessage = 'Votre message n\'a pas été envoyé pour les raisons suivantes:';
$thanks = "Votre message a été envoyé, nous vous contacterons dans les 24h.";

$emptyname =  'Saisir un nom';
$emptyemail = 'Saisir un e-mail';
$emptymessage = 'Saisir un message.';

$alertname =  'Format du nom invalide. N\'entrez pas de caractères spéciaux dans votre nom.';
$alertemail = 'Format e-mail incorrecte, bon format: yourname@domain.com';
$alertmessage = "Ne pas utiliser de caractères spéciaux dans votre message. Un lien classique fonctionne parfaitement.";


$alert = '';
$iserror = 0;


// cleaning the post variables
function clean_var($variable) {$variable = strip_tags(stripslashes(trim(rtrim($variable))));return $variable;}

// validation of filled form
if ( empty($_REQUEST['contact-name']) || $_REQUEST['contact-name'] == "") {
	$iserror = 1;
	$alert .= "<li><h6>" . $emptyname . "</h6></li>";
} elseif ( preg_match( "/[][{}()*+?.\\^$|]/i", $_REQUEST['contact-name'] ) ) {
	$iserror = 1;
	$alert .= "<li><h6>" . $alertname . "</h6></li>";
}

if ( empty($_REQUEST['contact-email']) || $_REQUEST['contact-email'] == "Entrer votre adresse e-mail") {
	$iserror = 1;
	$alert .= "<li><h6>" . $emptyemail . "</h6></li>";
} elseif ( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_REQUEST['contact-email']) ) {
	$iserror = 1;
	$alert .= "<li><h6>" . $alertemail . "</h6></li>";
}

if ( empty($_REQUEST['contact-message']) || $_REQUEST['contact-message'] == "Votre message ici...") {
	$iserror = 1;
	$alert .= "<li><h6>" . $emptymessage . "</h6></li>";
} elseif ( preg_match( "/[][{}()*+?\\^$|]/i", $_REQUEST['contact-message'] ) ) {
	$iserror = 1;
	$alert .= "<li><h6>" . $alertmessage . "</h6></li>";
}

// if there was error, print alert message
if ( $iserror==1 ) {

	echo "<script>
			$(\"#message\").addClass(\"warning\").stop().slideDown(\"normal\").fadeIn(\"normal\").delay(3500).slideUp(\"normal\");
		 </script>";
	echo "<div class=\"alert_title\"><h4>" . $iserrormessage . "</h4></div><br />";
	echo "<ul class=\"unordered\">";
	echo $alert;
	echo "</ul>";
	echo "</div>";

} else {
	// if everything went fine, send e-mail
	$plsubject = "=?utf-8?B?".base64_encode($subject)."?=";
	$msg = "Sujet: " . clean_var($_REQUEST['contact-sujet']) . "\n\n";
	$msg .= "Nom/société: " . clean_var($_REQUEST['contact-name']) . "\n";
	$msg .= "Message: \n\n" . clean_var($_REQUEST['contact-message']) . "\n";
	$msg .= "E-mail: " . clean_var($_REQUEST['contact-email']) . "\n";
	$msg .= "Téléphone: " . clean_var($_REQUEST['contact-tel']);
	$header = 'De:'. clean_var($_REQUEST['contact-email'])."\r\n";
	$header .= "Content-type: text/plain; charset=utf-8"; 
	


	mail($sendto, $plsubject, $msg, $header);

	echo "<script>$(\"#message\").addClass(\"success\").stop().slideDown(\"normal\").fadeIn(\"normal\").delay(3500).slideUp(\"normal\");</script>";
	echo "<h4>" . $thanks . "</h4>";
	echo "</div>";
	echo "<script>$('#contact-form input[type=text], #contact-form textarea').val('');</script>";
	die();
}
?>