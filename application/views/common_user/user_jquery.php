<!-- Bootstrap core JavaScript-->
      <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
      <!-- simplebar js -->
      <script src="<?php echo base_url(); ?>assets/plugins/simplebar/js/simplebar.js"></script>
      <!-- waves effect js -->
      <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
      <!-- sidebar-menu js -->
      <script src="<?php echo base_url(); ?>assets/js/sidebar-menu.js"></script>
      <!-- Custom scripts -->
      <script src="<?php echo base_url(); ?>assets/js/app-script.js"></script>
      <!-- Chart js -->
      <!-- <script src="<?php echo base_url(); ?>assets/plugins/Chart.js/Chart.min.js"></script> -->
      <!--Peity Chart -->
      <!-- <script src="<?php echo base_url(); ?>assets/plugins/peity/jquery.peity.min.js"></script> -->
      <!-- Index js -->

      <!--Data Tables js-->
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>

      <!--notification js -->
      <script src="<?php echo base_url(); ?>assets/plugins/notifications/js/lobibox.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/notifications/js/notifications.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/notifications/js/notification-custom-script.js"></script>

      <!--Sweet Alerts -->
      <script src="<?php echo base_url(); ?>assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/alerts-boxes/js/sweet-alert-script.js"></script>
      <!-- Alert JS -->
      <script src="<?php echo base_url()?>assets/alert/alert.js"></script>

      <!-- Gambar error Handle -->
      <script type="text/javascript">
          $(window).load(function() {
              $('img').each(function() {
                if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                  // image was broken, replace with your new image
                  this.src = 'https://goodeva.co.id/my-assets/images/logo.png';
                }
              });
            });
      </script>


          <script type="text/javascript">
          // $(".sidebar-menu li a").each(function() {   
          //     if (this.href == window.location.href) {
          //         $(this).('li').addClass("active");
          //     }
          // });

          

          jQuery(function($) {
               var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
               $('ul li a').each(function() {
                if (this.href === path || this.href+'/<?php echo $this->uri->segment('2') ?>' === path || this.href+'/<?php echo $this->uri->segment('2') ?>/<?php echo $this->uri->segment('3') ?>' === path || this.href+'/<?php echo $this->uri->segment('2') ?>/<?php echo $this->uri->segment('3') ?>/<?php echo $this->uri->segment('4') ?>' === path) {
                 $(this).parent('li').addClass('active');
                }
               });

              var $btns = $('.btn-fillter').click(function() {
                if (this.id == 'all') {
                  $('#parent > div').fadeIn(450);
                } else {
                  var $el = $('.' + this.id).fadeIn(450);
                  $('#parent > div').not($el).hide();
                }
                $btns.removeClass('current-demo');
                $(this).addClass('current-demo');
              })
              });
          </script>

