<?php
require_once "functions/cart.php";
echo"im excuted";

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
        echo $_SESSION['product_id'];
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


?>