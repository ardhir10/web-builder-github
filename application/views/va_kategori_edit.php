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
  		    <h4 class="page-title">Edit Data Kategori</h4>
  		    <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit  Data Kategori</li>
           </ol>
  	   </div>
  	   <div class="col-sm-3">
         <div class="btn-group float-sm-right">
          <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal-animation-14"><i aria-hidden="true" class="fa fa-plus"></i> &nbsp;Kategori</button>
          <!-- Modal Add New -->
            <div class="modal fade" id="modal-animation-14">
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
                       <input type="text" class="form-control" name="nama_kategori" placeholder="Nama Kategori" required="">
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
          
        </div>
       </div>
       </div>
      <!-- End Breadcrumb-->
         <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><i class="fa fa-table"></i> Edit Data Kategori Form
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
                  <form action="<?php echo base_url().$controller ?>/update" method="post">

                    <div class="form-group">
                      <label>Nama Package</label>
                      <input type="text" name="nama_kategori" class="form-control" value="<?php echo $data_kategori_edit->nama_kategori ?>" >
                      <input type="hidden" name="id" class="form-control" value="<?php echo $data_kategori_edit->ID; ?>" >
                    </div>
                  
                    

                    <div class="form-group">
                      <a href="<?php echo base_url().$controller ?>" class="btn btn-danger">Cancel</a>
                      <input type="submit" name="submit" value="Update" class="btn btn-success">
                    </div>
                  </form>  
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


  
	

</body>

</html>
