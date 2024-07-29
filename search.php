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

    <form action="search_action.php" method="post">
        
        <label for="search">search user:</label>
        <input type="text" id="searchUser" name="searchUser"><br>

        <input type="submit" value="Submit">
    </form>

    </form>
</body>

</html>