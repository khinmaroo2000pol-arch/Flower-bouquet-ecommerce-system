<?php
include ("nav.php");
include ("db.php");

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $description = $_POST['des'];
    $image = $_POST['img'];
    $off = $_POST['off'];
    $beforeprice = $_POST['bprice'];
    $nowprice = $_POST['nprice'];

    $sql1 = "INSERT INTO OFFER (O_IMAGE,O_NAME,O_DESCRIPTION,O_OFF,O_BPRICE,O_NPRICE) 
            VALUES ('$image','$name','$description','$off','$beforeprice','$nowprice')";
    $res1 = mysqli_query($conn , $sql1);

}
?>

    <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="mt-5" style="margin-left: 13rem;">Special Offer</h3>

            <form action="" class="p-3 my-5" method="post" style="margin-left: 12rem;width: 50rem;">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" >
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <input type="text" name="des" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                    <input type="file" name="img" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">% OFF</label>
                    <div class="col-sm-10">
                        <input type="text" name="off" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Before Price</label>
                    <div class="col-sm-10">
                        <input type="text" name="bprice" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Now Price</label>
                    <div class="col-sm-10">
                        <input type="text" name="nprice" class="form-control" >
                    </div>
                </div>
                
                <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" 
                class="p-1 mt-3 text-white rounded">
            </form>
            <table class="table table-bordered" id="datatablesSimple" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>OFFER ID</th>
                        <th>Image</th>
                        <th>Prouduct Name</th>
                        <th> Description</th>
                        <th>% OFF</th>
                        <th>Before Price</th>
                        <th>Now Price</th>  
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM OFFER";
                    $res = mysqli_query($conn , $sql);
                    $i=1;
                    While($data = mysqli_fetch_array($res)){

                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['OFFER_ID']; ?></td>
                        <td><img src="../Image/<?php echo $data['O_IMAGE']; ?>" width="100px" alt=""></td>                        
                        <td><?php echo $data['O_NAME']; ?></td>
                        <td><?php echo $data['O_DESCRIPTION']; ?></td>
                        <td><?php echo $data['O_OFF']; ?></td>
                        <td><?php echo $data['O_BPRICE']; ?></td>
                        <td><?php echo $data['O_NPRICE']; ?></td>
                        <td><a href="offer_edit.php?oid=<?php echo $data['OFFER_ID']; ?>" type="submit" class="btn btn-outline-success">
                            Edit</a></td>
                        <td><a href="offer_delete.php?oid=<?php echo $data['OFFER_ID']; ?>" type="submit" class="btn btn-outline-danger">
                            Delete</a></td>
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