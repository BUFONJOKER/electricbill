<?php
include('database_connection.php');
$view = False;
$alert = False;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $meterNumber = $_POST["meterNumber"];
    $sql = "SELECT * FROM `customer` WHERE meter_number = '$meterNumber'";

    $result = mysqli_query($connection, $sql);
    $firstName = "";
    $lastName = "";


    while ($row = mysqli_fetch_assoc($result)) {
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $image = $row['image'];
    }
    if ($firstName === "") {
        echo '
        <div class="alert alert-danger" role="alert">
            Customer not found
        </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
             
            }, 1000);
        </script>';
    } else {
        $view = True;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body class='bg-black'>

    <?php include("navbar_customer.php");

    ?>


    <h1 class="text-white text-center mt-5">Check your bill</h1>

    <div class="container">
        <form method="POST">

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="meterNumber" class="form-label text-white">Enter Your Meter Number</label>
                        <input name="meterNumber" minlength="11" maxlength="11" type="text" class="form-control" id="meterNumber" placeholder="Enter Your 11 digit Meter Number" oninput="checkInputs()">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" id="submitButton" disabled>Check</button>
        </form>

        <?php
        if ($view) {

            $sql = "SELECT * FROM `bill` WHERE meter_number = '$meterNumber'";

            $result = mysqli_query($connection, $sql);

            $numberOfMonths = 0;
            $totalBill = 0;

            $sr = 0;


            if (mysqli_num_rows($result) == 0) {
                echo '
                <h2 class="text-danger">Bill not found </h2>';
            } else {

                echo '<h1 class="text-white text-center mt-5 mb-5">Bill Details</h1>';
                echo'<img class="mx-5 mb-3" src="images/' . $image . '" alt="image" width="300" height="200" align="right">';
                echo '<h2 class="text-white">Meter Number:' . $meterNumber . '</h2>';

                echo '<h2 class="text-white">Customer Name: ' . $firstName . ' ' . $lastName . '   </h2>';
            

                echo '
                <div class="table-responsive ">
                <table class="table table-dark table-striped ">
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

                <tbody>';



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

                echo '</tbody> </table></div>';
            }
        }


        ?>

    </div>



    <script>
        function checkInputs() {

            let meterNumber = document.getElementById('meterNumber');
            let anyEmpty = meterNumber.value === '';
            let submitButton = document.getElementById('submitButton');
            submitButton.disabled = anyEmpty;
        }
    </script>
</body>

</html>