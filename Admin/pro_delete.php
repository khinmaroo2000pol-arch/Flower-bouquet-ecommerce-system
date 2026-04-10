<?php
include("db.php");

if(isset($_GET['pid'])){
    $id = $_GET['pid'];

    $sql = "DELETE FROM PRODUCT WHERE PRO_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: product.php");
    }

}
?>