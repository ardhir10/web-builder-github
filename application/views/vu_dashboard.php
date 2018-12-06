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
      <?php $this->load->view('common_user/user_css.php'); ?>
      <!-- END CSS -->
   </head>


   <body>
      <!-- Start wrapper-->
      <div id="wrapper">
         <!--Start sidebar-wrapper-->
         <?php $this->load->view('common_user/user_sidebar.php'); ?>
         <!--End sidebar-wrapper-->


         <!--Start topbar header-->
         <?php $this->load->view('common_user/user_topbar.php'); ?>
         <!--End topbar header-->
         <div class="clearfix">
         </div>


         <div class="content-wrapper">
            <div class="container-fluid">
               <!--Start Dashboard Content-->
               <div class="row mt-3">
                  <div class="col-12 col-lg-6 col-xl-3">
            <div class="card gradient-scooter">
              <div class="card-body text-center">
              <div class="icon-box"><i class="fa fa-rocket"></i></div>
              <a href="javascript:void();"><h3 class="text-white mt-2"><?php echo $data_order; ?></h3></a>
              <h6 class="text-white mt-2">Total Orders</h6>
            </div>
            </div>
              </div>
                <div class="col-12 col-lg-6 col-xl-3">
            <div class="card gradient-bloody">
              <div class="card-body text-center">
              <div class="icon-box"><i class="fa fa-shopping-cart"></i></div>
              <a href="javascript:void();"><h3 class="text-white mt-2">Rp.<?php echo $tagihan->total; ?></h3></a>
              <h6 class="text-white mt-2">Total Tagihan</h6>
            </div>
            </div>
              </div>    
            <div class="col-12 col-lg-6 col-xl-3">
            <div class="card gradient-quepal">
              <div class="card-body text-center">
              <div class="icon-box"><i class="fa fa-file-code-o"></i></div>
              <a href="javascript:void();"><h3 class="text-white mt-2"><?php echo $jum_website; ?></h3></a>
              <h6 class="text-white mt-2">Total Website</h6>
            </div>
            </div>
              </div>
                <div class="col-12 col-lg-6  col-xl-3">
		  <div class="card bg-google-plus">
		   <div class="card-body text-center">
		     <i class="fa fa-user-circle fa-2x text-white"></i>
			 <h5 class="mt-2 text-white"><?php echo $status_user->keterangan_status; ?></h5>
			 <hr class="border-light-2">
			 <div class="row">
<!--
			  <div class="col-12 border-right border-light-2">
			    <p class="mb-0 text-white"></p>
				<div class="font-weight-bold text-white"></div>
			  </div>
-->
			  <div class="col-12">
			    <p class="mb-0 text-white">Expired</p>
				<div class="font-weight-bold text-white"><?php echo $data_user->expired; ?></div>
			  </div>
			 </div>
		   </div>
		  </div>
        </div>
               </div>
               <!--End Row-->
<!--              <div class="demo-heading">WEBSITE ANDA</div>-->

     <div class="row">
        <div class="col-lg-12"> 
          <div class="card">
		   <div class="card-header text-uppercase text-primary">Status Tagihan</div>
            <div class="card-body">
			  <div class="table-responsive">
                <table class="table">
                  <thead class="thead-primary">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">No. Order</th>
                      <th scope="col">Status</th>
                      <th scope="col">Harga</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $no=1;
                      foreach($order as $order){
                      ?>
                    <tr>
                      <th scope="row"><?php echo $no++ ?></th>
                      <td><?php echo $order->no_order; ?></td>
                      <td><?php 
                            foreach ($status_order as $row_so) {
                              if ($row_so->ID == $order->status) {
                                echo '<span class="badge badge-pill badge-'.$row_so->atribut.' shadow-'.$row_so->atribut.' m-1">'.$row_so->nama_status.'</span>';
                              }
                            }
                            ?>
                              
                            </td>
                      <td><?php echo $order->harga; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
             </div>
            </div>
          </div>
        </div>
               </div><!--End Row-->

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
      <?php $this->load->view('common_user/user_jquery.php'); ?>
      <!-- END JQUERY -->

      <!-- Addon JS -->
      <script src="<?php echo base_url(); ?>assets/js/index.js"></script>
      <!-- END Addon JS -->


     <!--  <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bdTR6TKKutNUbQI2R0nhSrmTKbgTLik0bwfRDRE52v37bBLZDtevtOczWUYScs7dRurDLMTZCWQTvl2MGW9h1avko2FPEnrgexhgvuDA7222VRXZsdP%2blaSYtzIlnhb3sq7McE6r0G%2fdgPXLHSSv17a6xIQ5ufOFjHVrv%2ftR3IaT6jQl1bbhH9POfnQPGKBuz5AZ3%2ftHE%2bW%2bvi4pl%2ftGh%2fv83Zw0rt64QtoLvqbdCz71FkYqrS0fS4MymquJffe72BajOaEl34UP4YsoCPYYs%2fGZdPPpCTosjyyXIpuREEJwC%2fKgNuXlquy3Y11O5UA1NCJ5UFcwE8XXPnMjQ3Ri7MhXqScFDx3dPZbKF30JHMOKBsOnln6EmN3GXSpUiRqQDe4Lxnjt5KV1kXA61usTCMDzLothUWZDN0Pm1e97%2btc5ZdeMpLOkDDb3XBSCYev%2ftcder06es1dUhwdEsVw6EAeg%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script> -->
   </body>
</html>