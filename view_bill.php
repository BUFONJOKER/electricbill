<?php
include('database_connection.php');
$meterNumber = $_GET["meterNumber"];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body class='bg-black'>

    <?php include("navbar.php"); ?>

    <div class="container">
        <h1 class="text-white text-center mt-5 mb-5">Bill Details</h1>
        <h2 class="text-white">Meter Number:
            <?php echo $meterNumber; ?>
        </h2>
        <h2 class="text-white">Customer Name:
            <?php echo $firstName . ' ' . $lastName; ?>
        </h2>
        <div class="table-responsive">

            <table class="table table-dark table-striped">
                <thead>
                    <tr>

                        <th scope="col">Sr.</th>
                        <th scope="col">Month</th>
                        <th scope="col">Year</th>
                        <th scope="col">Units</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Previous Meter Reading</th>
                        <th scope="col">Present Meter Reading</th>

                    </tr>
                </thead>

                <tbody>
                    <?php

                    $sql = "SELECT * FROM `bill` WHERE meter_number = '$meterNumber'";

                    $result = mysqli_query($connection, $sql);

                    $numberOfMonths = 0;
                    $totalBill = 0;

                    $sr = 0;
                    while ($row = mysqli_fetch_assoc($result)) {

                        $month = $row['month'];
                        $numberOfMonths++;
                        $year = $row['year'];
                        $units = $row['units'];
                        $previousMeterReading = $row['previous_meter_reading'];
                        $presentMeterReading = $row['present_meter_reading'];
                        $total_amount = $row['total_amount'];
                        $totalBill += $total_amount;
                        $sr++;
                        echo '<tr>
                        <th scope="row">' . $sr . '</th>
                        <td>' . $month . '</td>
                        <td>' . $year . '</td>
                        <td>' . $units . '</td>
                        <td>' . $total_amount . '</td>
                        <td>' . $previousMeterReading . '</td>
                        <td>' . $presentMeterReading . '</td>
                    </tr>';
                    }
                    if ($numberOfMonths > 0) {
                        $averageBill = $totalBill / $numberOfMonths;
                        echo '
                    <tfoot>
                    <td colspan="7"><h2>Average Bill = ' . $averageBill . ' </h2></td>
                </tfoot>
                    ';
                    }


                    ?>
                </tbody>



            </table>
        </div>



    </div>
</body>

</html>