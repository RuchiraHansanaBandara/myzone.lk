<?php include("./functions/init.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="css/styleK.css">
    <!--Google fonts RaleWay-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="css/responsive.css">
    <!--Online Icon Library-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->


    <title>MyZone.lk-Home</title>

    <script>
        function lightbg_clr() {
            $('#qu').val("");
            $('#textbox-clr').text("");
            $('#search-layer').css({"width":"auto","height":"auto"});
            $('#livesearch').css({"display":"none"});
            $("#qu").focus();
        };

        function fx(str)
        {

            var s1=document.getElementById("qu").value;

            var xmlhttp;
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                document.getElementById("search-layer").style.width="auto";
                document.getElementById("search-layer").style.height="auto";
                document.getElementById("livesearch").style.display="block";
                $('#textbox-clr').text("");
                return;
            }
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if(xmlhttp.readyState==2){
                    //alert('dpdf');
                }

                if(xmlhttp.readyState==3){
                    //alert('3333');
                }

                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {

                    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
                    document.getElementById("search-layer").style.width="100%";
                    document.getElementById("search-layer").style.height="100%";
                    document.getElementById("livesearch").style.display="block";
                    $('#textbox-clr').text("X");




                }



            }
            xmlhttp.open("GET","includes/mainheader/call_ajax.php?n="+s1,true);
            xmlhttp.send();


        }

    </script>


</head>
<body>
<header>
    <div class="row">
        <nav class="col-md-12 nav-background">

            <div class="row ">
                <div class="col-md-12 upper-nav">

                    <div class="container">

                        <ul>
                            <li><a href="contactus.html">Contact Us</a></li>
                            <li><a href="Aboutus.html">About Us</a></li>
                            <?php if (logged_in()):?>
                                <li><a href="logout.php">Log out</a></li>
                            <?php endif; ?>
                            <li><a href="index.php">My Account</a></li>
                            <?php if (!logged_in()):?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Sign Up</a></li>
                            <?php endif;?>
                            <?php if (logged_in()):?>
                                <li><a href="admin/addproduct.php"><?php
                                        $user= $_SESSION['fName'];
                                        echo "$user";
                                        ?></a></li>
                            <?php endif; ?>
                        </ul>

                    </div>


                </div>
            </div>
            <div class="container ">
                <div class="row middle-row">

                    <div class=" col-2">
                        <div class="logo-div">
                            <a href="index.php"><img src="img/logo.png" alt="logo" class="logo"></a>
                        </div>
                    </div>

                    <div class=" col-8 nav-search">

                        <form action="search.php" method="get" >
                            <div class="input-group nav-search-input">
                                <input type="text" name="qu" id="qu" onKeyUp="fx(this.value)" autocomplete="off" class="form-control" placeholder="Search.." aria-label="Recipient's username with two button addons" aria-describedby="button-addon4" tabindex="1">

                                <div class="input-group-append" id="button-addon4">
                                    <button class="btn btn-outline-secondary btn-search" type="button">Real Time<i class="fas fa-caret-down down-arrow"></i></button>
                                    <button class="btn btn-outline-secondary btn-search-1" type="submit"><i class="fas fa-search"></i></button>
                                </div>

                                <div id="livesearch"></div><!--New Scroll -->

                            </div>
                        </form>
                        <!--<div id="search-layer"></div>-->
                    </div>

                    <div class=" col-2 nav-cart">

                        <a href="checkout.php"><button type="button" class="btn btn-sm btn-outline-secondary btn-cart"><p class="cart-text">My Cart &nbsp;</p><i class="fas fa-shopping-cart icon-big"></i><span>05</span> </button></a>

                    </div>

                </div>

            </div>
            <div class="row nav-bottom">

                <div class="container">
                    <div class="col-sm-12 nav-categories">
                        <ul>
                            <li><a href="Product.html">Phones</a></li>
                            <li><a href="Product.html">Cases</a></li>
                            <li><a href="Product.html">Adapters</a></li>
                            <li><a href="Product.html">Cables</a></li>
                            <li><a href="#">Audio</a></li>
                            <li><a href="#">Smart Watches</a></li>
                            <li><a href="#">microSD</a></li>
                            <li><a href="#">Batteries</a></li>

                        </ul>
                    </div>


                </div>
            </div>
        </nav>
    </div>

</header>