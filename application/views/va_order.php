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
  		    <h4 class="page-title">Data Order</h4>
  		    <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Order</li>
           </ol>
  	   </div>
  	   <div class="col-sm-3">
         <div class="btn-group float-sm-right">
          <!-- <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal-animation-14"><i aria-hidden="true" class="fa fa-plus"></i> &nbsp;Order</button> -->
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
              <div class="card-header"><i class="fa fa-table"></i> Data Order Table
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

              <?php if ($this->session->flashdata('status_update')): ?>''
                <div class="alert alert-info alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-icon">
                      <i class="fa fa-check"></i>
                  </div>
                  <div class="alert-message">
                      <span><?php echo $this->session->flashdata('status_update') ?></span>
                  </div>
                </div>
              <?php endif ?>

              </div>

              <div class="card-body">
                <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Type Order</th>
                          <th>Nama Package</th>
                          <th>Nama Website</th>
                          <th>Nama User</th>
                          <th>Status Order</th>
                          <th>Tanggal Order</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $no =1; foreach ($data_order as $row): ?>
                      <tr data-id="<?php echo $row->ID; ?>">
                        <td><?php echo $no++; ?></td>
                        <td><?php echo ($row->type_order == 'publish' ? '<span class="badge badge-pill badge-success shadow-success m-1">Publish</span>' : 'Package'); ?></td>
                        <td><?php echo $row->nama_package; ?></td>
                        <td><?php echo $row->nama_website; ?></td>
                        <td><?php 
                        foreach ($data_user as $row_user) {
                          if ($row_user->ID == $row->id_user) {
                            echo $row_user->nama;
                          }
                        }

                        ?></td>
                        <td><?php $row->status; ?><span class="badge badge-pill badge-dark shadow-success m-1">Waiting Payment</span></td>
                        <td><?php echo $row->tanggal_order; ?></td>



                        <td><a href="<?php echo base_url().$controller ?>/edit/<?php echo $row->ID ?>"><button type="button" class="btn btn-info btn-sm waves-effect waves-light m-1"><i class="zmdi zmdi-edit"></i> Edit</button></a>

                          <button type="button" onclick="" data-id="<?php echo $row->ID; ?>" class="btn btn-danger btn-sm waves-effect waves-light m-1 delete"><i class="zmdi zmdi-delete "></i> Hapus</button></td>
                      </tr>
                    <?php endforeach ?>
                    
                    


                  
                 
                  </tbody>
                 
              </table>
              </div>
              </div>
            </div>
          </div>
        </div><!-- End Row-->

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
          Copyright © 2018 Rukada Admin
        </div>
      </div>
    </footer>
	<!--End footer-->
   
  </div><!--End wrapper-->

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
