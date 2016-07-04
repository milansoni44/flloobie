<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $page_title; ?> | Floodie </title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>themes/front/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <script src="<?php echo base_url(); ?>themes/front/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>themes/front/js/jquery-ui.js"></script>
 	<link href="<?php echo base_url(); ?>themes/front/css/jquery-ui.css" rel="stylesheet" type="text/css"  media="screen">
	<!--<link href="<?php echo base_url(); ?>themes/front/css/bootstrap.min.css" rel="stylesheet" type="text/css"  media="screen">-->
	<link href="<?php echo base_url(); ?>themes/front/css/bootstrap.css" rel="stylesheet" type="text/css"  media="screen">
	<script src="<?php echo base_url(); ?>themes/front/js/bootstrap.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/front/css/quikr.css" type="text/css" media="screen">
    <script src="<?php echo base_url(); ?>themes/front/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/front/js/additional-methods.min.js"></script>
	<style type="text/css">
	#dino-list li{
		list-style:none;
		padding:5px;
		display:cursor;
	}
	input[type=text]{
	width:200px;
	padding:10px;	
	}
	
	li em {
	background:#ff6;
	font-weight:bold;
	font-style:normal;
	}
	.search_text{
	width: 145%;
	height:auto;
    position:absolute;
	z-index:999;
    top:40px;
    background:#DADADA;
	}
	</style>
    <script>
	$(document).ready(function(){
        $('.dropdown-toggle').dropdown();
		$(".searchToggle").hide();
		$("#button1").click(function(){
		$(".searchToggle").slideToggle('700');
		});
        $(".tab_content").hide();
            $(".tab_content:first").show();

          /* if in tab mode */
            $("ul.tabs li").click(function() {
                
              $(".tab_content").hide();
              var activeTab = $(this).attr("rel"); 
              $("#"+activeTab).fadeIn();		
                
              $("ul.tabs li").removeClass("active");
              $(this).addClass("active");

              $(".tab_drawer_heading").removeClass("d_active");
              $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
              
            });
            /* if in drawer mode */
            $(".tab_drawer_heading").click(function() {
              
              $(".tab_content").hide();
              var d_activeTab = $(this).attr("rel"); 
              $("#"+d_activeTab).fadeIn();
              
              $(".tab_drawer_heading").removeClass("d_active");
              $(this).addClass("d_active");
              
              $("ul.tabs li").removeClass("active");
              $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
            });
            
            
            /* Extra class "tab_last" 
               to add border to right side
               of last tab */
            $('ul.tabs li').last().addClass("tab_last");
		$('.dropdown-menu a').on('click', function(){ 
            $(this).parent().parent().prev().html($(this).html() + '<span class="caret" style="margin-left:10px;"></span>');
            $('#ct').val($(this).text());
            // console.log($(this).text());
		})
        $( "#search_dinosaurs" ).autocomplete({
            source: function(request, response){
                // $.getJSON("<?php echo base_url(); ?>index.php/listings/searchSuggetions", {city: $('#ct').val()}, response);
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/listings/searchSuggetions",
                    dataType: "json",
                    data: {
                        term : request.term,
                        city_name : $("#ct").val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            }
		});
	});
	</script>
</head>
<body>
    <?php
        // echo '<pre>';
        // print_r($this->template->getCities());
        // echo '</pre>';
    ?>
    <!-- header starts -->
	<div class="header HP-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3 logotitle">
							<div style="padding-bottom: 10px;><a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url(); ?>themes/admin/uploads/logo/<?php echo $template['logo']; ?>" width="230px" height="50px"/><!-- <img src="img/logo.png" alt="img1"  class="img-responsive"/> --></a></div>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-12">
													<div class="SearchTextBox">
														<div class="row">
															<div class="col-md-3">
																	<div class="dropdown dropdown-btn">
																		<button class="btn drpdwn btn-md dropdown-toggle"  id="account1"  data-toggle="dropdown" type="button" style="background-color:#fff;"><span>Cities</span>
																			<span class="caret"></span>
																		</button>
																		<ul id="city" role="menu" aria-labelledby="dropdownMenu" class="dropdown-menu"  style="background:#fff;border:none;">
                                                                            <li><a href="#">All</a></li>
                                                                            <?php
                                                                                $ct = $this->template->getCities();
                                                                                if(!empty($ct)){
                                                                                    foreach($ct as $rw){
                                                                            ?>
                                                                            <li><a href="#"><?php echo $rw->name; ?></a></li>
                                                                            <?php
                                                                                    }
                                                                                }
                                                                            ?>
																		</ul>
																	</div>
															</div>
                                                            <form action="<?php echo base_url(); ?>index.php/listings/search" method="get" id="search_form">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <input type="text" id="search_dinosaurs" name="search"  class="form-control input-lg inputSearch" width="50%" height="10px"  placeholder="Type Your Search Here..." value="<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?>">  
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="city" id="ct" value="All"/>
                                                                <div class="col-md-3 search1icon">
                                                                    <input type="submit" class="search_submit" />
                                                                </div>
															</form>
														</div>
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<a href="<?php echo base_url(); ?>index.php/listings/createadv" class="btn btn-info btn-lg createlisting">Post Your Ad</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- header ends -->
	<!-- menu header starts -->
	<div class="header Menu-Header">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<div class="navbar-collapse collapse menu-text">
						<ul class="nav navbar-nav">
							<li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/blog">Blog</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/contactus">Contact Us</a></li>
							<li><a href="#contact">Adverstise On Website</a></li>
						 </ul>        
					</div><!--/.nav-collapse -->
        		</div>
                <?php
                    if($this->template->user_logged_in()){
                ?>
                <div class="col-md-2">
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>index.php/listings/myad_listing">Edit Profile</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/listings/myad_listing">My Ads</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/listings/myad_listing">My Order</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/announcements/">Announcements</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/messages">Inbox</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a></li>
								</ul>
							</li>
						</ul>
        			</div><!--/.nav-collapse -->
  				</div>
                <?php
                    }else{
                ?>
                <div class="col-md-2">
                    <div class="navbar-collapse collapse menu-text">
						<ul class="nav navbar-nav">
							<li class="active"><a href="<?php echo base_url(); ?>index.php/auth/login">Login</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/auth/create_user">Register</a></li>
						 </ul>        
					</div><!--/.nav-collapse -->
  				</div>
                <?php
                    }
                ?>
			</div>
		</div><!--container closed here-->
	</div><!--header closed here-->
	<!-- menu ends -->
    <?php echo $template['body']; ?>
    <!-- footer start  -->
	<div class="footer" id="footer1">		 
		<div class="container">
			<div class="row">
				<div class="col-md-4 foottext">
					<span class="city1">Popular City</span>
					<h4 style="border-bottom:1px solid #15b6ff;width:250px;top:10;"></h4>
                    <ul style="float:left;padding:0">
                    <?php
                        $popular_cities = $this->template->getCities();
                        if(!empty($popular_cities)){
                            foreach($popular_cities as $ct_rw){
                    ?>
                        <li style="text-align:left;"><?php echo $ct_rw->name; ?></li>
                    <?php
                            }
                        }else{
                    ?>
                    </ul>
					<!--<ul class="city2">
						<li><a href="#">Ahmedabad</a></li>
						<li><a href="#">Surat</a></li>
						<li><a href="#">Mahesana</a></li>
						<li><a href="#">Vadosan</a></li>
						<li><a href="#">Delhi</a></li>
						<li><a href="#">Kalkatta</a></li>
					</ul>
					<ul>
						<li><a href="#">Chennai</a></li>
						<li><a href="#">Mumbai</a></li>
						<li><a href="#">Puna</a></li>
						<li><a href="#">Jaipur</a></li>
						<li><a href="#">Gwalior</a></li>
						<li><a href="#">Nasik</a></li>
					</ul>
					<ul>
						<li><a href="#">Chennai</a></li>
						<li><a href="#">Mumbai</a></li>
						<li><a href="#">Puna</a></li>
						<li><a href="#">Jaipur</a></li>
						<li><a href="#">Gwalior</a></li>
						<li><a href="#">Nasik</a></li>
					</ul>-->
                    Comming Soon....
                    <?php
                        }
                    ?>
			 </div>
			<div class="col-md-4 foottext">
				<span class="city1">Floobie Links</span>
				<h4 style="border-bottom:1px solid #15b6ff;width:270px;"></h4>
				<ul class="city2">
					<li><a href="<?php echo base_url(); ?>index.php/aboutus">About Us </a></li>
					<li><a href="<?php echo base_url(); ?>index.php/contactus">contact Us</a></li>
					<!--<li><a href="#">Help</a></li>
					<li><a href="#">careeres</a></li>-->
					<li><a href="<?php echo base_url(); ?>index.php/blog">blog</a></li>
					<!--<li><a href="#">Premium ads</a></li>-->
				</ul>
				<!--<ul>
					<li><a href="#">About Us </a></li>
					<li><a href="#">contact Us</a></li>
					<li><a href="#">Help</a></li>
					<li><a href="#">careeres</a></li>
					<li><a href="#">blog</a></li>
					<li><a href="#">Premium ads</a></li>
				</ul>
				<ul>
					<li><a href="#">Chennai</a></li>
					<li><a href="#">Mumbai</a></li>
					<li><a href="#">Puna</a></li>
					<li><a href="#">Jaipur</a></li>
					<li><a href="#">Gwalior</a></li>
					<li><a href="#">Nasik</a></li>
				</ul>-->
				
			</div>
					
			<div class="col-md-4 foottext">
				<span class="city1">Download Floobie App</span>
				<h4 style="border-bottom:1px solid #15b6ff;width:230px;"></h4>
			    <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/googlepaly.png" alt="img1" class="img-responsive" /></a>
			    <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/appstore.png" alt="img1" class="img-responsive" vspace="10px" /></a>
			    <a href="#"><img src="<?php echo base_url(); ?>themes/front/img/windowstore.png" alt="img1" class="img-responsive" vspace="10px" /></a>
			</div>
		</div>	
	</div>
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<p class="text-muted credit">Floobie is an online cross category classifieds platform where you can post ads related to a business, product or service offered in your city for free. Browse through our site to find yourself a suitable job, home services, buyers and sellers for apartments on rent /sale, used cars, bikes, electronic goods & more.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 foottext1 ">
					<ul>
						<li><a class="sell1" href="<?php echo base_url(); ?>index.php/aboutus">About Us |</a></li>
						<li><a class="sell1" href="<?php echo base_url(); ?>index.php/contactus">Contact Us |</a></li>
						<!--<li><a class="sell1" href="#">Help |</a></li>
						<li><a class="sell1" href="#">Careeres |</a></li>-->
						<li><a class="sell1" href="<?php echo base_url(); ?>index.php/blog">Blog |</a></li>
						<!--<li><a class="sell1" href="#">Premium ads</a></li>-->
				   </ul>
				</div>
		  </div>
		  <div class="row">
				<div class="col-md-12">
					<p class="text-muted"><small>Copyright © 2008 - 2015 Floobie Private Limited</small></p>
				</div>
		  </div>
	 </div>
</div>
<!-- footer ends -->
</body>
</html>