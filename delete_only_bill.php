<?php
include("database_connection.php");
$meterNumber = $_GET['meterNumber'];
$id = $_GET['id'];
$firstName = $_GET['firstName']; // Fix: Removed the $ sign from variable name
$lastName = $_GET['lastName'];
$sql = "DELETE FROM bill WHERE `id` = $id";

$result = mysqli_query($connection, $sql);
if ($result) {
    echo '
    <div class="alert alert-danger" role="alert">
        Bill deleted successfully
    </div>';

    echo '<script>
        setTimeout(function () {
            document.querySelector(".alert").style.display = "none";
            window.location.href = "view_bill.php?meterNumber=' . $meterNumber . '&firstName=' . urlencode($firstName) . '&lastName=' . urlencode($lastName) . '";
        }, 500);
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