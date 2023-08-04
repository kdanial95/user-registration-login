<?php

namespace Controllers;

// Include the FormValidator class
require_once(__DIR__ . '/FormValidator.php');

class UserManagerController
{
    private $users, $filePath, $formValidator;

    // Constructor to initialize the object with the file path and FormValidator instance
    public function __construct($file_path)
    {
        $this->filePath = $file_path;
        $this->users = $this->getFile(); // Load user data from the file into the $users array
        $this->formValidator = new FormValidator(); // Create an instance of FormValidator
    }

    // Method to register a new user with provided email and password
    public function registerUser($email, $password)
    {
        // Sanitize the email and password inputs
        $email = $this->formValidator->sanitize($email, 'email');
        $password = $this->formValidator->sanitize($password, 'string');

        // Encrypt the password for storage
        $password = $this->passwordEncryption($password);
        $userData = "$email:$password\n";

        // Check if the email already exists in the stored users
        foreach ($this->users as $eachUser) {
            list($registeredEmail, $registeredPassword) = explode(':', $eachUser);

            if ($email === $registeredEmail) {
                return ["success" => false]; // Return false if the user already exists
            }
        }

        // Append the new user data to the file
        file_put_contents($this->filePath, $userData, FILE_APPEND | LOCK_EX);

        return ["success" => true]; // Return true to indicate successful registration
    }

    // Method to authenticate a user during login
    public function loginUser($email, $password)
    {
        // Sanitize the email and password inputs
        $email = $this->formValidator->sanitize($email, 'email');
        $password = $this->formValidator->sanitize($password, 'string');

        // Check if the provided email and password match any of the stored users
        foreach ($this->users as $eachUser) {
            list($registeredEmail, $registeredPassword) = explode(':', $eachUser);
            $decryptedPassword = $this->passwordEncryption(null, $registeredPassword, true);

            if ($email === $registeredEmail && $password === $decryptedPassword) {
                return ["success" => true]; // Return true if the login is successful
            }
        }

        return ["success" => false]; // Return false if login fails
    }

    // Method to update a user's password
    public function updateUserPassword($email, $password)
    {
        // Sanitize the email and password inputs
        $email = $this->formValidator->sanitize($email, 'email');
        $password = $this->formValidator->sanitize($password, 'string');

        // Encrypt the new password
        $password = $this->passwordEncryption($password);

        // Update the user's password in the stored users
        foreach ($this->users as $key => &$eachUser) {
            list($registeredEmail) = explode(':', $eachUser);

            if ($email === $registeredEmail) {
                $this->users[$key] = $registeredEmail . ":" . $password;
            }
        }

        // Write the updated users array back to the file
        file_put_contents($this->filePath, $this->users, LOCK_EX);

        return ["success" => true]; // Return true to indicate successful password update
    }

    // Method to read user data from the file and return it as an array
    private function getFile()
    {
        echo $this->filePath;
        
        if (!file_exists($this->filePath)) {
            // If the file does not exist, create it
            $file = fopen('users.txt', 'x');
            fclose($file);
        }

        // Read user data from the file and return it as an array
        return file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    // Method to perform password encryption/decryption using OpenSSL
    private function passwordEncryption($password, $passwordEncrypted = null, $decrypt = false)
    {
        $key = pack('H*', 'uManagement'); // Generate a key from a hexadecimal string
        $method = 'aes-256-ecb'; // Encryption method: Advanced Encryption Standard (AES) with a 256-bit key in Electronic CodeBook (ECB) mode
        $res = null;

        if ($decrypt) {
            // Decrypt the password using the provided encrypted password and key
            $res = openssl_decrypt($passwordEncrypted, $method, $key);
        } else {
            // Encrypt the password using the key
            $res = openssl_encrypt($password, $method, $key);
        }

        return $res;
    }
}
