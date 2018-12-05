<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="desscription" content=""/>
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
<!--Start topbar header-->
<?php $this->load->view('common_user/user_topbar.php'); ?>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
       <div class="row pt-2 pb-2">
          <div class="col-sm-9">
  		    <h4 class="page-title">Data Subscription </h4>
  		    <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Subscription </li>
           </ol>
  	   </div>
  	   <div class="col-sm-3">
         <div class="btn-group float-sm-right">
          <a href="<?php echo base_url().$controller ?>/add"  class="btn btn-success waves-effect waves-light"><i aria-hidden="true" class="fa fa-plus"></i> &nbsp;Add Subscription</a>
          <!-- Modal Add New -->
           <!--  <div class="modal fade" id="modal-animation-14">
              <div class="modal-dialog">
                <div class="modal-content animated zoomInUp">
                  <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" action="<?php echo base_url().$controller ?>/create">

                  <div class="modal-body">
                     <div class="form-group">
                       <label for="input-1">Nama Kategori</label>
                       <input type="text" class="form-control" name="nama_kategori" placeholder="Nama Order" required="">
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
          -->
        </div>
       </div>
       </div>
      <!-- End Breadcrumb-->
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><i class="fa fa-table"></i> Data Subscription  Table
                <br>

              <?php if ($this->session->flashdata('status_tambah')): ?>''
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-icon">
                      <i class="fa fa-check"></i>
                  </div>
                  <div class="alert-message">
                      <span><?php echo $this->session->flashdata('status_tambah') ?></span>
                  </div>
                </div>
              <?php endif ?>

              

              </div>

              <div class="card-body">

                <?php if ($this->session->flashdata('message')=='add'): ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon">
                     <i class="fa fa-check"></i>
                    </div>
                    <div class="alert-message">
                      <span><strong>Success!</strong> Berhasil Add Subcription</span>
                    </div>
                  </div>
                <?php endif ?>

                <?php if ($this->session->flashdata('status_update')!= ''): ?>
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon">
                     <i class="fa fa-check"></i>
                    </div>
                    <div class="alert-message">
                      <span><strong>Success!</strong> Data berhasil di Update </span>
                    </div>
                  </div>
               
                <?php endif ?>

                <?php if ($this->session->flashdata('message')=='exist'): ?>
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon">
                     <i class="fa fa-close"></i>
                    </div>
                    <div class="alert-message">
                      <span><strong>Warning !</strong> Anda telah melakukan subsrciption , silahkan hapus atau edit Package sebelumnya</span>
                    </div>
                  </div>
                <?php endif ?>
                <?php if ($this->session->flashdata('message')=='delete'): ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon">
                     <i class="fa fa-trash"></i>
                    </div>
                    <div class="alert-message">
                      <span><strong>Delete !</strong> Subscription anda telah berhasil dihapus </span>
                    </div>
                  </div>
                <?php endif ?>

                <?php if ($this->session->flashdata('message') == 'confirm'): ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="alert-message">
                        <span>Konfirmasi berhasil pembayaran telah di kirim ! </span>
                    </div>
                  </div>
                <?php endif ?>
                

                <div class="table-responsive">
                  <table id="default-datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th style="text-align:center; vertical-align: middle;">Action</th>
                            <th>No Order</th>
                            <th>Type Order</th>
                            <th>Status Order</th>
                            <th>Tanggal Order</th>

                            <th>Nama Package</th>

                            <th>Harga</th>
                            <th>Jumlah Bayar</th>

                            <th>Nama Website</th>
                            <th>Nama User</th>
                            <th>Expired</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($data_subscription as $row): ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td style="text-align:center; vertical-align: middle;" >

                              <!-- Jika Status Expired -->
                                  <?php if ($row->status==6) {?>
                                    <span class="badge badge-danger shadow-danger">Subcription has been Expired</span>


                                  <?php }elseif($row->status==4){ ?>
                                  
                                    <span class="badge badge-success shadow-success">Subcription has been Verified</span>
                                    <br>
                                    <br>
                                    <?php if ($row->type_order == 'package'): ?>
                                      <form action="<?php echo base_url().$controller ?>/perpanjang_package/<?php echo $row->type_order ?>/<?php echo $row->ID ?>" method="post" >
                                        <button  type="submit" class="btn btn-sm btn-success">Perpanjang</button>
                                      </form>
                                    <?php endif ?>

                                  <?php }elseif($row->status == 5 ){ ?>
                                    <span class="badge badge-danger shadow-danger">Subcription has been Cancelled</span>
                                  <?php }else{ ?>
                                    <?php if ($row->status == 1 ): ?>
                                      <a href="<?php echo $controller ?>/edit/<?php echo $row->type_order ?>/<?php echo $row->ID ?>"><button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit</button></a>
                                    <?php endif ?>
                                    <a href="<?php echo $controller ?>/confirm_subscription/<?php echo $row->type_order ?>/<?php echo $row->ID ?>"><button type="button" class="btn btn-warning btn-sm"> <i class="fa fa-check"></i> Confirm</button></a>
                                      <button type="button" class="btn btn-danger btn-sm" onclick="$.confirm('Apa anda yakin ingin membatalkan Subscription ',function(a){
                                        if(a==true){
                                          window.location = '<?php echo base_url().$controller ?>/delete/<?php echo $row->ID ?>';
                                        }else{
                                          $.alert('Batal dihapus !');
                                        }
                                      });"><i class="fa fa-close"></i> Cancel</button>
                                  <?php } ?>


                                
                                
                            </td>
                            <td><?php echo $row->no_order; ?></td>

                            <td><?php 
                            if ($row->type_order == 'publish') {
                               echo '<span class="badge badge-pill badge-success shadow-success m-1"><i class="fa fa-rocket"></i> Publish</span>';
                            }elseif ($row->type_order == 'package') {
                              echo '<span class="badge badge-pill badge-info shadow-info m-1"><i class="fa fa-inbox"></i> Package</span>';
                            }elseif ($row->type_order == 'update') {
                              echo '<span class="badge badge-pill badge-primary shadow-primary m-1"><i class="fa fa-refresh"></i> Update</span>';
                            }

                           ?></td>
                           <td><?php 
                            foreach ($status_order as $row_so) {
                              if ($row_so->ID == $row->status) {
                                echo '<span class="badge badge-pill badge-'.$row_so->atribut.' shadow-'.$row_so->atribut.' m-1">'.$row_so->nama_status.'</span>';
                              }
                            }
                            ?>
                              
                            </td>
                            <td><?php echo $row->tanggal_order; ?></td>

                            <td><?php echo $row->nama_package; ?></td>

                            
                            <td>Rp<?php echo number_format($row->harga,0,'.','.'); ?></td>
                            <td>Rp<?php echo number_format($row->jumlah_bayar,0,'.','.'); ?></td>
                            <td><?php echo $row->nama_website; ?></td>
                            
                            <td><?php echo $this->session->userdata('userNama'); ?></td>
                            <td><?php echo $row->expired; ?></td>

                            
                            
                          </tr>
                      <?php endforeach ?>
            
                      


                    
                   
                    </tbody>
                     
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Row-->

    </div>
    <!-- End container-fluid-->

    <div class="overlay"></div>
    
  </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2018 Rukada user
        </div>
      </div>
    </footer>
	<!--End footer-->
   
  </div><!--End wrapper-->

  <!-- JQUERY -->
  <?php $this->load->view('common_user/user_jquery.php'); ?>
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
            url:'<?php echo base_url() ?>'+'user_kategori/delete',
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
