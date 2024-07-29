<?php
session_start();
header("Access-Control-Allow-Origin: * ");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginMail          = $_POST['loginMail'];
    $loginPassword          = $_POST['loginPassword'];
    $newFile = 'data.txt';
    $file = fopen("$newFile", "r");
    $data = [];
    while (($line = fgets($file))) {
        $data[] = $line;
    }
    // var_dump($data);
    // return;
    
    $userData = null;
    foreach ($data as $key => $line) {
        if ($key == 0 || $key % 8 == 0) {
            if (trim($data[$key + 2]) == trim($loginMail) && trim($data[$key + 4]) == trim($loginPassword) && trim($data[$key + 5]) == trim($loginPassword)) {
                
                $userData = [
                    'status' => true,
                    'message' => 'Login successfull!',
                    'token' => trim($data[$key + 6]),
                    // 'firstName' => trim($data[$key]),
                    // 'lastName' => trim($data[$key + 1]),
                    // 'email' => trim($data[$key + 2]),
                ];
            }
            if (empty($loginMail) || empty($loginPassword)) {
                echo json_encode(['status' => false, 'message' => 'fill in all fields ']);
            } elseif ($loginMail !=  trim($data[$key + 2]) || $loginPassword !=  trim($data[$key + 4]) && $loginPassword !=  trim($data[$key + 5])) {
                echo json_encode(['status' => false, 'message' => 'Email OR Password is incorrect']);
            }
        }
    }
    fclose($file);
    if ($userData != null) {
        // generates and writes new otp to file
        echo json_encode($userData);
    
        return header("location:requestotpindex.php");
        exit;
    } else {
        echo json_encode(['status' => false, 'message' => 'user not found']);
    }
    // var_dump($userData ?? "user not found");
    // echo json_encode(['status' => false,'message' => $userData]);

}
