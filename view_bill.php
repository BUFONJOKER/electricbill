<?php
include('database_connection.php');
$meterNumber = $_GET["meterNumber"];
$name = $_GET['name']
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <title>Electric Bill</title>
</head>

<body class='bg-black'>

    <?php include("navbar.php"); ?>

    <div class="container">
        <h1 class="text-white text-center mt-5 mb-5">Bill Details</h1>
        <h2 class="text-white">Meter Number:
            <?php echo $meterNumber; ?>
        </h2>
        <h2 class="text-white">Customer Name:
            <?php echo $name; ?>
        </h2>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Month</th>
                    <th scope="col">Year</th>
                    <th scope="col">Units</th>
                    <th scope="col">Total Amount</th>

                </tr>
            </thead>

            <tbody>

                <?php
                $sql = "SELECT * FROM `bill` WHERE meter_number = '$meterNumber'";

                $result = mysqli_query($connection, $sql);

                $numberOfMonths = 0;
                $totalBill = 0;

                while ($row = mysqli_fetch_assoc($result)) {

                    $month = $row['month'];
                    $numberOfMonths++;
                    $year = $row['year'];
                    $units = $row['units'];
                    $total_amount = $row['total_amount'];
                    $totalBill += $total_amount;
                    echo '<tr>
                        <th scope="row">' . $month . '</th>
                        <td>' . $year . '</td>
                        <td>' . $units . '</td>
                        <td>' . $total_amount . '</td>
                    </tr>';
                }
                $averageBill = $totalBill / $numberOfMonths;
                

                ?>
            </tbody>
        </table>

        <h2 class="text-white">Average bill = <?php echo $averageBill;?></h2>
                
    </div>
</body>

</html>