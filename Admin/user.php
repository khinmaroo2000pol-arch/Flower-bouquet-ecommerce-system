<?php
include ("nav.php");
include ("db.php");

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['pass'];
    $role = 'Admin';

    $sql = "INSERT INTO USER (USER_NAME,USER_EMAIL,USER_PHNO,USER_PASS,USER_ROLE) 
            VALUES ('$name','$email','$phone','$password','$role')";
    $res = mysqli_query($conn , $sql);
}
?>

    <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="mt-5" style="margin-left: 13rem;">User Lists</h3>
            <form action="" class="p-3 my-5" method="post" style="margin-left: 12rem;width: 50rem;">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" name="pass" class="form-control" >
                    </div>
                </div>              
                <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" class="p-1 mt-3 text-white rounded">
            </form>

            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Password</th>
                        <th>Phone</th>
                        <th>Role</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql1 = "SELECT * FROM USER";
                        $res1 = mysqli_query($conn , $sql1);
                        $i=1;
                        while($data1 = mysqli_fetch_array($res1)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data1['USER_ID']; ?></td>
                        <td><?php echo $data1['USER_NAME']; ?></td>
                        <td><?php echo $data1['USER_EMAIL']; ?></td>
                        <td><?php echo $data1['USER_PASS']; ?></td>
                        <td><?php echo $data1['USER_PHNO']; ?></td>
                        <td><?php echo $data1['USER_ROLE']; ?></td>
                        <td><a href="user_edit.php?uid=<?php echo $data1['USER_ID']; ?> " type="submit" class="btn btn-sm btn-outline-success">Edit</a>
                            <a href="user_delete.php? uid=<?php echo $data1['USER_ID']; ?> " type="submit" class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>               
            </table>           
        </div>
  </div>

  <script src="script1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
