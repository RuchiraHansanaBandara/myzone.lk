<?php 

$upload_directory = "uploads";

// helper functions


function last_id(){

global $conn;

return mysqli_insert_id($conn);


}

function escape_string($string){

global $conn;

return mysqli_real_escape_string($conn, $string);


}

/****************************login FUNCTIONS************************/



//include '../vendor/autoload.php';

/******************
Helper functions
 */

function clean($string){

    return htmlentities($string);

}

function redirect($location){
    return header("Location: {$location}");
}

function set_message($message){

    if(!empty($message)){

        $_SESSION['message'] = $message;
    }
    else{
        $message = "";
    }
}

function display_message(){
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator(){

    $token =  $_SESSION['token'] = md5(uniqid(mt_rand(),true));
    return $token;
}


function validation_errors($error_message){
    $error_message = <<<DELIMITER
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> $error_message
                            </div>
DELIMITER;
    return $error_message;
}

function email_exists($email){
    $sql = "select id from users where email='$email'";

    $result = query($sql);

    if(row_count($result)==1){
        return true;
    }
    else{
        return false;
    }
}

function username_exists($username){
    $sql = "select id from users where username='$username'";

    $result = query($sql);

    if(row_count($result)==1){
        return true;
    }
    else{
        return false;
    }
}// function username_exists

function send_mail($email, $subject,$msg, $headers){

    /*$mail = new PHPMailer(true);
    try {


        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp1.mailtrap.io';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '15fc903339680d';                 // SMTP username
        $mail->Password = '2c2551b4dd78c3';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 2525;

        $mail->setForm('mwdasun@gmail.com', 'dasun');
        $mail->addAddress('97machan@gmail.com');

        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }*/


    return mail($email, $subject,$msg, $headers);
}
/*******************
 *Validation functions
 */

function validate_user_registration(){

    $errors = [];

    $min = 3;
    $max = 20;


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $username = clean($_POST['username']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);

        if(strlen($first_name) < $min){
            $errors[] = "Your first name cannot be less than {$min} characters";
        }
        if(strlen($first_name) > $max){
            $errors[] = "Your first name cannot be more than {$max} characters";
        }


        if(strlen($last_name) < $min){
            $errors[] = "Your last name cannot be less than {$min} characters";
        }
        if(strlen($last_name) > $max){
            $errors[] = "Your Last name cannot be more than {$max} characters";
        }

        if(strlen($username) < $min){
            $errors[] = "Your username cannot be less than {$min} characters";
        }
        if(strlen($username) > $max){
            $errors[] = "Your username cannot be more than {$max} characters";
        }
        if(username_exists($username)){
            $errors[]="Sorry this username has taken";
        }
        if(email_exists($email)){
            $errors[]="Sorry this email already exsists";
        }

        if($password !== $confirm_password){
            $errors[] = "Your password fields do not match";
        }

        if(!empty($errors)){
            foreach ($errors as $error){
                    echo validation_errors($error);
            }// for loop
        }else{
            if(register_user($first_name,$last_name,$username,$email,$password)){

                set_message("<p class='bg-success text-center'>Please check your email for activation email </p>");
                redirect("index.php");
                echo "User registered";
            }else{
                set_message("<p class='bg-success text-center'>Sorry we could not register user </p>");
                redirect("index.php");
            }
        }//if else
    }// post request
}// function

/********* R4gister user ***********/
function register_user($first_name,$last_name,$username,$email,$password){

    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $username = escape($username);
    $email = escape($email);
    $password = escape($password);

    if(email_exists($email)){
        return false;
    }
    else if(username_exists($username)){
            return false;
    }
    else{
        $password = md5($password);

        $validation = md5($username. microtime());

        $sql="INSERT INTO users (first_name,last_name,username,email,password,validation_code,active) values ('$first_name','$last_name','$username','$email','$password','$validation',0)";
        $result = query($sql);

        $subject="Activate account";
        $msg="Please click the link below to activate your account
        http://localhost:63342/exercise-files/activate.php?email=$email&code=$validation
        ";

        $headers= "From: mwdasun@gmail.com";
        send_mail($email, $subject,$msg, $headers);

        return true;
    }

}// function register_user


