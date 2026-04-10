<?php
include ("nav.php");
include ("db.php");

if(isset($_GET['cid'])){
    $id = $_GET['cid'];
}

if(isset($_POST['save'])){
    $cat_name = $_POST['cat_name'];

    $sql1 = "UPDATE CATEGORY SET CAT_NAME = '$cat_name' WHERE CAT_ID = $id";
    $res1 = mysqli_query($conn , $sql1);

    if($res1){
        header("Location: category.php");
    }
}
?>

     <div class="main" id="main">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Category Lists</h1>
            
            <?php
                $sql = "SELECT * FROM CATEGORY WHERE CAT_ID = $id";
                $res = mysqli_query($conn , $sql);
                $data = mysqli_fetch_array($res);
            ?>
            <form action="" class="p-3 mt-5" method="post">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Category ID</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="<?php echo $data['CAT_ID']; ?>" name="cat_id" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                    <input type="text" value="<?php echo $data['CAT_NAME']; ?>" name="cat_name" class="form-control" >
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