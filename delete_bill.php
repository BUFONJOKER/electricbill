<?php
    include("database_connection.php");
    $meterNumber = $_GET['meterNumber'];
    $id = $_GET['id'];

    $sql = "DELETE FROM bill WHERE `meter_number` = $meterNumber";

    $result = mysqli_query($connection, $sql);
    if($result){
        echo '
        <div class="alert alert-danger" role="alert">
            Customer deleted
        </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
                window.location.href = "view_customers.php";
            }, 2000);
        </script>';
    }

?>

<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body class='bg-black'>

    <?php include("navbar.php"); ?>

</body>

</html>