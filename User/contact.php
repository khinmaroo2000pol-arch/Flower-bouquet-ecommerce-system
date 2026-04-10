<?php
include ("db.php");
include ("head.php");

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO CONTACT (C_NAME , C_EMAIL, C_PHNO, C_MESSAGE) 
            VALUES ('$name','$email','$phone','$message')";
    $res = mysqli_query($conn , $sql);

}
?>

<!-- /* nav section end  */ -->
 <style>

.contact{
    background-color: #ffffff;
    width: 15rem;
    text-align: center;
    padding: 7px;
    margin: auto;
    margin-top: 30px;
}
.div input{
    width: 32rem;
    border-radius: 5px;
    border: 1px solid grey;
}
.div{
    width: 35rem;
}
textarea{
    text-align: left;
    white-space: pre-wrap;
    overflow-wrap: break-word;
}
</style>

<body style="background-color: #FFDCDC;">

    <!-- nav section start -->
   <?php
    include ("nav.php");
   ?>

    <h3 class="contact"><span style="color: #87494A;">Contact</span> Us</h3>
    <form action="" method="post" class="d-flex justify-content-center ">
        <div class="div m-5 p-4 bg-white ">
            <input class="form-control mt-3" type="text" name="name" id="" placeholder="Name" required><br>
            <input class="form-control " type="email" name="email" id="" placeholder="Email" required><br>
            <input class="form-control " type="password" name="phone" id="" placeholder="Phone" required><br>
            <textarea class="form-control" rows="4" name="message" id="" placeholder="Message"></textarea>
            <button class=" my-3 btn btn-primary" type="submit" name="save">Send</button>
        </div>
        <img style="width: 30rem;margin: 30px;" src="./Image/flower1.png" alt="" >
    </form>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>