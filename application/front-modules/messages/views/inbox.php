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
														<a href="#"><img src="<?php echo base_url(); ?>themes/front/uploads/users/<?php echo $user->image; ?>" width="200px" alt="img1" class="img-responsive" /></a>
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
													<th>Messages</th>
													<th>Action</th>
												</tr>
												<?php 
                                                    if(!empty($messages)){
                                                        foreach($messages as $row){
                                                ?>
                                                <tr>
													<td><?php echo character_limiter(strip_tags($row->query),30); ?></td>
													<td><a href="<?php echo base_url(); ?>index.php/messages/view_message/<?php echo $row->id; ?>">View</a></td>
													<td><a href="<?php echo base_url(); ?>index.php/messages/delete/<?php echo $row->id; ?>">Delete</a></td>

												</tr>
                                                <?php
                                                        }
                                                    }
                                                ?>
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