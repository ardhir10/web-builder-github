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
  		    <h4 class="page-title">Data User</h4>
  		    <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data User</li>
           </ol>
  	   </div>
  	   <div class="col-sm-3">
         <div class="btn-group float-sm-right">
          <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Setting</button>
          <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
          <span class="caret"></span>
          </button>
          <div class="dropdown-menu">
            <a href="javaScript:void();" class="dropdown-item">Action</a>
            <a href="javaScript:void();" class="dropdown-item">Another action</a>
            <a href="javaScript:void();" class="dropdown-item">Something else here</a>
            <div class="dropdown-divider"></div>
            <a href="javaScript:void();" class="dropdown-item">Separated link</a>
          </div>
        </div>
       </div>
       </div>
      <!-- End Breadcrumb-->
         <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><i class="fa fa-table"></i> Data User Table
                <br>
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
                  <thead class="table-dark">
                      <tr>
                          <th>No</th>
                          <th class="sticky-th-dark">Action</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>No Telp</th>
                          <th>Nama Web</th>
                          <th>Status</th>
                          <th>Pakcage</th>
                          <th>Tanggal daftar</th>
                          <th>Expired</th>
                      </tr>
                  </thead>
                  <tbody>

                    <?php $no = 1; foreach($data_user as $row_user): ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td class="sticky-td"><a href="<?php echo base_url().$controller ?>/edit/<?php echo $row_user->ID ?>"><button type="button" class="btn btn-info btn-sm waves-effect waves-light m-1"><i class="zmdi zmdi-edit"></i> Edit</button></a></td>
                        <td><?php echo  $row_user->nama ?></td>
                        <td><?php echo  $row_user->email ?></td>
                        <td><?php echo  $row_user->no_telp ?></td>
                        <td><?php echo  $row_user->nama_web ?></td>

                        
                        <td>
                          <?php foreach ($data_user_status as $row_status): ?>
                            <?php if ($row_user->id_status == $row_status->ID): ?>
                              <span class="btn btn-sm btn-outline-<?php echo $row_status->index_color ?> btn-round btn-block"><?php echo  $row_status->keterangan_status ?></span>
                            <?php endif ?>
                          <?php endforeach ?>
                        </td>

                        <td>
                          <?php foreach ($data_package as $row_package): ?>
                            <?php if ($row_user->id_package == $row_package->ID): ?>
                             <?php echo  $row_package->nama_package ?>
                            <?php endif ?>
                          <?php endforeach ?>
                          <?php if ($row_user->id_package == 0): ?>
                              <p>Default</p>
                          <?php endif ?>
                        </td>




                        <td><?php echo  $row_user->tanggal_daftar ?></td>
                        <td><?php echo  $row_user->expired ?></td>
                       
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
	

</body>

</html>
