Php Based Login and Forgot Password System with OTP

A PHP-based project for handling forgot password functionality and email verification.

Table of Contents

Introduction

Features
Getting Started
How it Works
Usage
Dependencies
Contributing
License


Introduction
This project aims to provide a secure and efficient method for handling forgot password requests and email verification in a PHP-based application. The code uses MySQL for storing user data, PHP for server-side processing, and email to send verification codes.

Features

Allow users to request a password reset through email.

Generate and store a one-time verification code (OTP) for each password reset request.

Send an email with the OTP to the user's email address.

Verify the OTP provided by the user to reset the password.

Getting Started

To use this project on your local machine, follow these steps:

Clone the repository: git clone 
Set up a local server with PHP and MySQL support.
Create a new database and import the provided SQL schema from connection.php.
Update the database credentials in connection.php.
Upload the project files to your server or run it locally.

How it Works
When a user submits a "Forgot Password" request through the provided form, the code checks if the email exists in the database.
If the email is valid, it generates a random OTP, stores it in the database, and sends it to the user's email address.
The user receives an email with the OTP and is redirected to the verifyEmail.php page to enter the OTP for verification.
If the OTP is valid, the user is redirected to the newPassword.php page to set a new password.
Usage
Use the forgot_password form in your application to initiate a password reset request.
Check your email for the verification code and enter it in the verifyEmail.php form.
If the code is valid, you will be redirected to newPassword.php, where you can set a new password.

Dependencies

PHP version X.X or higher.
MySQL database.

Contributing
Contributions are welcome! If you find any bugs or have suggestions for improvements, feel free to submit a pull request.

License
This project is licensed under the MIT License.

Happy coding! 😄🚀
