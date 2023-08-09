<?php
require_once 'mail_header.php';
if($_GET['action'] == 'reset'){
    $password = $_GET['pd'];
    $mail->Subject = "Recen Password Reset";
    $mail->Body = "Your account password has been reset to : <b>{$password}</b>, kindly click the link below to activate your account and remember to change your password. <br>
    <a href=\"www.refoveo.recen.io/include/activate.php?id={$to}\" class='button'>Activate</a>
    ";
    
    if(!$mail->Send()){
        echo 'Mailer Error: ' . $mail->ErrorInfo;
	

	}
    else{
    	echo "
    		<script>alert('Password reset successful, New password has been sent to your email!')
    		</script>
    		<script>window.location = '../login.php'</script>
    		";
    }
}
?>