/*************** Activate user *****************/

function activate_user(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['email'])){
            $email= clean($_GET['email']);

            $validation= clean($_GET['code']);

            $sql= "SELECT id from users where email ='".escape($_GET['email'])."' AND validation_code='".escape($_GET['code'])."' ";
            $result = query($sql);

            if(row_count($result)==1){

                $sql2 =" update users Set active = 1, validation_code = 0 where email ='".escape($email)."' AND validation_code='".escape($_GET['code'])."'";
                $result2 = query($sql2);
                confirm($result2);

                set_message("<p class='bg-success'>Your account has been activated please login</p>");
                redirect("index.php");

            }else{
                set_message("<p class='bg-danger'>Your account not been activated</p>");
                redirect("login.php");

            }

        }//if

    }
}// function activate user

/*************** validate user login*****************/
function validate_user_login()
{

    $errors = [];


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $remember = isset($_POST['remember']);

        if(empty($email)){
            $errors[]="Email field can not be empty";
        }

        if(empty($password)){
            $errors[]="Password field can not be empty";
        }

        if(!empty($errors)){

            foreach ($errors as $error){
                echo validation_errors($error);

            }// for loop
        }else{
            if(login_user($email, $password,$remember)){
                redirect("index.php");
            }
            else{
                echo validation_errors("Your creditionals are not correct");
            }
        }
    }

}// validate user login


/*************** user login*****************/

function login_user($email,$password,$remember){

    $sql= "SELECT password,id, first_name from users where email ='".escape($email)."'";
    $result = query($sql);

    if(row_count($result)==1){
        $row = fetch_array($result);
        $db_password = $row['password'];

        if(md5($password)== $db_password){

            if($remember == "on"){
                setcookie('email',$email,time()+86400);
            }
            $_SESSION['email'] = $email;
            $_SESSION['userId'] = $row['id'];
            $_SESSION['fName'] = $row['first_name'];
            return true;

        }else{
            return false;
        }

        return true;

    }else{

            return false;
    }

}// function login user

/***************loged in function*****************/

function logged_in(){
    if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
        return true;
    }else{
        return false;
    }
}// end of loged in function


/***************check activation function*****************/
function check_activation(){
    $sql= "SELECT password,id from users where email ='".escape($_SESSION['email'])."' And active = 1";
    $result = query($sql);

    if(row_count($result)==1){
        return true;
    }else{
        return false;
    }



}

/***************recover password function*****************/
function recover_password(){

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']) {
            $email = clean($_POST['email']);

            if (email_exists($email)) {

                $validation_code = md5($email . microtime());

                setcookie('temp_access_code', $validation_code, time() + 900);

                $sql = "update users set validation_code= '" . escape($validation_code) . "' where email = '" . escape($email) . "'";
                $result = query($sql);
                confirm($result);

                $subject = "Please reset your password";
                $message = "Here is your password reset code{$validation_code}
                Click here to reset your password http://localhost:63342/exercise-files/code.php?email=$email&code=$validation_code
                ";
                $headers = "From: mwdasun@gmail.com";

                if (!send_mail($email, $subject, $message, $headers)) {
                    echo validation_errors("This email could not sent");
                }

                set_message("<p class='bg-success text-center'> please check your email or spam folder for password reset code</p>");
                redirect("index.php");
            } else {
                echo validation_errors("This email does not exist");
            }
        }// token set
        else {

            redirect("index.php");
        }
        if(isset($_POST['cancel_submit'])){
            redirect('login.php');
        }
    }//post request

}// function recover password

