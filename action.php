<?php
header("Access-Control-Allow-Origin: * ");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName          = $_POST['firstName'];
    $lastName           = $_POST['lastName'];
    $number             = $_POST['number'];
    $email              = $_POST['email'];
    $password           = $_POST['password'];
    $confirmPassword    = $_POST['confirmPassword'];

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || empty($number)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required!'
        ]);
        return;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email format!'
        ]);
        return;
    } elseif (strlen($password) < 8 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character!'
        ]);
        return;
    } elseif ($password != $confirmPassword) {
        echo json_encode([
            'success' => false,
            'message' => 'Password do not match!'
        ]);
        return;
    } else {

        // hash number
        $hashNumber = md5($number);

        $postData = $_POST;
        $postData['hashedNumber'] = $hashNumber;
        // write input to file
        $newFile = 'data.txt';
        $file = fopen("$newFile", "a");
    
       
        $jsonEncodePostData = json_encode($postData);
        fwrite($file, $jsonEncodePostData . "\n");
        fclose($file);


        echo json_encode([
            'success' => true,
            'message' => 'Registeration Successful!',

        ]);
      

        exit();
    }
}
