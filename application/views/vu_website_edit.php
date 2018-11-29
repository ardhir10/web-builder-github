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

      <!-- ADD ON CSS -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/material-editor/dist/grapesjs/grapes.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/material-editor/dist/gramateria/develop/gramateria.css">

      <link rel="shortcut icon" href="favicon.ico" />
      <script src="<?php echo base_url() ?>assets/material-editor/dist/grapesjs/grapes.min.js"></script>
      <script src="<?php echo base_url() ?>assets/material-editor/dist/grapesjs/plugins/grapesjs-plugin-export.min.js"></script>
   </head>


   <body>
    <!-- Preloader -->
    
      <!-- Start wrapper-->
      <div id="wrapper" >
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
            
              
                <div class="demo-heading">Website <h2><?php echo $data_website->nama_website ?></h2> 
                </div>
                <!-- <button class="btn btn-success" onclick="anim5_noti()">SHOW ME</button> -->
                <div class="row">
                  <div class="col-lg-4">
                      <div class="card">

                       
                        <div class="card-body">
                          <h5 class="card-title text-dark">
                          Detail Website
                          </h5>
                        </div>
                         <ul class="list-group list-group-flush list shadow-none">
                          <!-- <li class="list-group-item d-flex justify-content-between align-items-center">Kategori <span class="badge badge-dark badge-pill"><?php echo "ini detail"; ?> </span></li> 
                           <li class="list-group-item d-flex justify-content-between align-items-center">Type  <span class="badge badge-<?php echo "danger";?> badge-pill"><?php echo "ini detail"; ?></span></li>--> 
                           <li class="list-group-item d-flex justify-content-between align-items-center">Harga Publish<span>Rp.100,000</span></li> 
                        </ul>
                        <div class="card-body text-center">
                          <!--   <table class="table">
                                <tr>
                                  <td>Kategori </td>
                                  <td>| <?php echo $kategori->nama_kategori ?> </td>
                                </tr>
                                <tr>
                                  <td>Type</td>
                                  <td>| <?php echo $type->nama_type ?> </td>
                                </tr>
                              </table> -->
                      
                        <a href="<?php echo base_url()?>preview/website/<?php echo $data_website->slug_id; ?>" target="_blank" class="btn btn-sm btn-primary waves-effect waves-light">Lihat Template</a>
                        <a href="<?php echo base_url()?>User_website/edit/<?php echo $data_website->slug_id; ?>"  class="btn btn-sm btn-info waves-effect waves-light">Edit Detail</a>
                        <hr>
                        <a href="<?php echo base_url().$controller ?>/website/<?php echo $data_website->slug_id ?>" class="btn btn-secondary"  data-toggle="modal" data-target="#modal-publish" data-id="<?php echo $data_website->ID ?>">Publish</a>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-8">
                    <div style="margin-bottom: 20px;">
                      <span>List Page</span>
                      <!-- <button class="btn btn-sm btn-success">NEW PAGE</button> -->
                        <button type="button" class="btn btn-sm btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal-animation-14"><i aria-hidden="true" class="fa fa-plus"></i> &nbsp;NEW PAGE</button>

                      <!-- Modal Add New -->
                        <div class="modal fade" id="modal-animation-14">
                          <div class="modal-dialog">
                            <div class="modal-content animated zoomInUp">
                              <div class="modal-header">
                                <h5 class="modal-title">Tambah Page</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              
                                <form method="post" action="<?php echo base_url().$controller ?>/create_new_page">
                                <div class="modal-body">
                                   <div class="form-group">
                                   <label for="input-1">Judul Page</label>
                                   <input type="text" class="form-control" name="judul_page" placeholder="Judul Page" required="">
                                   <input type="hidden" class="form-control" name="id_website"  value="<?php echo $data_website->ID ?>">
                                 </div>
                           
                                    </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                <button type="submit" class="btn btn-info shadow-info px-5"><i class="fa fa-save"></i> Simpan</button>
                            
                              </div>  
                              </form>
                            </div>
                          </div>
                        </div>
                        <!--Modal publish-->
                         <div class="modal fade" id="modal-publish">
                          <div class="modal-dialog">
                            <div class="modal-content animated zoomInUp">
                              <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Publish Website</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              
                                   <form action="<?php echo base_url().$controller; ?>/order_publish/<?php echo $data_website->ID;?>" method="post">
                            <div class="modal-body">
                                
                                   <ul class="list-group list-group-flush list shadow-none">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Nama Website <span class="badge badge-dark badge-pill">
                                            <?php echo $data_website->nama_website ?> </span></li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Jumlah Page <span class="badge badge-<?php echo " danger";?> badge-pill">
                                            <?php echo "3"; ?></span></li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Harga Publish<span>Rp.100,000</span></li>
                                </ul>
                                   <div class="form-group">
                                       <label>Pilih Package</label>
                                       <select name="id_package" id="" class="form-control">
                                        <?php foreach ($data_package as $row): ?>    
                                           <option value="<?php echo $row->ID; ?>"><?php echo $row->nama_package; ?></option>
                                       <?php endforeach ?>
                                       </select>
                                   </div>
                                    </div>
                                 
                                   
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="submit" class="btn btn-info shadow-info px-5"><i class="fa fa-rocket"> </i> Order Publish</button>
                            
                              </div>  
                             </form>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="row">
                       <?php foreach ($data_page as $row_page): ?>
                          <div class="col-lg-4">
                              <div class="card">
                                <a href="<?php echo base_url().$controller ?>/edit/<?php echo $row_page->ID; ?>">

                                <!-- <iframe src="<?php echo base_url().$controller ?>/preview/<?php echo $row_template->ID ?>"></iframe> -->
                                <!-- <img src="<?php echo base_url() ?>assets/images/gallery/13.jpg" class="card-img-top" alt="Card image cap"> -->
                                 <!--  <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="http://localhost/ci_app/web-builder-github/Admin_template/template_page/22" allowfullscreen></iframe>
                                  </div> -->
                                </a>
                                <div class="card-body">

                                  <h5 class="card-title text-dark"><?php echo $row_page->judul_page ?></h5>
                                  <?php 
                                  if ($row_page->type_page != '') {
                                    echo "<p>".$row_page->type_page."</p>";
                                  }else{
                                    echo "<a href='".base_url()."user-website/update_index?id_page=".$row_page->ID."&id_website=".$row_page->id_website."'>set as index</a>";
                                  } ?>

                                  <hr>
                                </div>
                                 <!-- <ul class="list-group list-group-flush list shadow-none">
                                  <li class="list-group-item d-flex justify-content-between align-items-center">Cras justo odio <span class="badge badge-dark badge-pill">14</span></li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">Dapibus ac facilisis in <span class="badge badge-success badge-pill">2</span></li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">Vestibulum at eros <span class="badge badge-danger badge-pill">1</span></li>
                                </ul> -->
                                <div class="card-body">
                                  <a href="<?php echo base_url().$controller ?>/website/<?php echo $data_website->slug_id; ?>/<?php echo $row_page->slug_id ?>" class="card-link"><button class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Edit Page"><i class="fa fa-edit" ></i></button></a>
                                  <button class="btn btn-sm btn-danger delete" data-id="<?php echo $row_page->ID ?>" data-toggle="tooltip" data-placement="top" title="Hapus Page"><i class="fa fa-trash" ></i></button>
                                  <button class="btn btn-sm btn-dark" data-id="<?php echo $row_page->ID ?>"  data-toggle="tooltip" data-placement="top" title="Duplikat Page"><i class="fa fa-copy"></i></button>


                                  <!-- <a href="<?php echo base_url().$controller ?>/preview/<?php echo $row_page->ID; ?>" target="_blank" class="card-link">Lihat</a> -->
                                </div>
                              </div>
                          </div><!--End Row-->
                        <?php endforeach ?>
                    </div>

                  </div>

                </div>
                

                <div class="row">

                 
                   
                  
                </div>
                


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

      <!-- Add On Js -->
      <script src="<?php echo base_url() ?>assets/material-editor/dist/gramateria/develop/gramateria.js"></script>

      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> -->

      <!-- CUSTOM JS -->
      <script type="text/javascript">
        function saveContent()
        {
        var iframe = document.getElementsByTagName('iframe')[0];
        var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
        var frameBody = innerDoc.querySelector('body');
        var style = frameBody.querySelector('style');
        var htmlContent = frameBody.querySelector("#wrapper");
        var html=htmlContent.innerHTML; //get html content of document
        var css=editor.getCss(); //get css content of document

        var title_template = $('#title-template').val();
        console.log(html);

        if (title_template == ''){
          alert('Isi Title Template');
           // anim5_noti();
        }else{
          $.ajax({
          type:'post',
          url: "<?php echo base_url('ApiEditorTemplate/save'); ?>",
          data :{html:html,css:css,title_template:title_template},
          dataType: 'json',
          async:true,
          type:'POST',
          // beforeSend: function () {
          // },
          // complete: function (data) {
          // },
          success: function(result) {
              alert('DATA TEMPLATE DISIMPAN ');
              // anim5_noti();
              // console.log('Save ', result);
          },
          error:function(data) {
            alert('Gagal Menyimpan ke database ');
          }
          });
        }


        

        // $.ajax(
        // {
        //     type:"post",
        //     url: "<?php echo base_url('ApiEditor/save'); ?>",
        //     dataType: json,
        //     data :{html:html,css:css},
        //     success:function(response)
        //     {
        //         console.log(response);
        //         $("#message").html(response);
        //         $('#cartmessage').show();
        //     }
        //     error: function() 
        //     {
        //         alert("Invalide!");
        //     }
        // }
        // );
        }
      </script>
      <?php if ( $this->session->flashdata('message')=='add'): ?>
        <script type="text/javascript">
          $( document ).ready(function() {
            sukses_add_page();
          });
          function sukses_add_page(){
          Lobibox.notify('success', {
            pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
            position: 'center top',
            showClass: 'rollIn',
                hideClass: 'rollOut',
                icon: 'fa fa-check-circle',
                width: 600,
            msg: 'Data berhasil ditambahkan.'
            });
          }
        </script>
      <?php endif ?>

      <?php if ( $this->session->flashdata('message')=='update'): ?>
        <script type="text/javascript">
          $( document ).ready(function() {
            sukses_add_page();
          });
          function sukses_add_page(){
          Lobibox.notify('success', {
            pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
            position: 'center top',
            showClass: 'rollIn',
                hideClass: 'rollOut',
                icon: 'fa fa-check-circle',
                width: 600,
            msg: 'Data berhasil di Update.'
            });
          }
        </script>
      <?php endif ?>


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

      <?php if ( $this->session->flashdata('message')=='exist'): ?>
        <script type="text/javascript">
          $( document ).ready(function() {
            sukses_add_page();
          });
          function sukses_add_page(){
          Lobibox.notify('warning', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'center top',
            showClass: 'rollIn',
                hideClass: 'rollOut',
                icon: 'fa fa-exclamation',
                width: 600,
            msg: 'Judul Page sudah ada , Silahkan gunakan judul lain.',
            title: "Sudah ada !",   

            });
          }
        </script>
      <?php endif ?>


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
            url:'<?php echo base_url() ?>'+'User_website/delete_page',
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
      





   </body>
</html>