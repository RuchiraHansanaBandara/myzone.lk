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
    <div class="row baner-control">
      <div class="col-md-8">
          <div class="row"> <?php display_message(); ?></div>

        <!--Carousel
        ==============================================-->
        <div class="slider-limits">
          <div  class="slider " >
            <div class="slider-inner">
              <div class="slider-item ">
                <img class="d-block w-100 " src="img/1.jpg" alt="First slide">
              </div>
              <div class="slider-item">
                <img class="d-block w-100" src="img/2.jpg" alt="Second slide">
              </div>
              <div class="slider-item">
                <img class="d-block w-100" src="img/3.jpg" alt="Third slide">
              </div>
              <div class="slider-item">
                <img class="d-block w-100" src="img/4.jpg" alt="fourth slide">
              </div>
            </div>
            <a class="arrow-right" role="button" >
              <span><i class="fas fa-angle-right icon-right"></i></span>

            </a>
            <a class="arrow-left" role="button" >
              <span aria-hidden="true"><i class="fas fa-angle-left icon-left"></i></span>

            </a>
          </div>

        </div>
        <!--Carousel End
        ==============================================-->

      </div>
      <div class="col-md-4 ">

            <div class="side-image-container ">
              <img class="d-block w-100 side-image" src="img/item/31.jpg" alt="">
            </div>

            <div class="side-image-container">
              <img class="d-block w-100 side-image" src="img/item/32.jpg" alt="">
            </div>

      </div>
    </div>
    <!--ITEM -Section
    ===================================-->

    <!--Section-Title-->
    <div class="container ">
      <div class="row">
        <div class="col-md-12 section-title">
          <h2>Today's Featured Collections</h2>
        </div>
      </div>
    </div>
    <!--Section-Title End-->

    <div class="row">
      <div class="item-main-container col-md-12">

        <div class="row">
          <!--1st row -->
          <!--Item-->
          <?php
            $sql="SELECT p.product_id, p.product_title, p.product_price, i.imagePath FROM products p, product_image i WHERE i.prodID=p.product_id";
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
  <!--  Video Banner
  ======================================-->
  <div class="bgvid-container">
    <div class="vid-wrap">
      <video loop="true" autoplay="autoplay"  muted>
        <source src="video/bgvid.mp4" type="video/mp4">

      </video>
    </div>

    <div class="vid-overlay"></div>
    <div class="vid-text">
      <h2>MyZone.lk</h2>
      <p>No need to go for foreign sellers.<br> everything you want is now under one hood.</p>
    </div>
  </div>
  <!--  Video Banner End
  ======================================-->

  <!--ITEM -Section
    ===================================-->
  <div class="main-content container">
    <!--Section-Title-->
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-title">
          <h2>Today's Featured Collections</h2>
        </div>
      </div>
    </div>
    <!--Section-Title End-->

    <div class="row">
      <div class="item-main-container col-md-12">

        <div class="row">
          <!--1st row -->
          <!--Item-->
           <!--Item End-->
          <!--2nd row completed-->
        </div>



      </div>
    </div>
  </div>


  <!--Main content End-->

  <!--Footer
  ====================================================-->
  <?php require_once "includes/mainheader/footer.php"?>