/*********** Code validation ******************/
 function validate_code(){

    if(isset($_COOKIE['temp_access_code'])){
            if (!isset($_GET['email']) && !isset($_GET['code'])){
                redirect("index.php");

            }else if(empty($_GET['email']) || empty($_GET['code'])){
                redirect("index.php");
            }else{
                if (isset($_POST['code'])){

                    $email = clean($_GET['email']);
                    $validation_code = clean($_POST['code']);

                    $sql = "SELECT id FROM users where validation_code='".escape($validation_code)."' AND email = '".escape($email)."'";
                    $result = query($sql);

                    if(row_count($result) == 1) {

                        setcookie('temp_access_code', $validation_code, time() + 900);

                        redirect("reset.php?email=$email&code=$validation_code");

                    }else{

                        echo validation_errors("Sorry wrong with validation code");

                    }
                }
            }// set check// get method check
    }else{
        set_message("<p class='bg-danger text-center'>Your validation code was expired</p>");
        redirect("recover.php");
        echo "error";
    }



 }// validate code function




/*********** Password reset ******************/

function password_reset(){

    if (isset($_COOKIE['temp_access_code'])) {
        if (isset($_GET['email']) && isset($_GET['code'])) {
            if (isset($_SESSION['token']) && isset($_POST['token'])){
                if($_POST['token'] == $_SESSION['token']) {
                    if($_POST['password'] === $_POST['confirm_password'] ){

                        $updated_password = md5($_POST['password']);

                        $sql = "UPDATE users Set password = '".escape($updated_password)."', validation_code= 0 where email = '".escape($_GET['email'])."'";
                        query($sql);

                        set_message("<p class='bg-danger text-center'>Your Password has been reset Please log in</p>");
                        redirect('login.php');

                    }else{
                        echo validation_errors("Password fields don't match");
                    }
                }
            }
        }
    }else {
        set_message("<p class='bg-success text-center'>Sorry Your time has expired</p>");
        redirect('recover.php');
    }
}





/****************************FRONT END FUNCTIONS************************/


// get products


function get_products() {


$query = query(" SELECT * FROM products");
confirm($query);

while($row = fetch_array($query)) {

$product_image = display_image($row['product_image']);

if (logged_in()){
    $product = <<<DELIMETER

<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="functions/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
             <a class="btn btn-primary" target="_blank" href="functions/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>


       
    </div>
</div>

DELIMETER;
}else{
    $product = <<<DELIMETER

<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="functions/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
             <a class="btn btn-primary" target="_blank" href="login.php">Add to cart</a>
        </div>


       
    </div>
</div>

DELIMETER;
    set_message("<p class='alert-danger'>Please Login to your account before shop</p>");
}


echo $product;


		}


}


function get_categories(){


$query = query("SELECT * FROM categories");
confirm($query);

while($row = fetch_array($query)) {


$categories_links = <<<DELIMETER

<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>


DELIMETER;

echo $categories_links;

     }



}








