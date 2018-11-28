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
      <script src="<?php echo base_url() ?>assets/material-editor-user/dist/grapesjs/grapes.min.js"></script>
      <script src="<?php echo base_url() ?>assets/material-editor-user/dist/grapesjs/plugins/grapesjs-plugin-export.min.js"></script>
   </head>


   <body>
      <!-- Start wrapper-->
      <div id="wrapper" class="toggled">
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
            
              
                <div class="demo-heading"><h2><?php echo $data_website->nama_website ?></h2> 
                  <?php echo $data_page->judul_page; ?> 
                </div>
                <div class="form-group">
                  <!-- <label>List Page</label> -->
                  <!-- <select class="form-control">
                    <option>Home</option>
                  </select>   -->
                  <button type="button" class="btn btn-sm btn-default waves-effect waves-light" data-toggle="modal" data-target="#modal-animation-14"><i aria-hidden="true" class="zmdi zmdi-view-list-alt"></i> &nbsp;LIST PAGE</button>


                  <a href="<?php echo base_url().$controller ?>/website/<?php echo $data_website->slug_id ?>"><button type="button" class="btn btn-sm btn-info waves-effect waves-light" ><i aria-hidden="true" class="zmdi zmdi-globe-alt"></i> &nbsp;Detail Template</button></a>
                   <button class="btn btn-sm btn-primary  waves-effect waves-light" id="btnFullscreen" type="button"><i class="fa fa-arrows-alt"></i>&nbsp;Mode Fullscreen</button>


