<?php
namespace Controllers;

// Include the UserManagerController class
require_once(__DIR__ . '/UserManagerController.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create an instance of the UserManagerController and pass the path to 'users.txt'
    $userManagement = new UserManagerController(__DIR__ . '/users.txt');

    // Get the email and password from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the 'login' button was clicked
    if (isset($_POST['login'])) {
        // Attempt to log in the user
        $user = $userManagement->loginUser($email, $password);

        // Check if the login attempt was successful
        if ($user["success"]) {
            // Redirect to the dashboard if login is successful
            header("location: http://127.0.0.1:9001/dashboard");
        } else {
            // Redirect back to the login page with a parameter indicating unsuccessful login
            header("location: http://127.0.0.1:9001/login?success=false");
        }
    }

    // Check if the 'register' button was clicked
    if (isset($_POST['register'])) {
        // Attempt to register the user
        $user = $userManagement->registerUser($email, $password);

        // Check if the registration was successful
        if ($user["success"]) {
            // Redirect to the registration page with a parameter indicating successful registration
            header("location: http://127.0.0.1:9001/register?success=true");
        } else {
            // Redirect back to the registration page with a parameter indicating unsuccessful registration
            header("location: http://127.0.0.1:9001/register?success=false");
        }
    }
}