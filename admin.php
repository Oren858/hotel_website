<?php
include 'Calendar.php';
$calendar = new Calendar('2021-12-01');
$calendar->add_room('405', '2021-12-08', 4, 'green');
$calendar->add_room('201', '2021-12-10', 4, 'red');
$calendar->add_room('505', '2021-12-20', 2, 'yellow');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Revé Hotel</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/calendar.css">
</head>
<body>
<?php
include('header.php');
?>
<nav class="navtop">
    <div>
        <h1>Admin Page </h1>
    </div>
</nav>
<div class="content home">
    <?= $calendar ?>
</div>
</body>

<div id="outButton"><a href="logout.php">Log Out</a></div>


<?php
include ('footer.php');
?>
</html>



