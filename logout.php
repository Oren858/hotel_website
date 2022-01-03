<!DOCTYPE html>
<html lang="en">
<head>
    <title>Revé Hotel</title>
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include('header.php');
?>
<main>
    <h1>Logout Page</h1>
    <?php
    session_start();
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        echo "<p>You have been logged out.</p>";
        session_destroy();
    }else{
        echo '<p>You were not logged in, and so have not been logged out.</p>';
    }
    echo '<p><a href="login.php">Back to Login Page</a></p>';
    echo "</main";

    ?>
</main>

</body>
</html>