<!-- 
                  <a href="<?php echo base_url()?>preview/website/<?php echo $data_website->slug_id ?>/<?php echo $data_page->slug_id ?>" target="_blank"><button type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i aria-hidden="true" class="zmdi zmdi-eye"></i> &nbsp;Preview</button></a>
 -->
                  <button type="button" onclick="saveContent()" class="btn btn-sm btn-success waves-effect waves-light"><i aria-hidden="true" class="zmdi zmdi-save"></i> &nbsp;Save</button>




                  <style type="text/css">
                    tr:hover{
                      cursor: pointer;
                      background-color: #ccc;
                    }
                  </style>
                      <!-- Modal Add New -->
                        <div class="modal fade" id="modal-animation-14">
                          <div class="modal-dialog">
                            <div class="modal-content animated zoomInUp">
                              <div class="modal-header">
                                <h5 class="modal-title">List Page</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              <div class="table-responsive">
                                <table class="table">
                                 
                                  <tbody>
                                    <?php foreach ($data_page_result as $result_page): ?>
                                      <tr data-slug="<?php echo $result_page->slug_id ?>" >
                                        <td><?php echo $result_page->judul_page ?></td>
                                        <td><?php echo $result_page->type_page ?></td>
                                      </tr>
                                    <?php endforeach ?>
                                   

                                   

                                  </tbody>
                                </table>
                                
                              </div> 

                              </div>
                              <div class="modal-footer">
                               
                              </div>
                            </div>
                          </div>
                        </div>                
                </div>

                <!-- <button class="btn btn-success" onclick="anim5_noti()">SHOW ME</button> -->
                <div class="row">
                  <div class="col-12">

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Judul Page</label>
                          <input type="text" class="form-control" name="judul-page" id="judul-page" value="<?php echo $data_page->judul_page; ?>">
                        </div>
                      </div>
                    </div>
                   
                    <!-- EDITOR START -->
                      <div id="gjs" style="height: 1000px !importants;">
                      <style type="text/css">
                        <?php echo $data_page->css ?>
                      </style>
                      <?php echo $data_page->html ?>

                      </div>
                    <!-- EDITOR END -->
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
      <?php $this->load->view('common_admin/admin_jquery.php'); ?>
      <!-- END JQUERY -->

      <!-- Add On Js -->
      <script src="<?php echo base_url() ?>assets/material-editor-user/dist/gramateria/develop/gramateria.js"></script>

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
        var id='<?php echo $data_page->ID ?>'; //get css content of document

        var judul_page = $('#judul-page').val();
        var judul_page     = $('#judul-page').val();
        console.log(html);

        if (judul_page == ''){
          alert('Isi Judul Page');
           // anim5_noti();
        }else{
          $.ajax({
          type:'post',
          url: "<?php echo base_url('ApiEditor/update_page'); ?>",
          data :{id:id,html:html,css:css,judul_page:judul_page},
          dataType: 'json',
          async:true,
          type:'POST',
          // beforeSend: function () {
          // },
          // complete: function (data) {
          // },
          success: function(result) {
              alert('DATA TEMPLATE DISIMPAN ');
              // location.reload();

              window.location = "<?php echo base_url().$controller ?>/website/<?php echo $data_website->slug_id ?>/"+result.slug_id;

              // anim5_noti();
              console.log(result);
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

      <script type="text/javascript">
        $( document ).ready(function() {


          $("tr").click(function(){
            var id_page = $(this).data("slug");
           window.location = "<?php echo base_url().$controller ?>/website/<?php echo $data_website->slug_id  ?>/"+id_page;
         });
        });
        
      </script>

      <script>
        function toggleFullscreen(elem) {
          elem = elem || document.documentElement;
          if (!document.fullscreenElement && !document.mozFullScreenElement &&
            !document.webkitFullscreenElement && !document.msFullscreenElement) {
            if (elem.requestFullscreen) {
              elem.requestFullscreen();
            } else if (elem.msRequestFullscreen) {
              elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
              elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
              elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
          } else {
            if (document.exitFullscreen) {
              document.exitFullscreen();
            } else if (document.msExitFullscreen) {
              document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
              document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
              document.webkitExitFullscreen();
            }
          }
        }

        document.getElementById('btnFullscreen').addEventListener('click', function() {
          toggleFullscreen(document.getElementById('gjs'));
        });

      
        </script>

        <script type="text/javascript">


            $( document ).ready(function() {
                // $.getJSON( '<?php echo base_url() ?>'+'apigambar/read_image', function( data ) {
                //   console.log( data );
                // });

            });
            
        </script>

        <script type="text/javascript">
          // var am = editor.AssetManager;
          const am = editor.AssetManager;
          var base_url = '<?php echo base_url(); ?>';
          var assets = am.getAll(); // <- Backbone collection

          // Extend the original `image`
          // assets.addType('image',  {
          //   view: {
          //     onRemove(e) {
          //       e.stopPropagation();
          //       const model = this.model;

          //       if (confirm('Are you sure you want to delete this?')) {
          //         delete_action();
          //         model.collection.remove();
          //       }

                  

          //       // confirm('Are you sure?') && model.collection.remove(model);
          //       // confirm('Are you sure?') && delete_action();
          //     }
          //   },
          // });

          am.addType('image', {
              // As you adding on top of an already defined type you can avoid indicating
              // `am.getType('image').view.extend({...` the editor will do it by default
              // but you can eventually extend some other type
              view: {
                // If you want to see more methods to extend check out
                // https://github.com/artf/grapesjs/blob/dev/src/asset_manager/view/AssetImageView.js
                // onRemove(e) {
                //   e.stopPropagation();
                //   const model = this.model;

                //   if (confirm('Are you sure?')) {
                //     model.collection.remove(model);
                //   }
                // }

                onRemove(e) {
                  e.stopImmediatePropagation();
                  if (confirm('Are you sure?')) {
                      delete_action();
                      this.model.collection.remove(this.model);
                  }

                }
              },
            })

          function delete_action(){
                assets.on('remove', function(asset) {
                  var src_file = asset.get('src');
                  var nama_file = asset.get('name');
                  var id_file = asset.get('id');
                    $.ajax({
                      url: base_url+'Apigambar/delete',
                      type: 'POST',
                      data: {id_file:id_file,nama_file:nama_file},
                      dataType: 'json',
                      success: function(result){
                          alert(nama_file+' '+'Berhasil dihapus');
                          console.log(result);
                          // alert('success');
                      }
                  });
                })
            
          }

          // ==================

          // editor.on('asset:remove', () => {
          //   if (!window.confirm("Are you sure s?")) {
          //     // HERE I WOULD LIKE TO BREAK THE REMOVE ACTION.
              
          //   }else{
          //     assets.on('remove', function(asset) {
          //       var src_file = asset.get('src');
          //       var nama_file = asset.get('name');
          //       var id_file = asset.get('id');

          //         $.ajax({
          //           url: base_url+'Apigambar/delete',
          //           type: 'POST',
          //           data: {id_file:id_file,nama_file:nama_file},
          //           dataType: 'json',
          //           success: function(result){
          //               console.log(result);
          //               // alert('success');
          //           }
          //       });
          //     })
          //   }
          // });
      


          // assets.on('remove', function(asset) {
          //   var src_file = asset.get('src');
          //   var nama_file = asset.get('name');
          //   var id_file = asset.get('id');

          //     $.ajax({
          //       url: base_url+'Apigambar/delete',
          //       type: 'POST',
          //       data: {id_file:id_file,nama_file:nama_file},
          //       dataType: 'json',
          //       success: function(result){
          //           console.log(result);
          //           // alert('success');
          //       }
          //   });
          // })

          

          


            
          am.add([
          <?php foreach ($data_image as $row): ?>

            {
                id:'<?php echo $row->ID; ?>',
                type: 'image',
                name: '<?php echo $row->gambar; ?>',
                src: base_url+'image-server/website/'+'<?php echo $row->gambar; ?>',
                date: '<?php echo $row->tanggal_dibuat; ?>',
                height: 800,
                width: 1600
            },
          <?php endforeach ?>
           
            // ...
          ]);

          editor.on('asset:upload:start', () => {
            alert('Upload');
          });



        </script>







   </body>
</html>