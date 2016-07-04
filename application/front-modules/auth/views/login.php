    <!-- body content starts -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bodyContent">
					<div class="row">
						<div class="col-md-12" style="background:#fff;">
							<div class="row firstRow">
								<div class="col-md-12 center-block">
									<div class="loginfromdiv">
                                        <div id="infoMessage"><?php echo $message;?></div>
                                        <?php echo form_open("auth/login");?>
										    <div class="row">
                                                <div class="col-md-6">
                                                    <h3>Login</h3>
                                                    <?php echo form_input($identity);?>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo form_input($password);?>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                   <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>  <?php echo lang('login_remember_label');?>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo form_submit('submit', lang('login_submit_btn'),"class='btn btn-lg btn-block prmbtn1'");?>
                                                </div>
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-md-6">
                                                    <div class="loginwith">
                                                        <div class="sociallogin">
                                                            <p><strong>Or Login With</strong></p>
                                                        </div>
                                                        <div class="socialiconlogin">
                                                            <a href="fb#"><img src="<?php echo base_url(); ?>themes/front/img/fabpng.png" alt="img1" class="img-responsive" /></a>
                                                            <a href="fb#"><img src="<?php echo base_url(); ?>themes/front/img/twitterpng.png" alt="img1" class="img-responsive" /></a>
                                                            <a href="fb#"><img src="<?php echo base_url(); ?>themes/front/img/googlepng.png" alt="img1" class="img-responsive" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div><!--first row closed here-->
                    </div>
                </div>
            </div>
        </div>
    </div>