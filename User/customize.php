<?php

include ("head.php");
include ("db.php");

if(!isset($_SESSION['uid'])){
    header ("Location: login.php");
    exit();
}else if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
}

if(isset($_POST['save'])){
    $total = $_POST['total'];
    $deli_date = $_POST['deli_date'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    date_default_timezone_set("Asia/Yangon");
    $date = date("Y-m-d H:i:s");

    $sql6 = "INSERT INTO ORDERS(USER_ID, ORDER_DATE , TOTAL_AMOUNT,DELIVERY_DATE,ORDER_MESSAGE,ADDRESS) 
            VALUES ('$uid','$date','$total','$deli_date','$message','$address')";
    $res6 = mysqli_query($conn , $sql6);

    $order_id = mysqli_insert_id($conn);
    $cat_id = $_POST['cat_id'];
    $c_id = $_POST['c_id'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    

    for($i=0 ; $i<count($cat_id); $i++ ){

        if(empty($qty[$i]) || $qty[$i] == 0){
            continue;   // Skip this item (Do NOTHING)
        }

        $amount = $price[$i]*$qty[$i];

        $sql1 = "INSERT INTO ORDER_CUSTOMIZE (ORDER_ID,C_ID,CAT_ID,QTY,TOTAL_AMOUNT) VALUES ('$order_id','$c_id[$i]', '$cat_id[$i]','$qty[$i]','$amount')";
        $res1 = mysqli_query($conn , $sql1);

        $sql2 = "SELECT *  
                FROM BALANCE 
                WHERE CAT_ID = '$cat_id[$i]' and C_ID = '$c_id[$i]' ORDER BY BAL_ID DESC LIMIT 1";
        $res2 = mysqli_query($conn , $sql2);
        if($res2){
            $data = mysqli_fetch_assoc($res2);
            $latest_balance = $data['BALANCE'];
            $total_balance = $latest_balance - $qty[$i];
            $sql3 = "INSERT INTO BALANCE(CAT_ID ,BAL_DATE, C_ID, INCOME_QTY,SALE_QTY,BALANCE) VALUES ('$cat_id[$i]','$date','$c_id[$i]', 0,'$qty[$i]', '$total_balance')";
            $res3 = mysqli_query($conn , $sql3);
        }else{
          echo ("<script> alert('Balance not found') </script>");
        }    
    }
    echo ("
      <script>
      function done(){
      localStorage.removeItem('cart');
      };
      done();
      alert ('Order Done');
      </script>
    ");
}
?>

<body onload="calculateTotal()" style="background-color: #FFF0F5;">

    <!-- nav section start -->
    <?php
    include ("nav.php");
   ?>

     <!-- rose section start -->
    <div class="rose my-5 bg-white pt-5 w-50 m-auto rounded-4">
    <form action="" method="post" >
        <div class="div d-flex justify-content-around align-items-center " style="background-color: #FCE4EC;">
            <img src="./Image/rose-custom-1.png" alt="" style="width: 5rem;transform: rotate(-35deg);">
            <h4>Rose</h4>
            <img src="./Image/rose-custom-2.png" alt="" style="width: 6rem;">  
        </div>
        <div class="div1 d-flex justify-content-around m-3">
            <ul class="list-unstyled">
                <li class="fs-5 ms-4 text-center my-4 p-1 w-75" style="background-color: #FCE4EC;">Color</li>

                <?php 
                $sql4 = "SELECT CL.C_ID,CL.C_COLOR
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN COLOR AS CL ON CL.C_ID = CP.C_ID
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Rose'";
                $res4 = mysqli_query($conn , $sql4);
                while($data4 = mysqli_fetch_array($res4)){
                ?>

                <li class="ms-5 py-3"><span><?php echo $data4['C_COLOR']; ?> </span>
                    <input type="hidden" name="c_id[]" value="<?php echo $data4['C_ID']; ?>">
                </li>
                <?php } ?>
            </ul>
            <ul class="list-unstyled">
                <li class="fs-5 ms-3 my-4 text-center p-1 w-75" style="background-color: #FCE4EC;">Price</li>
                <?php 
                $sql5 = "SELECT CP.CP_PRICE , CP.CP_ID , C.CAT_ID
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Rose'";
                $res5 = mysqli_query($conn , $sql5);
                while($data5 = mysqli_fetch_array($res5)){
                ?>

                <li class="ms-4 py-3 price"><span><?php echo $data5['CP_PRICE']; ?> $ </span>
                    <input type="hidden" name="price[]" value="<?php echo $data5['CP_PRICE']; ?>">
                    <input type="hidden" name="cat_id[]" value="<?php echo $data5['CAT_ID']; ?>">
                </li>
                <?php } ?>
            </ul>
            <ul class="list-unstyled">
                <li class="fs-5 me-5 my-4 text-center p-1" style="background-color: #FCE4EC;">Qty</li>
                <?php 
                $sql8 = "SELECT  CP.CP_ID
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Rose'";
                $res8 = mysqli_query($conn , $sql8);
                while($data8 = mysqli_fetch_array($res8)){
                ?>
                <li class="me-5 py-3">
                    <input type="number" class="qty" name="qty[]" id="" placeholder="None" style="width: 60px;">
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="lily my-5 bg-white pt-5 w-50 m-auto rounded-4">
        <div class="div d-flex justify-content-around align-items-center " style="background-color: #FCE4EC;">
            <img src="./Image/lily-custom-1.png" alt="" style="width: 5rem;">
            <h4>Lily</h4>
            <img src="./Image/lily-custom-2.png" alt="" style="width: 4.5rem;transform: rotate(25deg);">  
        </div>

        <div class="div1 d-flex justify-content-around m-3">
            <ul class="list-unstyled">
                <li class="fs-5 ms-4 text-center my-4 p-1 w-75" style="background-color: #FCE4EC;">Color</li>
                <?php 
                $sql2 = "SELECT CL.C_ID,CL.C_COLOR
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN COLOR AS CL ON CL.C_ID = CP.C_ID
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Lily'";
                $res2 = mysqli_query($conn , $sql2);
                while($data2 = mysqli_fetch_array($res2)){
                ?>
                <li class="ms-5 py-3"><span><?php echo $data2['C_COLOR']; ?> </span>
                    <input type="hidden" name="c_id[]" value="<?php echo $data2['C_ID']; ?>">
                </li>
                <?php } ?>
            </ul>
            <ul class="list-unstyled">
                <li class="fs-5 ms-3 my-4 text-center p-1 w-75" style="background-color: #FCE4EC;">Price</li>
                <?php 
                $sql3 = "SELECT CP.CP_PRICE, CP.CP_ID ,C.CAT_ID
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Lily'";
                $res3 = mysqli_query($conn , $sql3);
                while($data3 = mysqli_fetch_array($res3)){
                ?>
                <li class="ms-4 py-3 price"><span> <?php echo $data3['CP_PRICE']; ?> $</span>
                    <input type="hidden" name="price[]" value="<?php echo $data3['CP_PRICE']; ?>">
                    <input type="hidden" name="cat_id[]" value="<?php echo $data3['CAT_ID']; ?>">
                </li>
                <?php } ?>
            </ul>
            <ul class="list-unstyled">
                <li class="fs-5 me-5 my-4 text-center p-1" style="background-color: #FCE4EC;">Qty</li>
                <?php 
                $sql7 = "SELECT  CP.CP_ID
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Lily'";
                $res7 = mysqli_query($conn , $sql7);
                while($data7 = mysqli_fetch_array($res7)){
                ?>
                <li class="me-5 py-3"><input type="number" class="qty" name="qty[]" id="" placeholder="None" style="width: 60px;"></li>
                <?php } ?>
            </ul>
        </div>
        
    </div>
    <div class="tulip my-5 bg-white pt-5 w-50 m-auto rounded-4">
        <div class="div d-flex justify-content-around align-items-center " style="background-color: #FCE4EC;">
            <img src="./Image/Tulip1.png" alt="" style="width: 4rem;">
            <h4>Tulip</h4>
            <img src="./Image/Tulip2.png" alt="" style="width: 5rem;">  
        </div>
        <div class="div1 d-flex justify-content-around m-3">
            
            <ul class="list-unstyled">
                <li class="fs-5 ms-4 text-center my-4 p-1 w-75" style="background-color: #FCE4EC;">Color</li>
                <?php 
                $sql = "SELECT CL.C_ID,CL.C_COLOR
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN COLOR AS CL ON CL.C_ID = CP.C_ID
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Tulip'";
                $res = mysqli_query($conn , $sql);
                while($data = mysqli_fetch_array($res)){
                ?>
                <li class="ms-5 py-3"><span> <?php echo $data['C_COLOR']; ?></span>
                    <input type="hidden" name="c_id[]" value="<?php echo $data['C_ID']; ?>">
                 </li>
                <?php } ?>
            </ul>
            <ul class="list-unstyled">
                <li class="fs-5 ms-3 my-4 text-center p-1 w-75" style="background-color: #FCE4EC;">Price</li>
                <?php 
                $sql1 = "SELECT  CP.CP_PRICE , CP.CP_ID , C.CAT_ID
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Tulip'";
                $res1 = mysqli_query($conn , $sql1);
                while($data1 = mysqli_fetch_array($res1)){
                ?>
                <li class="ms-4 py-3 price"><span><?php echo $data1['CP_PRICE']; ?> $ </span>
                    <input type="hidden" name="price[]" value="<?php echo $data1['CP_PRICE']; ?>">
                    <input type="hidden" name="cat_id[]" value="<?php echo $data1['CAT_ID']; ?>">
                </li>
                <?php } ?>
            </ul>
            <ul class="list-unstyled">
                <li class="fs-5 me-5 my-4 text-center p-1" style="background-color: #FCE4EC;">Qty</li>
                <?php 
                $sql6 = "SELECT CP.CP_ID
                        FROM CUSTOMIZE_PRODUCT AS CP
                        LEFT JOIN CATEGORY AS C ON C.CAT_ID = CP.CAT_ID WHERE CAT_NAME = 'Tulip'";
                $res6 = mysqli_query($conn , $sql6);
                while($data6 = mysqli_fetch_array($res6)){
                ?>
                <li class="me-5 py-3">
                    <input type="number" class="qty" name="qty[]" id="" placeholder="None" style="width: 60px;">
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
     <!-- rose section end -->

     <!-- order send section start  -->
    <div class="div w-25 m-auto">
        <h5 class="text-center mb-5">Total Amount :  <input type="text" name="total" id="totalAmount" class="w-25">$</h5>
        <input type="hidden" id="totalInput" name="total">
        <label for="">Delivery Date :</label>
        <input class="form-control" type="date" name="deli_date" id=""><br>
        <label for="">Address :</label>
        <input class="form-control" type="text" name="address" id=""><br>
        <label for="">Message :</label>
        <textarea class="form-control" name="message" id=""></textarea><br>
        <button type="submit" class="btn btn-primary" name="save">Send</button>
    </div>
    </form>
  
     <!-- footer section start  -->
    <?php
    include ("footer.php");
    ?>

         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
         integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>

        function calculateTotal() {
            let total = 0;

            // Price list
            let prices = document.querySelectorAll(".price span");
            // Qty list
            let qtys = document.querySelectorAll(".qty");

            for (let i = 0; i < prices.length; i++) {
                let price = parseFloat(prices[i].innerText); 
                let qty = parseInt(qtys[i].value) || 0;      

                let totaleach = price * qty;
            
                total += totaleach;
            }

            document.getElementById("totalAmount").value = total;
            document.getElementById("totalInput").value = total;
        }

        // qty ပြောင်းတိုင်း total auto update
        document.addEventListener("input", function(e) {    
            if (e.target.classList.contains("qty")) {
                calculateTotal();
            }
        });
    </script>
</body>
</html>