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
  		    <h4 class="page-title">Blank Page</h4>
  		    <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javaScript:void();">Rukada</a></li>
              <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
              <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
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
              <div class="card-header"><i class="fa fa-table"></i> Data Table Example</div>
              <div class="card-body">
                <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>No Telp</th>
                          <th>Nama Web</th>
                          <th>Status</th>
                          <th>Tanggal daftar</th>
                          <th>Expired</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Ardhi Ramadhan</td>
                      <td>ramadhn10@gmail.com</td>
                      <td>088-888-8888</td>
                      <td>Mayoones.com</td>
                      <td><span class="btn btn-sm btn-outline-success btn-round btn-block">Aktif</span></td>
                      <td>2018-11-10</td>
                      <td>2019-07-10</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Faiz</td>
                      <td>faiz@gmail.com</td>
                      <td>088-999-7777</td>
                      <td>Grooth.com</td>
                      <td><span class="btn btn-sm btn-outline-info btn-round btn-block">Trial</span></td>
                      <td>2018-11-10</td>
                      <td>2019-07-10</td>
                    </tr>

                    <tr>
                      <td>3</td>
                      <td>Imam</td>
                      <td>imam@gmail.com</td>
                      <td>088-000-666</td>
                      <td>Mams.com</td>
                      <td><span class="btn btn-sm btn-outline-danger btn-round btn-block">Suspend</span></td>
                      <td>2018-11-10</td>
                      <td>2019-07-10</td>
                    </tr>
                 
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>No Telp</th>
                          <th>Nama Web</th>
                          <th>Status</th>
                          <th>Tanggal daftar</th>
                          <th>Action</th>
                      </tr>
                  </tfoot>
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
