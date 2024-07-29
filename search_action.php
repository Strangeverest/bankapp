<?php

session_start();
header("Access-Control-Allow-Origin: * ");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $findUser          = $_POST['findUser'];
   


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
        if ($key == 0 ||$key % 8 == 0) {
            if (trim($data[$key + 6]) == trim($findUser)) {
                $userData = [
                    'status' => true,
                    'message' => 'User found!',
                    'firstName' =>trim( $data[$key]),
                    'lastName' => trim($data[$key + 1]),
                    'email' => trim($data[$key + 2]),
                ];
            }
        }
    }
    if($userData != null){
        echo json_encode($userData) ;
        
                exit;
    }else{
            echo json_encode(['status' => false,'message' => 'User not found!']);
        }
    // var_dump($userData ?? "user not found");
    // echo json_encode(['status' => false,'message' => $userData]);
    fclose($file);




    // if($findUser == $data[$key]){
    //     echo json_encode([
    //         'status' => true,
    //         'message' => 'User found!',
    //         'firstName' => $data[$key - 6],
    //         'lastName' => $data[$key - 5],
    //         'email' => $data[$key - 4],         
    //     ]) ;

    //     exit;
    // }else{
    //     echo json_encode(['status' => false,'message' => 'User not found!']);
    // }



    // // check if user exists in data.txt file
    // foreach ($data as $key => $value) {
    //     if ($value == $findUser) {
    //         $firstName = $data[0];
    //         $lastName  = $data[1];
    //         $email     = $data[2];
    //         echo json_encode([
    //             'status' => true,
    //             'message' => 'user found!',
    //             'userFirstName' =>  $firstName,
    //             'userLastName' => $lastName,
    //             'userEmail' => $email,
    //         ]);
    //         exit();
    //     }
    // }

    // if (in_array($hashedNumber, $data)) {
    //     echo json_encode([
    //         'status' => true,
    //         'message' => 'user found!',
    //         'userDetails' => "<pre>  $firstName,$lastName,$email</pre>"

    //     ]);
    //     exit();
    // } else {
    //     echo json_encode([
    //         'status' => false,
    //         'message' => 'user not found!'
    //     ]);
    //     exit();
    // }
}
