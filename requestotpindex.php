<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="requestoptaction.php" method="post">
    <label for="otp"> enter otp</label>
    <input type="text" placeholder="enter otp" name="otp" id="otp">
    <button type="submit">submit</button>
    </form>
</body>
</html>