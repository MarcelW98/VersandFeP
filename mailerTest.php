<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/* Klasse zur Behandlung von Ausnahmen und Fehlern */
require 'PHPMailer\src\Exception.php';

/* PHPMailer-Klasse */
require 'PHPMailer\src\PHPMailer.php';

/* SMTP-Klasse, die benötigt wird, um die Verbindung mit einem SMTP-Server herzustellen */
require 'PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);
try {
        // Instanz der PHPMailer-Klasse erstellen
       

        // if ($debug) {
        //         // gibt einen ausführlichen log aus
        //         $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER; 
        //     }
        

        // Authentifikation mittels SMTP
        $mail->isSMTP();
       


        $mail->CharSet ="UTF-8";

$mail->SMTPDebug = 4;
$mail->SMTPAuth = FALSE;
$mail->SMTPSecure = "none";
$mail->Port     = 25;  
$mail->Username = "";
$mail->Password = "";
$mail->Host     = "rb-smtp-int.bosch.com";
$mail->Mailer   = "smtp";


//$mail->SetFrom($_POST["userEmail"], $_POST["userName"]);
$mail->SetFrom("Marcel.Wagner2@de.bosch.com");
//$mail->AddReplyTo($_POST["userEmail"], $_POST["userName"]);
$mail->addAddress("Marcel.Wagner2@de.bosch.com");
//fepclp33.bologbriefkasten@de.bosch.com



       // $mail->addAttachment("/home/user/Desktop/beispielbild.png", "beispielbild.png");

     $mail->CharSet = 'UTF-8';
     $mail->Encoding = 'base64';

        $mail->isHTML(true);
        $mail->Subject = 'Der Betreff Ihrer Mail';
     $mail->Body = 'Der Text Ihrer Mail als HTML-Inhalt. Auch <b>fettgedruckte</b> Elemente sind beispielsweise erlaubt.';
     $mail->AltBody = 'Der Text als simples Textelement';

        $mail->send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
}
?>