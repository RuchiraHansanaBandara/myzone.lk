<?php
/**
 * Created by PhpStorm.
 * User: Kamal
 * Date: 10/4/2018
 * Time: 2:09 AM
 */
?>

<?php
    require_once('include/adminheader.php');



?>

<!--=====================================================
Custom content page - body - Referencing (adminheader.php)
=========================================================-->

<div class="main_content col-lg-10 col-md-12 col-sm-12 ">

    <!--Profile-->
    <?php

        if(isset($_POST['update'])){

            $fname=$_POST['first_name'];
            $lname=$_POST['last_name'];
            $email=$_POST['email'];
            $ad1=$_POST['ad1'];
            $ad2=$_POST['ad2'];
            $city=$_POST['city'];

            $sqlup="UPDATE users SET first_name='{$fname}', last_name='{$lname}', email='{$email}',addrLine1='{$ad1}', addrLine2='{$ad2}', addrCity='{$city}' WHERE id=3";
            $resultup=$conn->query($sqlup);

            if($resultup){


                echo '
                    <div class="alert alert-success" role="alert">
                              Data Entered Successfully!!
                    </div>
                ';
            }else{
                echo "Something went wrong!";
            }

        }


        $sql="SELECT * FROM users  WHERE id= 1";
        $result=$conn->query($sql);

        if($sql === FALSE) {
            die(mysqli_error()); // TODO: better error handling

        }
        if($result->num_rows>0){
            while($rows=$result->fetch_assoc()){
                echo '
                <form method="post" action="profile.php">
                
                        <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-10"><h1>'.$rows['first_name'].'</h1></div>
            <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->


                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                    <h6>Upload a different photo...</h6>
                    <input type="file" class="text-center center-block file-upload">
                </div></hr><br>




            </div><!--/col-3-->
            <div class="col-sm-9">


                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <form class="form" action="##" method="post" id="registrationForm">
                            <div class="form-group">

                                <div class="col-6">
                                    <label for="first_name"><h4>First name</h4></label>
                                    <input type="text" value="'.$rows['first_name'].'" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-6">
                                    <label for="last_name"><h4>Last name</h4></label>
                                    <input type="text" value="'.$rows['last_name'].'" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                                </div>
                            </div>

                     

                            <div class="form-group">

                                <div class="col-6">
                                    <label for="email"><h4>Email</h4></label>
                                    <input type="email" value="'.$rows['email'].'" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-6">
                                    <label for="ad1"><h4>Address Line 1</h4></label>
                                    <input type="text" value="'.$rows['addrLine1'].'" class="form-control" id="ad1" name="ad1" title="enter a location">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-6">
                                    <label for="ad2"><h4>Address Line 2</h4></label>
                                    <input type="text" value="'.$rows['addrLine2'].'" class="form-control" name="ad2" id="ad2"  title="enter your password.">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-6">
                                    <label for="city"><h4>City</h4></label>
                                    <input type="text" value="'.$rows['addrCity'].'" class="form-control" name="city" id="city"  title="enter your password2.">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <br>
                                    <button name="update" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
                                    
                                </div>
                            </div>
                        </form>

                        <hr>

                    
            </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</form>
                    
                ';
            }
        }

    ?>


    <!--Profile END-->

</div><!--Main content end-->
<!--END-Custom page content-->
</div>
</div>
</div>
</div><!--End PAGE CONTENT-->
</div>
<!--End NEW Structure-->


<script>
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="../js/admin.js"></script>
</body>
</html>
