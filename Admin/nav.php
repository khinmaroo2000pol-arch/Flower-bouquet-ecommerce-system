<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'Admin'){
    header("Location: ../login.php");
    exit();
}

include ("db.php");

if(isset($_POST['logout'])){
  session_destroy();
  header ("Location: ../login.php");
  exit();
}
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

        <div class="topnavbar d-flex align-items-center">
            <h2 class=" px-4 mt-3">Bloom & Joy</h2>   
            <i class="fas fa-bars tapbar fs-5 text-center mt-2" style="width: 9rem;" id="menu-btn"></i> 
                
        </div>

    <div class="sidenav" id="sidenav">  
            
        <div class=" py-4" >            
            <a href="./dashboard.php" class="text-decoration-none text-black ">
                <i class="fa-solid fa-house ms-3 me-2 pt-5"></i>Dashboard</a><br>
            <a href="./category.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-list ms-3 py-4 me-2"></i>Category </a><br>
            <a href="./color.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-brush ms-3 me-2"></i>Color </a><br>
            <a href="./product.php" class="text-decoration-none text-black"> 
                <i class="fa-brands fa-product-hunt ms-3 py-4 me-2"></i>Bouquets </a><br>
            <a href="./cus_product.php" class="text-decoration-none text-black"> 
                <i class="fa-brands fa-product-hunt ms-3 me-2 "></i>Customize </a><br>            
            <a href="./order.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-cart-shopping ms-3 py-4 me-2"></i>Bouquet Order</a><br>
            <a href="./custom_order.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-cart-shopping ms-3 me-2 "></i>Customize Order</a><br>
            <a href="./user.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-users ms-3 py-4 me-2"></i>User List</a><br>
            <a href="./message.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-message ms-3 me-2 "></i>View Message</a><br>
            <a href="./balance.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-sack-dollar ms-3 py-4 me-2"></i>Balance</a><br>
            <a href="./offer.php" class="text-decoration-none text-black">
                <i class="fa-solid fa-sack-dollar ms-3 me-2 "></i>Special Offer</a><br>
            <form method="post">
                <div class="dropdown">
                    <button style="border: none;outline: none;" class="bg-white pt-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user ms-2 me-2 "></i>Account</button>
                    <ul class="dropdown-menu ms-5">
                    <button class="dropdown-item" type="submit" name="logout"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout</button>
                    </ul>                
                </div>
            </form>
        </div>
    </div>
