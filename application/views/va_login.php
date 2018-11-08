<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo $title_page; ?></title>


   <!-- CSS -->
   <?php $this->load->view('common_admin/admin_css.php'); ?>
   <!-- END CSS -->
  
</head>

<body class="bg-dark">
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<!-- <img src="assets/images/logo-icon.png" alt="logo icon"> -->
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Log In</div>
		    <form method="post" action="<?php echo base_url(); ?>admin-login/create-login" enctype="multipart/form-data">
			  <div class="form-group">
			  <label for="exampleInputUsername" class="">Username</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="exampleInputUsername" class="form-control input-shadow" name="username" placeholder="Masukkan Username">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputPassword" class="">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" name="password" class="form-control input-shadow" placeholder="Masukkan Password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row">
			 <div class="form-group col-6">
			   <div class="icheck-material-primary">
                <input type="checkbox" id="user-checkbox" name="remember" value="1" checked="" />
                <label for="user-checkbox">Remember me</label>
			  </div>
			 </div>
			 <div class="form-group col-6 text-right">
			  <!-- <a href="authentication-reset-password.html">Reset Password</a> -->
			 </div>
			</div>
			 <button type="submit" class="btn btn-primary shadow-primary btn-block waves-effect waves-light">MASUK</button>
			  <!-- <div class="text-center mt-3">Sign In With</div> -->
			  
			<!-- <div class="form-row mt-4">
			  <div class="form-group mb-0 col-6">
			   <button type="button" class="btn btn-facebook shadow-facebook btn-block text-white"><i class="fa fa-facebook-square"></i> Facebook</button>
			 </div>
			 <div class="form-group mb-0 col-6 text-right">
			  <button type="button" class="btn btn-twitter shadow-twitter btn-block text-white"><i class="fa fa-twitter-square"></i> Twitter</button>
			 </div>
			</div> -->
			 
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <!-- <p class="text-muted mb-0">Do not have an account? <a href="authentication-signup.html"> Sign Up here</a></p> -->
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->
	
  	<!-- JQUERY -->
    <?php $this->load->view('common_admin/admin_jquery.php'); ?>
    <!-- END JQUERY -->
  
<!-- <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bdTR6TKKutNUa%2bMrofDMw9K6TOl6649uFPON88Hf78wmCm47pwEupliL2rv7KZOFKbUAkhkqLyBnOUE7Wk8T7SkJY93kAvQAn8udmpAv%2bPR%2fxALCzizVS7dw6kijwUZYbq3KGnbbjZsay2joRcciW6hNyYavW%2bAUG0XKFFooNPA%2f%2f6wxSnn0XScq1C4kS%2fsy5MP9IHdfNQzxlblSUmhLvj1vsR%2beV2JLh81AZM9TDYsJUB9Qx2j4hwYDQ%2bCVu7g8%2bLjG5tAu%2fPXjT9B6Kb308U1icS%2bEIXtnkfbk0qYspuyPwrCDWs%2bwtuaPqZ%2b%2f7ACGFLpEi4upHyw4BiMP3BinxWRSLqnGNN9ffALeANPR9ST%2bw34Vg2jzVriG4OkGPEENYtbqaM%2b5HlEmhTDfFR9M%2bma4k3N3s%2fRQbkUZ9%2fYQqB9ZLlAjqzQ7c67O8G6xSM%2fVr5%2b7HBPZCqWdA4%2fPE6J7HMTGwBg40S3l%2ffP5NtHiiZ49Y%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script> -->
</body>

</html>
