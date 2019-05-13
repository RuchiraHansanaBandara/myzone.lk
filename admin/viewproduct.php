<?php
require_once ('include/adminheader.php');

?>


<!--=====================================================
Custom content page - body - Referencing (adminheader.php)
=========================================================-->


<div class="main_content col-lg-10 col-md-12 col-sm-12 ">
    <div class="content-title">
        <h2>VIEW PRODUCT</h2>
        <div class="row">
            <div class="col-sm-12 table-inside">

                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Remove</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $sql="SELECT p.product_id,p.product_title,p.product_price,i.imagePath FROM products p,product_image i WHERE p.product_id=i.prodID AND p.sellerID='1'";
                    $result= $conn->query($sql);
                    if(!$result){
                        echo $conn->error;
                    }
                    if($result->num_rows>0){
                        while($rows=$result->fetch_assoc()){
                            echo'
                                <tr>
                                    <th scope="row">'.$rows['product_id'].'</th>
                                    <td>'.$rows['product_title'].'</td>
                                    <td>'.$rows['product_price'].'</td>
                                   
                                    <td><img height="75px" src="../product_img/'.$rows['imagePath'].'" alt=""></td>
                                    <td scope="col"><a href="#">Edit</a></td>
                                    <td scope="col"><a href="#">Remove</a></td>
                                </tr>
                            ';
                        }
                    }else{
                        echo "error";
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