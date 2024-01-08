<?php
include("check_login.php");

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


            <?php
            $sql = "SELECT * FROM `customer`";

            $result = mysqli_query($connection, $sql);

            if(mysqli_num_rows($result) > 0){
                echo '
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
                        <th scope="col">Customers</th>
                        <th scope="col">Bills</th>
                    </tr>
                </thead>

                <tbody>';


            



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
                $viewBill = "view_bill.php?meterNumber=" . urlencode($meter) . "&firstName=" . urlencode($firstName) . "&lastName=" . urlencode($lastName);
                $delete = "delete.php?meterNumber=" . urlencode($meter) . "&id=" . urlencode($id);
                $updateCustomer = "update_customer.php?meterNumber=" . urlencode($meter);




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
                
                <a class="btn btn-danger m-1" href=' . $delete . '>Delete</a>
                <a class="btn btn-warning m-1" href=' . $updateCustomer . '>Update</a>
                </td>
                <td>
                <a class="btn btn-primary m-1" href=' . $addBill . '>Add</a>
                <a class="btn btn-success m-1" href=' . $viewBill . '>View</a>
                
                </td>

            </tr>
            
            ';
            }
            }

            else{
                echo '
                    <h2 class="text-danger">No Customers Data found</h2>
                ';
            }

            ?>
            </tbody>
            </table>
        </div>
    </div>
</body>

</html>