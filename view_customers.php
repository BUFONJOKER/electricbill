<?php
include('database_connection.php');
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

    <?php include("navbar.php"); ?>

    <table class="table">
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

            $number = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $meter = $row['meter_number'];
                $name = $row['name'];
                $address = $row['address'];
                $email = $row['email'];
                $contact = $row['contact'];
                $link = "add_bill.php?meterNumber=" . $meter;
            }
            echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $meter . '</td>
                <td>' . $name . '</td>
                <td>' . $address . '</td>
                <td>' . $email . '</td>
                <td>' . $contact . '</td>
                <td><a class="btn btn-outline-dark" href=' . $link . '>Add Bill</a>
                <a class="btn btn-outline-dark" href=' . $link . '>Add Bill</a>
                </td>
                

            </tr>';

            ?>
        </tbody>
    </table>
</body>

</html>