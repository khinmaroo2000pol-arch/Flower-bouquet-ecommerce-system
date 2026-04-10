<?php

include ("db.php");
include ("head.php");

if(isset($_POST['save'])){
    $username = $_POST['username'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM USER WHERE USER_NAME = '$username' and USER_PASS='$password'";
    $res = mysqli_query($conn , $sql);
    if(mysqli_num_rows($res)>0){
        $data = mysqli_fetch_assoc($res);

        $_SESSION['uid']  = $data['USER_ID'];
        $_SESSION['role'] = $data['USER_ROLE'];
        $_SESSION['login'] = true;

        if($data['USER_ROLE'] === 'Admin'){
            header("Location: Admin/dashboard.php");
        }else{
            header("Location: homepage.php");
        }
        exit();
        
    }else{
            echo ("<script> alert('Incorrect username or password') </script>");
        }
}
?>
<style>
    .signup:hover{
        font-weight: bold;
        font-size: 18px;
    }
</style>

<body style="background-color: #FFDCDC;">

    <!-- nav section start -->
    <?php
    include ("nav.php");
    ?>
    <!-- nav section end -->

     <div class="login d-flex justify-content-center m-5 pt-4 mx-5">
        <div class="left text-center w-25" style="margin: 0px 7rem;" >
            <h2>WELCOME BACK!</h2>
            <img src="./Image/flower2.png" alt="" style="width: 24rem;">
        </div>
        <div class="right bg-white text-center" style="width: 30rem;">
            <h3 class="m-5">Login Account</h3>
            <form action="" method="post" class="mx-5">
                <input class="form-control" type="text" name="username" id="" placeholder="Username" required><br>
                <input class="form-control" type="password" name="pass" id="" placeholder="Password" required><br>
                <button type="submit" name="save" style="background-color: #87494A;width: 5rem;border: none;" class="text-white p-1  mt-3">Login</button><br>
                <p class="text-Center py-4 ">If you don't have Account
                <a class="signup text-decoration-none " style="color: #85181aff;" href="signup.php"> Register Here...</a></p>
            </form>
        </div>
     </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>