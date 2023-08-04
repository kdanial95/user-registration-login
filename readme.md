# User Registration and Login System

This repository contains a simple user registration and login system built using PHP and a local text file to store user data. The system allows new users to register with their email address and password, and existing users can log in using their registered credentials.

## Features

- User Registration: New users can register by providing their email address and password. The system will validate the email format and store the hashed password securely.

- User Login: Registered users can log in using their email and password. The system will check the provided credentials against the stored data and grant access if the information is correct.

- CSS Styling: The user registration and login forms have been styled using CSS for an appealing visual appearance.

## Getting Started

To run this project on your local machine, follow these steps:

1. Clone the repository to your local directory:

```
git clone https://github.com/kdanial95/user-registration-login.git
```

2. Set up a local server environment with PHP support (e.g., XAMPP, WAMP).

3. Copy the entire repository to the web server's document root or a directory accessible through the web server.

4. Navigate to the registration form page and the login form page in your web browser:

- Registration Form: `http://localhost:$port/register`
- Login Form: `http://localhost:$port/login`

## Files and Structure

- `index.php`: Entry point of the application.
- `views/register.html`: HTML file containing the user registration form.
- `views/login.html`: HTML file containing the user login form.
- `styles/style.css`: CSS file for styling the forms.
- `controllers/UserManagerController.php`: PHP class that encapsulates user registration and login functionalities.
- `controllers/AuthController.php`: PHP script to handle user authentication and use the `UserManager` class.
- `controllers/FormValidator.php`: PHP class to applies the appropriate filter to sanitize the value.
- `users.txt`: Text file to store user data in the format: `email:hashed_password`.

## PHP Class - UserManagement

The `UserManagement` class encapsulates user registration and login functionalities. It provides methods for registering new users and checking user credentials.

## Contributions

Contributions to this project are welcome. If you find any issues or have suggestions for improvements, feel free to open an issue or create a pull request.

## License

This project is licensed under the [MIT License](LICENSE). Feel free to use, modify, and distribute it according to the terms of the license.

## Acknowledgments

Special thanks to the creators of PHP, HTML, and CSS for providing powerful tools to build web applications.