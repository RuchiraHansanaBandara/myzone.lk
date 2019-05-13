<?php require_once("init.php"); ?>

<?php

?>




<?php 


  if(isset($_GET['add'])) {

    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)) {


      if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {

        $_SESSION['product_' . $_GET['add']]+=1;
        redirect("../checkout.php");


      } else {


        set_message("We only have " . $row['product_quantity'] . " " . "{$row['product_title']}" . " available");
        redirect("../checkout.php");



      }






    }



  // $_SESSION['product_' . $_GET['add']] +=1;

  // redirect("index.php");


  }


  if(isset($_GET['remove'])) {

    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1) {

      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect("../checkout.php");

    } else {

      redirect("../checkout.php");

     }


  }


 if(isset($_GET['delete'])) { 

  $_SESSION['product_' . $_GET['delete']] = '0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);

  redirect("../checkout.php");


 }

function cart_update(){

}


function cart() {
          $total = 0;
          $item_quantity = 0;
          $item_name = 1;
          $item_number =1;
          $amount = 1;
          $quantity =1;
          foreach ($_SESSION as $name => $value) {

              if($value > 0 ) {

                  if(substr($name, 0, 8 ) == "product_") {


                      $length = strlen($name . 8);

                      $id = substr($name, 8 , $length);


                      $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
                      confirm($query);

                      $queryi = query("SELECT imagePath From product_image where prodID ='".escape($id)."'");
                      confirm($queryi);

                      while($row = fetch_array($query)) {

                          $sub = $row['product_price']*$value;
                          $item_quantity +=$value;

                          $rows = fetch_array($queryi);

                          $product_image = $rows['imagePath'];

                          $product = <<<DELIMETER

<tr>
  <td>

  <img width='100' src='product_img/{$product_image}'>

  </td>
  <td>{$row['product_title']}</td>
  <td style="text-align: right;">{$value}&nbsp;&nbsp;<a class='btn btn-sm btn-warning' href="functions/cart.php?remove={$row['product_id']}"><i class="fas fa-minus"></i></a>&nbsp;<a class='btn btn-sm btn-success' href="functions/cart.php?add={$row['product_id']}"><i class="fas fa-plus"></i></a></td>
  <td style="text-align: right;">&#36;{$sub}</td>
<td style="text-align: right;"><a class='btn btn-sm btn-danger' href="functions/cart.php?delete={$row['product_id']}"><i class="fas fa-trash-alt"></i></span></a></td>        
  </tr>

<input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
<input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
<input type="hidden" name="quantity_{$quantity}" value="{$value}">


DELIMETER;

                          echo $product;

                          $item_name++;
                          $item_number++;
                          $amount++;
                          $quantity++;



                      }


                      $_SESSION['item_total'] = $total += $sub;
                      $_SESSION['item_quantity'] = $item_quantity;
                      $_SESSION['buy_items']= $value;
                    

                  }

              }

          }

}


function show_paypal() {


if(isset($_SESSION['buy_items']) && $_SESSION['buy_items'] >= 1) {

/*
$paypal_button = <<<DELIMETER

    <input type="image" name="upload" border="0"
src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
alt="PayPal - The safer, easier way to pay online">


DELIMETER;*/

$paypal_button = <<<DELIMETER
<div id="paypal-button-container"></div>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script>
            // Render the PayPal button
            paypal.Button.render({
// Set your environment
                env: 'sandbox', // sandbox | production

// Specify the style of the button
                style: {
                    layout: 'vertical',  // horizontal | vertical
                    size:   'medium',    // medium | large | responsive
                    shape:  'rect',      // pill | rect
                    color:  'gold'       // gold | blue | silver | white | black
                },

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
                funding: {
                    allowed: [
                        paypal.FUNDING.CARD,
                        paypal.FUNDING.CREDIT
                    ],
                    disallowed: []
                },

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
                client: {
                    sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                    production: '<insert production client id>'
                },

                payment: function (data, actions) {
                    return actions.payment.create({
                        payment: {
                            transactions: [
                                {
                                    amount: {
                                        total: '0.01',
                                        currency: 'USD'
                                    }
                                }
                            ]
                        }
                    });
                },

                onAuthorize: function (data, actions) {
                    return actions.payment.execute()
                        .then(function () {
                            window.alert('Payment Complete!');
                        });
                }
            }, '#paypal-button-container');
        </script>
DELIMETER;
return $paypal_button;

  }


}

function show_wishlist(){

      if(isset($_SESSION['buy_items']) && $_SESSION['buy_items']){
          $wishlist_button = <<<DELIMETER
<div class="row justify-content-center">
    <button type="submit" class="btn btn-success wishlistBtn" name="save_database" border="0" 
><i class="fas fa-heart"></i>Add to wishlist</button></div>



DELIMETER;

          return $wishlist_button;
      }
}

function quite(){
    echo"im excuted";
    foreach ($_SESSION as $name => $value) {

        if($value > 0 ) {
        
        if(substr($name, 0, 8 ) == "product_") {
        
        $length = strlen($name - 8);
        $id = substr($name, 8 , $length);
        
        
        //$send_order = query("INSERT INTO orders (order_amount, order_transaction, order_currency, order_status ) VALUES('{$amount}', '{$transaction}','{$currency}','{$status}')");
        //$last_id =last_id();
        //confirm($send_order);
        
        
        
        //$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
        //confirm($query);
        while($row = fetch_array($query)) {
        $product_price = $row['product_price'];
        $product_title = $row['product_title'];
        $sub = $row['product_price']*$value;
        $item_quantity +=$value;
        
        
        $insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
        confirm($insert_report);
        
        }
        
        
        $total += $sub;
        echo $item_quantity;
        
        
                   }
        
              }
         
            }

}


function process_transaction() {



if(isset($_GET['tx'])) {

$amount = $_GET['amt'];
$currency = $_GET['cc'];
$transaction = $_GET['tx'];
$status = $_GET['st'];
$total = 0;
$item_quantity = 0;

foreach ($_SESSION as $name => $value) {

if($value > 0 ) {

if(substr($name, 0, 8 ) == "product_") {

$length = strlen($name - 8);
$id = substr($name, 8 , $length);


//$send_order = query("INSERT INTO orders (order_amount, order_transaction, order_currency, order_status ) VALUES('{$amount}', '{$transaction}','{$currency}','{$status}')");
//$last_id =last_id();
//confirm($send_order);



$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
//confirm($query);
while($row = fetch_array($query)) {
$product_price = $row['product_price'];
$product_title = $row['product_title'];
$sub = $row['product_price']*$value;
$item_quantity +=$value;


$insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
confirm($insert_report);

}


$total += $sub;
echo $item_quantity;


           }

      }
 
    }

session_destroy();
  } else {


redirect("index.php");


}



}




















 ?>