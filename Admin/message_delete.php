<?php
include ("db.php");

if(isset($_GET['mid'])){
    $id = $_GET['mid'];

    $sql = "DELETE FROM CONTACT WHERE C_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: message.php");
    }
}
?>