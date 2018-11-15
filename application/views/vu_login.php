<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="zxx">
<!--<![endif]-->


<!-- Mirrored from rexbd.net/html/rupa/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Nov 2018 09:24:15 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>
        <?php echo $title_page;  ?>
    </title>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/landing/assets/images/favicon.png" />
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/landing/assets/css/bootstrap.css">
    <!--Owl Carousel CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/landing/assets/css/owl.carousel.min.css">
    <!--Icofont CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/landing/assets/css/icofont.css">
    <!--Magnific PopUp CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/landing/assets/css/magnific-popup.css">
    <!--Bootsnav CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/landing/assets/css/bootsnav.css">
    <!--Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/landing/assets/css/style.css">
    <!--Responsive CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/landing/assets/css/responsive.css">
 <!-- notifications css -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/notifications/css/lobibox.min.css"/>
    <!--Modanizr JS-->
    <script src="<?php echo base_url() ?>assets/landing/assets/js/modernizr.custom.js"></script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
    <!--Start Preloader-->
    <div class="site-preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!--End Preloader-->

    <!--Start Body Wrap-->
    <div id="body-wrap">
        <!--Start Header-->
        <header id="header">
            <nav class="navbar navbar-default bootsnav" data-spy="affix" data-offset-top="10">
                <!--Start Container-->
                <div class="container">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                       <a href="<?php echo base_url();?>sites/register">Register Now</a>
                    </div>
                    <!-- End Atribute Navigation -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="icofont icofont-navigation-menu"></i>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url();?>"><img src="https://goodeva.co.id/my-assets/images/logo.png" style="width:100px;" class="logo" alt=""></a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeIn" data-out="fadeOut">
                            <li class="active"><a href="#header">Home</a></li>
                            <li><a href="#about-area">About</a></li>
                            <li><a href="#features-area">Features</a></li>
                            <li><a href="#product-area">Product</a></li>
                            <li><a href="#testimonial-area">Testimonial</a></li>
                            <li><a href="#faq-area">FAQ</a></li>
                            <li><a href="#contact-area">Contact</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!--End Container-->
            </nav>
            <div class="clearfix"></div>
        </header>
        <!--End Header-->
        
       

      
        <!--Start Contact Area-->
        <section id="contact-area">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading Row-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="section-heading text-center">
                            <h2>Log In</h2>
                            <h3>New to Goodeva? <a href="<?php echo base_url().$controller ?>/register"><u>Sign Up</u></a></h3>
                            <div class="col-12 col-lg-4 col-xl-2">
                              
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Heading Row-->

                <!--Start Contact Row-->
                <div class="row">
                    <!--Start Contact Form-->
                    <div class="col-md-6 col-md-offset-1 col-sm-8" style="border-right: 1px solid;">
                        <div class="contact-form">
                            <form action="<?php echo base_url(); ?>user-login/login" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="username">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <a class="pull-right" href="">Forgot Password?</a>
                                </div>

                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!--End Contact Form-->

                    <!--Start Contact Info-->
                    <div class="col-md-5 col-sm-4">
                        <div class="contact-info">


                            <div class="btn-group" style="color: white; margin-top: 20px;width: 100%;">

                                <a class="btn btn-danger" href="<?php echo base_url(); ?>user_authentication" style="width: 100%;padding: 15px;">
                                    <i class="fa fa-google-plus disabled pull-left" style="width:16px; height:20px;font-size: 20px;">
                                    </i>Sign in with Google
                                </a>
                            </div>

                        </div>
                    </div>
                    <!--End Contact Info-->
                </div>
                <!--End Contact Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Contact Area-->
        <!--Start Footer-->
        <!--  <footer id="footer" class="bg-gray">
            <div class="container">
                <p class="text-center">&copy; Copy 2018 All Rights Reserved</p>
            </div>
        </footer>-->
        <!--End Footer-->
    </div>
    <!--End Body Wrap-->

    <!--jQuery JS-->
    <script src="<?php echo base_url() ?>assets/landing/assets/js/jquery.min.js"></script>
    <!--Bootstrap JS-->
    <script src="<?php echo base_url() ?>assets/landing/assets/js/bootstrap.min.js"></script>
    <!--Owl Carousel JS-->
    <script src="<?php echo base_url() ?>assets/landing/assets/js/owl.carousel.min.js"></script>
    <!--Magnific PopoUp JS-->
    <script src="<?php echo base_url() ?>assets/landing/assets/js/magnific-popup.min.js"></script>
    <!--Bootsnav JS-->
    <script src="<?php echo base_url() ?>assets/landing/assets/js/bootsnav.js"></script>
    <!--Main JS-->
    <script src="<?php echo base_url() ?>assets/landing/assets/js/custom.js"></script>
    
     <script src="<?php echo base_url() ?>assets/plugins/notifications/js/lobibox.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/notifications/js/notifications.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/notifications/js/notification-custom-script.js"></script>

    <?php
    
    if($this->session->flashdata('pesan'))
    {
        $cek=$this->session->flashdata('pesan');
    
    
    ?>
    
    
<script>
    $(document).ready(function() {
        suksesregister();
    });

    function suksesregister() {
        Lobibox.notify('success', {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            icon: 'fa fa-check-circle',
            delayIndicator: false,
            continueDelayOnInactiveTab: false,
            position: 'top center',
            msg: '<?php echo $cek; ?>'
        });
    }
</script>
  <?php
    }
    ?>
     <?php
    
    if($this->session->flashdata('pesan-login'))
    {
        $cek2=$this->session->flashdata('pesan-login');
    
    
    ?>
    
    
<script>
    $(document).ready(function() {
        suksesregister();
    });

    function suksesregister() {
     Lobibox.notify('error', {
		    pauseDelayOnHover: true,
		    size: 'mini',
		    rounded: true,
		    delayIndicator: false,
		    icon: 'fa fa-times-circle',
            continueDelayOnInactiveTab: false,
		    position: 'top center',
		    msg: '<?php echo $cek2; ?>'
		    });
    }
</script>
  <?php
    }
    ?>
   
</body>


<!-- Mirrored from rexbd.net/html/rupa/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Nov 2018 09:24:15 GMT -->

</html>