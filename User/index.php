<?php
session_start();
include ("db.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Great+Primer+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" 
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

<body>
    <?php
    include ("nav.php");
    ?>
    <!-- nav section end -->
    
    <!-- slider section start  -->
    <div class="swiper myHero">
        <div class="swiper-wrapper">

            <!-- slide 1 (single day) -->
            <div class="swiper-slide">
            <div class="slider1 d-flex">
                <div class="div1 m-5">
                <h5>New Arrivals!</h5>
                <span class="fs-4 fw-bold">11.11</span> 
                <span class="fs-5 fw-bold">Single’s Day</span>
                <h5 class="py-2">Celebrate your shine — Love Yourself, Bloom Freely</h5> 
                <button class="p-2 my-2"><a href="./all-flower.php" class="text-decoration-none text-white">Shop Now</a></button>
                </div>
                <img src="./Image/slider1-img.png" alt="">
            </div>
            </div>

            <!-- SLIDE 2 (Christmas) -->
            <div class="swiper-slide">
            <div class="slider1 d-flex text-white">
                <div class="div3 m-5">
                <h5>New Arrivals!</h5>
                <span class="fs-4 fw-bold">25.12</span>
                <span class="fs-5 fw-bold">Christmas Day</span>
                <h5 class="py-2">Share love, warmth and flowers - because Christmas is made for giving</h5>
                <button class="p-2 my-2"><a href="./all-flower.php" class="text-decoration-none">Shop Now</a></button>
                </div>
                <img src="./Image/christmas flower.png" alt="">
            </div>
            </div>

            <!-- SLIDE 3 (New Year) -->
            <div class="swiper-slide">
            <div class="slider1 d-flex">
                <div class="div2 m-5">
                <h5>New Arrivals!</h5>
                <span class="fs-4 fw-bold">31.12</span>
                <span class="fs-5 fw-bold">Happy New Year</span>
                <h5 class="py-2">Start the new year fresh - with flowers that whisper hope & happiness</h5>
                <button class="p-2 my-2"><a href="./all-flower.php" class="text-decoration-none text-white fw-bold">Shop Now</a></button>
                </div>
                <img src="./Image/happynew-bouquet.png" alt="">
            </div>
            </div>        
        </div>
        <!-- pagination dots -->
        <div class="swiper-pagination"></div>
    </div>                                 
    <!-- slider section end -->

     <!-- best seller section start  -->
    <div class="best container p-5">
        <h3 class=" text-center">Best Seller Bouquets</h3>
        <div class="row">
            <?php
            $sql = "SELECT P.PRO_NAME,P.PRO_IMAGE,P.PRO_PRICE,P.PRO_ID,SUM(OP.QTY) AS SUM
                    FROM ORDER_PRODUCT AS OP
                    LEFT JOIN PRODUCT AS P ON P.PRO_ID = OP.PRO_ID 
                    GROUP BY OP.PRO_ID ORDER BY SUM DESC LIMIT 4;";
            $res = mysqli_query($conn , $sql);
            while($data = mysqli_fetch_array($res)){
            ?>
            <div class="card1 col-md-3 mt-5 text-center " style="background-color: #FFF0F5;">
                <img class="w-50 pb-2" src="./Image/<?php echo $data['PRO_IMAGE']; ?>" alt="">
                <div class="bestrose mx-5">
                    <h5><?php echo $data['PRO_NAME']; ?> </h5>

                    <h4 class="py-2">$ <?php echo $data['PRO_PRICE']; ?></h4>
                    <button onclick="addCart('<?php echo $data['PRO_ID']; ?>','<?php echo $data['PRO_NAME']; ?>','<?php echo $data['PRO_PRICE']; ?>',
                     '<?php echo $data['PRO_IMAGE']; ?>' )"><a href="cart.php" class="text-decoration-none text-white">Add to cart</a></button>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
     <!-- best seller section end  -->

     <!-- Special offer section start  -->
    <div class=" container-fluid ">
        <h3 class="special text-center">Special Offer</h3>
        <div class="row m-5 p-3">
            <?php
                $sql = "SELECT * FROM OFFER";
                $res = mysqli_query($conn , $sql);
                $data = mysqli_fetch_assoc($res);

            ?>
            <div class="offer1 col-md-6 d-flex">
                <div class="off1">
                    <h2 class="ps-2"><?php echo $data['O_OFF']; ?> % OFF</h2>
                    <h5 class="ps-4 my-3"><strike>Before $ <?php echo $data['O_BPRICE']; ?></strike></h5>
                    <h3 class="ps-3 mt-4">Now <span class="fw-bold">$ <?php echo $data['O_NPRICE']; ?></span></h3>
                </div>
                <img class="w-25" src="./Image/Yellow Rose.png" alt="">
            </div>
            <div class="offer2 col-md-6 ">
                <div class="off2">
                    <h4><?php echo $data['O_NAME']; ?></h4>
                    <h6 class="py-4 pb-5"><?php echo $data['O_DESCRIPTION']; ?></h6>
                    <button onclick="addCart('<?php echo $data['OFFER_ID']; ?>','<?php echo $data['O_NAME']; ?>','<?php echo $data['O_NPRICE']; ?>',
                     '<?php echo $data['O_IMAGE']; ?>' )"><a href="cart.php" class="text-decoration-none text-white">Add to cart</a></button>
                </div>
            </div>
        </div>
    </div>
     <!-- Special offer section end -->

      <!-- about section start  -->
     <div class="about mt-5 p-5 " style="background-color: #FFF0F5;">
        <h3 class="text-white m-auto text-center p-2" style="background-color: #87494A;width: 10rem;border-radius: 0px 20px 0px 20px;">About Us</h3>
        <div class="aboutus p-2 d-flex">
            <div class="div m-5">
                <p>At Bloom & Joy, we believe every bloom tells a story — of love, joy, comfort, and connection.
               <span> Each bouquet we create is hand-crafted with care, using only the freshest, most beautiful flowers.</span></p>

                <p>From romantic roses to cheerful sunflowers, our arrangements are designed to bring warmth and meaning to every occasion. 
                Whether it’s a celebration, a thank-you, or a quiet moment of love, we’re here to help you express it beautifully — 
                through flowers that speak from the heart.</p>

                <p>Because to us, flowers aren’t just gifts.They’re emotions — lovingly wrapped, thoughtfully delivered.</p>

                <p>Crafted with love, delivered with care.</p>
            </div>
            <img class="" src="./Image/redrose-7.png" alt="" style="width: 17rem;">
        </div>
     </div>
    <!-- about section end -->
    
    <?php
    include ("footer.php");
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.1.0/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11.1.0/swiper-bundle.min.js"></script>

    
    <script>
        var swiper = new Swiper(".myHero", {
        loop: true,
        autoplay: {
            delay: 3000
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        }
        });

        function addCart(pro_id,pro_name,pro_price,pro_img){
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let existingProduct = cart.find(item=> item.pro_id === pro_id);
                if(existingProduct){
                    existingProduct.pro_qty +=1;
                }else {
                    cart.push({
                        pro_id: pro_id,
                        pro_name: pro_name,
                        pro_price: pro_price,
                        pro_img: pro_img,
                        pro_qty: 1
                    })
                }
                localStorage.setItem('cart',JSON.stringify(cart));
                alert (pro_name + " is add to cart");
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