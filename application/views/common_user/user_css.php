<!--favicon-->
      <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
      <!-- simplebar CSS-->
      <link href="<?php echo base_url(); ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
      <!-- Bootstrap core CSS-->
      <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"/>
      <!-- animate CSS-->
      <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet" type="text/css"/>
      <!-- Icons CSS-->
      <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css"/>
      <!-- Sidebar CSS-->
      <link href="<?php echo base_url(); ?>assets/css/sidebar-menu.css" rel="stylesheet"/>
      <!-- Custom Style-->
      <link href="<?php echo base_url(); ?>assets/css/app-style-user.css" rel="stylesheet"/>
       <!-- notifications css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/notifications/css/lobibox.min.css"/>
      <!--Data Tables -->
      <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

      <style type="text/css">
      .sidebar-menu li.sidebar-header {
            padding: 10px 25px 10px 15px;
            font-size: 12px;
            color: #fff !important;
      }

      .sidebar-menu>li>a {
          color: #fff;
      }

      .sidebar-menu>li:hover>a, .sidebar-menu>li.active>a {
          color: #000;
          background: rgba(255, 255, 255, 0.15);
          border-left-color: #ffffff;
      }
      .card {
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.83) !important;
      }

      .alert_overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.39) !important;
            -webkit-backdrop-filter: blur(3px);
        }

         .ribbon {
          -webkit-transform: rotate(-45deg); 
             -moz-transform: rotate(-45deg); 
              -ms-transform: rotate(-45deg); 
               -o-transform: rotate(-45deg); 
                  transform: rotate(-45deg); 
            border: 25px solid transparent;
            border-top: 25px solid #e59904c4;
            position: absolute;
            bottom: 62px;
            right: -35px;
            padding: 0 10px;
            width: 120px;
            color: white;
            font-family: sans-serif;
            size: 11px;
        }
        .ribbon .txt {
            position: absolute;
            top: -25px;
            left: -1px;
        }

        .full_img_content
        {
         float:left;
         width:400px; (slightly larger than image width)
         height:400px; (slightly larger than image height)
        }
        .full_img_content img // your image (if your img have this size)
        {
         width:390px;
         height:390px;
         z-index: 1;
        }
        .img_ribbon
        {
         background-image: url("link to img");
         background-positiom: x-pos y-pos bottom right;
         z-index: 2;
        }


      </style>
  