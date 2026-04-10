<?php
include ("db.php");

if(isset($_GET['cpid'])){
    $id = $_GET['cpid'];

    $sql = "DELETE FROM CUSTOMIZE_PRODUCT WHERE CP_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: cus_product.php");
    }
}
?>