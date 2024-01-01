<?php
    include("database_connection.php");
    if($connection){
        echo "connection successful <br>";
    }

    $meterNumber = $_GET['meterNumber'];
    $id = $_GET['id'];

    echo $meterNumber .'<br>';
    echo $id .'<br>';

    $sql = "DELETE FROM bill WHERE `meter_number` = $meterNumber";

    $result = mysqli_query($connection, $sql);
    if($result){
        echo "delete from bill table <br>";
    }

?>