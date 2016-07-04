	<!-- body content starts -->
	
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bodyContent">
						<div class="row">
							<div class="col-md-9" style="background:#fff;">
                                <?php
                                    if(!empty($blog)){
                                        foreach($blog as $rowBlog){
                                ?>
                                <div class="row firstRow">
									<div class="col-md-12" style="padding-top:5px;">
										<div class="leftDiv">
											<div class="">
												<a href="<?php echo base_url();?>index.php/blog/view_blog/<?php echo $rowBlog->blog_keywords; ?>"><img src="<?php echo base_url(); ?>themes/admin/uploads/blog/<?php echo $rowBlog->blog_featured_image; ?>" alt="img1" class="img-responsive"/></a>
											</div>
										</div>
										<div class="rightDiv">
											<div class="titlecontent">
												<div class="title">
													<a style="text-decoration:none; cursor:pointer;" href="<?php echo base_url(); ?>index.php/blog/view_blog/<?php echo $rowBlog->blog_keywords; ?>"><span><h4><?php echo ucfirst($rowBlog->blog_name); ?></h4><span></a>
												</div>
												<hr style="width:100%;clear:both;">
											</div>
											
											<div class="itemText">
												<span><?php echo character_limiter(strip_tags($rowBlog->blog_content),150); ?><span><a href="<?php echo base_url();?>index.php/blog/view_blog/<?php echo $rowBlog->blog_keywords; ?>">More...</a></span>
												</span>
											</div>
											<div class="postedBy">
												<div class="postText">
													<span>Posted by : <?php echo ucfirst($rowBlog->first_name); ?> on <?php echo date('jS F Y',strtotime($rowBlog->creation_time)); ?></span>
												</div>
											</div>
										</div>
									</div>
								</div><!--first row closed here  -->
                                <?php
                                        }
                                    }
                                ?>
								<div class="row viewmorerow">
										<div class="col-md-12 text-center">
											<?php echo $this->pagination->create_links(); ?>
										</div>
								</div>
							</div><!--col-9 closed here -->
							<div class="col-md-3">
								<div class="row secondRow">
									<div class="col-md-11 col-md-offset-1" style="background:#fff;">
										<div class="row">
											<div class="col-md-12 text-center blogTitle">
												<span class="car_Title"><h4>Recentely Posted</h4></span>
											</div>
										</div>
                                        <div class="maindiv">
                                            <?php
                                                if(!empty($listing)){
                                                    foreach($listing as $rwb){
                                            ?>
                                            <div class="row">
                                                <div class="cannonouterdiv">
                                                    <div class="col-md-3">
                                                        <a href="#"><img src="<?php echo base_url(); ?>themes/front/uploads/listing/<?php echo $rwb->listing_image; ?>" alt="img1" class="img-responsive" style="padding-top:6px;"/></a>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <span class="canontext"><?php $disallowed = array('Fuck'); echo word_censor(character_limiter(strip_tags($rwb->listing_description),40),$disallowed,'Beep!'); ?></span>
                                                        <div class="seeMore">
                                                            <span><a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $rwb->slug; ?>">See More...</a></span>
                                                        </div>
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
								<!-- first row of second colom closed -->
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
                                                if(!empty($blog)){
                                                    foreach($blog as $rw){
                                            ?>
                                            <div class="row">
                                                <div class="cannonouterdiv">
                                                    <div class="col-md-3">
                                                        <a href="#"><img src="<?php echo base_url(); ?>themes/admin/uploads/blog/<?php echo $rw->blog_featured_image; ?>" alt="img1" class="img-responsive" style="padding-top:6px;"/></a>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <span class="canontext"><?php $disallowed = array('Fuck'); echo word_censor(character_limiter(strip_tags($rw->blog_content),60),$disallowed,'Beep!'); ?></span>
                                                        <div class="seeMore">
                                                            <span><a href="<?php echo base_url(); ?>index.php/blog/view_blog/<?php echo $rw->blog_keywords; ?>">See More...</a></span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
									</div>
								</div>	<!-- second row of second colom closed -->
							</div>	<!-- col-md-3 closed -->
						</div>
				</div>
			</div>
		</div>
	</div>