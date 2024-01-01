<?php
    include("database_connection.php");
    if($connection){
        echo "connection successful <br>";
    }

    $meterNumber = $_GET['meterNumber'];
    $id = $_GET['id'];

    echo $meterNumber .'<br>';
    echo $id .'<br>';


    $sql = "DELETE FROM customer WHERE `meter_number` = $meterNumber";
    $result = mysqli_query($connection, $sql);
    if($result){
        echo "delete from customer table <br>";
    } 

?>


