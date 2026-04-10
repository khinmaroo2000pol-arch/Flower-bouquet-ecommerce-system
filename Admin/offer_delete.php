<?php
include ("db.php");

if(isset($_GET['oid'])){
    $id = $_GET['oid'];

    $sql = "DELETE FROM OFFER WHERE OFFER_ID = $id";
    $res = mysqli_query($conn , $sql);

    if($res){
        header ("Location: offer.php");
    }
}
?>