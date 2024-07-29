<?php
header("Access-Control-Allow-Origin: * ");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName              = $_POST['firstName'];
    $lastName               = $_POST['lastName'];
    $number                 = $_POST['number'];
    $email                  = $_POST['email'];
    $password               = $_POST['password'];
    $confirmPassword        = $_POST['confirmPassword'];

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || empty($number)) {
        echo json_encode([
            'success'       => false,
            'message'       => 'All fields are required!'
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
       
       $otp = rand(1000,9999);

        $postData = $_POST;
        $postData['hashedNumber'] = $hashNumber;
       
        // write input to file
        function writeToFile($firstName, $lastName, $email, $number, $password, $confirmPassword, $hashNumber,$otp)
        {
            $newFile = 'data.txt';
            $file = fopen("$newFile", "a");
            fwrite($file, $firstName . "\n");
            fwrite($file, $lastName . "\n");
            fwrite($file, $email . "\n");
            fwrite($file, $number . "\n");
            fwrite($file, $password . "\n");
            fwrite($file, $confirmPassword . "\n");
            fwrite($file, $hashNumber . "\n");
            fwrite($file, $otp . "\n");
            
            fclose($file);
        }
        function readFromFile()
        {
            $newFile = 'data.txt';
            $file = fopen("$newFile", "r");
            $data = [];
            while (($line = fgets($file)) !== false) {
                $data[] = trim($line);
            }
            fclose($file);
            return $data;
        }
        $data = readFromFile();
        if (in_array($email, $data) || in_array($number, $data)) {
            echo json_encode([
                'status' => false,
                'message' => 'user already exists!'
            ]);
            exit();
        }
        writeToFile($firstName, $lastName, $email, $number, $password, $confirmPassword, $hashNumber, $otp);

        echo json_encode([
            'status' => true,
            'message' => 'Registeration Successful!',
            // 'token' => $hashNumber,

            // $postData["hashedNumber"]

        ]);
        return header("location:loginindex.php");
        exit();
    }
    // get each user with hashed number
    // function getUserByHashNumber($hashNumber,   $firstName,$lastName,$email)
    // {
    //     $data = readFromFile();
    //     if (in_array($hashNumber, $data)) {
    //         echo json_encode([
    //             'status' => true,
    //             'message' => 'user found!',
    //             'userDetails' => "<pre>  $firstName,$lastName,$email</pre>"
    //         ]);
    //         exit();
    //     }else{
    //         echo json_encode([
    //             'status' => false,
    //             'message' => 'user not found!'
    //         ]);
    //         exit();
    //     }


    // $data = readFromFile();
    // $userData = [];
    // foreach ($data as $key => $value) {
    //     if ($key % 6 === 5 && $value === $hashNumber) {
    //         $userData[] = [
    //             'firstName' => $data[$key - 5],
    //             'lastName' => $data[$key - 4],
    //             'email' => $data[$key - 3],
    //             'number' => $data[$key - 2],
    //             'password' => $data[$key - 1],
    //             'confirmPassword' => $data[$key]
    //         ];
    //     }
    // }
    // return $userData;

        // search user by hashed number
    // function searchUser($searchNumber)
    // {
    //     $userData = getUserByHashNumber($searchNumber);
    //     if (empty($userData)) {
    //         echo json_encode([
    //             'status' => false,
    //             'message' => 'No user found!'
    //         ]);
    //         exit();
    //     }
    //     echo json_encode([
    //         'status' => true,
    //         'message' => 'User found!',
    //         'userData' => $userData
    //     ]);
    //     exit();
    // }

}
