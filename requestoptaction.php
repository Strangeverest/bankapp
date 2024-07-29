<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userOtp = $_POST["otp"];

    $newFile = 'data.txt';
    $file = fopen("$newFile", "r");
    $data = [];
    while (($line = fgets($file))) {
        $data[] = $line;
    }

    foreach ($data as $key => $line) {
        if ($key == 0 || $key % 8 == 0) {
            if ($userOtp == $data[$key + 7]) {
              echo json_encode([
                'status' => true,
                'message' => 'user validated',
              ]);
            }else{
                echo json_encode([
                    'status' => false,
                    'message' => 'user not validated',
                ]);
            }
        }
    }
}
