<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation - Reve Hotel</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/reservation.css">
</head>
<body>
<?php
include('dbFunctions.php');
include('header.php');
?>

<main id="mainSection">
    <?php
    session_start();
    $firstName = $lastName = $phone = $email = $loyaltyNumber = $address1 = $address2 = $city = $state = $zipCode = $checkIn = $checkOut = $checkDate = $guestNumber = $smokePreference = $roomType = $roomPrice = $guestNumber = $breakfast = "";
    $firstNameErr = $lastNameErr = $phoneErr = $emailErr = $loyaltyNumberErr = $address1Err = $address2Err = $cityErr = $stateErr = $zipCodeErr = $checkInErr = $checkOutErr = $checkDateErr = $smokePreferenceErr = $roomTypeErr = $guestNumberErr = $breakfastErr = $errors = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = false;
        $guestNumber = ($_POST["guestNumber"]);
        $breakfast = ($_POST["breakfast"]);
        if (empty($_POST["firstName"])) {
            $firstNameErr = "First name required";
            $errors = true;
        } else {
            $firstName = ($_POST["firstName"]);
        }
        if (empty($_POST["lastName"])) {
            $lastNameErr = "Last name required";
            $errors = true;
        } else {
            $lastName = ($_POST["lastName"]);
        }
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
            $errors = true;
        } else {
            $phone = ($_POST["phone"]);
            $phoneRegex = "^\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})$^";
            if (!preg_match($phoneRegex, $_POST["phone"])) {
                $phoneErr = "Invalid phone format";
                $errors = true;
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $errors = true;
        } else {
            $email = ($_POST["email"]);
        }
        if (empty($_POST["loyaltyNumber"])) {
            $loyaltyNumber = ($_POST["loyaltyNumber"]);
        } else {
            $loyaltyNumber = ($_POST["loyaltyNumber"]);
        }

        if (empty($_POST["address1"])) {
            $address1Err = "Address is required";
            $errors = true;
        } else {
            $address1 = ($_POST["address1"]);
        }
        if (empty($_POST["address2"])) {
            $address2 = ($_POST["address2"]);
        } else {
            $address2 = ($_POST["address2"]);
        }
        if (empty($_POST["city"])) {
            $cityErr = "City is required";
            $errors = true;
        } else {
            $city = ($_POST["city"]);
        }
        if (empty($_POST["state"])) {
            $stateErr = "State is required";
            $errors = true;
        } else {
            $state = ($_POST["state"]);
        }
        if (empty($_POST["zipCode"])) {
            $zipCodeErr = "Zip Code is required";
            $errors = true;
        } else {
            $zipCode = ($_POST["zipCode"]);
        }

        if (empty($_POST["checkIn"])) {
            $checkInErr = "Check-in date required";
            $errors = true;
        } else {
            $checkIn = ($_POST["checkIn"]);
            if (strtotime($checkIn) < strtotime("now")) {
                $checkInErr = "Date must be not in the past";
                $errors = true;
            }
        }

        if (empty($_POST["checkOut"])) {
            $checkOutErr = "Check-out date required";
            $errors = true;
        } else {
            $checkOut = ($_POST["checkOut"]);
            $checkIn = $_POST['checkIn'];
            if (strtotime($checkIn) > strtotime($checkOut)) {
                $checkOutErr = "Check-out date must be after check-in";
                $errors = true;
            }
        }

        if (empty($_POST["guestNumber"])) {
            $guestNumberErr = "Number is required";
            $errors = true;
        } else {
            $guestNumber = ($_POST["guestNumber"]);
        }
        if (empty($_POST["smokePreference"])) {
            $smokePreferenceErr = "Preference is required";
            $errors = true;
        } else {
            $smokePreference = ($_POST["smokePreference"]);
        }
        if (empty($_POST["roomType"])) {
            $roomTypeErr = "Preference is required";
            $errors = true;
        } else {
            $roomType = ($_POST["roomType"]);
        }
        if (empty($_POST["breakfast"])) {
            $breakfastErr = "Number is required";
            $errors = true;
        } else {
            $breakfast = ($_POST["breakfast"]);
        }
        if (!$errors) {
            header("Location: confirmation.php");
        }

        /* setting variables for session */

        if (isset($_POST["firstName"])) {
            $firstName = $_POST["firstName"];
        }
        $_SESSION["firstName"] = $firstName;

        if (isset($_POST["lastName"])) {
            $lastName = $_POST["lastName"];
        }
        $_SESSION["lastName"] = $lastName;

        if (isset($_POST["phone"])) {
            $phone = $_POST["phone"];
        }
        $_SESSION["phone"] = $phone;

        if (isset($_POST["email"])) {
            $email = $_POST["email"];
        }
        $_SESSION["email"] = $email;

        if (isset($_POST["loyaltyNumber"])) {
            $loyaltyNumber = $_POST["loyaltyNumber"];
        }
        $_SESSION["loyaltyNumber"] = $loyaltyNumber;

        if (isset($_POST["address1"])) {
            $address1 = $_POST["address1"];
        }
        $_SESSION["address1"] = $address1;

        if (isset($_POST["address2"])) {
            $address2 = $_POST["address2"];
        }
        $_SESSION["address2"] = $address2;

        if (isset($_POST["city"])) {
            $city = $_POST["city"];
        }
        $_SESSION["city"] = $city;

        if (isset($_POST["state"])) {
            $state = $_POST["state"];
        }
        $_SESSION["state"] = $state;

        if (isset($_POST["zipCode"])) {
            $zipCode = $_POST["zipCode"];
        }
        $_SESSION["zipCode"] = $zipCode;

        if (isset($_POST["checkIn"])) {
            $checkIn = $_POST["checkIn"];
        }
        $_SESSION["checkIn"] = $checkIn;

        if (isset($_POST["checkOut"])) {
            $checkOut = $_POST["checkOut"];
        }
        $_SESSION["checkOut"] = $checkOut;

        if (isset($_POST["guestNumber"])) {
            $guestNumber = $_POST["guestNumber"];
        }
        $_SESSION["guestNumber"] = $guestNumber;

        if (isset($_POST["smokePreference"])) {
            $smokePreference = $_POST["smokePreference"];
        }
        $_SESSION["smokePreference"] = $smokePreference;

        if (isset($_POST["roomType"])) {
            $roomType = $_POST["roomType"];
        }
        $_SESSION["roomType"] = $roomType;

        if (isset($_POST["roomPrice"])) {
            $roomPrice = $_POST["roomPrice"];
        }
        $_SESSION["roomPrice"] = $roomPrice;

        if (isset($_POST["breakfast"])) {
            $breakfast = $_POST["breakfast"];
        }
        $_SESSION["breakfast"] = $breakfast;

    }

    $smokingArray = array('Smoking', 'Non-Smoking');

    $roomTypeArray = array(
        'Suite King' => '$500', 'Suite Queen' => '$500',
        'Deluxe King' => '$350', 'Deluxe Queen' => '$350',
        'Superior King' => '$250', 'Superior Queen' => '$250');

    $roomPriceArray = array('500','350','250');

    ?>
    <section>
        <form class="formGrid" method="post" action="">
            <h1 class="formTitle">Guest Details</h1>
            <label for="firstName">First name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>"
                   placeholder="First Name">
            <span class="error">* <?php echo $firstNameErr ?></span>
            <label for="lastName">Last name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $lastName ?>" placeholder="Last Name">
            <span class="error">* <?php echo $lastNameErr ?></span>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone ?>"
                   placeholder="Enter 10 digit phone number">
            <span class="error">* <?php echo $phoneErr ?></span>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email ?>" placeholder="Enter Your Email">
            <span class="error">* <?php echo $emailErr ?></span>
            <label for="loyaltyNumber">Loyalty number:</label>
            <input type="number" id="loyaltyNumber" name="loyaltyNumber" value="<?php echo $loyaltyNumber ?>"
                   placeholder="Enter loyalty number if available">
            <span class="error"> <?php echo $loyaltyNumberErr ?></span>
            <h1 class="formTitle">Address</h1>
            <label for="address1">Address 1:</label>
            <input type="text" id="address1" name="address1" value="<?php echo $address1 ?>"
                   placeholder="Enter your address">
            <span class="error">* <?php echo $address1Err ?></span>
            <label for="address2">Address 2:</label>
            <input type="text" id="address2" name="address2" value="<?php echo $address2 ?>"
                   placeholder="Enter your address">
            <span class="error"><?php echo $address1Err ?></span>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo $city ?>" placeholder="Enter city">
            <span class="error">*<?php echo $cityErr ?></span>

            <?php
            if (isset($db) == false){
                initdb($password, $database);
            }

            $stateArray = getState($db);
            ?>
            <label for="state">State:</label>
            <select name="state" id="state">
                <option value="">Select State</option>
                <?php
                foreach($stateArray as $state){
                    foreach($state as $stateCode)
                    echo "<option value='$stateCode'>" . $stateCode . "</option>";
                }
                ?>
            </select>
            <span class="error">*<?php echo $stateErr ?></span>
            <label for="zipCode">Zip code:</label>
            <input type="text" id="zipCode" name="zipCode" value="<?php echo $zipCode ?>"
                   placeholder="Enter five digit zipcode">
            <span class="error">*<?php echo $zipCodeErr ?></span>
            <h1 class="formTitle">Reservation Date</h1>
            <label for="checkInDate">Check-In Date</label>
            <input type="date" id="checkInDate" name="checkIn" value="<?php echo $checkIn ?>">
            <span class="error">*<?php echo $checkInErr ?></span>
            <label for="checkOutDate">Check Out Date:</label>
            <input type="date" id="checkOutDate" name="checkOut" value="<?php echo $checkOut ?>">
            <span class="error">*<?php echo $checkOutErr ?></span>
            <h1 class="formTitle">Number of Guest</h1>
            <label for="guestNumber">Number of guest(s):</label>
            <input type="number" id="guestNumber" name="guestNumber" value="<?php echo $guestNumber ?>" min="1"
                   placeholder="Enter number of guests">
            <span class="error">*<?php echo $guestNumberErr ?></span>

            <h1 class="formTitle">Preferences</h1>
            <label for="smokePreference">Smoking preferences:</label>
            <select name="smokePreference" id="smokePreference">
                <option value="">Select Smoking Preferences</option>
                <?php
                foreach ($smokingArray as $key => $option) {
                    echo "<option value='$option'>" . $option . "</option>";
                }
                ?>
            </select>
            <span class="error">* <?php echo $smokePreferenceErr ?></span>

            <label for="roomType">Room Type:</label>
            <select name="roomType" id="roomType">
                <option value="">Select Room Type</option>
                <?php
                foreach ($roomTypeArray as $type => $price) {
                        echo "<option value='$type'>" . $type . " " . $price . "</option>";
                }
                ?>
            </select>
            <span class="error">* <?php echo $roomTypeErr ?></span>
            <label for="roomPrice">Room Price:</label>
            <select name="roomPrice" id="roomPrice">
                <option value="">Select Room Price</option>
                <?php
                foreach ($roomPriceArray as $roomPrice) {
                    echo "<option value='$roomPrice'>".'$' . " " . $roomPrice . "</option>";
                }
                ?>
            </select>
            <span class="error">* <?php echo $roomTypeErr ?></span>
            <label for="breakfastOption">Breakfast Option:</label>
            <select name="breakfastOption" id="breakfastOption">
                <option value="">Select Breakfast Preferences</option>
                <option value="yes">Yes</option>
                <option value="No">No</option>
            </select>
            <span class="error">* <?php echo $breakfastErr ?></span>
            <label for="breakfast">Breakfast Coupon:</label>
            <input type="number" id="breakfast" name="breakfast" value="<?php echo $breakfast?>" min="0"
                   placeholder="Enter Number of Breakfast Coupon Required">
            <span class="error">*<?php echo $breakfastErr?></span>
            <label for="submit"><a href=confirmation.php></a></label>
            <input type="submit" id="submit" name="submit" value="Reserve Now">
        </form>
    </section>
</main>

<?php
include('footer.php');
?>
</body>
</html>