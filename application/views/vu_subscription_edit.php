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
<!--Start topbar header-->
<?php $this->load->view('common_user/user_topbar.php'); ?>
<!--End topbar header-->

<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
       <div class="row pt-2 pb-2">
          <div class="col-sm-9">
          <h4 class="page-title">Edit Subscription </h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Subscription </li>
           </ol>
       </div>
    
       </div>
      <!-- End Breadcrumb-->
        <div class="row">
          <div class="col-lg-12">
        <div class="card">
          
           <div class="card-body">
           <div class="card-title text-primary">Edit Subscription</div>
           <hr>
            <form action=" :v " method="post">
           <div class="form-group">
            <label for="input-1">Package</label>
               <select class="form-control" id="basic-select" name="package" required>
                <!-- <option data-harga="0" data-id='0' data-keterangan="-">--Pilih Package</option> -->
                <!-- <option value="0" data-id="0" data-harga="0">Default</option> -->
                <?php foreach ($data_package as $row): ?>
                    <option value="<?php echo $row->ID ?>" <?php echo ($row->ID == $data_order->id_package) ? 'selected=selected' : '';?> data-harga="<?php echo number_format($row->harga,0,'.',',') ?>" data-id="<?php echo $row->ID ?>" data-status="<?php echo $row->status ?>" data-keterangan="<?php echo $row->keterangan ?>"><?php echo $row->nama_package ?></option>
                <?php endforeach ?>

                </select>
            
           </div>

           <div class="form-group">
            <label for="input-2">Harga</label>
            <input type="text" class="form-control" id="harga" value="" disabled>
           </div>

           <div class="form-group">
            <label for="input-2">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" value="" disabled>
           </div>
           <div class="form-group">
            <label for="input-2">USer</label>
            <input type="text" class="form-control"  value="<?php echo $this->session->userdata('userNama'); ?>" disabled>
           </div>
          <!--  <div class="form-group">
            <label for="input-3">Status Package</label>
            <input type="text" class="form-control" id="status-package" id="input-3" >
           </div> -->

          
          
           <div class="form-group">
            <button type="button" id="simpan" class="btn btn-primary shadow-primary px-5"> Simpan</button>
          </div>
          </form>
         </div>
         </div>
          </div>
        </div>
        <!-- End Row-->

        <script type="text/javascript">
        </script>

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


     $("#simpan").click(function(){
            var id_package = '';
            $( "select option:selected" ).each(function() {
                id_package += $( this ).data('id') + " ";
              });

            var base_url = '<?php echo base_url() ?>';
            if(id_package == 0){
              $.alert('Pilih Package Terlebih dahulu !');
            }else{
              $('#simpan').attr('disabled',true);
              $.ajax({
                  url: base_url+'user_subscription/update/'+'<?php echo $data_order->ID ?>',
                  type: 'POST',
                  data: {id_package:id_package},
                  dataType: "json",
                 error: function() {
                    $.alert('Something is wrong');
                    $('#simpan').removeAttr('disabled');
                 },
                 success: function(data) {
                      // console.log(data);
                      window.location = "<?php echo base_url().$controller ?>";
                 }
              });
            }
            
             
    });


    $( "select" )
      .change(function() {
        var harga = "";
        var keterangan = "";
        // var status = "";
        $( "select option:selected" ).each(function() {
          harga += $( this ).data('harga') + " ";
          keterangan += $( this ).data('keterangan') + " ";
          // status += $( this ).data('status') + " ";
        });
        $( "#harga" ).val( harga );
        $( "#keterangan" ).val( keterangan );
        // $( "#status-package" ).val( status );
      })
      .trigger( "change" );


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