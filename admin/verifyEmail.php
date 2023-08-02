<?php include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification Form</title>
    <link rel="stylesheet" href="css/otp.css">
</head>
<body>
    <div id="container">
        <!-- This is the next page after keying in your email  -->
        <div id="line"></div>
        <!-- Here, you are supposed to key in the code that was emailed in controller.php line 29 -->
        <form action="verifyEmail.php" method="POST" autocomplete="off">
            <?php
            if(isset($_SESSION['message'])){
                ?>
                <div id="alert"><?php echo $_SESSION['message']; ?></div>
                <?php
            }
            // Error is displayed above
            ?>

            <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?>  
            <!-- type can be different according to what you're keying in, from date to text etc -->
            <input type="number" name="OTPverify" placeholder="Verification Code" required><br>
            <input type="submit" name="verifyEmail" value="Verify">
            <!-- Submit button parses the OTP you've keyed in to the controller.php with the var= OTPverify button=verifyEmail -->
        </form>
    </div>
</body>
</html>