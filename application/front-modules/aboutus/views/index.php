	<!-- body content starts -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bodyContent">
					<div class="row">
						<div class="col-md-9" style="background:#fff;">
							<div class="blog_title">
								<h2><?php echo ucfirst($about->title); ?></h2>
							</div>
							<div class="row firstRow">
								<div class="col-md-12" style="padding-top:5px;">
									<!--<div class="leftDiv-single-listing-blog">
										<div class="">
											<a href="#"><img src="<?php echo base_url(); ?>themes/admin/uploads/about/<?php echo $about->image; ?>" alt="img1" width="100%" height="50%" class="img-responsive"/></a>
										</div>
									</div>-->
									<div class="row">
										<div class="col-md-12 discriptioncolumn">
											<div class="discriptionText">
												<span>
													<?php echo $about->content; ?>
												</span>
											</div>
										</div>
									</div>
                                </div>
                            </div><!--First Row Closed Here  -->
                        </div><!--col-md-9 row closed here  -->
                        <div class="col-md-3">
                            <!-- first row of second colom closed -->
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
                                                foreach($blogs as $rw){
                                        ?>
                                        <div class="row">
                                            <div class="cannonouterdiv">
                                                <div class="col-md-3">
                                                    <a href="<?php echo base_url();?>index.php/blog/view_blog/<?php echo $rw->blog_keywords; ?>"><img src="<?php echo base_url(); ?>themes/admin/uploads/blog/<?php echo $rw->blog_featured_image; ?>" alt="img1" class="img-responsive" style="padding-top: 6px;"/></a>
                                                </div>
                                                <div class="col-md-9">
                                                    <span class="canontext"><?php echo character_limiter(strip_tags($rw->blog_content),60); ?></span>
                                                    <div class="seeMore">
                                                        <span><a href="<?php echo base_url();?>index.php/blog/view_blog/<?php echo $rw->blog_keywords; ?>">See More...</a></span>
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
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>