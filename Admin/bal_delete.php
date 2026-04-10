<?php
include("db.php");

if(isset($_GET['bid'])){
    $id = $_GET['bid'];

    $sql = "DELETE FROM BALANCE WHERE BAL_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: balance.php");
    }
}
?>