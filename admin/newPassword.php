<?php include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/forgot.css">
</head>
<body>
<div id="container">
        <h2>Password</h2>
        <p>Set a new password</p>
        <div id="line"></div>
        <!-- Form for inputing our new password -->
        <form action="newPassword.php" method="POST" autocomplete="off">
            <?php
            if ($errors > 0) {
                foreach ($errors as $displayErrors) {
            ?>
                    <div id="alert"><?php echo $displayErrors; ?></div>
            <?php
                }
            }
            ?>
            <!-- Input type password hides characters that we are typing -->
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirmPassword" placeholder="Confirm Password" required><br>
            <!-- We've assigned a name= confirmPassword, to be used in controller.php to check  -->
            <input type="submit" name="changePassword" value="Save">
            <!-- In controller.php, we are taking our data to a changePassword{} -->
        </form>
    </div>
</body>
</html>