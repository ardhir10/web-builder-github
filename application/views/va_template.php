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
                      <a href="<?php echo base_url().$controller ?>/add"><button type="button" class="btn btn-success waves-effect waves-light m-1">TEMPLATE <i class="zmdi zmdi-plus"></i></button></a>
                  </div>
                  
               </div>
               <!--End Row-->
              
              <div class="demo-heading"><?php echo $title_card; ?></div>

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
                         <!-- <ul class="list-group list-group-flush list shadow-none">
                          <li class="list-group-item d-flex justify-content-between align-items-center">Cras justo odio <span class="badge badge-dark badge-pill">14</span></li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Dapibus ac facilisis in <span class="badge badge-success badge-pill">2</span></li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Vestibulum at eros <span class="badge badge-danger badge-pill">1</span></li>
                        </ul> -->
                        <div class="card-body">
                          <a href="<?php echo base_url().$controller ?>/template_page/<?php echo $row_template->slug_id; ?>" class="card-link">Detail</a>
                          <a href="<?php echo base_url() ?>preview/template/<?php echo $row_template->slug_id; ?>" target="_blank" class="card-link">Lihat</a>
                          <a href="#" class="card-link delete" data-id="<?php echo $row_template->ID ?>">Hapus</a>
                        </div>
                      </div>
                  </div><!--End Row-->
                  
                <?php endforeach ?>
               


               <!--End Dashboard Content-->
            </div>


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

           <!-- Sweet Alert -->
  <script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
      type:"post",
      cache:false,
      dataType: "json"
    })

    $(".delete").click(function(){
        var id=$(this).attr("data-id");
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
            url:'<?php echo base_url() ?>'+'Admin_template/delete_template',
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

     


     <!--  <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bdTR6TKKutNUbQI2R0nhSrmTKbgTLik0bwfRDRE52v37bBLZDtevtOczWUYScs7dRurDLMTZCWQTvl2MGW9h1avko2FPEnrgexhgvuDA7222VRXZsdP%2blaSYtzIlnhb3sq7McE6r0G%2fdgPXLHSSv17a6xIQ5ufOFjHVrv%2ftR3IaT6jQl1bbhH9POfnQPGKBuz5AZ3%2ftHE%2bW%2bvi4pl%2ftGh%2fv83Zw0rt64QtoLvqbdCz71FkYqrS0fS4MymquJffe72BajOaEl34UP4YsoCPYYs%2fGZdPPpCTosjyyXIpuREEJwC%2fKgNuXlquy3Y11O5UA1NCJ5UFcwE8XXPnMjQ3Ri7MhXqScFDx3dPZbKF30JHMOKBsOnln6EmN3GXSpUiRqQDe4Lxnjt5KV1kXA61usTCMDzLothUWZDN0Pm1e97%2btc5ZdeMpLOkDDb3XBSCYev%2ftcder06es1dUhwdEsVw6EAeg%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script> -->
   </body>
</html>