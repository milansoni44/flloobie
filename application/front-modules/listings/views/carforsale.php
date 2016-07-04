	<script>
        $(document).ready(function(){
            // alert(<?php echo $user_id; ?>);
            $('#query-submit').submit(function(event){
                // alert(<?php echo $user_id; ?>);
                var user_id = <?php echo $user_id; ?>;
                var listing_id = <?php echo $listing_id; ?>;
                var formData =  {
                                    'name'      : $('input[name=name]').val(),
                                    'address'   : $('input[name=address]').val(),
                                    'phone'     : $('input[name=mobile]').val(),
                                    'query'     : $('input[name=query]').val(),
                                    'to_user'   : user_id,
                                    'listing_id': listing_id
                                };
                // console.log(formData);
                
                // process the form data
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/listings/addQuery",
                    type: 'POST',
                    data: formData,
                    success: function(msg) {
                        if (msg == 'YES'){
                            $('#alert-msg').html('<div class="alert alert-success text-center">Query send successfully!</div>');
                            // var url = "<?php echo base_url() ?>index.php/quotations/add";
                            // $( location ).attr("href", url);

                        }else{
                            $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                        }
                            
                    }
                });
                /* stop form from submitting normally */
                event.preventDefault();
                
            });
        });
    </script>
    <!-- body content starts -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bodyContent">
                    <div class="row">
                        <div class="col-md-9" style="background:#fff;">
                            <div class="row firstRow">
                                <div class="col-md-12" style="padding-top:5px;">
                                    <div class="leftDiv-single-listing">
                                        <div class="">
                                            <a href="#"><img src="<?php echo base_url(); ?>themes/front/uploads/listing/<?php echo $list->listing_image; ?>" alt="img1" width="100%" class="img-responsive"/></a>
                                        </div>
                                    </div>
                                    <div class="rightDiv-single-listing">
                                        <div class="titlecontent">
                                            <div class="title">
                                                <span><h4><?php echo $list->listing_name; ?></h4><span>
                                            </div>
                                            <div class="price">
                                                <span class="negotiable">*<?php if($list->negotiable){ echo ucfirst($list->negotiable); }?></span>
                                                <button type="button" class="btn prmbtn">
                                                    <span class="carPrice">$<?php echo $list->price; ?></span>
                                                </button>
                                        </div>
                                            <hr style="width:100%;clear:both;">
                                        </div>
                                        <div class="bodycontent">
                                            <div class="item-discription">
                                                <span><b>Preferred Contact Method(s):</b></span><?php echo $list->preferred_contact_method; ?><br>
                                                <span><b>Phone:</b></span><?php echo $user->phone; ?><br>
                                                <span><b>City:</b></span><?php echo $user->city; ?> City<br>
                                                <!--<span><b>State:</b></span>Utah<br>-->
                                                <span><b>Country:</b></span> <?php echo $user->country; ?><br>
                                                <span><b>Zip/Postal Code:</b></span><?php echo $user->pincode; ?><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 listnsocial">
                                            <div class="listedBy">
                                                <span class="listedText">Listed by: <?php echo $user->first_name.' '.$user->last_name; ?> on <?php echo date('F d, Y',strtotime($list->creation_time)); ?> </span>
                                            </div>
                                            <div class="socialicon">
                                                <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/fbicon.png" alt="img1" class="img-responsive"/></a>
                                                <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/twittericon.png" alt="img1" class="img-responsive"/></a>
                                                <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/googleplus.png" alt="img1" class="img-responsive"/></a>
                                                <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/pintresticon.png" alt="img1" class="img-responsive"/></a>
                                                <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/emailicon.png" alt="img1" class="img-responsive"/></a>
                                                <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/plussign.png" alt="img1" class="img-responsive"/></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 discriptioncolumn">
                                            <div class="col-md-6">
                                                <div class="discriptionText">
                                                    <span class="discriptionTextfont">
                                                        <span id="discriptionTextfont"><b>Item description:</b></span><br>
                                                        <?php echo $list->listing_description; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="googlemap">
                                                    <iframe src="<?php echo $list->google_map; ?>" width="400" height="200" frameborder="0" style="border:0"></iframe>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    <div id="exTab1">	
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul  class="nav nav-pills" style="padding-top:15px;">
                                                    <li class="active">
                                                        <a  id="fad" class="text-center" data-toggle="tab">Related Listing</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content clearfix">
                                                    <div class="tab-pane active" id="1a"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                                if(!empty($releted_listings)){
                                                    foreach($releted_listings as $rr){
                                            ?>
                                            <div class="col-md-3">
                                                    <div class="reletedproductImage">
                                                        <a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $rr->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/uploads/listing/<?php echo $rr->listing_image; ?>"  style="width:170px; height:130px;" alt="img1" class="img-responsive center-block" /></a>
                                                    </div>
                                                    <div class="listing_name">
                                                        <span><a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $rr->slug; ?>"><?php echo $rr->listing_name; ?></a></span>
                                                    </div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--First Row Closed Here  -->
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-11 col-md-offset-1" style="background:#fff;">
                                    <div class="row">
                                        <div class="col-md-12 recentTitle">
                                            <ul class="tabs">
                                              <li class="active" rel="tab1">Contact</li>
                                              <li rel="tab2">Poster</li>
                                            </ul>
                                            <div class="tab_container">
                                                <h3 class="d_active tab_drawer_heading" rel="tab1">Tab 1</h3>
                                                <div id="tab1" class="tab_content">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <span>To inquire about this ad listing, complete the 
                                                            form below to send a message to the ad poster.
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="alert-msg"></div>
                                                    <form action="/" id="query-submit">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">		
                                                                <div class="nameTextbox">
                                                                    <input class="form-control input-md" id="inputsm" name="name" type="text" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="row">		
                                                                <div class="nameTextbox">
                                                                    <input class="form-control input-md" id="inputsm" type="text" name="address" placeholder="Address">
                                                                </div>
                                                            </div>
                                                            <div class="row">		
                                                                <div class="nameTextbox">
                                                                    <input class="form-control input-md" id="inputsm" type="text" name="mobile" placeholder="Mobile">
                                                                </div>
                                                            </div>
                                                            <div class="row">		
                                                                <div class="nameTextbox">
                                                                    <input class="form-control input-md" id="inputsm" type="text" name="query" placeholder="Write a Query">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">		
                                                                <div class="submitButton">
                                                                    <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- #tab1 -->
                                                <h3 class="tab_drawer_heading" rel="tab2">Tab 2</h3>
                                                <div id="tab2" class="tab_content">
                                                    <div class="row">
                                                        <div class="infoadposter">
                                                            <span>Information about the ad poster</span>
                                                        </div>
                                                        <div class="usericontextdiv">
                                                            <div class="usericonimage">
                                                                <a href="#"><img src="<?php echo base_url(); ?>themes/front/uploads/users/<?php echo $user->image; ?>" alt="img1" class="img-responsive"/></a>
                                                            </div>
                                                            <div class="usericontext">
                                                                <span>Listed by: <code><?php echo $user->first_name.' '.$user->last_name; ?></code></span><br>
                                                                <span>Member Since: </span><br>
                                                                <span>November 22, 2015 </span>
                                                            </div>
                                                        </div>
                                                        <div class="other_Product">
                                                            <h4 style="font-size:12px;">Other Listing</h4>
                                                                <span>
                                                                <?php
                                                                    if(!empty($other_listings)){
                                                                        foreach($other_listings as $rowList){
                                                                ?>
                                                                <a href="<?php echo base_url();?>index.php/listings/view_listing/<?php echo $rowList->slug; ?>"><?php echo $rowList->listing_name; ?></a><br>
                                                                <?php
                                                                        }
                                                                    }else{
                                                                ?>
                                                                <?php
                                                                    }
                                                                ?>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                                <!-- #tab2 -->
                                            </div>											
                                        </div>
                                    </div>
                                </div>
                            </div><!-- first row of second colom closed -->
                            
                            <div class="row">
                                <div class="col-md-12" style="height:20px;">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="row secondRow">
                                <div class="col-md-11 col-md-offset-1" style="background:#fff;">
                                    <div class="row">
                                        <div class="col-md-12 text-center blogTitle">
                                            <span class="car_Title"><h4>Blog</h4></span>
                                        </div>
                                    </div>
                                <div class="maindiv">
                                    <?php 
                                        if(!empty($blogs)){
                                            foreach($blogs as $rowBlog){
                                    ?>
                                    
                                    <div class="cannonouterdiv">
                                        <div class="col-md-3">
                                            <a href="<?php echo base_url();?>index.php/blog/view_blog/<?php echo $rowBlog->blog_keywords; ?>"><img src="<?php echo base_url(); ?>themes/admin/uploads/blog/<?php echo $rowBlog->blog_featured_image; ?>" alt="img1" class="img-responsive" style="padding-top: 6px;"/></a>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="canontext"><?php echo character_limiter(strip_tags($rowBlog->blog_content),60); ?></span>
                                            <div class="seeMore">
                                                <span><a href="<?php echo base_url();?>index.php/blog/view_blog/<?php echo $rowBlog->blog_keywords; ?>">See More...</a></span>
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                
                                    <?php
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
										
										
                    </div>
                </div>	<!-- second row of second colom closed -->
            </div>	<!-- second coloumn (col-md-3 closed) -->
        </div><!--Main Row closed Here  -->
    </div><!--Col-md-12 Body Content Closed Here  -->