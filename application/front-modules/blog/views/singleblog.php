	<!-- body content starts -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bodyContent">
					<div class="row">
						<div class="col-md-9" style="background:#fff;">
							<div class="blog_title">
								<h2><?php echo ucfirst($blog->blog_name); ?></h2>
							</div>
							<div class="row firstRow">
								<div class="col-md-12" style="padding-top:5px;">
									<div class="leftDiv-single-listing-blog">
										<div class="">
											<a href="#"><img src="<?php echo base_url(); ?>themes/admin/uploads/blog/<?php echo $blog->blog_featured_image; ?>" alt="img1" class="img-responsive" style="height:350px; width:100%;"/></a>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 listnsocial">
											<div class="listedBy">
												<span class="listedText">Listed by: <?php echo ucfirst($blog->first_name).' '.$blog->last_name; ?> on <?php echo date('F d, Y'); ?></span>
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
											<div class="discriptionText">
												<span class="discriptionTextfont">
													<?php echo $blog->blog_content; ?>
												</span>
											</div>
										</div>
									</div>
                                </div>
                            </div><!--First Row Closed Here  -->
                        </div><!--col-md-9 row closed here  -->
                        <div class="col-md-3">
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
                </div>	<!-- second row of second colom closed -->
            </div>	<!-- second coloumn (col-md-3 closed) -->
        </div><!--Main Row closed Here  -->
    </div><!--Col-md-12 Body Content Closed Here  -->