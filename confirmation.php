<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reve Hotel - Confirmation Page</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/confirmation.css">
</head>
<body>
<?php
session_start();
include('dbFunctions.php');
include('header.php');
?>

<main>
    <section class="confirmationTop">
        <h1>Reservation Confirmation</h1>
        <div class="hotelInformation">
            <h3>Reve Hotel</h3>
            <p>711 5th Ave, New York, NY 10022</p>
            <p>Phone: (212) 868-7388</p>
        </div>
        <div class="hotelImage">
            <a href="https://goo.gl/maps/AycYHoJYQbywqJFM6"><img src='images/hotelFacilitiesPhoto/map.jpg' alt='mapImage'></a>
            <img src='images/lobbyPhoto/hotelImage1.jpg' alt='roomImage'>
        </div>
    </section>
    <section>
        <h3>Room Information</h3>
        <div class="roomInformation">
            <p class="title">Room Type</p>
            <p class="content"><?php echo $_SESSION["roomType"] ?></p>
            <p class="title">Number of Guest(s)</p>
            <p class="content"><?php echo $_SESSION["guestNumber"] ?></p>
            <p class="title">Preference</p>
            <p class="content"><?php echo $_SESSION["smokePreference"] ?></p>
            <p class="title">Breakfast</p>
            <p class="content"><?php echo $_SESSION["breakfast"] , ' breakfast(s)' ?></p>
            <p class="title">Check-in</p>
            <p class="content"><?php echo $_SESSION["checkIn"] ?></p>
            <p class="title">Check-out</p>
            <p class="content"><?php echo $_SESSION["checkOut"] ?></p>
        </div>
        <h3>Guest Information</h3>
        <div class="guestInformation">
            <p class="title">Customer Name</p>
            <p class="content"><?php echo $_SESSION["firstName"] . " " . $_SESSION["lastName"] ?></p>
            <p class="title">Phone</p>
            <p class="content"><?php echo $_SESSION["phone"] ?></p>
            <p class="title">Email</p>
            <p class="content"><?php echo $_SESSION["email"] ?></p>
            <p class="title">Loyalty Card Number</p>
            <p class="content"><?php echo $_SESSION["loyaltyNumber"] ?></p>
            <p class="title">Address</p>
            <p class="content"><?php echo $_SESSION["address1"]. ", ". $_SESSION["address2"].", ". $_SESSION["city"].", " .$_SESSION["state"].",". $_SESSION['zipCode'] ?></p>
        </div>
        <h3>Payment information</h3>
        <div class="paymentInformation">
            <p class="title">1 room(s) per night</p>
            <p class="content">
                <?php
                echo "$". ($_SESSION["roomPrice"]);
                ?>
            <p class="title"> Total Hotel Room Price</p>
            <p class="content">
                <?php
                $dayDiff = (strtotime($_SESSION['checkOut']) - strtotime($_SESSION['checkIn']))/86400;
                $totalRoomPrice = $dayDiff * ($_SESSION["roomPrice"]);
                echo "$". $totalRoomPrice;
                ?></p>
            <p class="title">One Breakfast price</p>
            <p class="content">
                <?php
                $breakfastCharge = 20;
                echo "$", $breakfastCharge
                ?>
            </p>
            <p class="title">Breakfast Total</p>
            <p class="content">
                <?php
                function calculateBreakfast(){
                    $breakfastCharge = 20;
                    echo "$" . $_SESSION['breakfast'] * $breakfastCharge;
                }

                if(empty($_SESSION["loyaltyNumber"])){
                    calculateBreakfast();
                } else {
                    echo "";
                }

                $breakfastTotal = $_SESSION['breakfast'] * $breakfastCharge;
                ?>
            </p>
            <p class="title">Tax</p>
            <p class="content">
                <?php
                $beforeTax = $totalRoomPrice + $breakfastTotal;
                $tax = 0.088 * $beforeTax;
                echo "$" . $tax;
                ?>
            </p>
            <p class="title">Total Price</p>
            <p class="content">
                <?php
                $totalPrice = $totalRoomPrice + $breakfastTotal + $tax;
                echo "$". $totalPrice;
                ?>
            </p>
        </div>
    </section>
</main>

<?php
// insert query results into customer table
initdb($password, $database);

$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$phone = $_SESSION['phone'];
$email = $_SESSION['email'];
$address1 = $_SESSION['address1'];
$address2 = $_SESSION['address2'];
$city = $_SESSION['city'];
$state = $_SESSION['state'];
$zipCode = $_SESSION['zipCode'];
$loyaltyNumber = $_SESSION['loyaltyNumber'];

$query = "INSERT INTO customer (firstName, lastName, phone, email, address1, address2, city, stateCode, zipCode,loyaltyNumber)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insert = $db->prepare($query);
//bind parameters
$insert->bind_param('sssssssssi', $firstName, $lastName, $phone, $email, $address1, $address2, $city, $state, $zipCode, $loyaltyNumber);
if($insert->execute()){
    echo ' ';
    $customerId = mysqli_insert_id($db);
}
else{
    echo 'Error: '.$db->error;
}

// insert query results into reservation table
$checkInDate = $_SESSION['checkIn'];
$checkOutDate = $_SESSION['checkOut'];
$numberOfGuest = $_SESSION['guestNumber'];
$numberOfBreakfast = $_SESSION['breakfast'];
$smokingOption = $_SESSION["smokePreference"];
$roomId = 1;

$query2 = "INSERT INTO reservation (customerId, roomId, checkInDate, checkOutDate, numberOfGuest,
                         numberOfBreakfast, totalBreakfastCharge, numberOfNights, smokingOption, totalPrice)
    VALUES (?,?,?,?,?,?,?,?,?,?)";

$insert = $db->prepare($query2);
//bind parameters
$insert->bind_param('iisssiiisi', $customerId, $roomId, $checkInDate, $checkOutDate, $numberOfGuest,
    $numberOfBreakfast, $breakfastTotal, $dayDiff, $smokingOption, $totalPrice);
if($insert->execute()){
    echo ' ';
    $reservationId = mysqli_insert_id($db);
}
else{
    echo 'Error: '.$db->error;
}
?>

<div class="greeting">
    <p>Your Reservation Number is:
        <?php
        echo $reservationId;
        ?>
    </p>
    <p>Reservation confirmation will be sent to your email within 24 hours.</p>
    <p>Thank you for choosing Reve Hotel, and we look forward to seeing you!</p>
</div>

<?php
include('footer.php');
session_destroy();
?>
</body>
</html>
