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
         <!--Start topbar header-->
         <?php $this->load->view('common_admin/admin_topbar.php'); ?>
         <!--End topbar header-->
         <div class="clearfix"></div>
         <div class="content-wrapper">
            <div class="container-fluid">
               <!-- Breadcrumb-->
               <div class="row pt-2 pb-2">
                  <div class="col-sm-9">
                     <h4 class="page-title">Proses Website </h4>
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Proses Website </li>
                     </ol>
                  </div>
               </div>
               <!-- End Breadcrumb-->
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="card-title text-primary">Proses Website</div>
                           <hr>
                           <?php if ($this->session->flashdata('message') == 'failed'): ?>
                           <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <div class="alert-icon">
                                 <i class="fa fa-close"></i>
                              </div>
                              <div class="alert-message">
                                 <span>Gagal mohon isi form dengan benar !</span>
                              </div>
                           </div>
                           <?php endif ?>


                           <?php if ($this->session->flashdata('message') == 'confirm'): ?>
                           <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <div class="alert-icon">
                                 <i class="fa fa-refresh"></i>
                              </div>
                              <div class="alert-message">
                                 <span>Data berhasil di update !</span>
                              </div>
                           </div>
                           <?php endif ?>

                           

                           <form action="<?php echo base_url().$controller ?>/update_status_website/<?php echo $data_order->ID ?>/<?php echo $data_order->id_website ?>" method="post" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <section class="invoice">
                                       <!-- title row -->
                                       <div class="row mt-3">
                                          <div class="col-lg-6">
                                             <h4><i class="fa fa-globe"></i> <?php echo $data_order->nama_website ?></h4>
                                          </div>
                                         <!--  <div class="col-lg-6">
                                             <h5 class="float-sm-right">Tanggal Order : <?php echo $data_order->tanggal_order ?></h5>
                                          </div> -->
                                       </div>
                                       <hr>
                                       

                                       <div class="row">
                                          <!-- accepted payments column -->
                                          <div class="col-lg-12 payment-icons">
                                             <p class="lead">Detail Website :</p>
                                             <div class="table-responsive">
                                              <table class="table">
                                              <tbody>
                                                  <tr>
                                                    <th style="width:50%">Nama Website :</th>
                                                    <td><?php echo $data_website->nama_website ?></td>
                                                  </tr>
                                                 
                                                  <tr>
                                                    <th>Type:</th>
                                                    <td>
                                                      <?php foreach ($type_template as $row_tt): ?>
                                                          <?php if ($row_tt->ID == $data_website->type_template): ?>
                                                            <span class="badge badge-<?php echo $row_tt->label ?>"><?php echo $row_tt->nama_type ?></span>
                                                          <?php endif ?>
                                                      <?php endforeach ?>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <th>Nama User : </th>
                                                    <td><?php 
                                                      foreach ($data_user as $row_user) {
                                                        if ($row_user->ID == $data_order->id_user) {
                                                          echo $row_user->nama;
                                                        }
                                                      }

                                                      ?></td>
                                                  </tr>

                                                  <tr>
                                                    <th>Jumlah Page : </th>
                                                    <td><?php 
                                                      echo $jumlah_page;

                                                      ?></td>
                                                  </tr>

                                                   <tr>
                                                    <th>Status : </th>
                                                    <td><?php
                                                     if($data_website->status_website == 'Published') {
                                                        echo '<span class="badge badge-success">Published</span>'; 
                                                     }elseif ($data_website->status_website == 'Not Published'){ 
                                                       echo '<span class="badge badge-danger">Not Published</span>';
                                                     }else{
                                                       echo '<span class="badge badge-dark">On Process</span>';
                                                     }
                                                       ?></td>
                                                  </tr>
                                                  
                                                </tbody>
                                              </table>
                                          </div>
                                             
                                          </div>
                                          <!-- /.col -->
                                         
                                          <!-- /.col -->
                                       </div>
                                       <!-- /.row -->
                                       <hr>

                                       <div class="row invoice-info">
                                          <div class="col-sm-4 invoice-col">
                                             <img class="img-fluid" src="<?php echo base_url(); ?>assets/images/websites/<?php echo $data_website->photo ?>">
                                          </div>
                                          <!-- /.col -->
                                          <div class="col-sm-8 invoice-col">
                                             <div class="row">
                                                <div class="col-12 table-responsive">
                                                   <table class="table table-striped">
                                                      <thead>
                                                         <tr>
                                                            <th>No</th>
                                                            <th>Nama Page</th>
                                                            <th>Type Page</th>
                                                            
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $no = 1; foreach ($data_page as $row): ?>
                                                          <tr>
                                                              <td><?php echo $no++ ?></td>
                                                              <td><?php echo $row->judul_page ?></td>
                                                              <td><?php echo $row->type_page ?></td>
                                                              
                                                           </tr>
                                                        <?php endforeach ?>
                                                         
                                                        
                                                      </tbody>
                                                   </table>
                                                </div>
                                                <!-- /.col -->
                                             </div>
                                          </div>
                                          <!-- /.col -->
                                          
                                          <!-- /.col -->
                                       </div>
                                       <div class="text-muted bg-light p-2 mt-3 border rounded">
                                          <div class="row">
                                            <div class="col-lg-12 ">
                                              <div class="table-responsive">
                                                <table>
                                                  <tr>
                                                    <th style="padding-right: 20px;">Status Website  : 
                                                    </th>
                                                    <!-- <th style="padding-right: 20px;">
                                                     Website  : 
                                                    </th> -->
                                                  </tr>
                                                  <tr>
                                                    <td style="padding-right: 20px;">
                                                      <div class="form-group">
                                                        <select class="form-control" name="status_website">
                                                          <option <?php echo ($data_website->status_website == 'Published' ? 'selected=selected' : ''); ?> value="Published">Published</option>
                                                          <option  <?php echo ($data_website->status_website == 'On Process' ? 'selected=selected' : ''); ?> value="On Process">On Process</option>
                                                          <option <?php echo ($data_website->status_website == 'Not Published' ? 'selected=selected' : ''); ?> value="Not Published">Not Published</option>
                                                        </select>
                                                      </div>
                                                    </td>
                                                    <td style="padding-right: 20px;">
                                                      <div class="form-group">
                                                        <a target="_blank" href="<?php echo base_url() ?>preview/website-user/<?php echo $data_website->slug_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-eye"> </i> Pratinjau</button></a>
                                                      </div>

                                                     <!--  <?php  
                                                      foreach ($status_order as $row_so) {
                                                        if ($row_so->ID == $data_order->status) {
                                                            echo '<span class="badge  badge-'.$row_so->atribut.' shadow-'.$row_so->atribut.' m-1">'.$row_so->nama_status.'</span>';
                                                          }
                                                        }?> -->
                                                    </td>
                                                    <td style="padding-right: 20px;">
                                                      <div class="form-group">
                                                        <a href="<?php echo base_url() ?>zip/download_asset_website/<?php echo $data_website->ID ?>"><button type="button" class="btn btn-dark"><i class="fa fa-download"> </i> Download Asset</button></a>
                                                      </div>
                                                    </td>
                                                  </tr>
                                                </table>
                                                
                                              </div>
                                              
                                            </div> 
                                           
                                          </div>

                                       </div>
                                       
                                       <!-- /.row -->
                                       <!-- this row will not appear when printing -->
                                       <hr>
                                      
                                    </section>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <button type="submit" id="" class="btn btn-success shadow-success px-5"> Simpan</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Row-->
            </div>
            <!-- End container-fluid-->
            <div class="overlay"></div>
         </div>
         <!--End content-wrapper-->
         <!--Start Back To Top Button-->
         <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
         <!--End Back To Top Button-->
         <!--Start footer-->
         <footer class="footer">
            <div class="container">
               <div class="text-center">
                  Copyright © 2018 Rukada admin
               </div>
            </div>
         </footer>
         <!--End footer-->
      </div>
      <!--End wrapper-->
      <!-- JQUERY -->
      <?php $this->load->view('common_admin/admin_jquery.php'); ?>
      <!-- END JQUERY -->
      <script>
         $(document).ready(function() {
          //Default data table
           $('#default-datatable').DataTable();
         
         
           var table = $('#example').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
          } );
         
         table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
         
          } );
         
      </script>
      <script type="text/javascript">
         function anim5_noti(){
           Lobibox.notify('success', {
             pauseDelayOnHover: true,
                 continueDelayOnInactiveTab: false,
             position: 'center top',
             showClass: 'rollIn',
                 hideClass: 'rollOut',
                 icon: 'fa fa-check-circle',
                 width: 600,
             msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
             });
           }
      </script>
      <!-- Sweet Alert -->
      <script type="text/javascript">
         $(document).ready(function(){
         
         
           //  $("#simpan").click(function(){
           //         var id_package = '';
           //         $( "select option:selected" ).each(function() {
           //             id_package += $( this ).data('id') + " ";
           //           });
         
           //         var base_url = '<?php echo base_url() ?>';
           //         if(id_package == 0){
           //           $.alert('Pilih Package Terlebih dahulu !');
           //         }else{
           //           $('#simpan').attr('disabled',true);
           //           $.ajax({
           //               url: base_url+'user_subscription/update/'+'<?php echo $data_order->ID ?>',
           //               type: 'POST',
           //               data: {id_package:id_package},
           //               dataType: "json",
           //              error: function() {
           //                 $.alert('Something is wrong');
           //                 $('#simpan').removeAttr('disabled');
           //              },
           //              success: function(data) {
           //                   // console.log(data);
           //                   window.location = "<?php echo base_url().$controller ?>";
           //              }
           //           });
           //         }
                   
                    
           // });
         
         
         
         
         
             // =========
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
                   $("tr[data-id='"+id+"']").fadeOut(1500,function(){
                       $(this).remove();
                   });
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
                   url:'<?php echo base_url() ?>'+'admin_kategori/delete',
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
                       // location.reload();
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