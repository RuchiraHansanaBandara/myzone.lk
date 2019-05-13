<?php
$title = "Admin";
include 'includes/mainheader/header.php'?>

<?php
    redirect("admin_panel/admin/addproduct.php")
?>

<div class="jumbotron">
		<h1 class="text-center"><?php if(logged_in()) {
		    echo "Logged in";
            }
            else{
		    redirect("index.php");
            }?></h1>
	</div>





<?php  include 'includes/mainheader/footer.php'?>
