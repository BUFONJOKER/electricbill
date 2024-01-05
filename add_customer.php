<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$alert = false;
include("database_connection.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerCnic = $_POST['customerCnic'];

    $sql = "SELECT * FROM `customer`";

    $result = mysqli_query($connection, $sql);
    $cnic = "";
    $duplicateData = false;
    while ($row = mysqli_fetch_assoc($result)) {
        $cnic = $row['cnic'];
        if ($cnic == $customerCnic) {
            echo '
                <div class="alert alert-danger" role="alert">
                    Customer data already available. Please try again.
                </div>';

            echo '<script>
                setTimeout(function () {
                    document.querySelector(".alert").style.display = "none";
                }, 2000);
            </script>';

            $duplicateData = true; // Set the flag to true if there is a duplicate
            break;
        } else {
            $duplicateData = false;
        }
    }


    if ($duplicateData == false) {
        $customerFirstName = $_POST['customerFirstName'];
        $customerLastName = $_POST['customerLastName'];
        $customerCnic = $_POST['customerCnic'];

        $customerContact = $_POST['customerContact'];
        $customerEmail = $_POST['customerEmail'];
        $customerAddress = $_POST['customerAddress'];

        $meterNumber = substr($customerContact, 1, 6);
        $randomNumber = random_int(10000, 99999) . "";
        $meterNumber = $meterNumber . $randomNumber;



        $imageName = strtolower($customerFirstName) . $_FILES['image']['name'];      // Get the original filename
        $tmp_name = $_FILES['image']['tmp_name'];  // Get the temporary filename on the server

        move_uploaded_file($_FILES['image']['tmp_name'], "images/$imageName");
        // Move the uploaded file to the "images" directory with the specified filename


        $sql = "INSERT INTO `customer` (`meter_number`,`first_name`,`last_name`,`cnic`,`contact`,`email`,`address`,`image`) VALUES ('$meterNumber','$customerFirstName','$customerLastName','$customerCnic','$customerContact','$customerEmail','$customerAddress','$imageName')";

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
        <div class="alert alert-success" role="alert">
            Customer added successfully
        </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
                window.location.href = "view_customers.php";
            }, 1000);
        </script>';
    }
    $alert = false;
    ?>


    <div class="container text-white mt-5">
        <h1 class='text-center'>Add Customer Details</h1>
        <form method="POST" action="add_customer.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerFirstName" class="form-label">First Name</label>
                        <input name="customerFirstName" type="text" class="form-control" id="customerFirstName" minlength="4" oninput="checkInputs()" placeholder="Enter First Name having more than 5 characters">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerLastName" class="form-label">Last Name</label>
                        <input name="customerLastName" type="text" class="form-control" id="customerLastName" minlength="4" oninput="checkInputs()" placeholder="Enter Last Name having more than 5 characters">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerCnic" class="form-label">CNIC</label>
                        <input name="customerCnic" type="text" class="form-control" id="customerCnic" minlength="13" maxlength="13" oninput="checkInputs()" placeholder="Enter 13 digits CNIC">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerContact" class="form-label">Contact Number</label>
                        <input name="customerContact" type="text" class="form-control" id="customerContact" minlength="11" maxlength="11" oninput="checkInputs()" placeholder="Enter 11 digits Contact Number">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Email address</label>
                        <input name="customerEmail" type="email" class="form-control" id="customerEmail" aria-describedby="emailHelp" oninput="checkInputs()" placeholder="Enter Email Address like example@example.com">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Address</label>
                        <input name="customerAddress" type="text" class="form-control" id="customerAddress" minlength="5" oninput="checkInputs()" placeholder="Enter Address having more than 5 characters">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Choose Customer Image</label>
                    <input name="image" class="form-control" type="file" id="image" oninput="checkInputs()">
                </div>

            </div>

            <button type="submit" id="submitButton" class="btn btn-primary" disabled>Add</button>


        </form>
    </div>


    <script>
        function checkInputs() {
            let customerFirstName = document.getElementById('customerFirstName');
            let customerLastName = document.getElementById('customerLastName');
            let customerCnic = document.getElementById('customerCnic');
            let customerContact = document.getElementById('customerContact');
            let customerEmail = document.getElementById('customerEmail');
            let customerAddress = document.getElementById('customerAddress');
            let image = document.getElementById('image');



            console.log(image.value);

            let anyEmpty = customerFirstName.value === "" || customerLastName.value === "" || customerCnic.value === "" || customerContact.value === "" || customerEmail.value === "" || customerAddress.value === "" || image.value === "";

            let submitButton = document.getElementById('submitButton');
            submitButton.disabled = anyEmpty;
        };
    </script>
</body>

</html>