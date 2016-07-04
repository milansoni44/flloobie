	<!-- body content starts -->
    <div class="section">
        <div class="container">
            <div class="row review_listing">
                    <h3 style="padding-left:15px;">Order Summary</h3>
                    <hr style="width:100%;">
              <form class="form-horizontal" role="form">
                  <table style="width:35%;margin-left:100px;cellpadding:0 cellspacing:0" class="table borderless">
                    <tr>
                        <td>Transaction Id:</td>
                        <td><?php echo $success['txn_id']; ?></td>
                    </tr>
                    <?php
                        foreach($success['listProducts'] as $product){
                    ?>
                    <tr>
                        <td>Ad For Product : </td>
                        <td><?php echo ucfirst($product['item_name']); ?></td>
                    </tr>
                    <tr>
                        <td>Free unless Featured : </td>
                        <td><?php echo '$'.$product['mc_gross']; ?></td>
                    </tr>
                    <tr>
                        <td>Total: </td>
                        <td><?php echo '$'.$success['mc_gross']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td>
                            <p>Thank you for your purchase!</p>
                            <p>Your order has been completed!</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">View Ad Listing</button>
                        </td>
                    </tr>
                </table>
             </form>
         </div>
        </div><!-- container closed here  -->
    </div><!-- section closed here  -->