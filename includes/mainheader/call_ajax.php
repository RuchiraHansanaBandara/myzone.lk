<?php include("../../functions/init.php"); ?>
<?php

$s1=$_REQUEST["n"];
$select_query="SELECT p.product_id, p.product_title, p.product_price, i.imagePath FROM products p, product_image i WHERE i.prodID=p.product_id AND p.product_title LIKE '%".$s1."%'";;
$sql=mysqli_query($conn,$select_query);
$s="";
if($sql === FALSE) { 
    die(mysqli_error()); // TODO: better error handling
}

if(mysqli_num_rows($sql)>0){
	while($row=mysqli_fetch_assoc($sql))
{
	$s=$s."
	<a class='link-p-colr' href='product.php?pid=".$row['product_id']."'>
		<div class='live-outer'>
            	<div class='live-im'>
                	<img src='product_img/".$row['imagePath']."'>
                </div>
                <div class='live-product-det'>
                	<div class='live-product-name'>
                    	<p>".$row['product_title']."</p>
                    </div>
                    <div class='live-product-price'>
						<div class='live-product-price-text'><p>Rs.".number_format($row['product_price'])."</p></div>
                    </div>
                </div>
            </div>
	</a>
	"	;
}
}else{
	echo "No Products Found!!";
}

echo $s;
?>