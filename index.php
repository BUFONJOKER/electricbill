<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

include('database_connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<?php include("head.php");?>

<body class='bg-black'>

    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <h1 class="text-white text-center mb-4">Customer Information</h1>
        <div class="table-responsive">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Meter Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Bill</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $sql = "SELECT * FROM `customer`";

                $result = mysqli_query($connection, $sql);

                

                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $meter = $row['meter_number'];
                    $name = $row['name'];
                    $address = $row['address'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $addBill = "add_bill.php?meterNumber=" . $meter;
                    $viewBill = "view_bill.php?meterNumber=" . $meter . "&name=" . $name;
                    $delete = "delete.php?meterNumber=" . $meter . "&id=" . $id;
                    


                
                echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $meter . '</td>
                <td>' . $name . '</td>
                <td>' . $address . '</td>
                <td>' . $email . '</td>
                <td>' . $contact . '</td>
                <td>
                <a class="btn btn-primary" href=' . $addBill . '>Add Bill</a>
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