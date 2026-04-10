<?php
include("nav.php");
include("db.php");

if(isset($_GET['bid'])){
    $id = $_GET['bid'];

    if(isset($_POST['save'])){
        $option = $_POST['option_type'];   // category or product
        $product = $_POST['product'];
        $category = $_POST['category'];
        $color = $_POST['color'];
        $balance = $_POST['balance'];
        $inc_qty = $_POST['inc_qty'];
        $total_bal = $balance + $inc_qty;

        date_default_timezone_set("Asia/Yangon");
        $date = date("Y-m-d H:i:s");

        // ----- NULL FIX -----
        $product_sql = ($product == "" ? "NULL" : $product);
        $category_sql = ($category == "" ? "NULL" : $category);
        $color_sql = ($color == "" ? "NULL" : $color);

        $sql1 = "INSERT INTO BALANCE (PRO_ID, CAT_ID, C_ID, BAL_DATE, INCOME_QTY, SALE_QTY, BALANCE)
                 VALUES ($product_sql, $category_sql, '$color_sql', '$date', $inc_qty, 0, $total_bal)";
        $res1 = mysqli_query($conn , $sql1);

        if($res1){
            header("Location: balance.php");
        }
    }
}
?>
        <div class="main" id="main">
            <div class="container-fluid ps-5 ms-5">
                <h1 class="mt-4">Edit Balance</h1>

                <?php 
                    $sql = "SELECT * FROM BALANCE WHERE BAL_ID = $id";
                    $res = mysqli_query($conn , $sql);
                    $data = mysqli_fetch_array($res);
                ?>

                <form action="" class="p-3 mt-4" method="post">

                    <!-- Radio -->
                    <label><input type="radio" name="option_type" value="product" checked onclick="toggleMode()"> Product</label>
                    <label class="ms-3 mb-4"><input type="radio" name="option_type" value="category" onclick="toggleMode()"> 
                    Category + Color</label>

                    <!-- PRODUCT SECTION -->
                    <div id="productBlock">
                        <label>Product Name</label>
                        <select name="product" class="form-control w-50 ">
                            <option value="">Select Product</option>
                            <?php
                                $psql = "SELECT * FROM PRODUCT";
                                $pres = mysqli_query($conn , $psql);
                                while($p = mysqli_fetch_assoc($pres)){
                                    $sel = ($p['PRO_ID']==$data['PRO_ID']) ? "selected" : "";
                                    echo "<option value='{$p['PRO_ID']}' $sel>{$p['PRO_NAME']}</option>";
                                }
                            ?>
                            
                        </select>
                    </div>

                    <!-- CATEGORY SECTION -->   
                    <div id="catBlock" style="display:none;">
                        <label>Category</label>
                        <select name="category" class="form-control w-50">
                            <option value="">Select Category</option>
                            <?php
                                $csql = "SELECT * FROM CATEGORY";
                                $cres = mysqli_query($conn , $csql);
                                while($c = mysqli_fetch_assoc($cres)){
                                    $sel = ($c['CAT_ID']==$data['CAT_ID']) ? "selected" : "";
                                    echo "<option value='{$c['CAT_ID']}' $sel>{$c['CAT_NAME']}</option>";
                                }
                            ?>
                        </select>

                        <label class="mt-2">Color</label>
                        <select name="color" class="form-control w-50">
                            <option value="">Select Color</option>
                            <?php
                                $sql = "SELECT * FROM COLOR";
                                $res = mysqli_query($conn , $sql);
                                while($cl = mysqli_fetch_array($res)){
                                    $sel = ($cl['C_ID']==$data['C_ID']) ? "selected" : "";
                                    echo "<option value='{$cl['CAT_ID']}' $sel>{$cl['C_COLOR']}</option>";
                                }
                            ?>                           
                        </select>
                    </div>

                    <label class="mt-2">Balance</label>
                    <input type="number" value="<?php echo $data['BALANCE']; ?>" name="balance" class="form-control w-50">

                    <label class="mt-2">Income Qty</label>
                    <input type="number" name="inc_qty" class="form-control w-50">

                    <input type="submit" name="save" value="Update" 
                        style="background-color:#87494A;border:none;width:5rem;" 
                        class="p-1 mt-3 text-white rounded">
                </form>
            </div>
        </div>

        <script>
        function toggleMode(){
            let type = document.querySelector("input[name='option_type']:checked").value;

            document.getElementById("productBlock").style.display = (type=="product") ? "block" : "none";
            document.getElementById("catBlock").style.display     = (type=="category") ? "block" : "none";
        }
        </script>

 <script src="script1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
