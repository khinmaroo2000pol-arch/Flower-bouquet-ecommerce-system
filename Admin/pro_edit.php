<?php
include ("nav.php");
include ("db.php");

if(isset($_GET["pid"])){
    $id = $_GET['pid'];

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $new_img = $_POST['new_img'];
        $old_img = $_POST['old_img'];

        $cat_id = $_POST['cat'];

        if($new_img != ''){
            $sql2 = "UPDATE PRODUCT SET PRO_NAME = '$name',PRO_PRICE = '$price',PRO_IMAGE = '$new_img',CAT_ID= '$cat_id' WHERE PRO_ID ='$id'";
        }else{
            $sql2 = "UPDATE PRODUCT SET PRO_NAME = '$name',PRO_PRICE = '$price',PRO_IMAGE = '$old_img',CAT_ID= '$cat_id' WHERE PRO_ID ='$id'";
        }
        $res2 = mysqli_query($conn , $sql2);

        if($res2){
            header("Location: product.php");
        }
    }
}
?>
        <div class="main" id="main">
            <div class="container-fluid px-4">
                <h3 class="mt-4">Product Lists</h3>

            <?php 
                $sql1 = "SELECT P.* , C.CAT_NAME
                        FROM PRODUCT AS P
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID =P.CAT_ID WHERE PRO_ID = $id;";
                $res2 = mysqli_query($conn , $sql1);
                $data2 = mysqli_fetch_array($res2);  
            ?>
            <form action="" class="p-3 mt-5" method="post">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Name</label>
                    <div class="col-sm-10">
                    <input type="text" value="<?php echo $data2['PRO_NAME']; ?>" name="name" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="text" name="price" value="<?php echo $data2['PRO_PRICE']; ?>" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                    <input type="file"  name="new_img" class="form-control" >
                    <input type="hidden" name="old_img" value="<?php echo $data2['PRO_IMAGE']; ?>">
                    </div>
                </div>               
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                    <select name="cat" id="" class="form-control">
                        <OPTION value="<?php echo $data2['CAT_ID']; ?>"><?php echo $data2['CAT_NAME']; ?></OPTION>
                        <?php
                            $sql = "SELECT * FROM CATEGORY WHERE CAT_ID = $id";
                            $res = mysqli_query($conn , $sql);
                            while($data = mysqli_fetch_array($res)){
                        ?>
                        <option value="<?php echo $data['CAT_ID']; ?>"><?php echo $data['CAT_NAME']; ?> </option>

                        <?php } ?>                        
                    </select>
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