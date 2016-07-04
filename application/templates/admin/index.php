<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>../themes/admin/images/favicon.png" type="image/png">

  <title><?php echo $page_title;?> | Floobie Admin</title>

  <link href="<?php echo base_url(); ?>../themes/admin/css/style.default.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>../themes/admin/css/jquery.datatables.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>../themes/admin/css/datepicker.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>../themes/admin/js/jquery-1.10.2.min.js"></script>
  <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
  <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>../themes/admin/js/bootstrap-datepicker.js"></script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
    <script type="text/javascript">
        // $(function () {
            // $('#lstFruits').multiselect({
                // includeSelectAllOption: true
            // });
            // $('#btnSelected').click(function () {
                // var selected = $("#lstFruits option:selected");
                // var message = "";
                // selected.each(function () {
                    // message += $(this).text() + " " + $(this).val() + "\n";
                // });
                // alert(message);
            // });
        // });
    </script>
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
    
    <div class="logopanel">
        <h1><span>[</span> floobie <span>]</span></h1>
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="<?php echo base_url(); ?>../themes/admin/images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4>John Doe</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <!--<li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href="#"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a></li>-->
              <li><a href="<?php echo base_url(); ?>auth/logout"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li <?php if($page_title == 'Home') { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="nav-parent <?php if($page_title == 'Categories' || $page_title == 'Create Category' || $page_title == 'Update Category' || $page_title == 'Sub Categories' || $page_title == 'Update Sub Category'){ ?> active <?php } ?>"><a href="#"><i class="fa  fa fa-tag"></i> <span>Listing Category</span></a>
            <ul class="children" <?php if($page_title == 'Categories' || $page_title == 'Create Category' || $page_title == 'Update Category'){ ?> style="display:block;" <?php } ?>>
                <li <?php if($page_title == 'Categories') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>category"><i class="fa fa-caret-right"></i> Categories</a>
                </li>
                <li <?php if($page_title == 'Sub Categories') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>subcategory"><i class="fa fa-caret-right"></i> Sub Categories</a>
                </li>
            </ul>
        </li>
        <li class="nav-parent <?php if($page_title == 'Blog' || $page_title == 'Create Blog' || $page_title == 'Update Blog' || $page_title == 'Blog Categories' || $page_title == 'Update Blog Categories'){ ?> active <?php } ?>"><a href="#"><i class="fa fa-suitcase"></i> <span>Blog</span></a>
            <ul class="children" <?php if($page_title == 'Blog' || $page_title == 'Create Blog' || $page_title == 'Update Blog'){ ?> style="display:block;" <?php } ?>>
                <li <?php if($page_title == 'Blog Categories') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>blog_category"><i class="fa fa-caret-right"></i> Blog Categories</a>
                </li>
                <li <?php if($page_title == 'Blog') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>blog"><i class="fa fa-caret-right"></i> Blog</a>
                </li>
            </ul>
        </li>
        <li class="nav-parent <?php if($page_title == 'Announcements' || $page_title == 'Create Announcement' || $page_title == 'Update Announcement'){ ?> active <?php } ?>"><a href="#"><i class="fa fa-suitcase"></i> <span>Announcements</span></a>
            <ul class="children" <?php if($page_title == 'Announcements' || $page_title == 'Create Announcement' || $page_title == 'Update Announcement'){ ?> style="display:block;" <?php } ?>>
                <li <?php if($page_title == 'Announcements') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>announcement"><i class="fa fa-caret-right"></i> Announcements</a>
                </li>
                <li <?php if($page_title == 'Create Announcement') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>announcement/add"><i class="fa fa-caret-right"></i> Create Announcement</a>
                </li>
            </ul>
        </li>
        <li <?php if($page_title == 'About Us'){?> class="active" <?php } ?>>
            <a href="<?php echo base_url(); ?>aboutus/about"><span class="glyphicon glyphicon-leaf"></span><span>About Us</span></a>
        </li>
        <li <?php if($page_title == 'Inquiries'){?> class="active" <?php } ?>>
            <a href="<?php echo base_url(); ?>inquiry"><span class="glyphicon glyphicon-leaf"></span><span>Inquiry</span></a>
        </li>
        <li class="nav-parent <?php if($page_title == 'City' || $page_title == 'City List'){ ?> active <?php } ?>"><a href="#"><i class="fa fa-suitcase"></i> <span>City</span></a>
            <ul class="children" <?php if($page_title == 'City' || $page_title == 'City List'){ ?> style="display:block;" <?php } ?>>
                <li <?php if($page_title == 'City') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>cities/city_setting"><span class="glyphicon glyphicon-leaf"></span><span>City</span></a>
                </li>
                <li <?php if($page_title == 'City List') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>cities/city_list"><span class="glyphicon glyphicon-leaf"></span><span>City List</span></a>
                </li>
            </ul>
        </li>
        <li <?php if($page_title == 'Settings') { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>settings"><span class="glyphicon  glyphicon-leaf"></span> <span>Settings</span></a></li>
        <li class="nav-parent <?php if($page_title == 'Active Listings Reports' || $page_title == 'Paid Listing Reports' || $page_title == 'Free Listing Reports' || $page_title == 'Pause Listing Reports'){ ?> active <?php } ?>"><a href="#"><i class="fa fa-suitcase"></i> <span>Reports</span></a>
            <ul class="children" <?php if($page_title == 'Active Listings Reports' || $page_title == 'Paid Listing Reports' || $page_title == 'Free Listing Reports' || $page_title == 'Pause Listing Reports'){ ?> style="display:block;" <?php } ?>>
                <li <?php if($page_title == 'Active Listings Reports') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>reports/active_listing"><i class="fa fa-caret-right"></i> Active Listings</a>
                </li>
                <li <?php if($page_title == 'Pause Listing Reports') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>reports/paused_listing"><i class="fa fa-caret-right"></i> Paused Listings</a>
                </li>
                <li <?php if($page_title == 'Paid Listing Reports') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>reports/paid_listing"><i class="fa fa-caret-right"></i> Paid Listings</a>
                </li>
                <li <?php if($page_title == 'Free Listing Reports') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>reports/free_listing"><i class="fa fa-caret-right"></i> Free Listings</a>
                </li>
                <li <?php if($page_title == 'Create Announcement') { ?> class="active" <?php } ?>>
                    <a href="<?php echo base_url(); ?>reports/active_user"><i class="fa fa-caret-right"></i> Active Users</a>
                </li>
            </ul>
        </li>
        <li <?php if($page_title == 'Login Activity') { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>logins"><span class="glyphicon   glyphicon-hand-right"></span> <span>Logins Activity</span></a></li>
      </ul>
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    
    <div class="headerbar">
      
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      
      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>../themes/admin/images/photos/loggeduser.png" alt="" />
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?php echo base_url(); ?>auth/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->
    <?php echo $template['body']; ?>
  </div><!-- mainpanel -->
  
    <div class="rightpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
            <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
            <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
            <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
        </ul>
        
    </div><!-- tab-content -->
  </div><!-- rightpanel -->
</section>
    <script src="<?php echo base_url(); ?>../themes/admin/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/modernizr.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/toggles.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/retina.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/jquery.cookies.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/flot/flot.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/flot/flot.resize.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/raphael-2.1.0.min.js"></script>
    
    <script src="<?php echo base_url(); ?>../themes/admin/js/jquery.datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/chosen.jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>../themes/admin/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>../themes/admin/js/dashboard.js"></script>
</body>
</html>