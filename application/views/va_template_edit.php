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

      <!-- ADD ON CSS -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/material-editor/dist/grapesjs/grapes.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/material-editor/dist/gramateria/develop/gramateria.css">

      <link rel="shortcut icon" href="favicon.ico" />
      <script src="<?php echo base_url() ?>assets/material-editor/dist/grapesjs/grapes.min.js"></script>
      <script src="<?php echo base_url() ?>assets/material-editor/dist/grapesjs/plugins/grapesjs-plugin-export.min.js"></script>
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
            
              
                <div class="demo-heading"><?php echo $title_card; ?> | LIVE TEMPLATE EDITOR</div>
                <!-- <button class="btn btn-success" onclick="anim5_noti()">SHOW ME</button> -->
                <form method="post" action="<?php echo base_url().$controller; ?>/update_detail_template" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Template :</label>
                        <input type="text" name="nama_template" value="<?php echo $data_template->nama_template ?>" class="form-control" id="title-template" required>
                        <input type="hidden" name="id" value="<?php echo $data_template->ID ?>" class="form-control" id="title-template" required>
                        <input type="hidden" name="slug_id_old" value="<?php echo $data_template->slug_id ?>" class="form-control" id="title-template" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori Template :</label>
                        <select name="id_kategori" class="form-control" required>
                          <!-- <option>-Pilih Kategori</option> -->
                          <?php foreach ($kategori_template as $row_kategori): ?>
                          <option value="<?php echo $row_kategori->ID ?>" 
                            <?php if ($data_template->id_kategori == $row_kategori->ID) {
                              echo 'selected=selected';
                            } ?>

                            ><?php echo $row_kategori->nama_kategori ?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type Template :</label>
                        <select name="id_type" class="form-control" required>
                          <!-- <option>-Pilih Type</option> -->
                          <?php foreach ($type_template as $row_type): ?>
                          <option value="<?php echo $row_type->ID ?>" 
                            <?php if ($data_template->id_type == $row_type->ID) {
                              echo 'selected=selected';
                            } ?>
                           ><?php echo $row_type->nama_type ?></option>
                          <?php endforeach ?>
                        </select>
                    </div>

                      <div class="form-group">
                          <label>Gambar Thumbnail :</label>
                          <br>
                          <img id="blah" alt="your image" src="<?php echo base_url() ?>assets/images/templates/<?php echo $data_template->photo ?>" style="max-width: 200px;height: auto;" />
                          <input type="file" class="form-control" name="gambar" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                          <input type="hidden" name="gambar_old" value="<?php echo $data_template->photo ?>"> 
                          <small class="text-danger">*Max Ukuran file 2MB</small>
                      </div>
                      <div class="form-group">
                        <a href="<?php echo base_url().$controller; ?>">
                        <button  class="btn btn-danger">Batal</button>
                        </a>
                       <button type="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </div>
                </form>
                


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
      <?php $this->load->view('common_admin/admin_jquery.php'); ?>
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
            msg: 'Template sudah ada , Silahkan gunakan judul lain.',
            title: "Sudah ada !",   

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

      <?php if ( $this->session->flashdata('message')=='image'): ?>
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
            msg: 'Upload gambar gagal.',
            title: "Cek file gambar anda",   

            });
          }
        </script>
      <?php endif ?>





   </body>
</html>