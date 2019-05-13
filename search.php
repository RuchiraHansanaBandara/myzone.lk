<?php

include_once ("includes/mainheader/header.php");

?>

    <!--Main Content
    ==================================================-->

    <a href="#" id="scroll" style="display: none;"><i class="fas fa-angle-up scroll-ico"></i></a>

    <div class="main-content container">
        <?php if (logged_in()):?>
            <?php if(!check_activation()):?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">Please
                            <a href="activate.php" class="alert-link">Activate</a>
                            your account.
                        </div></div></div>
            <?php endif;?>
        <?php endif; ?>

        <!--ITEM -Section
        ===================================-->

       <?php
        $search=$_GET['qu'];
       ?>

        <div class="row">
            <div class="item-main-container col-md-12">

                <div class="row">
                    <!--1st row -->
                    <!--Item-->
                    <?php
                    $sql="SELECT p.product_id, p.product_title, p.product_price, i.imagePath FROM products p, product_image i WHERE i.prodID=p.product_id AND p.product_title LIKE '%".$search."%'";
                    $result=$conn->query($sql);

                    if($result->num_rows>0){
                        while($rows=$result->fetch_assoc()){
                            echo'
                    <div class="col-md-3 item-wrap-main">
                    <div class="item-wrap">
                      <div class="item-image">
                        <a href="#"><img class="item-image-itself" src="product_img/'.$rows['imagePath'].'" alt="Tempered"></a>
                        <div class="product-overlay">
                          <a href="functions/cart.php?add='.$rows['product_id'].'" ><i class="fas fa-shopping-cart"></i><span> Add to Cart</span></a>
                          <a href="product.php?pid='.$rows['product_id'].'" class="bor"><i class="icon-shopping-cart"></i><span>View Product</span></a>
                        </div>
                      </div>
        
                      <div class="item-description">
                        <div class="item-title"><h3><a href="#">'.$rows['product_title'].'</a></h3></div>
                        <div class="item-price"><ins>Rs.'.$rows['product_price'].'/=</ins></div>
                        <div class="item-rating">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star-half-alt"></i>
                          <i class="far fa-star"></i>
                        </div>
                      </div>
                    </div>
                  </div><!--Item End-->
                  
                    ';
                        }
                    }else{
                        echo "no data records".$conn->connect_error;
                    }
                    ?>
                    <!--Item End-->

                    <!--Item-->



                    <!--2nd row completed-->
                </div>



            </div>
        </div>
        <!--   item end-->
    </div>





    <!--Main content End-->

    <!--Footer
    ====================================================-->
<?php require_once "includes/mainheader/footer.php"?>