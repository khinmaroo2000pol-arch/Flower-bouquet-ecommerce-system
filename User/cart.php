<?php
include ("db.php");
include ("head.php");

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

    $sql = "INSERT INTO ORDERS(USER_ID, ORDER_DATE , TOTAL_AMOUNT,DELIVERY_DATE,ORDER_MESSAGE,ADDRESS) 
            VALUES ('$uid','$date','$total','$deli_date','$message','$address')";
    $res = mysqli_query($conn , $sql);
    
    $order_id = mysqli_insert_id($conn);
    $pro_id = $_POST['pro_id'];
    $qty = $_POST['qty'];
    $amount = $_POST['amount'];

    for($i=0 ; $i<count($pro_id); $i++ ){
        $sql1 = "INSERT INTO ORDER_PRODUCT (ORDER_ID,PRO_ID,QTY,AMOUNT) VALUES ('$order_id', '$pro_id[$i]','$qty[$i]','$amount[$i]')";
        $res1 = mysqli_query($conn , $sql1);

        $sql2 = "SELECT * FROM BALANCE WHERE PRO_ID = '$pro_id[$i]' ORDER BY BAL_ID DESC LIMIT 1";
        $res2 = mysqli_query($conn , $sql2);
        if($res2){
            $data = mysqli_fetch_assoc($res2);
            $latest_balance = $data['BALANCE'];
            $total_balance = $latest_balance - $qty[$i];
            $sql3 = "INSERT INTO BALANCE(PRO_ID ,BAL_DATE, INCOME_QTY,SALE_QTY,BALANCE) VALUES ('$pro_id[$i]','$date', 0 , '$qty[$i]', '$total_balance')";
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

<body onload="loadData()" style="background-color: #FFF0F5;">

    <!-- nav section start -->
    <?php
    include ("nav.php");
    ?>

    <!-- table section start  -->
    <div class="table ">
        <h3 class="m-5 text-center">Shopping <span style="color: #87494A;">Cart</span></h3>

     <form method="post" action="">
        <table class="table text-center">
            <thead>
                <tr>
                <th scope="col"><span  class="ms-5 ">Product</span></th>
                <th scope="col">Price</th>
                <th scope="col"><span  class="me-5">Quantity</span></th>
                <th scope="col"><span  class="me-5 pe-5">Total</span></th>
                <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody id="cart-items" style="background-color: #FFF0F5;">
                
            </tbody>
        </table>
    
            <h4 class="text-end me-5 pe-5 ">Total Amount: $ <input type="" name="total"  id="total_all" value=""></h4>
            <div class="div1 d-flex justify-content-around ">
              <img src="./Image/flower1.png" alt="" style="width: 400px;margin-right: 150px;background-color: #FFF0F5;">
            <div class="div w-25  my-5">
                <label for="" class="text-start">Delivery Date :</label>
                <input class="form-control" type="date" name="deli_date" id=""><br>
                <label for="">Address :</label>
                <input class="form-control" type="text" name="address" id=""><br>
                <label for="">Message :</label>
                <textarea class="form-control" name="message" id=""></textarea><br>
                <button type="submit" class="btn btn-primary" name="save">Send</button>
            
            </div>
            </div>
    </form>
    </div>
    
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
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function loadData(){
        let tbody = document.querySelector('tbody');
        tbody.innerHTML =``;
        let total_all = 0;

        if(cart.length === 0){
            tbody.innerHTML = `<h3 class="text-end my-5" style=" margin: auto;">Empty cart...</h3>`;
        }else{
            cart.forEach(item=> {
                const total_each = item.pro_price * item.pro_qty;
                total_all += total_each;
                tbody.innerHTML += `
                <tr>
                  <td>
                    <div class="d-flex align-items-center justify-content-center">
                      <img src="./Image/${item.pro_img}" class="img-thumbnail me-3" style="width: 100px;" alt="Product Image">
                      <span>${item.pro_name}</span>
                      <input type="hidden" value="${item.pro_id}" name="pro_id[]" id="pro_id">
                    </div>
                  </td>
                  <td>$${item.pro_price}</td>
                  <td>
                    <div class="d-flex align-items-center justify-content-center me-5">
                      <button onclick="changeQty('decrease', '${item.pro_id}')" class="btn btn-sm btn-outline-secondary decrement">-</button>
                      <input name="qty[]" type="text" class="form-control text-center mx-2 qty-input" style="width: 60px;" value="${item.pro_qty}">
                      <button onclick="changeQty('increase', '${item.pro_id}')" class="btn btn-sm btn-outline-secondary increment">+</button>
                    </div>
                  </td>
                  <td class="item-total"><span class="ms-5">$<input name="amount[]" 
                  class="total-each" type="number" readonly style="border: none; outline: none;" value="${total_each.toFixed(2)}"></span></td>
                  <td>
                    <button onclick="removeItem('${item.pro_id}')" class="btn btn-danger btn-sm remove">Remove</button>
                  </td>
                </tr>
              `;
            });
            document.querySelector('#total_all').value = total_all.toFixed(2);
        }
    }

    function changeQty(status, id) {
          const index = cart.findIndex(item => item.pro_id == id);
       
            if (status === 'decrease') {
              cart[index].pro_qty -= 1;
            } else if (status === 'increase') {
              cart[index].pro_qty += 1;
            }

            if (cart[index].pro_qty <= 0) {
              cart.splice(index, 1);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            loadData(); 
            upgrade();
        }

        function removeItem(id) {
          const index = cart.findIndex(item => item.pro_id == id);
          cart.splice(index, 1);
          localStorage.setItem('cart', JSON.stringify(cart));
          loadData(); 
          upgrade();
        }

        // Load data on page load
        document.addEventListener('DOMContentLoaded', loadData);
   
        function upgrade(){
          let cart = JSON.parse(localStorage.getItem('cart')) || [];
          let cartqty = document.querySelector('.cartqty');
          let totalqty = cart.reduce((sum,item) => sum + item.pro_qty, 0);
          cartqty.textContent = totalqty;
          loaddData();
        }
        upgrade();
     </script>

    </body>
</html>