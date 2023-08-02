<?php
    include_once("connection.php");
    session_start();
    $errors = [];

    if (isset($_POST['forgot_password'])) {
        // Email below is derived from our forgot.php input form
        $email = $_POST['email'];
        $_SESSION['email'] = $email;
// The query below checks whether the email input in our forgot.php file exists in the database
        $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        // the results are attached to a variable $emailCheckResult 
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        if ($emailCheckResult) {
            if (mysqli_num_rows($emailCheckResult) > 0) {
                // generate a code (OTP) and assign it variable $code note that we need a column for storing the OTP in the database
                $code = rand(999999, 111111); //random number from 999999 to 111111
                $updateQuery = "UPDATE users SET code = $code WHERE email = '$email'";
                // update your users table with the code you just generated where the email is the $email you input in  the forgot.php form
                $updateResult = mysqli_query($conn, $updateQuery);
                // store the results in a variable $updateResult
                if ($updateResult) {
                    //sends a mail to your $email with the message carrying the code you generated 
                    $subject = 'Email Verification Code';
                    $message = "Your Recen verification code is $code"; //$code is the code we generated in line 18 above
                    $sender = 'From:info@refoveo.recen.io';
                    // parse this data to your php mailer for emailing
                    header('location: mailer/mail.php?action=reset&mail=$email&pd=$code');

                    if (mail($email, $subject, $message, $sender)) {
                        $message = "We've sent a verification code to your Email <br> $email";

                        $_SESSION['message'] = $message;
                        // if mail sending is a success, it takes to verifyEmail.php
                        header('location: verifyEmail.php');
                    } else {
                        $errors['otp_errors'] = 'Failed while sending code!';
                    }
                } else {
                    $errors['db_errors'] = "Failed while inserting data into database!";
                }
            }else{
                $errors['invalidEmail'] = "Invalid Email Address";
            }
        }else {
            $errors['db_error'] = "Failed while checking email from database!";
        }
    }

if(isset($_POST['verifyEmail'])){    //Our button
    $_SESSION['message'] = "";
    // We declare another variable $OTPverify that takes data from verifyEmail.php 
    $OTPverify = mysqli_real_escape_string($conn, $_POST['OTPverify']); //OTPverify was the name of our input form
    $verifyQuery = "SELECT * FROM users WHERE code = $OTPverify";
    // Checks from users to see which user has a OTP that is equal to the one just keyed in (Remember we stored 
    // the OTP when we created it)
    $runVerifyQuery = mysqli_query($conn, $verifyQuery);
    if($runVerifyQuery){
        if(mysqli_num_rows($runVerifyQuery) > 0){
            //WE now reset the code column in our database for future use because we've found our user
            $newQuery = "UPDATE users SET code = 0";
            $run = mysqli_query($conn,$newQuery);
            //Redirect to another page newPassword.php
            header("location: newPassword.php");
        }else{
            $errors['verification_error'] = "Invalid Verification Code";
        }
    }else{
        $errors['db_error'] = "Failed while checking Verification Code from database!";
    }
}

// change Password
if(isset($_POST['changePassword'])){  //Our {} as defined in newPassword.php line 31&32
    $password = md5($_POST['password']);
    // Message Digest Method 5) is a cryptographic hash algorithm used to generate a 128-bit digest from a string of any length. It represents the digests as 32 digit hexadecimal numbers.
    $confirmPassword = md5($_POST['confirmPassword']);
    // $password and $confirmPassword are the same thing since it's just a confirmation
    
    if (strlen($_POST['password']) < 8) { //strlen means "string Length"
        $errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
    } else {
        // if password not matched deny access
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $errors['password_error'] = 'Password not matched';
        } else {
            // If passwords match, it proceeds to set the new password in  the users table under the $email that is active
            $email = $_SESSION['email'];
            $updatePassword = "UPDATE users SET password = '$password' WHERE email = '$email'";
            $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
            session_unset($email);
            //reset the session $email and take back to the login page.
            session_destroy();
            header('location: login.php');
        }
    }
}