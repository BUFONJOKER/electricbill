<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include('database_connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body class='bg-black'>

    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <h1 class="text-white text-center mb-4">Customer Information</h1>
        <div class="table-responsive">
            <table class="table table-dark table-striped w-200">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Meter No.</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">CNIC</th>
                       
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT * FROM `customer`";

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


                        $addBill = "add_bill.php?meterNumber=" . $meter;
                        $viewBill = "view_bill.php?meterNumber=" . $meter . "&firstName=" . $firstName . "&lastName=" . $lastName;
                        $delete = "delete.php?meterNumber=" . $meter . "&id=" . $id;




                        echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $meter . '</td>
                <td>' . $firstName . '</td>
                <td>' . $lastName . '</td>
                <td>' . $cnic . '</td>
                <td>' . $contact . '</td>
                <td>' . $email . '</td>
                <td>' . $address . '</td>
                <td><img src="images/' . $image . '" alt="image" width="50"></td>
                <td>
                <a class="btn btn-primary" href=' . $addBill . '><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
              </svg></a>
                <a class="btn btn-primary" href=' . $viewBill . '>View Bill</a>
                <a class="btn btn-danger" href=' . $delete . '>Delete Customer</a>
                </td>

            </tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>