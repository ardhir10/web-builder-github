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
                      <a href="<?php echo base_url().$controller ?>/add?usr=<?php echo md5($this->session->userdata('userID')); ?>&status=<?php echo md5($this->session->userdata('userStatus')); ?>"><button type="button" class="btn btn-success waves-effect waves-light m-1">WEBSITE BARU <i class="zmdi zmdi-plus"></i></button></a>
                  </div>
                  
               </div>
               <!--End Row-->
              
              <div class="demo-heading">WEBSITE ANDA</div>

              <div class="row">
                <?php foreach ($data_website as $data_website): ?>
                 <div class="col-lg-4">
                    <div class="card-deck">
                        <div class="card text-center" >
                           <img class="card-img-top" src="<?php echo base_url() ?>assets/images/thumbnails/<?php echo $data_website->photo ?>" alt="Card image cap">
                           <div class="card-body" style="padding-bottom: 5px;">
                             <h5 class="card-title" ><?php echo $data_website->nama_website ?></h5>
                           </div>
                           <div class="card-footer text-center">
                             <a class="card-link" href="<?php echo base_url().$controller ?>/website/<?php echo $data_website->slug_id ?>">Detail</a>
                             <a class="card-link" href="<?php echo base_url()?>preview/website/<?php echo $data_website->slug_id ?>" target="_blank">Lihat</a>
                            <a href="#" class="card-link delete" data-id="<?php echo $data_website->ID ?>">Hapus</a> 
                             <hr>
                             <a href="<?php echo base_url().$controller ?>/website/<?php echo $data_website->slug_id ?>" class="btn btn-secondary" data-id="<?php echo $data_website->ID ?>">Publish</a>

                           </div>
                        </div>
                    </div>
                  </div>
                <?php endforeach ?>
              </div>

              <!--End Row-->
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
      <!-- END Addon JS -->

      <!-- Sweet Alert -->
          <script type="text/javascript">
          $(document).ready(function(){
            $.ajaxSetup({
              type:"post",
              cache:false,
              dataType: "json"
            })

            $(".delete").click(function(){
                var id=$(this).data("id");
                swal({
                  title: "Yakin ingin dihapus  ?",
                  text: "Setelah dihapus data akan hilang",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    
                    swal({   
                            icon: "success",
                            title: "Deleted !",   
                            text: "Data berhasil dihapus",   
                            type: "success",       
                            confirmButtonText: "Ok",    
                            closeOnConfirm: false,   
                            closeOnCancel: false 
                        });

                    $.ajax({
                    data:{id:id},
                    url:'<?php echo base_url() ?>'+'User_website/delete_website',
                    success: function(html) {
                        // $("tr[data-id='"+id+"']").fadeOut(1500,function(){
                        //     $(this).remove();
                        // });
                        // swal({   
                        //     icon: "success",
                        //     title: "Deleted !",   
                        //     text: "Data berhasil dihapus",   
                        //     type: "success",       
                        //     confirmButtonText: "Ok",    
                        //     closeOnConfirm: false,   
                        //     closeOnCancel: false 
                        // });
                        location.reload();
                    }
                    });

                  }else{
                    swal("Batal dihapus !");
                  }
                });

            });

          });
          </script>

          <?php if ( $this->session->flashdata('message')=='delete'): ?>
            <script type="text/javascript">
              $( document ).ready(function() {
                sukses_add_page();
              });
              function sukses_add_page(){
              Lobibox.notify('error', {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'center top',
                showClass: 'rollIn',
                    hideClass: 'rollOut',
                    icon: 'fa fa-trash',
                    width: 600,
                msg: 'Data berhasil dihapus.',
                title: "Deleted !",   

                });
              }
            </script>
          <?php endif ?>


     <!--  <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bdTR6TKKutNUbQI2R0nhSrmTKbgTLik0bwfRDRE52v37bBLZDtevtOczWUYScs7dRurDLMTZCWQTvl2MGW9h1avko2FPEnrgexhgvuDA7222VRXZsdP%2blaSYtzIlnhb3sq7McE6r0G%2fdgPXLHSSv17a6xIQ5ufOFjHVrv%2ftR3IaT6jQl1bbhH9POfnQPGKBuz5AZ3%2ftHE%2bW%2bvi4pl%2ftGh%2fv83Zw0rt64QtoLvqbdCz71FkYqrS0fS4MymquJffe72BajOaEl34UP4YsoCPYYs%2fGZdPPpCTosjyyXIpuREEJwC%2fKgNuXlquy3Y11O5UA1NCJ5UFcwE8XXPnMjQ3Ri7MhXqScFDx3dPZbKF30JHMOKBsOnln6EmN3GXSpUiRqQDe4Lxnjt5KV1kXA61usTCMDzLothUWZDN0Pm1e97%2btc5ZdeMpLOkDDb3XBSCYev%2ftcder06es1dUhwdEsVw6EAeg%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script> -->
   </body>
</html>