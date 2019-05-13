<?php
    include_once ("includes/mainheader/header.php");
?>
    <script>
        $(document).ready(function(){
            $count=0;
            $("#leftarrow").click(function(){
                if($count>0)
                {
                    $count--;
                    $("#counter").text($count);
                }
            });
            $("#leftarrow").mousedown(function(){
                $("#leftarrow").css("BoxShadow","0px 0px 0px gray");
            });
            $("#leftarrow").mouseup(function(){
                $("#leftarrow").css("BoxShadow","0px 2px 1px gray");
            });
            $("#rightarrow").click(function(){
                if($count<10)
                {
                    $count++;
                    $("#counter").text($count);
                }
            });
            $("#rightarrow").mousedown(function(){
                $("#rightarrow").css("BoxShadow","0px 0px 0px gray");
            });
            $("#rightarrow").mouseup(function(){
                $("#rightarrow").css("BoxShadow","0px 2px 1px gray");
            });
        });
    </script>



 
<!--Main Content
==================================================-->
<!--Product preview
  ====================================================-->
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-9 product-card">
            <div class="col-md-4 image">
                <div class="col-md-12" style="padding-top: 20px;">
                    <?php
                        $prodID=$_GET['pid'];
                        $sql="SELECT p.product_id,p.product_price,p.product_description,p.product_title,i.imagePath FROM products p, product_image i WHERE p.product_id = i.prodID AND product_id=$prodID";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($rows=$result->fetch_assoc()){
                                echo '
                                    
                                    <img width="100%"  id="imgp1" src="product_img/'.$rows['imagePath'].'" alt="Product preview" >
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div id="prod1" class="col-md-4 product-min"><img width="100%" height="auto" src="img/item/19.jpg"></div>
                    <div  id="prod2" class="col-md-4 product-min"><img width="100%" height="auto" src="img/item/20.jpg"></div>
                    <div id="prod3" class="col-md-4 product-min"><img width="100%" height="auto" src="img/item/21.jpg"></div>
                </div>


            </div>
            <div class="col-md-8 info">
                <div class="product-right">



                    <h6>'.$rows['product_title'].'</h6>
                    <span class="desc">Ratings</span>
                    <span class="rate"><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star"></ion-icon><ion-icon name="star-half"></ion-icon><ion-icon name="star-outline"></ion-icon></span>

                    <hr>

                    <div class="detail">

                        Price  :  <span class="price">LKR '.$rows['product_price'].'</span><span class=piece>/piece</span>  <br>


                        <br>
                        <br>
                        Shipping :<span class="ship">   Free Shipping to Sri Lanka via Sri lankan postal service<br>
                                  <span class=time>Estimated Delivery Time:3-4days</span>
                                  </span>


                    </div>
                               
                               
                    <div class="detail">Quantity:</div>
                    <div id="clicker">
                        <div id="leftarrow">&#9668;</div>
                        <div id="counter">0</div>
                        <div id="rightarrow">&#9658;</div>
                    </div>

                    <br><br>


                    <a class="add-to-cart first" href="functions/cart.php?add='.$rows['product_id'].'"><span>Add to cart</span><i class="margincart fas fa-shopping-cart"></i></a>           
                                    
                                ';
                            }
                        }else{
                            echo"heloo";
                        }
                    ?>









                </div>
            </div>
        </div>
        <div class="col-md-3 product-popular">
            <div class="col-md-12 product-ti">
                <h2>PROMOTE YOUR BRAND NAME</h2>
            </div>
            <div class="col-md-12 item-wrap-main">
                <div class="item-wrap">
                    <div class="item-image relcss">
                        <a href="#"><img class="item-image-itself" src="img/item/123.jpg" alt="Tempered"></a>
                    </div>
                    <div class="poduct-desc-overlay"></div>
                    <div class="item-description-1 absolutecss">
                        <div class="item-title-prod"><h3>Contact Us for more details!</h3></div>


                    </div>
                </div>
            </div>
        </div>

        <br>

    </div>
</div>
<br>
<hr>
<br>


<!--newly added items
  ====================================================-->

<div class="container">
    <div class="row">
        <div class="col-md-12 product-card">
            <h4>You may also like</h4>


            <!--ITEM -Section
===================================-->
            <div class="row">
                <div class="item-main-container col-md-12">

                    <div class="row">
                        <!--1st row -->
                        <!--Item-->
                        <div class="col-md-3 item-wrap-main">
                            <div class="item-wrap">
                                <div class="item-image">
                                    <a href="#"><img class="item-image-itself" src="img/item/1.jpg" alt="Tempered"></a>
                                </div>

                                <div class="item-description">
                                    <div class="item-title"><h3><a href="#">Product1</a></h3></div>
                                    <div class="item-price"><del>Rs.78,000</del> <ins>Rs.50,900</ins></div>
                                    <div class="item-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div> <!--Item End-->

                        <!--Item-->
                        <div class="col-md-3">
                            <div class="item-wrap">
                                <div class="item-image">
                                    <a href="#"><img class="item-image-itself" src="img/item/17.jpg" alt="Tempered"></a>
                                </div>

                                <div class="item-description">
                                    <div class="item-title"><h3><a href="#">Product2</a></h3></div>
                                    <div class="item-price"><del>Rs.78,000</del> <ins>Rs.50,900</ins></div>
                                    <div class="item-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div> <!--Item End-->

                        <!--Item-->
                        <div class="col-md-3">
                            <div class="item-wrap">
                                <div class="item-image">
                                    <a href="#"><img class="item-image-itself" src="img/item/16.jpg" alt="Tempered"></a>
                                </div>

                                <div class="item-description">
                                    <div class="item-title"><h3><a href="#">Product3</a></h3></div>
                                    <div class="item-price"><del>Rs.78,000</del> <ins>Rs.50,900</ins></div>
                                    <div class="item-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div> <!--Item End-->

                        <!--Item-->
                        <div class="col-md-3">
                            <div class="item-wrap">
                                <div class="item-image">
                                    <a href="#"><img class="item-image-itself" src="img/item/15.jpg" alt="Tempered"></a>
                                </div>

                                <div class="item-description">
                                    <div class="item-title"><h3><a href="#">Product4</a></h3></div>
                                    <div class="item-price"><del>Rs.78,000</del> <ins>Rs.50,900</ins></div>
                                    <div class="item-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div> <!--Item End-->
                        <!--1st row completed-->




                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
            <br>
            <hr>
            <br>





<!--Main content End-->

<!--Footer
  ====================================================-->
  <?php require_once "includes/mainheader/footer.php"?>