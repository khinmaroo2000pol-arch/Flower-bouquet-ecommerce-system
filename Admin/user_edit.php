<?php
include ("nav.php");
include ("db.php");

if(isset($_GET['uid'])){
    $id = $_GET['uid'];

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['pass'];
        $role = 'Admin';

        $sql1 = "UPDATE USER SET USER_NAME='$name' , USER_EMAIL='$email', 
                USER_PHNO = '$phone', USER_PASS = '$password',USER_ROLE = '$role' WHERE USER_ID = $id";
        $res1 = mysqli_query($conn , $sql1);

        if($res1){
            header("Location: user.php");
        }
    }
}
?>
        <div class="main" id="main">
            <div class="container-fluid px-4">
                <h3 class="mt-4">User Lists</h3>
            <?php
                $sql = "SELECT * FROM USER WHERE USER_ID = $id ";
                $res = mysqli_query($conn , $sql);
                $data = mysqli_fetch_array($res);

            ?>

            <form action="" class="p-3 mt-5" method="post">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">User ID</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $data['USER_ID']; ?>" disabled name="uid" class="form-control" >
                    </div>
                </div>    
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $data['USER_NAME'] ;?>" name="name" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">User Email</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $data['USER_EMAIL'] ;?>" name="email" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">User Phone No.</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $data['USER_PHNO'] ;?>" name="phone" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">User Password</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $data['USER_PASS'] ;?>" name="pass" class="form-control" >
                    </div>
                </div>
                
                <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" 
                class="p-1 mt-3 text-white rounded">
            </form>

            </div>
        </div>

        <script src="script1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>