<?php
include ("nav.php");
include ("db.php");
?>

    <div class="main" id="main">
        <div class="row">
            <div class="col">
                <div class="alert alert-danger text-black d-flex justify-content-around">
                    <img src="../Image/flower-dashboard.png" alt="" style="width: 7rem;">
                    <h3>Welcome Back Admin</h3>
                    <img src="../Image/flower-dashboard.png" alt="" style="width: 7rem;">
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $sql = "SELECT COUNT(PRO_ID) AS COUNT FROM PRODUCT";
                            $res = mysqli_query($conn , $sql);
                            $data = mysqli_fetch_array($res);
                        ?>
                        <h5><?php echo $data['COUNT']; ?></h5>
                        <span>Total Products <i class="fa-solid fa-cart-shopping"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $cpsql = "SELECT COUNT(CP_ID) AS COUNT FROM CUSTOMIZE_PRODUCT";
                            $cpres = mysqli_query($conn , $cpsql);
                            $cpdata = mysqli_fetch_array($cpres);
                        ?>
                        <h5><?php echo $cpdata['COUNT']; ?></h5>
                        <span>Total Customize Products <i class="fa-solid fa-cart-shopping"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-5 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $sql1 = "SELECT COUNT(CAT_ID) AS COUNT FROM CATEGORY";
                            $res1 = mysqli_query($conn , $sql1);
                            $data1 = mysqli_fetch_array($res1);
                        ?>
                        <h5><?php echo $data1['COUNT']; ?></h5>
                        <span>Category <i class="fa-solid fa-list"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-5 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $sql2 = "SELECT COUNT(ORDER_ID) AS COUNT FROM ORDER_PRODUCT";
                            $res2 = mysqli_query($conn , $sql2);
                            $data2 = mysqli_fetch_array($res2);
                        ?>
                        <h5><?php echo $data2['COUNT']; ?></h5>
                        <span>Total Product Order <i class="fa-solid fa-truck ms-2"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-5 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $sqlorder = "SELECT COUNT(ORDER_ID) AS COUNT FROM ORDER_CUSTOMIZE";
                            $resorder = mysqli_query($conn , $sqlorder);
                            $dataorder = mysqli_fetch_array($resorder);
                        ?>
                        <h5><?php echo $dataorder['COUNT']; ?></h5>
                        <span>Total Customize Order <i class="fa-solid fa-truck ms-2"></i></span>
                    </div>
                </div>
            </div> 
            <div class="col-lg-4 my-5 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $sql3 = "SELECT COUNT(USER_ID) AS COUNT FROM USER";
                            $res3 = mysqli_query($conn , $sql3);
                            $data3 = mysqli_fetch_array($res3);
                        ?>
                        <h5><?php echo $data3['COUNT']; ?></h5>
                        <span>User List <i class="fa-solid fa-users ms-2"></i></span>
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-4 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $sql3 = "SELECT (SELECT IFNULL (SUM(AMOUNT),0) FROM ORDER_PRODUCT) + 
                                    (SELECT IFNULL(SUM(TOTAL_AMOUNT),0) FROM ORDER_CUSTOMIZE) AS TOTAL";
                            $res3 = mysqli_query($conn , $sql3);
                            $data3 = mysqli_fetch_array($res3);
                        ?>
                        <h5>$<?php echo $data3['TOTAL']; ?></h5>
                        <span>Income Balance<i class="fa-solid fa-money-check-dollar ms-2"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $sql3 = "SELECT COUNT(C_MESSAGE) AS COUNT FROM CONTACT;";
                            $res3 = mysqli_query($conn , $sql3);
                            $data3 = mysqli_fetch_array($res3);
                        ?>
                        <h5><?php echo $data3['COUNT']; ?></h5>
                        <span>Message Noti <i class="fa-solid fa-message ms-2"></i></span>
                    </div>
                </div>
            </div>
        </div>
  </div>

  <script src="script1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
