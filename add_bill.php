<?php
include("database_connection.php");
$meterNumber = $_GET["meterNumber"];
$alert = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $units = $_POST['units'];
    $totalAmount = $units * 20;

   $sql = "INSERT INTO `bill` (`meter_number`,`month`,`year`,`units`,`total_amount`) VALUES ('$meterNumber','$month','$year','$units','$totalAmount')";
   $result = mysqli_query($connection,$sql);
   if($result){
    $alert = true;
   }
   else{
    echo "data cannnot added <br>";
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
            Bill details added successfully
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
        <h1 class='text-center mb-5'>Add Bill Details</h1>
        <h2 class='text-center mb-5'>Meter Number : <?php echo $meterNumber; ?></h2>

        <form method="POST">

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <input name="month" minlength="3" maxlength="3" type="text" class="form-control" id="month" placeholder="Enter month like Jan,Feb">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input name="year" minlength="4" maxlength="4" type="text" class="form-control" id="year" placeholder="Enter year like 2011,2012,2023">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="mb-3">
                        <label for="units" class="form-label">Units</label>
                        <input name="units" type="text" class="form-control" id="units" placeholder="Enter total Units used in One Month">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="priceOneUnit" class="form-label">Price Of One Unit</label>
                        <input readonly value="20" name="priceOneUnit" type="email" class="form-control" id="priceOneUnit" aria-describedby="emailHelp">
                    </div>
                </div>


            </div>





            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>