<!DOCTYPE html>
<html>
<head>
  <title><?php echo $data_template->nama_template ?> : <?php echo $data_page->judul_page;?></title>
  
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<style>
    <?php echo $data_page->css;?>

    .preview__header {
        font-size: 12px;
    height: 54px;
    background-color: #262626;
    z-index: 100;
    line-height: 54px;
    /* margin-bottom: 1px; */
    /*position: sticky;
    top: 0;*/
    }
    
    .preview__envato-logo {
    float: left;
    padding: 0 20px;
    }
    .preview__actions {
    float: right;
    }
    .preview__action--buy, .preview__action--close {
    display: inline-block;
    padding: 0 20px;
    }
    .preview__action--close {
    border-left: 1px solid #333333;
    }
    
    </style>

</head>

<body>
<!-- <div id="preview_header" class="preview__header" data-view="ctaHeader">

  <div class="preview__envato-logo">
    <img src="https://goodeva.co.id/my-assets/images/logo.png" style="padding-bottom: 10px; width:90px;">
  </div>

  <div class="preview__actions">
  <div class="preview__action--buy">
    <a class="btn btn-success" style="background-color:#6f9a37;" href="https://api.whatsapp.com/send?phone=6285693268369&text=Halo%20Admin%20Saya%20Mau%20Order%20Tema">Buy now</a>
  </div>

  <div class="preview__action--close">
    <a href="#" id="remove-frame" >
      <i class="fa fa-edit"></i><span style="color:white;">Remove Frame</span>
      </a>  </div>
  </div>
</div> -->
   
    <?php echo $data_page->html;?>

<script>
    
    $(document).ready(function(){
       function remove_frame(){
           $("#preview_header").fadeOut("slow");
       }
        
    $("#remove-frame").click(function(){
        $("#preview_header").fadeOut();
        });
        
    });
        
    
    </script>
</body>

</html>