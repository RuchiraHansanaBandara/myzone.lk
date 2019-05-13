<?php
require_once ('include/adminheader.php');

?>


<!--=====================================================
Custom content page - body - Referencing (adminheader.php)
=========================================================-->


<div class="main_content col-lg-12 col-md-12 col-sm-12 ">
    <div class="content-title">
        <h2>purchased Pending</h2>
        <!--Success Msg
        =========================================-->
        <?php
        if(isset($_GET['received'])=='success'){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Order has been completed.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }
        ?> <!--Success msg - END-->


        <div class="row">
            <div class="col-sm-12 table-inside">

                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Address</th>
                        <th scope="col">Placed Date</th>
                        <th scope="col">Ship</th>
                        <th scope="col">Receive</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $sql="SELECT o.orderId,p.product_title,o.quantity,o.amount,p.sellerID,o.addrline1,o.addrline2,o.addrcity,o.orderDate,o.shipStatus,o.orderReceive FROM orders o,products p WHERE p.product_id=o.prodId AND o.userID=1 AND o.orderReceive='pending'";
                    $result= $conn->query($sql);
                    if(!$result){
                        echo $conn->error;
                    }
                    if($result->num_rows>0){
                        while($rows=$result->fetch_assoc()){
                            echo'
                                <tr>
                                    <th scope="row">'.$rows['orderId'].'</th>
                                    <td>'.$rows['product_title'].'</td>
                                    <td>'.$rows['quantity'].'</td>
                                    <td>'.$rows['amount'].'</td>
                                    <td>'.$rows['sellerID'].'</td>
                                    <td>'.$rows['addrline1'].',</br>'.$rows['addrline2'].'</br>'.$rows['addrcity'].'</td>
                                    <td>'.$rows['orderDate'].'</td>
                                    <td>'.$rows['shipStatus'].'</td>
                                    <td>'.($rows['orderReceive']=="pending"?'<a href="include/update_staus.php?rid='.$rows['orderId'].'">'.$rows['orderReceive'].'</a>':'Done').'</td>
                                </tr>
                            ';
                        }
                    }else{
                        echo "No Records";
                    }
                    ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <!--form-->
</div><!--Main content end-->
<!--END-Custom page content-->
</div>
</div>
</div>
</div><!--End PAGE CONTENT-->
</div>
<!--End NEW Structure-->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="../js/admin.js"></script>
</body>
</html>