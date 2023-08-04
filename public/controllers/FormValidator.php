<?php

namespace Controllers;

class FormValidator
{
    /**
     * Sanitizes a value based on the specified type.
     *
     * @param mixed $value The value to be sanitized.
     * @param string $type The type of sanitization to be applied (optional, default is 'string').
     * @return mixed The sanitized value.
     */
    public function sanitize($value, $type = 'string')
    {
        // Based on the specified type, apply the appropriate sanitization filter
        switch ($type) {
            case 'email':
                $filter = FILTER_SANITIZE_EMAIL; // Sanitize the value as an email address
                break;
            case 'special_chars':
                $filter = FILTER_SANITIZE_SPECIAL_CHARS; // Sanitize the value by converting special characters to HTML entities
                break;
            case 'encoded':
                $filter = FILTER_SANITIZE_ENCODED; // Sanitize the value by encoding special characters
                break;

            default:
                // If no specific type is provided, sanitize the value using htmlspecialchars
                return htmlspecialchars($value); // Sanitize the value to prevent HTML/JavaScript injection
                break;
        }

        // Use the PHP filter_var function to apply the specified filter
        $output = filter_var($value, $filter);

        // Return the sanitized value
        return $output;
    }
}
