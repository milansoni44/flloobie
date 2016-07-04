	<!-- body content starts -->
    <div class="section">
        <div class="container">
            <div class="row review_listing">
                <h3 style="padding-left:15px;">Review Your Listing</h3>
                <hr style="width:100%;">
                <?php
                    if($listing->listing_type == 'paid'){
                ?>
                <form class="form-horizontal" role="form" method="post" action="<?php echo $this->config->item('posturl'); ?>">
                <?php
                    }else{
                ?>
                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>index.php/listings/order_summary_free">
                <?php
                    }
                ?>
                    <table style="width:30%;margin-left:100px;cellpadding:0 cellspacing:0" class="table borderless">
                        <tr>
                            <td><label for="category">Category</label></td>
                            <td><?php echo ucfirst($listing->category_name); ?> <?php if(!empty($listing->sub_category_name)){ echo ucfirst($listing->sub_category_name); }?></td>
                        </tr>
                        <tr>
                            <td><label for="title">Title</label></td>
                            <td><?php echo ucfirst($listing->listing_name); ?></td>
                        </tr>
                        <tr>
                            <td><label for="price">Price</label></td>
                            <td><?php echo $listing->price; ?></td>
                        </tr>
                        <tr>
                            <td><label for="discription">Discription</label></td>
                            <td><?php echo ucfirst($listing->listing_description); ?></td>
                        </tr>
                        <tr>
                            <td><label for="category">Preferred Contact Method</label></td>
                            <td> <?php echo $listing->preferred_contact_method; ?></td>
                        </tr>
                        <tr>
                            <td><label for="phone">Phone</label></td>
                            <td><?php echo $listing->phone; echo form_input($phone); ?></td>
                        </tr>
                        <tr>
                            <td><label for="category">Street</label></td>
                            <td><?php echo $listing->city; echo form_input($city); ?></td>
                        </tr>
                        <tr>
                            <td><label for="title">Country</label></td>
                            <td><?php echo $listing->country; echo form_input($country); ?></td>
                        </tr>
                        <tr>
                            <td><label for="category">Zip/Postal code</label></td>
                            <td><?php echo $listing->pincode; echo form_input($pincode); ?></td>
                        </tr>
                        <tr>
                            <td><label for="title">Tag</label></td>
                            <td><?php echo $listing->slug; ?></td>
                        </tr>
                        <tr>
                            <td><label for="title">Ad Listing Fee</label></td>
                            <td>
                                <?php if($listing->listing_type == 'paid'){ echo '$'.$list_price; echo form_input($price); }else{ echo '0'; echo form_input($price); } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="title">Total Amount Due</label></td>
                            <td> 
                                <?php if($listing->listing_type == 'paid'){ echo '$'.$list_price; echo form_input($price); }else{ echo '0'; echo form_input($price); } ?>
                            </td>
                        </tr>
                        <input type="hidden" name="upload" value="1" />
                        <input type="hidden" name="return" value="<?php echo $this->config->item('returnurl'); ?>" />
                        <input type="hidden" name="cmd" value="_cart" />
                        <input type="hidden" name="business" value="<?php echo $this->config->item('business'); ?>" />
                        
                        <?php echo form_input($title); ?>
                        <?php echo form_input($listing_id); ?>
                        <?php echo form_input($price); ?>
                        <input type="hidden" name="quantity_1" value="1" />
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-primary">Continue</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div><!-- container closed here  -->
    </div><!-- section closed here  -->