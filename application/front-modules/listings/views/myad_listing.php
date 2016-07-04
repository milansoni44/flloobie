	<script>
        $(document).ready(function(){
            $('#save_value').click(function(){
                var val = [];
                var str;
                $(':checkbox:checked').each(function(i){
                  val[i] = $(this).val();
                });
                str = val.toString();
                if(str == ''){
                    $('#error').html('<div class="alert alert-block alert-danger fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>Please select the status</div>');
                    return false;
                }else{
                    $('#error').html('');
                    var formData =  {
                        'status'      : str,
                    };
                    // console.log(formData);
                    
                    // process the form data
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/listings/getTransactions",
                        type: 'POST',
                        data: formData,
                        success: function(data) {
                            var txn = $.parseJSON(data);
                            // console.log(data);
                            var html = '<table class="table" id="transaction"><tr><th>ID</th><th>Date</th><th>Order Summary</th><th>Price</th><th>Payment/Status</th></tr>';
                            $.each(txn, function (index, value) {
                                html += '<tr><td>#'+value.transaction_id+'</td><td>'+value.transaction_date+'</td><td>'+value.listing_name+'</td><td>$'+value.amount_paid+'</td><td>'+value.status+'</td></tr>';
                            });
                            html += '</table>';
                            $('#transaction').html(html);
                        }
                    });
                }
            });
        })
    </script>
    <script type="text/javascript">
        // When the browser is ready...
          $(function() {
            // Setup form validation on the #register-form element
            $("#register-form").validate({
                // Specify the validation rules
                rules: {
                    fname: "required",
                    lname: "required",
                    email: {
                            required: true,
                            email: true,
                        },
                    // description: "required",
                    phone: {
                        required: true,
                        number: true,
                    },
                    city: "required",
                    state: "required",
                    zip: {
                        required: true,
                        number: true,
                    },
                    country: "required",
                    // zip: {
                        // required: true,
                        // number: true,
                    // },
                    // tag: "required",
                    // google_map: "required",
                    profile: {
                        accept: "image/*",
                    },
                    // listing_type: "required",
                    // email: {
                        // required: true,
                        // email: true
                    // },
                    // password: {
                        // required: true,
                        // minlength: 5
                    // },
                    // agree: "required"
                },
                
                // Specify the validation error messages
                messages: {
                    fname: "First Name is required.",
                    lname: "Please enter your last name.",
                    email: {
                        required: "Please Enter email.",
                        email: "Please enter valid email.",
                    },
                    phone: {
                        required: "Please Enter phone.",
                        number: "Please Enter only number in phone.",
                    },
                    city: "City is required",
                    state: "State is required",
                    zip: {
                        required: "Zip is required",
                        number: "Please enter only numbers",
                    },
                    country: "Please Enter your country",
                    // zip: {
                        // required: "Please enter zip/postal code",
                        // number: "Only numbers allowed.",
                    // },
                    // tag: "Please enter tag.",
                    // google_map: "Please enter google map iframe",
                    profile: {
                        accept: "Only images allowed.",
                    },
                    // listing_type: "Please select appropriate listing type.",
                    // password: {
                        // required: "Please provide a password",
                        // minlength: "Your password must be at least 5 characters long"
                    // },
                    // email: "Please enter a valid email address",
                    // agree: "Please accept our policy"
                },
                
                submitHandler: function(form) {
                    form.submit();
                }
            });

          });
    </script>
    <!-- body content starts -->
    <div class="section">
        <div class="container">
            <div class="row review_listing">
                <?php 
                    if($this->session->flashdata('success')){
                ?>
                <div class="alert alert-block alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php
                    }
                ?>
                <div class="col-md-12 recentTitle1">
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#myad">My Ad</a></li>
                    <li><a data-toggle="tab" href="#myorder">My Order</a></li>
                    <li><a data-toggle="tab" href="#editprofile">Edit Profile</a></li>
                    <li><a data-toggle="tab" href="#accountstastics">Account Stastics</a></li>
                  </ul>

                  <div class="tab-content">
                    <div id="myad" class="tab-pane fade active in">
                        <table class="table" width="100%" id="listing_table">
                            <tr>
                                <th width="60%" style="border-top:none">
                                    Title
                                </th>
                                <th width="10%">
                                    View
                                </th>
                                <th width="15%">
                                    Status
                                </th>
                                <th width="15%">
                                    Option
                                </th>
                            </tr>

                            <?php
                                if(!empty($listings)){
                                    foreach($listings as $row){
                            ?>
                            <tr>
                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $row->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/uploads/listing/<?php echo $row->listing_image; ?>" alt="img1" class="img-responsive" width="10%" align="left" />

                                    <span id="listingg"><?php echo ucfirst($row->listing_name); ?><br></span>
                                    <!--<span id="listingg">Help wanted December 1,	2015</span>--></a>
                                </td>
                                <td>
                                    <?php echo $row->views; ?>
                                </td>
                                <td>
                                    Live <br>(January<br> 15, 2016<br> 5:33 am)
                                </td>
                                <td>
									<table width="70%" border="0">
										<tr>
											<td align="center">
												<span id="edit"><a href="<?php echo base_url(); ?>index.php/listings/edit_listing/<?php echo $row->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/img/pencil.png" alt="img1" class="img-responsive"  /></a></span>
											</td>
											<td align="center">
												<span id="cross"><a href="<?php echo base_url(); ?>index.php/listings/delete/<?php echo $row->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/img/crosssign.png" alt="img1" class="img-responsive" /></a></span>
											</td>
											<td align="center">
                                                <?php 
                                                    if($this->listings_model->getPauseItem($row->slug)){
                                                ?>
                                                <a href="<?php echo base_url(); ?>index.php/listings/unpause/<?php echo $row->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/img/play.png" alt="img1" class="img-responsive" /></a>
                                                <?php
                                                    }else{
                                                ?>
												<a href="<?php echo base_url(); ?>index.php/listings/pause/<?php echo $row->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/img/pausesign.png" alt="img1" class="img-responsive" /></a>
                                                <?php
                                                    }
                                                ?>
											</td>
										</tr>
										<tr>
											<td colspan="3">
												<?php if($this->listings_model->getSoldItem($row->slug)){?>
                                                    <a href="<?php echo base_url(); ?>index.php/listings/unsold/<?php echo $row->slug; ?>">Mark Unsold</a>
                                                <?php }else{?>
                                                    <a href="<?php echo base_url(); ?>index.php/listings/sold/<?php echo $row->slug; ?>">Mark Sold</a>
                                                <?php }?>
											</td>
										</tr>
									</table>
                                </td>

                            </tr>

                            <?php

                                    }

                                }

                            ?>

                        </table>
                      </div>
                    
                    <div id="myorder" class="tab-pane fade">
                        <table style="width:100%;" class="table"> 
                            <tr>
                                <div id="error"></div>
                                <td style="border:none;">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="status[]" value="pending" class="checkbox">Pending</label>
                                        <label><input type="checkbox" name="status[]" value="failed" class="checkbox">Failed</label>
                                        <label><input type="checkbox" name="status[]" value="completed" class="checkbox">Completed</label>
                                        <label><input type="checkbox" name="status[]" value="activated" class="checkbox">Activated</label>
                                        <button id="save_value">Search</button>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background:#ccc">
                                <td>
                                    <table class="table borderless" style="background:#ccc;cellpadding:0; cellspacing:0">
                                        <tr><td><strong>Pending	</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order not processed.</tr></td>
                                        <tr><td><strong>Failed </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order failed or manually cancelled.</tr></td>
                                        <tr><td><strong>Completed</strong>&nbsp;&nbsp;&nbsp;&nbsp;Order processed successfully but pending moderation before activation.</tr></td>
                                        <tr><td><strong>Activated</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Order processed successfully and activatedM.</tr></td>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table" id="transaction">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Order Summary       
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Payment/Status
                                            </th>
                                        </tr>
                                        <?php if(!empty($transactions)){
                                            foreach($transactions as $rt){
                                        ?>
                                        <tr>
                                            <td>#<?php echo $rt->transaction_id; ?></td>
                                            <td><?php echo date('jS F Y',strtotime($rt->transaction_date)); ?></td>
                                            <td><?php echo $rt->listing_name; ?><?php if($rt->amount_paid == 0){?><br/>(free)<?php }else{?> <br/>(Featured)<?php }?></td>
                                            <td>$<?php echo $rt->amount_paid; ?></td>
                                            <td><?php echo ucfirst($rt->status); ?></td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="editprofile" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 editprofile">
                                <span><strong>Edit Profile</strong></span>
                            </div>
                        </div>
                        <div class="maintable">
                            <form  method="post" action="<?php echo base_url(); ?>index.php/listings/edit_user/<?php echo $user->id ?>" id="register-form" enctype="multipart/form-data">
                                <div class="lefttable">
                                    <table style="width:100%;" class="table borderless">
                                        <tr>
                                            <td><label for="fname">First Name</label></td>
                                            <td><input type="text" id="fname" name="fname" class="form-control" value="<?php echo $user->first_name; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="lname">Last Name</label></td>
                                            <td><input type="text" id="lname" name="lname" class="form-control" value="<?php echo $user->last_name; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="email">Email</label></td>
                                            <td><input type="text" id="email" name="email" class="form-control" value="<?php echo $user->email; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="website">Website</label></td>
                                            <td><input type="text" name="website" class="form-control" id="website" value="<?php echo $user->website; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="abtme">About me</label></td>
                                            <td><input type="text" name="abtme" id="abtme" class="form-control" value="<?php echo $user->about; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="twitter">Twitter</label></td>
                                            <td><input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo $user->twitter; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="facebook">Facebook</label></td>
                                            <td><input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo $user->facebook; ?>"/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="righttable">
                                    <table style="width:100%;" class="table borderless">
                                        <tr>
                                            <td width="40%"><label for="phone">Phone number</label></td>
                                            <td><input type="text" name="phone" class="form-control" id="phone" value="<?php echo $user->phone; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="state">State</label></td>
                                            <td><!--<input type="text" class="form-control" id="state" name="state" value="<?php echo $user->state; ?>"/>-->
                                                <?php 
                                                    $options = array();
                                                    if(!empty($state)){
                                                        foreach($state as $rws){
                                                            $options[$rws->id] = $rws->name;
                                                        }
                                                    }
                                                    echo form_dropdown('state',$options,$user->state,'class="form-control" id="state"');
                                                ?>
                                            </td>
                                        </tr>
										<tr>
                                            <td><label for="city">City</label></td>
                                            <td><!--<input type="text" class="form-control" id="city" name="city" value="<?php echo $user->city; ?>"/>-->
                                                <?php 
                                                    $optionct = array();
                                                    if(!empty($city)){
                                                        foreach($city as $rwcs){
                                                            $optionct[$rwcs->id] = $rwcs->name;
                                                        }
                                                    }
                                                    echo form_dropdown('city',$optionct,$user->city,'class="form-control" id="city"');
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="zip">Zip/Postal Code</label></td>
                                            <td><input type="text" id="zip" class="form-control" name="zip" value="<?php echo $user->pincode; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="country">Country</label></td>
                                            <td><input type="text" id="country" name="country" class="form-control" value="<?php echo $user->country; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="profile">Profile Picture</label></td>
                                            <td><input type="file" id="profile" name="profile" class="form-control" /></td>
                                        </tr>
                                    </table>
                                </div>
                                <input type="hidden" name="edit_image" value="<?php echo $user->image; ?>" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="save" type="submit" width="50%">Save</button>
                                        <button id="cancel" type="submit">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="accountstastics" class="tab-pane fade">
                      <div class="row">
                        <div class="col-md-12 editprofile">
                            <span><strong>Statistics</strong></span>
                        </div>
                      </div>
                        <div class="col-md-12">
                            <span>Live Listings:<?php echo $live_listings->num; ?></span><br>
                            <span>Pending Listings:<?php echo $pending_listings->num; ?></span><br>
                            </span>Total Listings:<?php echo ($live_listings->num+$pending_listings->num); ?></span><br>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div><!-- Container Closed Here  -->