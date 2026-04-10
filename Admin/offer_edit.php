<?php
include ("nav.php");
include ("db.php");

if(isset($_GET["oid"])){
    $id = $_GET['oid'];

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $description = $_POST['des'];
        $new_img = $_POST['new_img'];
        $old_img = $_POST['old_img'];
        $off = $_POST['off'];
        $beforeprice = $_POST['bprice'];
        $nowprice = $_POST['nprice'];

        if($new_img != ''){
            $sql2 = "UPDATE OFFER SET O_NAME = '$name', O_DESCRIPTION = '$description', O_IMAGE = '$new_img',  O_OFF= '$off', 
                    O_BPRICE = '$beforeprice', O_NPRICE = '$nowprice' WHERE OFFER_ID = '$id'";
        }else{
            $sql2 = "UPDATE OFFER SET O_NAME = '$name', O_DESCRIPTION = '$description', O_IMAGE = '$old_img',  O_OFF= '$off', 
                    O_BPRICE = '$beforeprice', O_NPRICE = '$nowprice' WHERE OFFER_ID = '$id'";
        }
        $res2 = mysqli_query($conn , $sql2);

        if($res2){
            header("Location: offer.php");
        }
    }
}

?>
        <div class="main" id="main">
            <div class="container-fluid px-4">
                <h3 class="mt-4">Offer Edit</h3>

            <?php 
                $sql1 = "SELECT * FROM OFFER WHERE OFFER_ID = $id;";
                $res2 = mysqli_query($conn , $sql1);
                $data2 = mysqli_fetch_array($res2);  

            ?>
            <form action="" class="p-3 mt-5" method="post">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Name</label>
                    <div class="col-sm-10">
                    <input type="text" value="<?php echo $data2['O_NAME']; ?>" name="name" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <input type="text" name="des" value="<?php echo $data2['O_DESCRIPTION']; ?>" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                    <input type="file"  name="new_img" class="form-control" >
                    <input type="hidden" name="old_img" value="<?php echo $data2['O_IMAGE']; ?>">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">% Off</label>
                    <div class="col-sm-10">
                    <input type="text" name="off" value="<?php echo $data2['O_OFF']; ?>" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Before Price</label>
                    <div class="col-sm-10">
                    <input type="text" name="bprice" value="<?php echo $data2['O_BPRICE']; ?>" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Now Price</label>
                    <div class="col-sm-10">
                    <input type="text" name="nprice" value="<?php echo $data2['O_NPRICE']; ?>" class="form-control" >
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