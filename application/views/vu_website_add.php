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
         
              
              <div class="demo-heading">PILIH TEMPLATE 

              </div>

              <!-- <div class="row">
                <?php foreach ($website as $data_website): ?>
                 <div class="col-lg-4">
                  <a href="<?php echo base_url() ?>User_editor/website/<?php echo $data_website->ID ?>">
                    <div class="card-deck">
                        <div class="card">
                           <img class="card-img-top" src="assets/images/gallery/page.png" alt="Card image cap">
                           <div class="card-body">
                             <h5 class="card-title"><?php echo $data_website->ID ?></h5>
                           </div>
                           <div class="card-footer">
                             <small class="text-muted">Last updated 3 mins ago</small>
                           </div>
                        </div>
                    </div>
                  </a>
                  </div>
                <?php endforeach ?>
              </div> -->

              <!--End Row-->

              <div class="row">
                 <?php foreach ($template_result as $row_template): ?>
                  <div class="col-lg-4">
                      <div class="card">
                        <a href="<?php echo base_url().$controller ?>/edit/<?php echo $row_template->ID; ?>">

                        <!-- <iframe src="<?php echo base_url().$controller ?>/preview/<?php echo $row_template->ID ?>"></iframe> -->
                        <!-- <img src="<?php echo base_url() ?>assets/images/gallery/13.jpg" class="card-img-top" alt="Card image cap"> -->
                        </a>

                        <div class="card-body">
                          <h5 class="card-title text-dark"><?php echo $row_template->nama_template ?></h5>
                        </div>
                        <img class="img-fluid thumbnails" src="<?php echo base_url() ?>assets/images/thumbnails/<?php echo $row_template->photo ?>">

                         <!-- <ul class="list-group list-group-flush list shadow-none">
                          <li class="list-group-item d-flex justify-content-between align-items-center">Cras justo odio <span class="badge badge-dark badge-pill">14</span></li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Dapibus ac facilisis in <span class="badge badge-success badge-pill">2</span></li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Vestibulum at eros <span class="badge badge-danger badge-pill">1</span></li>
                        </ul> -->

                        <div class="card-body">
               


                          <button  class="btn-gunakan btn btn-success gunakan" type="button" data-id="<?php echo $row_template->ID ?>">Gunakan</button>
                          <!-- <a " data-id="<?php echo $row_template->ID ?>" class="card-link use">Gunakan</a> -->
                          <a href="<?php echo base_url() ?>preview/template/<?php echo $row_template->slug_id; ?>" target="_blank"  class="btn-gunakan btn btn-info ">Lihat</a>
                          <!-- <a href="#" class="card-link delete" data-id="<?php echo $row_template->ID ?>">Hapus</a> -->
                        </div>
                      </div>
                  </div><!--End Row-->
                  
                <?php endforeach ?>
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

   <!-- 
      <script type="text/javascript">
        $(document).ready(function() {
            alert('Ha');
         $(".btn-gunakan").click(function(){
            var id_page = $(this).attr("data-id");
            alert('Ha');
            // window.location = "<?php echo base_url().$controller ?>/"+id_page;
         }); 

          

        // function gunakan(){
        //     var id_page = $(this).attr("data-id");
        //     window.location = "<?php echo base_url().$controller ?>/"+id_page;
        // }
        
        });
      </script>
      
 -->
      <!-- JQUERY -->
      <?php $this->load->view('common_user/user_jquery.php'); ?>
      <!-- END JQUERY -->

      <!-- Addon JS -->
      <!-- <script src="<?php echo base_url(); ?>assets/js/index.js"></script> -->
      <!-- END Addon JS -->


      

      <script type="text/javascript">
        $(document).ready(function(){
        

          $(".gunakan").click(function(){
            var id_template=$(this).data("id");
            // alert(id_page);
            // window.location = "<?php echo base_url().$controller ?>/"+id_page;

            $.ajax({
            type:"post",
            url:'<?php echo base_url().$controller ?>'+'/use_template',
            data:{id_template:id_template},
            dataType: 'json',
            success: function(data) {
              // console.log(data);
              // alert(data.records.nama_website);
              window.location = "<?php echo base_url().$controller ?>/website/"+data.records.slug_id+'?usrToken=<?php echo md5($this->session->userdata('adminID')) ?>';

                // console.log(resp.records[0].nama_website);
                // console.log("Success... "+data);
            },error: function (jqXHR, exception) {
              var msg = '';
              if (jqXHR.status === 0) {
                  msg = 'Not connect.\n Verify Network.';
              } else if (jqXHR.status == 404) {
                  msg = 'Requested page not found. [404]';
              } else if (jqXHR.status == 500) {
                  msg = 'Internal Server Error [500].';
              } else if (exception === 'parsererror') {
                  msg = 'Parse Error ';
              } else if (exception === 'timeout') {
                  msg = 'Time out error.';
              } else if (exception === 'abort') {
                  msg = 'Ajax request aborted.';
              } else {
                  msg = 'Uncaught Error.\n' + jqXHR.responseText;
              }
              alert(msg);
          },
            });
            
          });



        });
        </script>

        

        






     <!--  <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bdTR6TKKutNUbQI2R0nhSrmTKbgTLik0bwfRDRE52v37bBLZDtevtOczWUYScs7dRurDLMTZCWQTvl2MGW9h1avko2FPEnrgexhgvuDA7222VRXZsdP%2blaSYtzIlnhb3sq7McE6r0G%2fdgPXLHSSv17a6xIQ5ufOFjHVrv%2ftR3IaT6jQl1bbhH9POfnQPGKBuz5AZ3%2ftHE%2bW%2bvi4pl%2ftGh%2fv83Zw0rt64QtoLvqbdCz71FkYqrS0fS4MymquJffe72BajOaEl34UP4YsoCPYYs%2fGZdPPpCTosjyyXIpuREEJwC%2fKgNuXlquy3Y11O5UA1NCJ5UFcwE8XXPnMjQ3Ri7MhXqScFDx3dPZbKF30JHMOKBsOnln6EmN3GXSpUiRqQDe4Lxnjt5KV1kXA61usTCMDzLothUWZDN0Pm1e97%2btc5ZdeMpLOkDDb3XBSCYev%2ftcder06es1dUhwdEsVw6EAeg%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script> -->
   </body>
</html>