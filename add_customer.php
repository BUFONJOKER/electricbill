<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

include("database_connection.php");
$alert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['customerName'];
    $customerAddress = $_POST['customerAddress'];
    $customerEmail = $_POST['customerEmail'];
    $customerContact = $_POST['customerContact'];

    $meterNumber = substr($customerContact, 1, 6);
    $randomNumber = random_int(10000, 99999) . "";
    $meterNumber = $meterNumber . $randomNumber;

    $sql = "INSERT INTO `customer` (`meter_number`,`name`,`address`,`email`,`contact`) VALUES ('$meterNumber','$customerName','$customerAddress','$customerEmail','$customerContact')";

    $result = mysqli_query($connection, $sql);


    if ($result) {
        $alert = true;
    } else {
        echo "Data could not be added" . "<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Electric Bill</title>
</head>

<body class='bg-black'>

    <?php include("navbar.php");
    if ($alert) {
        echo '
        <div class="alert alert-success" role="alert">
            Customer added successfully
        </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
                window.location.href = "index.php";
            }, 1000);
        </script>';
    }
    $alert=false;
    ?>


    <div class="container text-white mt-5">
        <h1 class='text-center'>Add Customer Details</h1>
        <form method="POST" action="add_customer.php">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Name</label>
                        <input name="customerName" type="text" class="form-control" id="customerName" minlength="5">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Address</label>
                        <input name="customerAddress" type="text" class="form-control" id="customerAddress" minlength="5">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Email address</label>
                        <input name="customerEmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerContact" class="form-label">Contact Number</label>
                        <input name="customerContact" type="text" class="form-control" id="customerContact" minlength="11" maxlength="11">
                    </div>
                </div>
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>


        </form>
    </div>
</body>

</html>