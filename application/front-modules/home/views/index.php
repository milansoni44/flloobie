	<!-- body content starts -->
	<div class="section">
		<div class="container">
			<div class="row" style="background-color:white;border-radius:5px;margin-top:20px">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="row titlebox">
								<div class="col-md-2">
								</div>
								<div class="col-md-8">
									<div >
										<span class="title"><h3>Sell Or Advertising Anything Using</h3></span>
										<span class="createlistingspan"><a href="<?php echo base_url(); ?>index.php/listings/createadv" class="btn btn-info btn-lg createlisting">Post Your Ad</a></span>
									</div>
								</div>
								<div class="col-md-2">
								</div>
								
								
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12 box-border">
									<div class="row">
                                        <?php
                                            if(!empty($category_6)){
												$i = 0;
                                                foreach($category_6 as $rowCat6){
													$i = $i+1;
                                        ?>
                                        <div class="col-md-2 <?php if($i == '6'){?> <?php }else{?>box<?php } ?>">
											<div class="row">
												<div class="col-md-12 text-center">
                                                    <a href="<?php echo base_url(); ?>index.php/category/cat/<?php echo $rowCat6->category_code; ?>">
													<div class="">
														<img src="<?php echo base_url();?>themes/admin/uploads/category/icons/<?php echo $rowCat6->category_icon; ?>" alt="img1" class="img-responsive center-block" vspace="10px"/>
													</div>
													<div class="cartext"><?php echo $rowCat6->category_name; ?></div></a>
												</div>
											</div>
										</div>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <div class="col-md-2">
											<div class="row">
												<p>There is no listing available.</p>
											</div>
										</div>
                                        <?php
                                            }
                                        ?>
									</div>
								</div>
							</div>
							<div class="row" style="margin-top:25px;padding-bottom:20px;">
								<div class="col-md-12">
									<div class="row">
                                        <?php
                                            if(!empty($category_12)){
												$j = 0;
                                                foreach($category_12 as $rowCat12){
													$j=$j+1;
                                        ?>
                                        <div class="col-md-2 <?php if($j == '6'){?> <?php }else{?>box<?php } ?>">
											<div class="row">
                                                <a href="<?php echo base_url(); ?>index.php/category/cat/<?php echo $rowCat12->category_code; ?>">
												<div class="col-md-12 text-center">
													<div class="">
														<img src="<?php echo base_url();?>themes/admin/uploads/category/icons/<?php echo $rowCat12->category_icon; ?>" alt="img1" class="img-responsive center-block" vspace="10px"/>
													</div>
													<div class="cartext"><?php echo $rowCat12->category_name; ?></div></a>
												</div>
											</div>
										</div>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <div class="col-md-2">
											<div class="row">
												<p>There is no listing available.</p>
											</div>
										</div>
                                        <?php
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
	<div class="section">
		<div id="exTab1" class="container">	
			<div class="row">
				<ul  class="nav nav-pills" style="padding-top:15px;">
					<li class="active" style="width:160px;">
						<a  id="fad" class="text-center" data-toggle="tab">Featured Ad</a>
					</li>
				</ul>
				<div class="tab-content clearfix">
					<div class="tab-pane active" id="1a"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row"  style="background-color:white;border-radius:5px;margin-bottom:20px;">
				<div class="col-md-12 featuredListing" >
					<div class="row">
                        <?php 
                            if(!empty($featured4)){
                                foreach($featured4 as $rwb){
                        ?>
                        <div class="col-md-3">
							<div class="productImage">
								<a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $rwb->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/uploads/listing/<?php echo $rwb->listing_image; ?>"  alt="img1" style="width:245px; height:183px" class="img-responsive center-block" /></a>
							</div>
							<div>
								<a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $rwb->slug; ?>"><span class="productTitle"><?php echo $rwb->listing_name; ?> Urgentely</span></a>
							</div>
						</div>
                        <?php
                                }
                            }
                        ?>
					</div>
					<div class="row">
                        <?php
                            if(!empty($featured8)){
                                foreach($featured8 as $rwb8){
                        ?>
                        <div class="col-md-3">
							<div class="productImage">
								<a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $rwb8->slug; ?>"><img src="<?php echo base_url(); ?>themes/front/uploads/listing/<?php echo $rwb8->listing_image; ?>"  alt="img1" style="width:245px; height:183px" class="img-responsive center-block" /></a>
							</div>
							<div>
								<a href="<?php echo base_url(); ?>index.php/listings/view_listing/<?php echo $rwb8->slug; ?>"><span class="productTitle"><?php echo $rwb8->listing_name; ?> Urgentely</span></a>
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
	<!-- body content ends  -->