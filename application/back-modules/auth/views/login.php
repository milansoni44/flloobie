<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url();?>../themes/admin/images/favicon.png" type="image/png">

  <title>Floobie Admin Login</title>

  <link href="<?php echo base_url();?>../themes/admin/css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> floobie <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                    <div style="color:red;"><?php echo $message;?></div>
                    <!--<h5><strong>Welcome to Bracket Bootstrap 3 Template!</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Fully Responsive Layout</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> HTML5/CSS3 Valid</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                    </ul>
                    <div class="mb20"></div>
                    <strong>Not a member? <a href="signup.html">Sign Up</a></strong>-->
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <?php echo form_open("auth/login");?>
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                
                    <?php echo form_input($identity);?>
                    <?php echo form_input($password);?>
                    <?php echo form_submit('submit', lang('login_submit_btn'),"class='btn btn-success btn-block'");?>
                    
                <?php echo form_close();?>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2015. All Rights Reserved. Floobie
            </div>
            <div class="pull-right">
                Created By: <a href="http://vakratundasystem.in/" target="_blank">Vakratunda System</a>
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>


<script src="<?php echo base_url();?>../themes/admin/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>../themes/admin/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url();?>../themes/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>../themes/admin/js/modernizr.min.js"></script>
<script src="<?php echo base_url();?>../themes/admin/js/retina.min.js"></script>

<script src="<?php echo base_url();?>../themes/admin/js/custom.js"></script>

</body>
</html>