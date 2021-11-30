<?php

class UserValidator
{

    private $data;
    private $errors = [];
    private static $fields = ['username', 'email'];

    // Create a constructor to handle the POST data 
    public function __construct($data)
    {
        $this->data = $data;
    }

    // Check that required fields are present in the data
    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present");
            }
        }
        $this->validateUsername();
        $this->validateEmail();
        return $this->errors;
    }

    // Create method to validate the username
    private function validateUsername()
    {
        // Trim any whitespace from username
        $val = trim($this->data['username']);

        // Pass error if empty otherwise validate entry
        if (empty($val)) {
            $this->addError('username', 'Username field cannot be empty.');
        } else {
            // Use Regex to validate the username criteria
            if (!preg_match('/^[a-zA-Z0-9]{6,18}$/', $val)) {
                $this->addError('username', 'Username must be 6-18 alphanumeric characters long.');
            }
        }
    }

    // Create method to validate the email
    private function validateEmail()
    {
        // Trim any whitespace from email
        $val = trim($this->data['email']);

        // Pass error if empty otherwise validate entry
        if (empty($val)) {
            $this->addError('email', 'Email field cannot be empty.');
        } else {
            // 
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Please enter a valid email address.');
            }
        }
    }

    // Create a function to handle the field key and error value error arguments
    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
