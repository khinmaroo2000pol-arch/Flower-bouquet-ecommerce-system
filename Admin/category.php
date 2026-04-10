<?php
include ("nav.php");
include ("db.php");

if(isset($_POST['save'])){
    $cat_name = $_POST['cat_name'];

    $sql = "INSERT INTO CATEGORY (CAT_NAME) VALUES ('$cat_name')";
    $res = mysqli_query($conn , $sql);
}
?>

    <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="mt-4 " style="margin-left: 11rem;">Category</h3>

            <form action="" class="p-3 my-5" method="post" style="margin-left: 10rem;width: 60rem;">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="cat_name" class="form-control" >
                    </div>
                </div>
                <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" 
                class="p-1 mt-3 text-white rounded">
            </form>
            
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                </tfoot>
                <tbody>
                    <?php
                        $sql1 ="SELECT * FROM CATEGORY";
                        $res1 = mysqli_query($conn , $sql1);
                        $i = 1;
                        while($data = mysqli_fetch_array($res1)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['CAT_ID']; ?></td>
                        <td><?php echo $data['CAT_NAME']; ?></td>
                        <td><a href="cat_edit.php? cid=<?php echo $data['CAT_ID']; ?>" type="submit" class="btn btn-outline-success">Edit</a></td>
                        <td><a href="cat_delete.php?cid=<?php echo $data['CAT_ID']; ?>" type="submit" class="btn btn-outline-danger">Delete</a></td>
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
