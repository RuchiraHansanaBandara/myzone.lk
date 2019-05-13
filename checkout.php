
<?php require_once "includes/mainheader/header.php"?>



    <!-- Page Content -->
    <div class="container">


<!-- /.row -->
        <div class="jumbotron jumbotron-fluid text-center">
            <div class="container">
                <h1>My Cart</h1>
            </div>
        </div>
        <!--<div class="row">-->
      <h4 class="text-center bg-danger"><?php display_message(); ?></h4>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="dasunpriyankara98@gmail.com">
<input type="hidden" name="currency_code" value="US">
    <table class="table table-striped" id="myTable">
        <thead>
        <tr>
            <th scope="col"> </th>
            <th scope="col">Product</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-right">Item Price</th>
            <th scope="col" class="text-right"> Remove Items</th>
        </tr>
        </thead>
        <tbody>
        <?php cart(); ?>
        </tbody>

        <tr class="cart-subtotal">
            <td></td>
            <td></td>
            <td></td>
            <th style="text-align: right">Items:</th>
            <td style="text-align: right"><span class="amount"><?php
                    echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";?></span></td>
        </tr>
        <tr class="shipping">
            <td></td>
            <td></td>
            <td></td>
            <th style="text-align: right">Shipping</th>
            <td style="text-align: right">Free Shipping</td>
        </tr>

        <tr class="order-total">
            <td></td>
            <td></td>
            <td></td>
            <th style="text-align: right">Order Total</th>
            <td style="text-align: right"><strong><span class="amount">&#36;<?php
                        echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";?>



</span></strong> </td>
        </tr>
    </table>
  <?php echo show_paypal(); ?>
</form>

    <form action="wishlist.php">
        <?php echo show_wishlist(); ?>
    </form>





 <!--</div>--><!--Main Content-->


    </div>
    <!-- /.container -->


<?php require_once "includes/mainheader/footer.php"; ?>
