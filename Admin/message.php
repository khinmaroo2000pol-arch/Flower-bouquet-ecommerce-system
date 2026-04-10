<?php
include ("nav.php");
include ("db.php");
?>

    <div class="main" id="main">
        <div class="container-fluid px-4">
            <h3 class="my-3 mb-5" >Message</h3>
            <table class="table table-bordered" id="datatablesSimple" style="border: 1px solid #87494A;" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Phone Number</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM CONTACT";
                    $res = mysqli_query($conn , $sql);
                    $i=1;
                    while($data = mysqli_fetch_array($res)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['C_ID']; ?></td>
                        <td><?php echo $data['C_NAME']; ?></td>
                        <td><?php echo $data['C_EMAIL']; ?></td>
                        <td><?php echo $data['C_PHNO']; ?></td>
                        <td><?php echo $data['C_MESSAGE']; ?></td>
                        <td><a href="message_delete.php? mid=<?php echo $data['C_ID']; ?>" type="submit" class="btn btn-outline-danger">
                            Delete</a></td>
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
