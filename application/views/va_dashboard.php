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


   <body>
      <!-- Start wrapper-->
      <div id="wrapper">
         <!--Start sidebar-wrapper-->
         <?php $this->load->view('common_admin/admin_sidebar.php'); ?>
         <!--End sidebar-wrapper-->


         <!--Start topbar header-->
         <?php $this->load->view('common_admin/admin_topbar.php'); ?>
         <!--End topbar header-->
         <div class="clearfix">
         </div>


         <div class="content-wrapper">
            <div class="container-fluid">
               <!--Start Dashboard Content-->
               <div class="row mt-3">
                  <div class="col-12 col-lg-6 col-xl-3">
                     <div class="card bg-success">
                        <div class="card-body">
                           <div class="media align-items-center">
                              <div class="media-body">
                                 <p class="text-white">Total Orders</p>
                                 <h4 class="text-white line-height-5">8450</h4>
                              </div>
                              <div class="w-circle-icon rounded-circle border border-white">
                                 <i class="fa fa-cart-plus text-white"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-3">
                     <div class="card bg-primary">
                        <div class="card-body">
                           <div class="media align-items-center">
                              <div class="media-body">
                                 <p class="text-white">Total Revenue</p>
                                 <h4 class="text-white line-height-5">$750</h4>
                              </div>
                              <div class="w-circle-icon rounded-circle border border-white">
                                 <i class="fa fa-money text-white"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-3">
                     <div class="card bg-danger">
                        <div class="card-body">
                           <div class="media align-items-center">
                              <div class="media-body">
                                 <p class="text-white">Jumlah User</p>
                                 <h4 class="text-white line-height-5"><?php echo $data_user; ?></h4>
                              </div>
                              <div class="w-circle-icon rounded-circle border border-white">
                                 <i class="fa fa-users text-white"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-3">
                     <div class="card bg-info">
                        <div class="card-body">
                           <div class="media align-items-center">
                              <div class="media-body">
                                 <p class="text-white">Bounce Rate</p>
                                 <h4 class="text-white line-height-5">12.80%</h4>
                              </div>
                              <div class="w-circle-icon rounded-circle border border-white">
                                 <i class="fa fa-pie-chart text-white"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End Row-->
               <div class="row">
                  <div class="col-12 col-lg-6">
                     <div class="card">
                        <div class="card-header border-0">
                           5 Template Terpopuler
                           
                        </div>
                        <div class="table-responsive">
                           <table class="table align-items-center table-flush">
                              
                              <tbody>
                                <?php foreach($jumlah_template as $jumlah_templates): ?>
                                 <tr>
                                    <!-- <td><img src="assets/images/avatars/avatar-1.png" class="rounded-circle customer-img" alt="user avatar"></td> -->
                                    <td><?php echo $jumlah_templates->nama_template; ?></td>
                                    <td><b><?php echo $jumlah_templates->digunakan; ?></b> Digunakan</td>
                                    
                                    
                                 </tr>
                                 
                                 <?php endforeach ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6">
                     <div class="card">
                        <div class="card-header">
                           Statistik Status User
                           <div class="card-action">
                              <div class="dropdown">
                                 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                                 <i class="icon-options"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void();">Action</a>
                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                    <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <canvas id="chart-user"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End Row-->
             
               <!--End Row-->
               <!--End Dashboard Content-->
            </div>
            <!-- End container-fluid-->
         </div>
         <!--End content-wrapper-->
         <!--Start Back To Top Button-->
         <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
         <!--End Back To Top Button-->
         <!--Start footer-->
         <!--End footer-->
      </div>
      <!--End wrapper-->
      

      <!-- JQUERY -->
      <?php $this->load->view('common_admin/admin_jquery.php'); ?>
      <!-- END JQUERY -->

      <!-- Addon JS -->
      <script src="<?php echo base_url(); ?>assets/js/index.js"></script>
      <!-- END Addon JS -->
    <script>
       var ctx = document.getElementById("chart-user").getContext('2d');

      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ["TRIAL", "AKTIF", "SUSPENED"],
          datasets: [{
            backgroundColor: [
              '#11cdef',
              '#2dce89',
              '#ff2fa0'
            ],
            hoverBackgroundColor: [
              '#11cdef',
              '#2dce89',
              '#ff2fa0'
            ],
            data: [<?php echo $user_trial ?>, <?php echo $user_aktif ?>, <?php echo $user_suspened ?>],
      borderWidth: [1, 1, 1]
          }]
        },
        options: {
      cutoutPercentage: 25,
            legend: {
        position: 'right',
              display: true,
        labels: {
                boxWidth:12
              }
            },
      tooltips: {
        displayColors:false,
      }
        }
      });
       
        
       </script>

     <!--  <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bdTR6TKKutNUbQI2R0nhSrmTKbgTLik0bwfRDRE52v37bBLZDtevtOczWUYScs7dRurDLMTZCWQTvl2MGW9h1avko2FPEnrgexhgvuDA7222VRXZsdP%2blaSYtzIlnhb3sq7McE6r0G%2fdgPXLHSSv17a6xIQ5ufOFjHVrv%2ftR3IaT6jQl1bbhH9POfnQPGKBuz5AZ3%2ftHE%2bW%2bvi4pl%2ftGh%2fv83Zw0rt64QtoLvqbdCz71FkYqrS0fS4MymquJffe72BajOaEl34UP4YsoCPYYs%2fGZdPPpCTosjyyXIpuREEJwC%2fKgNuXlquy3Y11O5UA1NCJ5UFcwE8XXPnMjQ3Ri7MhXqScFDx3dPZbKF30JHMOKBsOnln6EmN3GXSpUiRqQDe4Lxnjt5KV1kXA61usTCMDzLothUWZDN0Pm1e97%2btc5ZdeMpLOkDDb3XBSCYev%2ftcder06es1dUhwdEsVw6EAeg%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script> -->
   </body>
</html>