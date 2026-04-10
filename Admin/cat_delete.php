<?php
include ("db.php");

if(isset($_GET['cid'])){
    $id = $_GET['cid'];

    $sql = "DELETE FROM CATEGORY WHERE CAT_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: category.php");
    }
}
?>