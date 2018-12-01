<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_website extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->model('Model_template');
        $this->load->model('Model_website');
        $this->load->model('Model_package');
        $this->load->model('Model_order');
        $this->load->model('Model_template_page');
        $this->load->model('Model_website_page');
        $this->load->model('ApiModelImage');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        date_default_timezone_set("Asia/Jakarta");

        // cek session
        if ($this->session->userdata('userLogged') != TRUE) {
            redirect(base_url('user-panel'));
        }
    }

    



    private $controller = 'User_website';
   

    public function index()
    {
        // ambil cookie
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Website User | Goodeva';

        $id_user = $this->session->userdata('userID');

        $data['data_website'] = $this->Model_website->get_website($id_user)->result();





       
        if($this->session->userdata('userPackage') == 0){
            $data['template_result'] = $this->Model_template->get_data()->result();
        }
        // print_r($data['website']);
        $this->load->view('vu_website',$data);

    	
    }

    function add()
    {
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'New Website | Goodeva';


        if($this->session->userdata('userPackage') == 0){
            $data['template_result'] = $this->Model_template->get_data_free()->result();
        }else{
            $data['template_result'] = $this->Model_template->get_data()->result();
        }




        // $this->load->view('va_template',$data);

        // print_r($data['website']);
        $this->load->view('vu_website_add',$data);
    }


    function use_template()
    {
        $id_template = $this->input->post('id_template');
        // $id_template = 65;


        // Get Data Template
        $where['data_template']   = array(
            'ID' => $id_template 
        ); 

        $data_template = $this->Model_template->edit_data($where['data_template'])->row();


        // Insert Data to User Website

        $cek_data           = $this->Model_website->get_data()->num_rows();
        
        $id_website         = $this->Model_website->get_data()->row();

        $slug_awal          = $data_template->slug_id;
        $id_user = $this->session->userdata('userID');

        $nama_file_foto = $id_user.time().$data_template->photo;



        // Membuat Prefix Awal untukk Link Website
        if ($cek_data > 0) {
            $website_id         = $id_website->ID+1;
            $slug_id_website    = $website_id."-".$data_template->slug_id;
        }else{
            $slug_id_website    = $data_template->slug_id;
        }



        $data['template_data'] = array(
            'nama_website'  => $data_template->nama_template,
            'slug_id'       => $slug_id_website,
            'id_user'       => $this->session->userdata('userID'),
            'template_id'   => $id_template,
            'tanggal_dibuat'=> date('Y-m-d H:i:s'),
            'type_template' => $data_template->id_type,
            'photo'         => $nama_file_foto
        );

        $insert = $this->Model_website->insert_data($data['template_data']);

        $id     = $this->db->insert_id();

        $data['return_json'] = array(
            'ID'            => $id,
            'nama_website'  => $data_template->nama_template,
            'slug_id'       => $slug_id_website,
            'id_user'       => $this->session->userdata('userID'),
            'template_id'   => $id_template,
            'tanggal_dibuat'=> date('Y-m-d H:i:s'),
            'type_template' => $data_template->id_type,
            'photo'         => $nama_file_foto
        );



        // Update Digunakan
        $data['in_use'] = array(
            'digunakan' => $data_template->digunakan+1
        );


        $update = $this->Model_template->update_data($where['data_template'],$data['in_use']);

        $this->use_page($id_template,$slug_awal);

        // Memindahkan Thumbnails themplate to Website User
        $file_awal = './assets/images/templates/'.$data_template->photo;
        $file_baru = './assets/images/websites/'.$nama_file_foto;

        copy($file_awal,$file_baru);

        $myObj = (object) array();
        $myObj->records  = $data['return_json'];
        echo json_encode($myObj);
    }

    
    function edit($slug_id){
        
            //==== Inisiasi Awal
            $id_user= $this->session->userdata('userID');
            $data['controller']                 = $this->controller;
            $data['title_page']                 = 'Edit Website | Goodeva';
            $data['title_card']                 = 'Edit Website';
           
          
           
        
            $validasi_data      = $this->Model_website->data_website_validate($slug_id,$id_user)->num_rows();

            if($validasi_data > 0){
                $data['data_website']      = $this->Model_website->data_website_validate($slug_id,$id_user)->row();

                $this->load->view('vu_website_edit_detail',$data);
            }else{
                // redirect($_SERVER['HTTP_REFERER']);
                redirect(base_url().$this->controller);
            }



    }
    
    

    function use_page($id_template,$slug_awal)
    {
        //  Insert data Page User Website
        $where['data_page_where'] = array(
            'id_template' => $id_template
        );

        $template_page = $this->Model_template_page->edit_data($where['data_page_where'])->result();
        $data_website  = $this->Model_website->get_data()->row();

        foreach ($template_page as $row_template ) {
           $data['template_data_page'] = array(
                'id_website'    => $data_website->ID,
                'judul_page'    => $row_template->judul_page,
                'slug_id'       => $row_template->slug_id,
                'css'           => $row_template->css,
                'html'          =>  str_replace('./'.$slug_awal,'./'.$data_website->slug_id, $row_template->html),
                'tanggal_dibuat'=> date('Y-m-d H:i:s'),
                'type_page'     => $row_template->type_page,
                'id_user'       => $this->session->userdata('userID'),
           );
           $insert_data_page = $this->Model_website_page->insert_data($data['template_data_page']);

        }
    }


 




    function website($slug_id)
    {

        if($this->uri->segment('4') != NULL){
            //==== Inisiasi Awal 
            $slug_id_page       = $this->uri->segment('4');
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Edit Page | Goodeva';
            $data['title_card'] = 'Page';
            $id_user = $this->session->userdata('userID');



            $cek_data_website           = $this->Model_website->get_data_website($slug_id,$id_user)->num_rows();

            $data['data_website']       = $this->Model_website->get_data_website($slug_id,$id_user)->row();



            if ($cek_data_website > 0) {
                $cek_data_page              = $this->Model_website_page->get_page_child($data['data_website']->ID,$slug_id_page,$id_user)->num_rows();
                $data['data_page']          = $this->Model_website_page->get_page_child($data['data_website']->ID,$slug_id_page,$id_user)->row();
                $data['data_page_result']   = $this->Model_website_page->get_page($data['data_website']->ID,$id_user)->result();
                $data['data_image']         = $this->ApiModelImage->get_my_image($id_user)->result();

                // print_r($data['data_image']);

                
                if ($cek_data_page>0) {
                    // print_r($data['data_page']);
                    $this->load->view('vu_website_page_editor',$data);
                }else{
                    echo "Page Not Found";
                }
            }else{
                echo "Website Not Found";
            }







        }
        else{
            $id_user = $this->session->userdata('userID');
            $cek_data_website           = $this->Model_website->get_data_website($slug_id,$id_user)->num_rows();
            $data['data_website']       = $this->Model_website->get_data_website($slug_id,$id_user)->row();
            if ($cek_data_website > 0) {
                //==== Inisiasi Awal 
                $data['controller'] = $this->controller;
                $data['title_page'] = 'Website : '.$data['data_website']->nama_website.' | Goodeva';
                $data['data_package']=$this->Model_package->edit_data(array('status'=>'publish'))->result();
                $data['data_page']  = $this->Model_website_page->get_page($data['data_website']->ID,$id_user)->result();
                $data['jumlah_page']  = $this->Model_website_page->get_page($data['data_website']->ID,$id_user)->num_rows();

                // print_r($data['data_page']);

                $this->load->view('vu_website_edit',$data);
            }else{
                echo "Website Not Found";
            }
        }

        
    }

    function create_new_page()
    {
        $judul_page  = $this->input->post('judul_page');
        $id_website  = $this->input->post('id_website' );
        $id_user     = $this->session->userdata('userID');

        $cek_slug_page = $this->Model_website_page->cek_slug_page($id_website,$this->clean($judul_page),$id_user)->num_rows();

        if ($cek_slug_page>0) {
            $this->session->set_flashdata('message','exist');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $data = array(
                    'id_website'        => $id_website,
                    'judul_page'        => $judul_page,
                    'slug_id'           => $this->clean($judul_page),
                    'css'               => '* { box-sizing: border-box; } body {margin: 0;}#nav-mobile{transform:translateX(-100%);}#icpyb{display:block;transform:translate3d(-50%, 281px, 0px);}#ict7f{display:block;transform:translate3d(-50%, 4px, 0px);}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;background-color:rgb(255, 255, 255);}#nav-mobile{transform:translateX(-100%);}nav .brand-logo, nav ul a{color:rgb(68, 68, 68);}footer.gram-footer ul.collection > li.collection-header, footer.gram-footer ul.collection > li.collection-item{background-image:initial;background-position-x:0px;background-position-y:0px;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-top-style:initial;border-right-style:initial;border-bottom-style:initial;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:initial;border-left-color:initial;border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}footer.gram-footer ul.collection{border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-top-style:initial;border-right-style:initial;border-bottom-style:initial;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:initial;border-left-color:initial;border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}footer.page-footer{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}#contact input#your-email, #contact textarea#your-message{color:rgb(255, 255, 255);}section#members{width:100%;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(246, 247, 249);padding-top:40px;padding-right:0px;padding-bottom:40px;padding-left:0px;}.single-member .profile-img{width:80px;height:80px;border-top-left-radius:100%;border-top-right-radius:100%;border-bottom-right-radius:100%;border-bottom-left-radius:100%;}.single-member h5{font-size:16px;}.single-member p{font-size:12px;color:rgb(119, 119, 119);}ul.social-icons{width:100%;}ul.social-icons li{display:inline-block;}ul.social-icons li a{margin-top:10px;margin-right:10px;margin-bottom:10px;margin-left:10px;}ul.social-icons li a img{width:20px;height:20px;}.col:empty{display:table-cell;height:75px;}#myForm .input-field [type="checkbox"] + label, #myForm .input-field [type="radio"]:checked + label, #myForm .input-field [type="radio"]:not(:checked) + label{pointer-events:auto;}input:not([type]):focus:not([readonly]), input[type="date"]:not(.browser-default):focus:not([readonly]), #myForm input[type="datetime-local"]:not(.browser-default):focus:not([readonly]), #myForm input[type="datetime"]:not(.browser-default):focus:not([readonly]), #myForm input[type="email"]:not(.browser-default):focus:not([readonly]), #myForm input[type="number"]:not(.browser-default):focus:not([readonly]), #myForm input[type="password"]:not(.browser-default):focus:not([readonly]), #myForm input[type="search"]:not(.browser-default):focus:not([readonly]), #myForm input[type="tel"]:not(.browser-default):focus:not([readonly]), #myForm input[type="text"]:not(.browser-default):focus:not([readonly]), #myForm input[type="time"]:not(.browser-default):focus:not([readonly]), #myForm input[type="url"]:not(.browser-default):focus:not([readonly]), #myForm textarea.materialize-textarea:focus:not([readonly]){border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:orange;box-shadow:orange 0px 1px 0px 0px;}.col:empty, #myForm .col:empty{display:table-cell;height:75px;}#myForm .col:empty{position:relative;}#myForm .col:empty::after{content:"Add form elements here";color:rgb(136, 136, 136);position:absolute;left:10px;top:10px;display:block;width:400px;}.button-collapse{color:rgb(38, 166, 154);}.parallax-container .section{width:100%;}.parallax{position:static;}.parallax-container{min-height:380px;line-height:0;height:auto;color:rgba(255, 255, 255, 0.9);}.section-title{color:rgb(38, 46, 65);margin-top:40px;margin-right:0px;margin-bottom:40px;margin-left:0px;}.single-member{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(255, 255, 255);padding-top:60px;padding-right:20px;padding-bottom:40px;padding-left:20px;text-align:center;border-top-left-radius:3px;border-top-right-radius:3px;border-bottom-right-radius:3px;border-bottom-left-radius:3px;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.single-member:hover{margin-top:-10px;box-shadow:rgba(167, 176, 211, 0.38) 0px 1px 10px;}@media only screen and (max-width: 992px){.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}}',
                'html'              => '<div class="parallax-container" data-gjs-type="default" data-highlightable="1"><script class="null">$("a.dropdown-button").dropdown();$(".button-collapse").sideNav();</script><nav class="light-blue lighten-1" data-gjs-type="default" role="navigation" data-highlightable="1"><div class="nav-wrapper container" data-gjs-type="default" data-highlightable="1"><a class="brand-logo white-text" data-gjs-type="link" id="logo-container" href="" data-highlightable="1">Default</a><ul class="right hide-on-med-and-down" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a class="white-text gjs-comp-selected" data-gjs-type="link" href="#" data-highlightable="1">Home Page</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="page-Default" data-highlightable="1">Default Page</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text gjs-hovered" data-gjs-type="link" href="page-contact" data-highlightable="1">Contact Page</a></li></ul><ul class="side-nav light-blue" data-gjs-type="default" id="nav-mobile" data-highlightable="1" style="transform:translateX(-100%);"><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#" data-highlightable="1">Navbar Link</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#" data-highlightable="1">Navbar Link</a></li></ul><a class="button-collapse white-text" data-gjs-type="link" href="#" data-activates="nav-mobile" data-highlightable="1"><i class="material-icons" data-gjs-type="text" data-highlightable="1">menu</i></a></div></nav><script class="null">
                        $(".button-collapse").sideNav();
                        </script><div class="parallax" data-gjs-type="default" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1515419443/background_ckgyqe.jpg" onmousedown="return false" style="display: block; transform: translate3d(-50%, 281px, 0px);"></div></div><div class="section white" data-gjs-type="default" data-highlightable="1"><div class="row container" data-gjs-type="default" data-highlightable="1"><h2 class="header" data-gjs-type="text" data-highlightable="1">Default Us</h2><p class="grey-text text-darken-3 lighten-3" data-gjs-type="text" data-highlightable="1">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p></div><section data-gjs-type="default" id="members" data-highlightable="1"><div class="container" data-gjs-type="default" data-highlightable="1"><div class="row" data-gjs-type="default" data-highlightable="1"><div class="col m12" data-gjs-type="default" data-highlightable="1"><h2 class="section-title center" data-gjs-type="text" data-highlightable="1">Our Team</h2></div></div><div class="row" data-gjs-type="default" data-highlightable="1"><div class="col m4 s6" data-gjs-type="default" data-highlightable="1"><div class="single-member" data-gjs-type="default" data-highlightable="1"><img class="profile-img" data-gjs-type="image" src="https://randomuser.me/api/portraits/women/82.jpg" alt="" onmousedown="return false"><h5 data-gjs-type="text" data-highlightable="1">Marian Holmes</h5><p data-gjs-type="text" data-highlightable="1">Developer</p><ul class="social-icons" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/facebook_xufb3l.png" alt="facebook" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/twitter_cxpl2b.png" alt="twitter" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/linkedin_vkgoom.png" alt="linkedin" onmousedown="return false"></a></li></ul></div></div><div class="col m4 s6" data-gjs-type="default" data-highlightable="1"><div class="single-member" data-gjs-type="default" data-highlightable="1"><img class="profile-img" data-gjs-type="image" src="https://randomuser.me/api/portraits/women/74.jpg" alt="" onmousedown="return false"><h5 data-gjs-type="text" data-highlightable="1">Peggy Henry</h5><p data-gjs-type="text" data-highlightable="1">Marketing manager</p><ul class="social-icons" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/facebook_xufb3l.png" alt="facebook" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/twitter_cxpl2b.png" alt="twitter" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/linkedin_vkgoom.png" alt="linkedin" onmousedown="return false"></a></li></ul></div></div><div class="col m4 s6" data-gjs-type="default" data-highlightable="1"><div class="single-member" data-gjs-type="default" data-highlightable="1"><img class="profile-img" data-gjs-type="image" src="https://randomuser.me/api/portraits/men/13.jpg" alt="" onmousedown="return false"><h5 data-gjs-type="text" data-highlightable="1">Eduardo Carter</h5><p data-gjs-type="text" data-highlightable="1">Director</p><ul class="social-icons" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/facebook_xufb3l.png" alt="facebook" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/twitter_cxpl2b.png" alt="twitter" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/linkedin_vkgoom.png" alt="linkedin" onmousedown="return false"></a></li></ul></div></div></div></div></section></div><div class="parallax-container" data-gjs-type="default" data-highlightable="1"><div class="parallax" data-gjs-type="default" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1515419441/background2_gjvaxs.jpg" onmousedown="return false" style="display:block;transform:translate3d(-50%, 4px, 0px);"></div></div><script class="null">$(".parallax").parallax();</script>',
                    'tanggal_dibuat'    => date('Y-m-d H:i:s'),
                    'id_user'           => $id_user
                );
            $this->Model_website_page->insert_data($data);
            $this->session->set_flashdata('message','add');
            redirect($_SERVER['HTTP_REFERER']);
            // $insert = $this->Model_template_page->insert_page($data);
        }

        
    }

    function update_index()
    {
        $id_user    = $this->session->userdata('userID');
        $id_page    = $this->input->get('id_page');
        $id_website = $this->input->get('id_website');

        $data = array(
            'type_page' => 'index'
        );

        // Remove Index First
        $data_remove = array(
            'type_page' => ''
        );
        $remove = $this->Model_website_page->remove_index($id_website,$data_remove,$id_user);
        // Update Index
        $update        = $this->Model_website_page->update_index($id_page,$id_website,$data,$id_user);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete_page()
    {
        $id         = $this->input->post('id');
        $id_user    = $this->session->userdata('userID');
        $delete     = $this->Model_website_page->delete_page($id,$id_user);
        $this->session->set_flashdata('message','delete');
        echo '{}';
    }

    function delete_website()
    {
        $id         = $this->input->post('id');
        $gambar         = $this->input->post('gambar');
        $id_user    = $this->session->userdata('userID');

        if ($gambar != '') {
            unlink('./assets/images/websites/'.$gambar);
        }
        $delete     = $this->Model_website->delete_page($id,$id_user);
        $this->session->set_flashdata('message','delete');
        echo '{}';
    }
    
    
    
     function update_detail_website()
    {
        $id_website   = $this->input->post('id');
        $id_user    = $this->session->userdata('userID');
        $slug_id_old    = $this->input->post('slug_id_old');
        $gambar_old    = $this->input->post('gambar_old');

        $nama_website  = $this->input->post('nama_website');
      

        $data = array(
            'nama_website'         => $nama_website,
            'slug_id'               => $this->clean($nama_website),
        );

        if ($slug_id_old == $this->clean($nama_website)) {
            $cek_slug_id = 0;
        }else{
            $cek_slug_id = $this->Model_website->data_website_validate($this->clean($nama_website),$id_user)->num_rows();
        }

        $where = array(
            'ID' => $id_website
        );

        //ambil slug awal
         $data_website = $this->Model_website->edit_data($where)->row();
         $slug_awal=$data_website->slug_id;
         $slug_baru=$this->clean($nama_website);

        if ($cek_slug_id > 0) {
            // echo "sudah ada";
            $this->session->set_flashdata('message','exist');

            redirect($_SERVER['HTTP_REFERER']);

        }else{

            $config['upload_path'] = './assets/images/websites/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = 'thumbnails'.$id_user.time();
            $config['max_size'] = '2048';

            $this->load->library('upload',$config);

            if ($_FILES['gambar']['name']) {
                if ($this->upload->do_upload('gambar')) {
                    $image = $this->upload->data();
                    $data['photo'] = $image['file_name'];

                    if ($gambar_old != '') {
                        unlink('./assets/images/websites/'.$gambar_old);
                    }

                    
                     
                     

                     //
                     $this->update_link_page($id_website,$slug_awal,$slug_baru);
                     
                     print_r($data);
                     
                     $update = $this->Model_website->update_data($where,$data);

                     $this->session->set_flashdata('message','update');
                     redirect( base_url().$this->controller.'/website/'.$slug_baru);
                }else{
                    $this->session->set_flashdata('message','image');
                    redirect(base_url().$this->controller.'/edit/'.$slug_id_old);
                }
            }else{
                $update = $this->Model_website->update_data($where,$data);
                $this->session->set_flashdata('message','update');
                redirect( base_url().$this->controller.'/website/'.$slug_baru);

                // redirect(base_url().$this->controller.'/edit/'.$this->clean($nama_website));
            }


            

        }

        
       
        
    }
    
    
    function update_link_page($id_website,$slug_awal,$slug_baru)
    {
        $id_user = $this->session->userdata('userID');
        $website_page = $this->Model_website_page->get_page($id_website,$id_user)->result();
        $data_website  = $this->Model_website->get_data()->row();

        foreach ($website_page as $row_website ) {
           $data = array(
                'html'          =>  str_replace('./'.$slug_awal,'./'.$slug_baru, $row_website->html)
           );
           $where =  array (
            'ID'=>$row_website->ID,              
           );  
                
           $update_link_page = $this->Model_website_page->update_data($where,$data);
        }
        
    }
    
    function order_publish($id_website='')
    {
        $id_user=$this->session->userdata('userID');
        
        $validasi_website=$this->Model_website->validasi_website($id_website,$id_user)->num_rows();
        $data_website=$this->Model_website->validasi_website($id_website,$id_user)->row();
        $id_package=$this->input->post('id_package');
        
        if($validasi_website==true){
            
            $data_package=$this->Model_package->edit_data(array('ID'=>$id_package))->row();
            //data
            $data = array(
            "id_website" => $id_website,
            "nama_website" => $data_website->nama_website,
            "id_user" => $id_user,
            "status" => 0,
            "nama_package" => $data_package->nama_package,
            "type_order" => $data_package->status,
            "harga" => $data_package->harga,
            "tanggal_order" => date('Y-m-d H:i:s'),
                  
            );
            
           $this->Model_order->insert_data($data);
           $this->session->set_flashdata('message','publish');
           redirect($_SERVER['HTTP_REFERER']);
            
        }else{
          redirect($_SERVER['HTTP_REFERER']);
        }
        
    }
/*--------------------------------------------------------*/    
    //fungsi clean
      function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string)); // Removes special chars.
    }

    
    
    

   // Hanya Untuk Testing
    function json()
    {
        // $id_template = $this->input->post('id_template');
        $id_template = 65;


        // Get Data Template
        $where['data_template']   = array(
            'ID' => $id_template 
        ); 

        $data_template      = $this->Model_template->edit_data($where['data_template'])->row();

        $id_website         = $this->Model_website->get_data()->row();

        $website_id         = $this->db->insert_id();
        // $website_id         = 

        $slug_id_website    =  $website_id."-".$data_template->slug_id;

         $data['template_data'] = array(
            'nama_website'  => $data_template->nama_template,
            'slug_id'       => $slug_id_website,
            'id_user'       => $this->session->userdata('userID'),
            'template_id'   => $id_template,
            'tanggal_dibuat'=> date('Y-m-d H:i:s'),
            'type_template' => $data_template->id_type
        );

        $myObj = (object) array();
        $myObj->records  = $data['template_data'];
        echo json_encode($myObj);

    }
    
    
    

	
}//end



