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
  		    <h4 class="page-title">Edit User</h4>
  		    <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit User Package</li>
           </ol>
  	   </div>
  	   <div class="col-sm-3">
         <div class="btn-group float-sm-right">

           
         
        </div>
       </div>
       </div>
      <!-- End Breadcrumb-->
         <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><i class="fa fa-table"></i> Edit Data User Form
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
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <?php foreach ($data_status as $row_status): ?>
                            <option <?php if($row_status->ID == $data_user->id_status) echo 'selected="selected"'?> value="<?php echo $row_status->ID; ?>"><?php echo $row_status->keterangan_status; ?></option>
                        <?php endforeach ?>
                      </select>
                      <input type="hidden" name="id" class="form-control" value="<?php echo $data_user->ID; ?>" >
                    </div>

                    <div class="form-group">
                      <label>Package</label>
                      <select class="form-control" name="package">
                        <option value="0">Default</option>
                        <?php foreach ($data_package as $row_package): ?>
                            <option <?php if($row_package->ID == $data_user->id_package) echo 'selected="selected"'?> value="<?php echo $row_package->ID; ?>"><?php echo $row_package->nama_package; ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Expired</label>
                      <input type="text" id="date-time-picker" name="expired" class="form-control" value="<?php if($data_user->expired == '0000-00-00 00:00:00') echo ''; else echo $data_user->expired;  ?>">
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

   <script>

     $(function () {
         
        // dat time picker
        $('#date-time-picker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });

       // only date picker
        $('#date-picker').bootstrapMaterialDatePicker({
            time: false
        });

       // only time picker
        $('#time-picker').bootstrapMaterialDatePicker({
            date: false,
            format: 'HH:mm'
        });
   

     });
    
   </script>


  
	

</body>

</html>