function get_products_in_cat_page() {


$query = query(" SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " ");
confirm($query);

while($row = fetch_array($query)) {

$product_image = $row['product_image'];

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="product_img/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="functions/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


		}


}







function get_products_in_shop_page() {


$query = query(" SELECT * FROM products");
confirm($query);

while($row = fetch_array($query)) {

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


        }


}







function send_message() {

    if(isset($_POST['submit'])){ 

        $to          = "97machan@gmail.com";
        $from_name   =   $_POST['name'];
        $subject     =   $_POST['subject'];
        $email       =   $_POST['email'];
        $message     =   $_POST['message'];


        $headers = "From: {$from_name} {$email}";


        $result = mail($to, $subject, $message,$headers);

        if(!$result) {

            set_message("Sorry we could not send your message");
            redirect("contact.php");
        } else {

            set_message("Your Message has been sent");
            redirect("contact.php");
        }




    }




}



/****************************BACK END FUNCTIONS************************/
/*

function display_orders(){



$query = query("SELECT * FROM orders");
confirm($query);


while($row = fetch_array($query)) {


$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>




DELIMETER;

echo $orders;



    }



}




/************************ Admin Products Page ********************/

/*function display_image($picture) {

global $upload_directory;

return $upload_directory  . DS . $picture;



}





function get_products_in_admin(){


$query = query(" SELECT * FROM products");
confirm($query);

while($row = fetch_array($query)) {

$category = show_product_category_title($row['product_category_id']);

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER

        <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
        <a href="index.php?edit_product&id={$row['product_id']}"><img width='100' src="../../resources/{$product_image}" alt=""></a>
            </td>
            <td>{$category}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
             <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>

DELIMETER;

echo $product;


        }





}


function show_product_category_title($product_category_id){


$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
confirm($category_query);

while($category_row = fetch_array($category_query)) {

return $category_row['cat_title'];

}



}






/***************************Add Products in admin********************/

/*
function add_product() {


if(isset($_POST['publish'])) {


$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_FILES['file']['name']);
$image_temp_location    = escape_string($_FILES['file']['tmp_name']);

move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);


$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$short_desc}', '{$product_quantity}', '{$product_image}')");
$last_id = last_id();
confirm($query);
set_message("New Product with id {$last_id} was Added");
redirect("index.php?products");


        }


}

function show_categories_add_product_page(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = fetch_array($query)) {


        $categories_options = <<<DELIMETER

        <option value="{$row['cat_id']}">{$row['cat_title']}</option>


DELIMETER;

        echo $categories_options;

     }
}



/***************************updating product code ***********************/
/*
function update_product() {


if(isset($_POST['update'])) {


$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_FILES['file']['name']);
$image_temp_location    = escape_string($_FILES['file']['tmp_name']);


if(empty($product_image)) {

$get_pic = query("SELECT product_image FROM product WHERE product_id =" .escape_string($_GET['id']). " ");
confirm($get_pic);

while($pic = fetch_array($get_pic)) {

$product_image = $pic['product_image'];

    }

}



move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);


$query = "UPDATE product SET ";
$query .= "product_title            = '{$product_title}'        , ";
$query .= "product_category_id      = '{$product_category_id}'  , ";
$query .= "product_price            = '{$product_price}'        , ";
$query .= "product_description      = '{$product_description}'  , ";
$query .= "short_desc               = '{$short_desc}'           , ";
$query .= "product_quantity         = '{$product_quantity}'     , ";
$query .= "product_image            = '{$product_image}'          ";
$query .= "WHERE product_id=" . escape_string($_GET['id']);





$send_update_query = query($query);
confirm($send_update_query);
set_message("Product has been updated");
redirect("index.php?products");


        }


}

/*************************Categories in admin ********************/

/*
function show_categories_in_admin() {


$category_query = query("SELECT * FROM categories");
confirm($category_query);


while($row = fetch_array($category_query)) {

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];


$category = <<<DELIMETER


<tr>
    <td>{$cat_id}</td>
    <td>{$cat_title}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>



DELIMETER;

echo $category;



    }



}


function add_category() {

if(isset($_POST['add_category'])) {
$cat_title = escape_string($_POST['cat_title']);

if(empty($cat_title) || $cat_title == " ") {

echo "<p class='bg-danger'>THIS CANNOT BE EMPTY</p>";


} else {


$insert_cat = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
confirm($insert_cat);
set_message("Category Created");



    }


    }




}

 /************************admin users***********************/

/*

function display_users() {


$category_query = query("SELECT * FROM users");
confirm($category_query);


while($row = fetch_array($category_query)) {

$user_id = $row['user_id'];
$username = $row['username'];
$email = $row['email'];
$password = $row['password'];

$user = <<<DELIMETER


<tr>
    <td>{$user_id}</td>
    <td>{$username}</td>
     <td>{$email}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>



DELIMETER;

echo $user;



    }



}


function add_user() {


if(isset($_POST['add_user'])) {


$username   = escape_string($_POST['username']);
$email      = escape_string($_POST['email']);
$password   = escape_string($_POST['password']);
// $user_photo = escape_string($_FILES['file']['name']);
// $photo_temp = escape_string($_FILES['file']['tmp_name']);


// move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);


$query = query("INSERT INTO users(username,email,password) VALUES('{$username}','{$email}','{$password}')");
confirm($query);

set_message("USER CREATED");

redirect("index.php?users");



}



}





function get_reports(){


$query = query(" SELECT * FROM reports");
confirm($query);

while($row = fetch_array($query)) {


$report = <<<DELIMETER

        <tr>
             <td>{$row['report_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_title']}
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>

DELIMETER;

echo $report;


        }





}*/












 ?>