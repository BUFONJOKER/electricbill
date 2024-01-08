<?php
include("check_login.php");
    include("database_connection.php");
   

    $meterNumber = $_GET['meterNumber'];
    $id = $_GET['id'];




    $sql = "DELETE FROM customer WHERE `meter_number` = $meterNumber";
    $result = mysqli_query($connection, $sql);
    

?>


