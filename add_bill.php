<?php
include("check_login.php");
include("database_connection.php");
$meterNumber = $_GET["meterNumber"];


$sql = "SELECT * FROM `bill` WHERE meter_number = '$meterNumber'";

$result = mysqli_query($connection, $sql);

$numRows = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {

    $previousReading = $row['previous_meter_reading'];
    $presentReading = $row['present_meter_reading'];
}

$alert = false;
if (isset($_POST['submit'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];

    $sql = "SELECT month, year FROM `bill` WHERE meter_number = '$meterNumber'";
    $result = mysqli_query($connection, $sql);
   
    $duplicateData = false;

    // check if month and year already exits or not
    while ($row = mysqli_fetch_assoc($result)) {

        $monthDatabase = $row['month'];
        $yearDatabase = $row['year'];
        if ($monthDatabase == $month && $yearDatabase == $year) {
            echo '
            <div class="alert alert-danger" role="alert">
                Bill dstails already available. Please try again.
            </div>';

            echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
            }, 2000);
        </script>';
            $duplicateData = true;
            break;
        }
    }
    
    if (!$duplicateData) {
        $units = $_POST['units'];
        $totalAmount = $units * 20;
        if ($numRows == 0) {
            $previousMeterReading = 0;
            $presentMeterReading = $units;
        } else {
            $previousMeterReading = $presentReading;
            $presentMeterReading = $presentReading + $units;
        }


        $sql = "INSERT INTO `bill` (`meter_number`,`month`,`year`,`units`,`total_amount`,`previous_meter_reading`,`present_meter_reading`) VALUES ('$meterNumber','$month','$year','$units','$totalAmount','$previousMeterReading','$presentMeterReading')";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $alert = true;
        } else {
            echo "data cannnot added <br>";
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
            Bill details added successfully
        </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
             
            }, 1000);
        </script>';
    }
    $alert = false;
    ?>

    <div class="container text-white mt-5">
        <h1 class='text-center mb-5'>Add Bill Details</h1>
        <h2 class='text-center mb-5'>Meter Number : <?php echo $meterNumber; ?></h2>

        <form method="POST">

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <input name="month" minlength="3" id="month" maxlength="3" oninput="checkInputs()" type="text" class="form-control" id="month" placeholder="Enter month like Jan,Feb">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input name="year" id="year" minlength="4" maxlength="4" oninput="checkInputs()" type="number" class="form-control" id="year" placeholder="Enter year like 2011,2012,2023">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="mb-3">
                        <label for="units" class="form-label">Units</label>
                        <input name="units" id="units" type="number" oninput="checkInputs()" class="form-control" id="units" placeholder="Enter total Units used in One Month">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="priceOneUnit" class="form-label">Price Of One Unit</label>
                        <input readonly value="20" name="priceOneUnit" type="text" class="form-control" id="priceOneUnit" aria-describedby="emailHelp">
                    </div>
                </div>


            </div>
            <button type="submit" name="submit" id="submitButton" disabled class="btn btn-primary">Add</button>
        </form>
    </div>

    <script>
        function checkInputs() {
          
            let month = document.getElementById('month');
            let year = document.getElementById('year');
            let units = document.getElementById('units');
          

            if(year.value.length>4){
                year.value = year.value.slice(0,4);
            }

            let anyEmpty = month.value === '' || year.value.length!=4 || year.value === '' || units.value === '';
            let submitButton = document.getElementById('submitButton');
            submitButton.disabled = anyEmpty;
        }
    </script>
</body>

</html>