<?php
include ("db.php");

if(isset($_GET['uid'])){
    $id = $_GET['uid'];

    $sql = "DELETE FROM USER WHERE USER_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: user.php");
    }
}
?>