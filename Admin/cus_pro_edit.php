<?php
include ("nav.php");
include ("db.php");

if(isset($_GET["cpid"])){
    $id = $_GET['cpid'];

    if(isset($_POST['save'])){
        $price = $_POST['price'];
        $color = $_POST['color'];
        $cat_id = $_POST['cat'];
        
        $sql2 = "UPDATE CUSTOMIZE_PRODUCT SET CP_PRICE = '$price', C_ID = '$color', CAT_ID= '$cat_id' WHERE CP_ID = '$id'";

        $res2 = mysqli_query($conn , $sql2);

        if($res2){
            header("Location: cus_product.php");
        }
    }
}
?>
        <div class="main" id="main">
            <div class="container-fluid px-4">
                <h3 class="mt-4">Customize Product</h3>

            <?php 
                $sql1 = "SELECT CP.* , C.CAT_NAME, CL.C_COLOR
                        FROM CUSTOMIZE_PRODUCT AS CP
                         LEFT JOIN COLOR AS CL ON CL.C_ID = CP.C_ID
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CP_ID = $id;";
                $res2 = mysqli_query($conn , $sql1);
                $data2 = mysqli_fetch_array($res2);  
            ?>
            <form action="" class="p-3 mt-5" method="post">
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
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Color</label>
                    <div class="col-sm-10">
                        <select name="color" id="" class="form-control">
                        <OPTION value="<?php echo $data2['C_ID']; ?>"><?php echo $data2['C_COLOR']; ?></OPTION>
                        <?php
                            $sql = "SELECT * FROM COLOR";
                            $res = mysqli_query($conn , $sql);
                            while($data = mysqli_fetch_array($res)){
                        ?>
                            <option value="<?php echo $data['C_ID']; ?>"><?php echo $data['C_COLOR']; ?></option>
                        <?php } ?>
                        
                    </select>                    
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="text" name="price" value="<?php echo $data2['CP_PRICE']; ?>" class="form-control" >
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