<?php

// Get the current request URI
$request = $_SERVER['REQUEST_URI'];

// Switch statement to handle different URI requests
switch ($request) {
    case '/':
        // If the request URI is '/', serve the index.html view
        require __DIR__ . '/views/index.html';
        break;

    case str_contains($request, '/login'):
        // If the request URI contains '/login', serve the login.html view
        require __DIR__ . '/views/login.html';
        break;

    case str_contains($request, '/register'):
        // If the request URI contains '/register', serve the register.html view
        require __DIR__ . '/views/register.html';
        break;

    case str_contains($request, '/dashboard'):
        // If the request URI contains '/dashboard', serve the index.html view
        require __DIR__ . '/views/index.html';
        break;

    default:
        // For any other request URI, serve the 404.html view
        require __DIR__ . '/views/404.html';
        break;
}
