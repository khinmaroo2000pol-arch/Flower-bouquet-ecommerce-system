<?php

include ("nav.php");
include ("db.php");

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $cat = $_POST['cat'];

    $sql1 = "INSERT INTO PRODUCT (PRO_NAME,PRO_PRICE,PRO_IMAGE,CAT_ID)
            VALUES ('$name','$price','$img','$cat')";
    $res1 = mysqli_query($conn , $sql1);
}
?>

    <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="mt-5" style="margin-left: 13rem;">Product</h3>

            <form action="" class="p-3 my-5" method="post" style="margin-left: 12rem;width: 50rem;">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" >
                    </div>
                </div>                
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="text" name="price" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                    <input type="file" name="img" class="form-control" >
                    </div>
                </div>
                
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

                <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" 
                class="p-1 mt-3 text-white rounded">
            </form>

            <table class="table table-bordered" id="datatablesSimple" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product ID</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql2 = "SELECT P.* , C.CAT_NAME
                                FROM PRODUCT AS P
                                LEFT JOIN CATEGORY AS C ON C.CAT_ID =P.CAT_ID;";
                        $res2 = mysqli_query($conn , $sql2);
                        $i = 1;
                        while($data2 = mysqli_fetch_array($res2)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data2['PRO_ID']; ?></td>
                        <td><?php echo $data2['CAT_NAME']; ?></td>
                        <td><?php echo $data2['PRO_NAME']; ?></td>                       
                        <td><?php echo $data2['PRO_PRICE']; ?>$</td>
                        <td><img src="../Image/<?php echo $data2['PRO_IMAGE']; ?>" width="100px" alt=""></td>
                        <td><a href="pro_edit.php?pid=<?php echo $data2['PRO_ID']; ?>" type="submit" class="btn btn-outline-success">Edit</a></td>
                        <td><a href="pro_delete.php?pid=<?php echo $data2['PRO_ID']; ?>" type="submit" class="btn btn-outline-danger">Delete</a></td>
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
