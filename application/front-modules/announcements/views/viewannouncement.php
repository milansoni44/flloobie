	<script>
    function goBack() {
        window.history.back();
    }
    </script>
    <!-- body content starts -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bodyContent">
					<div class="row">
						<div class="col-md-12" style="background:#fff;">
							<div class="row firstRow">
								<div class="col-md-3">
									<div class="row">
										<div class="col-md-12 sidebar">
											<div class="row">
												<div class="col-md-12">
													<div class="profpics">
														<a href="#"><img src="<?php echo base_url(); ?>themes/front/img/profilepic.jpg" width="200px" alt="img1" class="img-responsive" /></a>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 proftext-menu">
													<span>New Message</span>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 proftext-menu">
													<span>Announcement</span>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 proftext-menu">
													<span>Message Box</span>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 proftext-menu">	
													<span>Setting</span>
												</div>
											</div>
											
		
										</div>
									</div>
									
								 </div><!--col-md-3 closed here-->
								 <div class="col-md-9" style="padding-top:5px;">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<div class="authorti">
														<span class=""><strong><?php echo ucfirst($user->first_name).' '.ucfirst($user->last_name); ?></strong></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="panel-body">
											<table style="width:80%;" class="table">
												<tr>
													<th><?php echo $announcement->announcement_title; ?></th>
												</tr>
												<tr>
													<td><p><?php echo $announcement->announcement_message; ?></p>
													</td>
												</tr>
												<tr>
													<td>
														<button type="button" onClick="goBack();" class="btn prmbtn1" form="form1" value="Submit">Back</button>
													</td>
												</tr>
											</table>
											</div>
										</div>
									</div>
								</div><!--col-md-9 closed here-->
							</div><!--first row closed here-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>