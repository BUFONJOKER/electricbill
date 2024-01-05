<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$alert = false;
include("database_connection.php");

$meterNumber = $_GET['meterNumber'];




$sql = "SELECT * FROM `customer` WHERE meter_number = $meterNumber";

$result = mysqli_query($connection, $sql);



while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $meter = $row['meter_number'];
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $cnic = $row['cnic'];
    $contact = $row['contact'];
    $email = $row['email'];
    $address = $row['address'];
    $image = $row['image'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $customerFirstName = $_POST['customerFirstName'];
    $customerLastName = $_POST['customerLastName'];
    $customerContact = $_POST['customerContact'];
    $customerEmail = $_POST['customerEmail'];
    $customerAddress = $_POST['customerAddress'];

    $imageError = $_FILES['image']['error'];


    if ($imageError != 4) {
        $imageName = strtolower($customerFirstName) . $_FILES['image']['name'];      // Get the original filename
        $tmp_name = $_FILES['image']['tmp_name'];  // Get the temporary filename on the server

        move_uploaded_file($_FILES['image']['tmp_name'], "images/$imageName");


        $sql = "UPDATE `customer` SET
        `first_name` = '$customerFirstName',
        `last_name` = '$customerLastName',
        `contact` = '$customerContact',
        `email` = '$customerEmail',
        `address` = '$customerAddress',
        `image` = '$imageName'
        WHERE `meter_number` = '$meterNumber'";
        $result = mysqli_query($connection, $sql);


        if ($result) {
            $alert = true;
        } else {
            echo "Data could not be added" . "<br>";
        }
    }
    // Move the uploaded file to the "images" directory with the specified filename

    else {
        $sql = "UPDATE `customer` SET
        `first_name` = '$customerFirstName',
        `last_name` = '$customerLastName',
        `contact` = '$customerContact',
        `email` = '$customerEmail',
        `address` = '$customerAddress'
        WHERE `meter_number` = '$meterNumber'";

        $result = mysqli_query($connection, $sql);

        if ($result) {
            $alert = true;
        } else {
            echo "Data could not be added" . "<br>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body class='bg-black'>

    <?php include("navbar.php");
    if ($alert) {
        echo '
        <div class="alert alert-primary" role="alert">
            Customer Updated successfully
        </div>';

        echo '<script>
        setTimeout(function () {
            document.querySelector(".alert").style.display = "none";
            window.location.href = "view_customers.php";
        }, 2000);
        
        </script>';
    }
    $alert = false;
    ?>


    <div class="container text-white mt-5">
        <h1 class='text-center'>Update Customer Details</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerFirstName" class="form-label">First Name</label>
                        <input name="customerFirstName" value="<?php echo $firstName ?>" type="text" class="form-control" id="customerFirstName" minlength="4">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerLastName" class="form-label">Last Name</label>
                        <input name="customerLastName" value="<?php echo $lastName ?>" type="text" class="form-control" id="customerLastName" minlength="4">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerContact" class="form-label">Contact Number</label>
                        <input name="customerContact" value="<?php echo $contact ?>" type="text" class="form-control" id="customerContact" minlength="11" maxlength="11">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Email address</label>
                        <input name="customerEmail" value="<?php echo $email ?>" type="email" class="form-control" id="customerEmail" aria-describedby="emailHelp">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Address</label>
                        <input name="customerAddress" value="<?php echo $address ?>" type="text" class="form-control" id="customerAddress" minlength="5">
                    </div>



                </div>



            </div>

            <div class="row">
                <div class="col-6">

                    <div class="mb-3">
                        <label for="oldImage" class="form-label">Current Image Path</label>
                        <input name="oldImage" readonly='true' value="<?php echo $image ?>" type="text" class="form-control" id="customerAddress" minlength="5">
                    </div>

                </div>

                <div class="col-6">

                    <div class="mb-3">
                        <label for="image" class="form-label">Choose to update Image</label>
                        <input name="image" class="form-control" type="file" id="image">
                    </div>

                </div>


            </div>

            <button type="submit" id="submitButton" class="btn btn-primary">Update</button>


        </form>
    </div>



</body>

</html>