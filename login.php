<!DOCTYPE html>
<html lang="en">
<head>
    <title>Revé Hotel</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include('header.php');
?>
<main>
    <h1>Login Page</h1>
    <?php
    //check if user has logged in
    session_start();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $userId=$_POST['userId'];
        $password=$_POST['password'];
        if($userId=='test' and $password=="123"){
            $_SESSION['user']=$userId;
        }
    }
    //if successfully logged in
    if(isset($_SESSION['user'])){
        header ("Location:admin.php");
        echo "</div>";
    }else {
        if (isset($userId)) {
            echo '<p id="invalidEntry">UserId or password not found. Please try again</p>';
        } else {
            echo '<p class="loginText">You are not logged in.</p>';
        }
        //user has not logged in successfully. Either login has failed or haven't tried.
        //Display appropriate message and show form to enter credentials.

        echo "<div id='formBox'>";
        echo '<form id="loginForm" action="login.php" method="post">';
        echo '<p><label for="userId">User ID:</label>';
        echo '<input type="text" name="userId" id="userId" size="30"/></p>';
        echo '<p><label for="password">Password:</label>';
        echo '<input type="password" name="password" id="password" size="30"/></p>';
        echo '<button type="submit" name="login">Login</button>';
        echo '</form>';
        echo "</div>";
    }
    ?>
</main>
<?php
include ('footer.php');
?>


