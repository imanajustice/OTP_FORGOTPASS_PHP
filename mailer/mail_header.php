<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mailer/phpmailer/Exception.php';
require '../mailer/phpmailer/PHPMailer.php';
require '../mailer/phpmailer/SMTP.php';

//$msg = $_POST['msg'];
$mail = new PHPMailer;

$mail->isSMTP();

$mail->SMTPDebug = 2;

$mail->Host = 'smtp@gmail.com';

$mail->Port = 587;

$mail->SMTPAuth = true;

$mail->Username = 'telescodev@gmail.com';

$mail->Password = 'aivpqwfonpcxgcde';

$mail->setFrom('telescodev@gmail.com', 'Telesco');

$mail->addReplyTo('telescodev@gmail.com', 'Telesco');

$mail->addAddress('telescolawrence@gmail.com', 'Lorens');

$to = $_GET['mail'];
$mail->addAddress($to);