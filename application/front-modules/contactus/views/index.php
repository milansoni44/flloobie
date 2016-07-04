	<!-- body content starts -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bodyContent">
					<div class="row">
						<div class="col-md-9" style="background:#fff;">
							<div class="blog_title">
								<h2><?php echo $page_title; ?></h2>
							</div>
							<div class="row firstRow">
								<div class="col-md-12" style="padding-top:5px;">
									<div class="row">
                                        <?php
                                            if($errors){
                                                foreach($errors as $error){
                                        ?>
                                                <div class="alert alert-block alert-danger fade in">
                                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <?php echo $error; ?>
                                                </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                        <form class="form-horizontal" style="padding-left: 20%;" action="contactus" method="post">
                                            <div class="form-group">
                                                <div class="col-md-2"><?php echo form_label('First Name','first_name'); ?></div>
                                                <div class="col-md-6">
                                                    <?php echo form_input($first_name); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2"><?php echo form_label('Last Name','last_name'); ?></div>
                                                <div class="col-md-6">
                                                    <?php echo form_input($last_name); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2"><?php echo form_label('Email','email'); ?></div>
                                                <div class="col-md-6">
                                                    <?php echo form_input($email); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2"><?php echo form_label('Subject','subject'); ?></div>
                                                <div class="col-md-6">
                                                    <?php echo form_input($subject); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2"><?php echo form_label('Message','message'); ?></div>
                                                <div class="col-md-6">
                                                    <?php echo form_textarea($message); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div style="margin-left: 37%;margin-right: 50%;"><button type="submit" class="btn prmbtn1" name="create">Submit</button></div>
                                            </div>
                                        </form>
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