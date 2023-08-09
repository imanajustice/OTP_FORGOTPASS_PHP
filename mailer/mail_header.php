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

$mail->Host = 'Your host here';

$mail->Port = 587;

$mail->SMTPAuth = true;

$mail->Username = '';

$mail->Password = '';

$mail->setFrom('info@refoveo.recen.io', 'Taylor');

$mail->addReplyTo('info@refoveo.recen.io', 'Taylor');

$mail->addAddress('imaanajustice@gmail.com', 'Imana');

$to = $_GET['mail'];
$mail->addAddress($to);