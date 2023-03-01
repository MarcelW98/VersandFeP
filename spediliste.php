<?php



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
//include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/head.inc.php");
require_once('PHPMailer/src/PHPMailer.php');
//AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);

//require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);

// try {
  
//     //Server settings
//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'w.marcel98@gmail.com';                     //SMTP username
//     $mail->Password   = 'egwhfjyqwkijvdaj';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipientsc
//     $mail->setFrom('w.marcel98@gmail.com');
//      $mail->addAddress('w.marcel98@gmail.com');     //Add a recipient
//     // $mail->addAddress('ellen@example.com');               //Name is optional
//     // $mail->addReplyTo('info@example.com', 'Information');
//     // $mail->addCC('cc@example.com');
//     // $mail->addBCC('bcc@example.com');

//     //Attachments
//     // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }

?>

<html>
<style>

  
</style>

<body class="bg">
  <?php
  include("templates/header.inc.php");
  ?>

  <main>
  
  <div class="container">
  <label for="exampleDataList" class="form-label">Datalist example</label>
<input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
<datalist id="datalistOptions">
  <option value="San Francisco">
  <option value="New York">
  <option value="Seattle">
  <option value="Los Angeles">
  <option value="Chicago">
  <option value="Agility">Agility</option>
      <option value="Barsan">Barsan</option>
      <option value="CEVA">CEVA</option>
      <option value="Cosco">Cosco</option>
      <option value="CPD">CPD</option>
      <option value="DHL-Express">DHL-Express</option>
      <option value="DHL-Global">DHL-Global</option>
      <option value="DSV">DSV</option>
      <option value="ERA">ERA</option>
      <option value="FCM">FCM</option>
      <option value="Große Vehne">Große Vehne</option>
      <option value="Hellman">Hellman</option>
      <option value="K&N">K&N</option>
      <option value="KWE">KWE</option>
      <option value="LGI">LGI</option>
      <option value="LKW Walter">LKW Walter</option>
      <option value="Nippon">Nippon</option>
      <option value="Patinter">Patinter</option>
      <option value="Robinson">Robinson</option>
      <option value="Rüdiger">Rüdiger</option>
      <option value="Schenker">Schenker</option>
      <option value="TMC">TMC</option>
      <option value="TNT">TNT</option>
      <option value="UPS">UPS</option>
      <option value="Wackler">Wackler</option>
</datalist>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="input-group">
  <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
  <option value="Search">Search...</option>
  <option value="Agility">Agility</option>
      <option value="Barsan">Barsan</option>
      <option value="CEVA">CEVA</option>
      <option value="Cosco">Cosco</option>
      <option value="CPD">CPD</option>
      <option value="DHL-Express">DHL-Express</option>
      <option value="DHL-Global">DHL-Global</option>
      <option value="DSV">DSV</option>
      <option value="ERA">ERA</option>
      <option value="FCM">FCM</option>
      <option value="Große Vehne">Große Vehne</option>
      <option value="Hellman">Hellman</option>
      <option value="K&N">K&N</option>
      <option value="KWE">KWE</option>
      <option value="LGI">LGI</option>
      <option value="LKW Walter">LKW Walter</option>
      <option value="Nippon">Nippon</option>
      <option value="Patinter">Patinter</option>
      <option value="Robinson">Robinson</option>
      <option value="Rüdiger">Rüdiger</option>
      <option value="Schenker">Schenker</option>
      <option value="TMC">TMC</option>
      <option value="TNT">TNT</option>
      <option value="UPS">UPS</option>
      <option value="Wackler">Wackler</option>
  </select>
  <button class="btn btn-primary" type="button">Button</button>
</div>
<a href="mailto:Marcel.Wagner2@de.bosch.com?subject=Hier%20steht%20der%20Betreff&amp;body=Hallo%20Max,%0D%0A%0D%0Ahier%20steht%20eine%20TestNachricht.%20Bolognummer:12123213" target="_blank" class="btn btn-primary">Email Button</a>
  </div>
  </main>

<?php
include("templates/footer.inc.php");
include("speditionsliste/scripts/spediliste_js.php");
?>