<?php
include ("db.php");
include ("head.php");


if(isset($_POST['save'])){
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $role = 'User';

    $sql = "INSERT INTO USER (USER_NAME,USER_EMAIL,USER_PHNO,USER_PASS,USER_ROLE) 
            VALUES ('$username','$email','$phone','$password','$role')";
    $res = mysqli_query($conn , $sql);

    if($res){
        header("Location: login.php");
    }
}
?>

<body style="background-color: #FFDCDC;">

    <!-- nav section start -->
    <?php
    include ("nav.php");
    ?>
    <!-- nav section end -->



     <div class="login d-flex justify-content-center m-5 pt-4 mx-5">
        <div class="left text-start w-25" style="margin: 0px 7rem;" >
            <h2>Hello! Register to get started</h2>
            <img src="./Image/flower3.png" alt="" style="width: 24rem;margin-top: 30px;">
        </div>
        <div class="right bg-white text-center" style="width: 30rem;">
            <h3 class="m-5">Sign Up</h3>
            <form action="" method="post" class="mx-5">
                <input class="form-control" type="text" name="username" id="" placeholder="Username" required><br>
                <input class="form-control" type="tel" name="phone" id="" placeholder="Phone No." required><br>
                <input class="form-control" type="email" name="email" id="" placeholder="Email" required><br>
                <input class="form-control" type="password" name="pass" id="" placeholder="Password" required><br>
                <button type="submit" name="save" style="background-color: #87494A;width: 6rem;border: none;" class="text-white p-1">Sign Up</button><br>
                <i class="fa-brands fa-facebook-f fs-5"></i>
                <i class="fa-brands fa-google py-4 fs-5"></i>
            </form>
        </div>
     </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>