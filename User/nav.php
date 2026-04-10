<?php

include ("db.php");

if(isset($_POST['logout'])){
  session_destroy();
  header ("Location: homepage.php");
  exit();
}

?>
 


 
 <nav class="navbar navbar-expand-lg bg-white w-75">
        <div class="container">
            <a class="navbar-brand fs-2 w-25 mx-4" href="#">Bloom & Joy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-75 justify-content-center">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./all-flower.php">All Bouquet</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Flower Type
                    </a>
                    <ul class="dropdown-menu">
                    <?php
                        $sql = "SELECT * FROM CATEGORY ";
                        $res = mysqli_query($conn , $sql);
                        while($data = mysqli_fetch_array($res)){
                    ?>
                        <li><a class="dropdown-item" href="all-flower.php?cid=<?php echo $data['CAT_ID']; ?>"><?php echo $data['CAT_NAME']; ?></a></li>
                    <?php } ?>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./customize.php">Customize Bouquet</a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link" href="./contact.php">Contact</a>
                    </li>
                </ul>
                <div class="right d-flex justify-content-around align-items-center">
                    <?php
                    if(!isset($_SESSION['uid'])){
                    ?>
                    <div class="dropdown">
                        <button style="border: none;outline: none;" class="bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i></button>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./login.php">Login</a></li>
                        <li><a class="dropdown-item" href="./signup.php">Sign Up</a></li>
                        </ul>
                    </div>
                    <?php }
                    else if(isset($_SESSION['uid'])){
                    ?>
                    <form action="all-flower.php" method="post" class="d-flex">
                        <input class="" type="search" name="search" style="border: none;outline: none;border-bottom:1px solid black;">
                        <button type="submit" class="me-2 bg-white" name="save" style="border: none; outline: none;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    <a class="dropdown-item m-2" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <span class="cartqty text-light bg-danger text-center " style="height: 20px;width: 20px;border-radius: 50%;position: absolute;right: 2.7rem;top: 15px;">
                        0</span>
                    <form method="post">
                        <div class="dropdown">
                            <button style="border: none;outline: none;" class="bg-white ms-3" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i></button>
                            <ul class="dropdown-menu">
                            <button class="dropdown-item" type="submit" name="logout">Logout</button>
                            </ul>
                        </div>
                        
                    </form>
                    
                    <?php }?>
                </div>
            </div>
        </div>
    </nav>