<?php
include("db.php");

if(isset($_GET['odid'])){
    $id = $_GET['odid'];

    $sql = "DELETE FROM ORDERS WHERE PRO_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: order.php");
    }

}
?>