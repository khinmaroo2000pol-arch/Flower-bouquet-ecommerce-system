<?php
include ("db.php");
include ("head.php");
?>

<style>

/* home section start   */

.div1{
    margin: 80px 0px;
    padding: 8rem 0rem 0rem 15px;
    color: #87494A;
}
.div1 button{
    width: 7rem;
    border-radius: 5px;
    background-color: #87494A;
    border: none; 
}
.navbar::before{
    content: "";
    background-color: #FFDCDC;
    position: absolute;
    width: 100rem;
    height: 90vh;
    z-index: -1;
    left: -200px;
}

.roseimg1{
    width: 150px;
}
.roseimg2{
    width: 270px;
}
.hometext{
    top: 300px;
}
.hometext button{
    width: 7rem;
    border-radius: 5px;
    background-color: #87494A;
    border: none; 
    padding: 7px;
}
/* home section end */
/* card section start   */
.card1 button{
    width: 6rem;
    border-radius: 5px;
    background-color: #87494A;
    border: none; 
    padding: 6px;
    color: #FFffff;
}
/* box section start */
.add{
    background-color: #87494A;
    outline: none;
    border: none;
    color: white;
    padding: 5px;
    width: 4rem;
    border-radius: 8px;
}
.cancel{
    border: 1px solid #87494A;
    background-color: #FFF0F5;
    padding: 5px;
    width: 5rem;
    border-radius: 8px;
}
  </style>

<body>
    <!-- nav section start -->
   <?php
    include ("nav.php");
   ?>
    <!-- nav section end -->

     <!-- home section start  -->
      <div class="home d-flex align-items-center justify-content-around py-3">
        <img class="roseimg1  " src="./Image/All blooms.png" alt="" style="rotate: 30deg;">
        <div class="hometext text-center">
            <h2>All Blooms</h2>
            <p>Each bouquet hand-crafted with love, care, and  timeless elegance.</p><br>
            <button class="text-white">Shop Now</button> 
        </div>
        <img class="roseimg2" src="./Image/All blooms.png" alt="" style="rotate: -25deg;">
      </div>
     <!-- home section end -->

    <!-- card section start  -->

    <?php
    if(isset($_POST['save'])){
        $search = $_POST['search'];
    ?>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mt-5">

            <?php
            $sql = "SELECT * FROM PRODUCT WHERE PRO_NAME LIKE '%$search%'";
            $res = mysqli_query($conn , $sql);
            while($data = mysqli_fetch_assoc($res)){
            ?>

            <div class="col-md-4 text-center">
                <img src="./Image/<?php echo $data['PRO_IMAGE']; ?>" class="w-50" alt="">
                <div class="card1 pt-3">
                    <h4><?php echo $data['PRO_NAME']; ?></h4>
                    <h3>$ <?php echo $data['PRO_PRICE']; ?></h3>
                    <button onclick="addCart('<?php echo $data['PRO_ID']; ?>','<?php echo $data['PRO_NAME']; ?>','<?php echo $data['PRO_PRICE']; ?>',
                    '<?php echo $data['PRO_IMAGE']; ?>' )">Add to cart</button>
                </div>
            </div>
            <?php } ?>
        </div>       
    </div>

    <?php } else if(isset($_GET['cid'])){
            $id = $_GET['cid'];
     ?>
      
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mt-5">

            <?php
            $sql = "SELECT * FROM PRODUCT WHERE CAT_ID = $id";
            $res = mysqli_query($conn , $sql);
            while($data = mysqli_fetch_assoc($res)){
            ?>

            <div class="col-md-4 text-center">
                <img src="./Image/<?php echo $data['PRO_IMAGE']; ?>" class="w-50" alt="">
                <div class="card1 pt-3">
                    <h4><?php echo $data['PRO_NAME']; ?></h4>
                    <h3>$ <?php echo $data['PRO_PRICE']; ?></h3>
                    <button onclick="addCart('<?php echo $data['PRO_ID']; ?>','<?php echo $data['PRO_NAME']; ?>','<?php echo $data['PRO_PRICE']; ?>',
                    '<?php echo $data['PRO_IMAGE']; ?>' )">Add to cart</button>
                </div>
            </div>
            <?php } ?>
        </div>     
    </div>

    <?php } else { ?>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mt-5">

            <?php
            $sql = "SELECT * FROM PRODUCT";
            $res = mysqli_query($conn , $sql);
            while($data = mysqli_fetch_assoc($res)){
            ?>

            <div class="col-md-4 text-center">
                <img src="./Image/<?php echo $data['PRO_IMAGE']; ?>" class="w-50" alt="">
                <div class="card1 pt-3">
                    <h4><?php echo $data['PRO_NAME']; ?></h4>
                    <h3>$ <?php echo $data['PRO_PRICE']; ?></h3>
                    <button onclick="addCart('<?php echo $data['PRO_ID']; ?>','<?php echo $data['PRO_NAME']; ?>','<?php echo $data['PRO_PRICE']; ?>',
                    '<?php echo $data['PRO_IMAGE']; ?>' )">Add to cart</button>
                </div>
            </div>
            <?php } ?>

        </div>
        
    </div>
    <?php } ?>
    <!-- card section end -->

     <!-- footer section start  -->
    <?php
    include ("footer.php");
    ?>
    <!-- footer section end -->

    <!-- box section start  -->
    <div class="card position-fixed top-50 start-50 translate-middle d-none w-25  shadow-lg" style="height: 8rem;background-color: #FFF0F5;" id="box">
        <h4 class="text-center p-3">Add this item to your cart?</h4>
        <div class="click d-flex justify-content-between">
            <button onclick="cancel()" class="cancel">Cancel</button>
            <button onclick="add()" class="add">Add</button>
        </div>
    </div>
    <!-- box section end -->

     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
     integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" 
     referrerpolicy="no-referrer"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
        <script>
             function addCart(pro_id,pro_name,pro_price,pro_img){
                tempProduct = {
                    pro_id : pro_id,
                    pro_name : pro_name,
                    pro_price : pro_price,
                    pro_img : pro_img

                }
                document.querySelector('#box').classList.remove('d-none');
                document.querySelector('#box').classList.add('d-block');          
             }

            function cancel(){
                document.querySelector('#box').classList.remove('d-block');
                document.querySelector('#box').classList.add('d-none');
            }

            function add(){
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let existingProduct = cart.find(item => item.pro_id === tempProduct.pro_id);
                if(existingProduct){
                    existingProduct.pro_qty +=1;
                }else {
                    cart.push({
                        pro_id: tempProduct.pro_id,
                        pro_name: tempProduct.pro_name,
                        pro_price: tempProduct.pro_price,
                        pro_img: tempProduct.pro_img,
                        pro_qty: 1
                    })
                }
                localStorage.setItem('cart',JSON.stringify(cart));
                tempProduct = {};
                cancel();
                upgrade();
            }
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