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
    <?php
    if(isset($_SESSION['error']))
    {
        echo "<p>". $_SESSION['error']. "</p>";
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success']))
    {
        echo "<p>". $_SESSION['success']. "</p>";
        unset($_SESSION['success']);
    }
    ?>

    <form action="sign_up.php" method="post">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstName" name="firstName"><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName"><br>

        <label for="number">Phone Number:</label>
        <input type="number" id="number" name="number"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>
        
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword"><br>

        <input type="submit" value="Submit">
    </form>

    </form>
</body>

</html>