<?php
include ("nav.php");
include ("db.php");

if(isset($_POST['save'])){
    $price = $_POST['price'];
    $color = $_POST['color'];
    $cat = $_POST['cat'];

    $sql1 = "INSERT INTO CUSTOMIZE_PRODUCT (C_ID,CP_PRICE,CAT_ID)
            VALUES ('$color','$price','$cat')";
    $res1 = mysqli_query($conn , $sql1);
}

?>

    <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="mt-5" style="margin-left: 13rem;">Customize Product</h3>

            <form action="" class="p-3 my-5" method="post" style="margin-left: 12rem;width: 50rem;">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                    <select name="cat" id="" class="form-control">
            
                        <option value="">Choose Category</option>
                        <?php
                            $sql = "SELECT * FROM CATEGORY";
                            $res = mysqli_query($conn , $sql);
                            while($data = mysqli_fetch_array($res)){
                        ?>
                            <option value="<?php echo $data['CAT_ID']; ?>"><?php echo $data['CAT_NAME']; ?></option>
                        <?php } ?>
                        
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Color</label>
                    <div class="col-sm-10">
                        <select name="color" id="" class="form-control">
            
                        <option value="">Choose Color</option>
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
                    <input type="number" name="price" class="form-control" >
                    </div>
                </div>

                <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" 
                class="p-1 mt-3 text-white rounded">
            </form>

            <table class="table table-bordered" id="datatablesSimple" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cus_Product ID</th>
                        <th>Category</th>
                        <th>Color</th>                        
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql2 = "SELECT CP.* , C.CAT_NAME , CL.C_COLOR
                                FROM CUSTOMIZE_PRODUCT AS CP
                                LEFT JOIN COLOR AS CL ON CL.C_ID = CP.C_ID
                                LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID;";
                        $res2 = mysqli_query($conn , $sql2);
                        $i = 1;
                        while($data2 = mysqli_fetch_array($res2)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data2['CP_ID']; ?></td>
                        <td><?php echo $data2['CAT_NAME']; ?></td>
                        <td><?php echo $data2['C_COLOR']; ?></td>                       
                        <td><?php echo $data2['CP_PRICE']; ?>$</td>
                        <td><a href="cus_pro_edit.php? cpid=<?php echo $data2['CP_ID']; ?>" type="submit" class="btn btn-outline-success">Edit</a></td>
                        <td><a href="cus_pro_delete.php? cpid=<?php echo $data2['CP_ID']; ?>" type="submit" class="btn btn-outline-danger">Delete</a></td>
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
