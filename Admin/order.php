<?php
include ("nav.php");
include ("db.php");

?>
     <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="my-4">Bouquet Orders</h3>
            <table class="table table-bordered" id="datatablesSimple" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th> Phone no.</th>
                        <th> Address</th>
                        <th>Product Name</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>  
                        <th>Message</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $sql = "SELECT O.ORDER_ID,U.USER_NAME,U.USER_PHNO,P.PRO_NAME,O.ADDRESS,O.ORDER_DATE,O.DELIVERY_DATE,O.ORDER_MESSAGE,OP.QTY,OP.AMOUNT
                            FROM ORDER_PRODUCT AS OP
                            LEFT JOIN PRODUCT AS P ON P.PRO_ID = OP.PRO_ID
                            LEFT JOIN ORDERS AS O ON O.ORDER_ID = OP.ORDER_ID
                            LEFT JOIN USER AS U ON U.USER_ID = O.USER_ID ORDER BY OP.OP_ID DESC;";
                    $res = mysqli_query($conn , $sql);
                    $i=1;
                    while($data = mysqli_fetch_array($res)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['ORDER_ID']; ?></td>
                        <td><?php echo $data['USER_NAME']; ?></td>
                        <td><?php echo $data['USER_PHNO']; ?></td>
                        <td><?php echo $data['ADDRESS']; ?></td>
                        <td><?php echo $data['PRO_NAME']; ?></td>
                        <td><?php echo $data['ORDER_DATE']; ?></td>
                        <td><?php echo $data['DELIVERY_DATE']; ?></td>
                        <td><?php echo $data['ORDER_MESSAGE']; ?></td>
                        <td><?php echo $data['QTY']; ?></td>
                        <td><?php echo $data['AMOUNT']; ?></td>
                        <td><a href="order_delete.php?odid=<?php echo $data['ORDER_ID']; ?>" type="submit" class="btn btn-outline-danger">Delete</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </div>
    </div>

  <script src="script1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
