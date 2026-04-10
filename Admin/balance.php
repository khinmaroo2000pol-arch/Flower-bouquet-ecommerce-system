<?php
include ("nav.php");
include ("db.php");

if(isset($_POST['save'])){
    $type = $_POST['option_type'];
    $product = $_POST['product'];
    $category = $_POST['category'];
    $color = $_POST['color'];
    $inc_qty = $_POST['inc_qty'];
    date_default_timezone_set("ASIA/YANGON");
    $date = date("Y-m-d H:i:s");

   // 1. HANDLE NULL VALUES CORRECTLY
    // -----------------------------

    // If category not chosen → NULL
    if ($category == "" || $category == null) {
        $category_sql = "NULL";
    } else {
        $category_sql = $category;  // keep integer
    }
    if ($color == "" || $color == null) {
        $color_sql = "NULL";
    } else {
        $color_sql = $color;
    }
    // If product not chosen → NULL
    if ($product == "" || $product == null) {
        $product_sql = "NULL";
    } else {
        $product_sql = $product;    // keep integer
    }
    // -----------------------------
    // 2. FETCH LAST BALANCE ONLY IF PRODUCT IS SELECTED
    // -----------------------------

    $data1 = false;  // default no previous balance

    if ($type == 'product') {

        $sql1 = "SELECT * FROM BALANCE
                 WHERE PRO_ID = $product
                 ORDER BY BAL_ID DESC
                 LIMIT 1";

    } else { // category + color

        $sql1 = "SELECT * FROM BALANCE
                 WHERE CAT_ID = $category
                   AND C_ID = $color
                 ORDER BY BAL_ID DESC
                 LIMIT 1";
    }
        $res1  = mysqli_query($conn, $sql1);
        $data1 = mysqli_fetch_assoc($res1);

    // 3. FINAL BALANCE CALC
    // -----------------------------

    if ($data1 ) {
        $latest_bal = $data1['BALANCE'];
        $total_bal = $latest_bal + $inc_qty;
        $sql2 = "INSERT INTO BALANCE(PRO_ID, BAL_DATE, INCOME_QTY, SALE_QTY, BALANCE, C_ID, CAT_ID)
                VALUES ($product_sql, '$date', $inc_qty, 0, $total_bal, $color_sql, $category_sql)";
    } else {
        $sql2 = "INSERT INTO BALANCE(PRO_ID, BAL_DATE, INCOME_QTY, SALE_QTY, BALANCE, C_ID, CAT_ID)
                VALUES ($product_sql, '$date', $inc_qty, 0, $inc_qty, $color_sql, $category_sql)";
    }
    $res2 = mysqli_query($conn, $sql2);
}
 
?>  

    <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="my-3 ps-3" style="margin-left: 20rem;">Balance Quantity</h3>

            <form action="" method="post">

              <!-- Radio options -->
              <label>
                  <input type="radio" name="option_type" value="category" checked onclick="toggleOption()"> 
                  Choose Category + Color
              </label><br>

              <label>
                  <input type="radio" name="option_type" value="product" onclick="toggleOption()"> 
                  Choose Product
              </label>

              <hr>

              <!-- Option 1: Category + Color -->
              <div id="catBlock">
                  <label>Category :</label>
                  <select name="category" class="form-control w-25">
                      <option value="">Select Category</option>
                      <?php
                          $sql = "SELECT * FROM CATEGORY ";
                          $res = mysqli_query($conn , $sql);
                          while($data = mysqli_fetch_array($res)){
                      ?>
                          <option value="<?php echo $data['CAT_ID']; ?>"><?php echo $data['CAT_NAME']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Color :</label>
                <select name="color" class="form-control w-25">
                  <option value="">Select Color</option>
                  <?php
                      $sql = "SELECT * FROM COLOR";
                      $res = mysqli_query($conn , $sql);
                      while($data = mysqli_fetch_array($res)){
                  ?>
                  <option value="<?php echo $data['C_ID']; ?>"><?php echo $data['C_COLOR']; ?></option>
                  <?php } ?>
                </select>
              </div>

              <!-- Option 2: Product -->
              <div id="productBlock" style="display:none;">
                  <label>Product :</label>
                  <select name="product" class="form-control w-25">
                      <option value="">Select Product</option>
                      <?php
                              $sql = "SELECT * FROM PRODUCT";
                              $res = mysqli_query($conn , $sql);
                              while($data = mysqli_fetch_assoc($res)){
                              ?>
                              <option value="<?php echo $data['PRO_ID']; ?>"><?php echo $data['PRO_NAME']; ?></option>
                      <?php } ?>
                  </select>
              </div>

              <!-- Qty input -->
              <label>Income Qty :</label>
              <input type="number" name="inc_qty" class="form-control w-25" required>

            <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" 
            class="p-1 mt-3 text-white rounded">
          </form>

            <div class="row w-75 my-5">
              <form action="" method="post" class="d-flex">
                <select name="cat" id="" class="form-control w-25 mx-4">
                    <option value="">Search By product</option>
                    <option value="">Rose</option>
                    <option value="">Lily</option>
                    <option value="">Tulip</option>
                </select>
                <input type="submit" name="save" value="Add" style="background-color: #87494A;border: none;width: 4rem;" 
                class="p-1 mt-3 text-white rounded">
              </form>
            </div>

            <table class="table table-bordered" id="datatablesSimple">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Balance ID</th>
                  <th>Product Name</th>
                  <th>Category Name</th>
                  <th> Color</th>
                  <th>Date & Time</th>
                  <th>Income Qty</th>
                  <th>Sale Qty</th>
                  <th>Balance</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql3 = "SELECT B.* , P.PRO_ID , P.PRO_NAME , C.CAT_NAME, CL.C_ID, CL.C_COLOR
                        FROM BALANCE AS B
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = B.CAT_ID
                        LEFT JOIN PRODUCT AS P ON P.PRO_ID = B.PRO_ID
                        LEFT JOIN COLOR AS CL ON CL.C_ID = B.C_ID  ORDER BY B.BAL_ID DESC";
                $res3 = mysqli_query($conn , $sql3);
                $i = 1;
                while($data3 = mysqli_fetch_array($res3)){

                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $data3['BAL_ID']; ?></td>
                  <td><?php echo $data3['PRO_NAME']; ?></td>
                  <td><?php echo $data3['CAT_NAME']; ?></td>
                  <td><?php echo $data3['C_COLOR']; ?></td>
                  <td><?php echo $data3['BAL_DATE']; ?></td>
                  <td><?php echo $data3['INCOME_QTY']; ?> </td>
                  <td><?php echo $data3['SALE_QTY']; ?></td>
                  <td><?php echo $data3['BALANCE']; ?></td>
                  <td><a href="bal_edit.php?bid=<?php echo $data3['BAL_ID']; ?> " type="submit" class="btn btn-outline-success" >
                    Edit</a></td>
                  <td><a href="bal_delete.php?bid=<?php echo $data3['BAL_ID']; ?> " class="btn btn-outline-danger" >Delete</a></td>              
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
  </div>

  <script src="script1.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" 
  integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
    function toggleOption() {
        let type = document.querySelector("input[name='option_type']:checked").value;

        if (type === "category") {
            document.getElementById("catBlock").style.display = "block";
            document.getElementById("productBlock").style.display = "none";
        } else {
            document.getElementById("catBlock").style.display = "none";
            document.getElementById("productBlock").style.display = "block";
        }
    }
    </script>


</body>
</html>
