<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_template extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('admin_model/Model_admin');
        $this->load->model('admin_model/Model_admin_login');
        $this->load->model('Model_editor_template');
        $this->load->model('Model_kategori_template');
        $this->load->model('Model_type_template');
        $this->load->model('Model_template');
        $this->load->model('Model_template_page');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        date_default_timezone_set("Asia/Jakarta");
        // cek session
        if ($this->session->userdata('adminLogged') != TRUE) {
            redirect(base_url('Admin_panel/login'));
        }
    }

    



    private $controller = 'Admin_template';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Data Template | Goodeva';
            $data['title_card'] = 'Data Template';

            $data['template_result'] = $this->Model_template->get_data()->result();

            $this->load->view('va_template',$data);

        } else if($cookie <> '') {
            // cek cookie
            $row = $this->Model_admin_login->get_by_cookie($cookie)->row();
            if ($row) {
                $this->create_session($row);
            } else {
                redirect(base_url('Admin_panel/login'));
            }
        } else {
                $this->login();
        }
    	
    }


    function add()
    {
        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller']         = $this->controller;
            $data['title_page']         = 'Add Template | Goodeva';
            $data['title_card']         = 'Add Template';
            $data['kategori_template']  = $this->Model_kategori_template->get_data()->result();
            $data['type_template']      = $this->Model_type_template->get_data()->result();


            $this->load->view('va_template_add',$data);

        } else if($cookie <> '') {
            // cek cookie
            $row = $this->Model_admin_login->get_by_cookie($cookie)->row();
            if ($row) {
                $this->create_session($row);
            } else {
                redirect(base_url('Admin_panel/login'));
            }
        } else {
                $this->login();
        }
    }


    function edit($slug_id)
    {
        // ambil cookie
        $cookie = get_cookie('gwb_cookie');

        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller']                 = $this->controller;
            $data['title_page']                 = 'Edit Template | Goodeva';
            $data['title_card']                 = 'Edit Template';
            $data['kategori_template']          = $this->Model_kategori_template->get_data()->result();
            $data['type_template']              = $this->Model_type_template->get_data()->result();



            $where = array(
                'slug_id' => $slug_id
            );
            $validasi_data      = $this->Model_template->edit_data($where)->num_rows();

            if($validasi_data > 0){
                $data['data_template']      = $this->Model_editor_template->edit_data($where)->row();

                $this->load->view('va_template_edit',$data);
            }else{
                // redirect($_SERVER['HTTP_REFERER']);
                redirect(base_url().$this->controller);
            }



        } else if($cookie <> '') {
            // cek cookie
            $row = $this->Model_admin_login->get_by_cookie($cookie)->row();
            if ($row) {
                $this->create_session($row);
            } else {
                redirect(base_url('Admin_panel/login'));
            }
        } else {
                $this->login();
        }
    }


    public function login()
    {
        $data['title_page'] = 'Login | Web Builder Goodeva';
    	$this->load->view('va_login',$data);
    }


    function preview()
    {

        // $where = array(
        //     'ID' => $id
        // );
        // $data['data_edit']  = $this->Model_editor_template->edit_data($where)->row();
        // $this->load->view('va_preview_template',$data);
        if ($this->uri->segment('4')) {
            $slug_id_template = $this->uri->segment('3');
            $slug_id_page     = $this->uri->segment('4');

            $where = array(
                'slug_id' => $slug_id_template
            );
            $validasi_data      = $this->Model_template->edit_data($where)->num_rows();

            if($validasi_data > 0){
                $data['data_template']      = $this->Model_editor_template->edit_data($where)->row();

                $data['data_edit']          = $this->Model_template_page->get_page_child($data['data_template']->ID,$slug_id_page)->row();

                $this->load->view('va_preview_template',$data);
            }else{
                // redirect($_SERVER['HTTP_REFERER']);
                redirect(base_url().$this->controller);
            }


        }else{
            //==== Inisiasi Awal 
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Edit Template | Goodeva';
            $data['title_card'] = 'Template';

            $slug_id = $this->uri->segment('3');
            // Data Template
            $where = array(
                'slug_id' => $slug_id
            );
            $validasi_data      = $this->Model_template->edit_data($where)->num_rows();

            if($validasi_data > 0){
                $data['data_template']      = $this->Model_editor_template->edit_data($where)->row();

                $data['data_edit']          = $this->Model_template_page->get_index($data['data_template']->ID)->row();

                $this->load->view('va_preview_template',$data);
            }else{
                // redirect($_SERVER['HTTP_REFERER']);
                redirect(base_url().$this->controller);
            }
        }
       

    } 


    // Template Page

    function template_page($slug_id)
    {

        if($this->uri->segment('4') != NULL){
            //==== Inisiasi Awal 
            $id                 = $this->uri->segment('4');
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Edit Page | Goodeva';
            $data['title_card'] = 'Page';


            // Data Template
            $where = array(
                'ID' => $id
            );

            $validasi_data      = $this->Model_template_page->edit_data($where)->num_rows();
            if($validasi_data > 0){
                $data['data_page']     = $this->Model_template_page->get_page_detail($id)->row();



                $where = array(
                    'ID' => $data['data_page']->id_template 
                );

                $data['data_template']        = $this->Model_template->edit_data($where)->row();
                $data['data_page_result']     = $this->Model_template_page->get_page($data['data_template']->ID)->result();

                $this->load->view('va_template_page_editor',$data);
            }else{
                redirect(base_url().$this->controller);
            }
        }else{
            //==== Inisiasi Awal 
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Edit Template | Goodeva';
            $data['title_card'] = 'Template';

           
            // Data Template
            $where = array(
                'slug_id' => $slug_id
            );
            $validasi_data      = $this->Model_template->edit_data($where)->num_rows();
            if($validasi_data > 0){
                $data['data_template'] = $this->Model_template->edit_data($where)->row();
                $data['data_page']     = $this->Model_template_page->get_page($data['data_template']->ID)->result();
                $data['kategori']      = $this->Model_kategori_template->get_kategori($data['data_template']->id_kategori)->row();
                $data['type']          = $this->Model_type_template->get_type($data['data_template']->id_type)->row();

                $this->load->view('va_template_page',$data);
            }else{
                redirect(base_url().$this->controller);
            }
        }
        

    }

    // function template_page_editor($id)
    // {
    //     //==== Inisiasi Awal 
    //     $data['controller'] = $this->controller;
    //     $data['title_page'] = 'Edit Page | Goodeva';
    //     $data['title_card'] = 'Page';


    //     // Data Template
    //     $where = array(
    //         'ID' => $id
    //     );

    //     $validasi_data      = $this->Model_template_page->edit_data($where)->num_rows();
    //     if($validasi_data > 0){
    //         $data['data_page']     = $this->Model_template_page->get_page_detail($id)->row();



    //         $where = array(
    //             'ID' => $data['data_page']->id_template 
    //         );

    //         $data['data_template'] = $this->Model_template->edit_data($where)->row();


    //         $this->load->view('va_template_page_editor',$data);
    //     }else{
    //         redirect(base_url().$this->controller);
    //     }

    // }




    // Crud Template

    function create()
    {
        $nama_template  = $this->input->post('nama_template');
        $id_kategori    = $this->input->post('id_kategori');
        $id_type        = $this->input->post('id_type');

        $data = array(
            'nama_template'         => $nama_template,
            'slug_id'               => $this->clean($nama_template),
            'id_kategori'           => $id_kategori,
            'id_type'               => $id_type,
            'tanggal_dibuat'        => date('Y-m-d H:i:s')
        );

        $insert         = $this->Model_template->insert_data($data);
        $id_template    = $this->Model_template->get_data()->row();
        $this->create_page($id_template->ID,$this->clean($nama_template));

        redirect(base_url().$this->controller.'/template_page/'.$this->clean($nama_template));

    }

    function delete_page()
    {
        $id = $this->input->post('id');

        $where = array(

            'ID' => $id
        );
        $delete = $this->Model_template_page->delete_data($where);
        $this->session->set_flashdata('message','delete');
        echo '{}';
    }

    function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string)); // Removes special chars.
    }

    function create_page($id_template,$template)
    {
        $id_template = $id_template;





        $data = array(
            array(
                'id_template'       => $id_template,
                'judul_page'        => 'Page Home',
                'slug_id'           => $this->clean('Page-home'),
                'css'               => '* { box-sizing: border-box; } body {margin: 0;}#nav-mobile{transform:translateX(-100%);}#ivous{padding:22px 0 0 0;min-height:1px;float:none;position:relative;text-align:center;}#itdbw{padding:0 0 0 0;text-align:right;margin:0 0 0 0;}#id39u{height:400px;}#i1d8c{opacity:0;transform:translateX(0px) translateY(0px);}#isp3l{background-image:url("https://res.cloudinary.com/ronaldaug/image/upload/v1515419441/background2_gjvaxs.jpg");}#iikjs{opacity:0;transform:translateY(-100px) translateX(0px);}#ik2ei{opacity:0;transform:translateX(0px) translateY(0px);}#i6kah{background-image:url("https://res.cloudinary.com/ronaldaug/image/upload/v1515419443/background_ckgyqe.jpg");}#ibyra{opacity:0;transform:translateX(-100px) translateY(0px);}#irub1{opacity:0;transform:translateX(0px) translateY(0px);}#i9qgi{background-image:url("https://res.cloudinary.com/ronaldaug/image/upload/v1515419443/background3_d0ghix.jpg");}#in16k{opacity:0;transform:translateX(100px) translateY(0px);}#inzgt{opacity:1;transform:translateX(0px) translateY(0px);}#i18k7{background-image:url("https://res.cloudinary.com/ronaldaug/image/upload/v1515419446/background4_pzh5ou.jpg");}#ih3o2{opacity:1;transform:translateY(0px) translateX(0px);}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;background-color:rgb(255, 255, 255);}#banner-gradient{background-image:linear-gradient(45deg, rgb(122, 188, 255) 0px, rgb(96, 171, 248) 44%, rgb(64, 150, 238) 100%);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;}.bg-none{background-image:none;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(0, 0, 0, 0.1);}nav .brand-logo, nav ul a{color:rgb(68, 68, 68);}footer.gram-footer ul.collection > li.collection-header, footer.gram-footer ul.collection > li.collection-item{background-image:initial;background-position-x:0px;background-position-y:0px;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-top-style:initial;border-right-style:initial;border-bottom-style:initial;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:initial;border-left-color:initial;border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}footer.gram-footer ul.collection{border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-top-style:initial;border-right-style:initial;border-bottom-style:initial;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:initial;border-left-color:initial;border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}footer.page-footer{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}#contact input#your-email, #contact textarea#your-message{color:rgb(255, 255, 255);}section#members{width:100%;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(246, 247, 249);padding-top:40px;padding-right:0px;padding-bottom:40px;padding-left:0px;}.single-member .profile-img{width:80px;height:80px;border-top-left-radius:100%;border-top-right-radius:100%;border-bottom-right-radius:100%;border-bottom-left-radius:100%;}.single-member h5{font-size:16px;}.single-member p{font-size:12px;color:rgb(119, 119, 119);}ul.social-icons{width:100%;}ul.social-icons li{display:inline-block;}ul.social-icons li a{margin-top:10px;margin-right:10px;margin-bottom:10px;margin-left:10px;}ul.social-icons li a img{width:20px;height:20px;}.col:empty{display:table-cell;height:75px;}#myForm .input-field [type="checkbox"] + label, #myForm .input-field [type="radio"]:checked + label, #myForm .input-field [type="radio"]:not(:checked) + label{pointer-events:auto;}input:not([type]):focus:not([readonly]), input[type="date"]:not(.browser-default):focus:not([readonly]), #myForm input[type="datetime-local"]:not(.browser-default):focus:not([readonly]), #myForm input[type="datetime"]:not(.browser-default):focus:not([readonly]), #myForm input[type="email"]:not(.browser-default):focus:not([readonly]), #myForm input[type="number"]:not(.browser-default):focus:not([readonly]), #myForm input[type="password"]:not(.browser-default):focus:not([readonly]), #myForm input[type="search"]:not(.browser-default):focus:not([readonly]), #myForm input[type="tel"]:not(.browser-default):focus:not([readonly]), #myForm input[type="text"]:not(.browser-default):focus:not([readonly]), #myForm input[type="time"]:not(.browser-default):focus:not([readonly]), #myForm input[type="url"]:not(.browser-default):focus:not([readonly]), #myForm textarea.materialize-textarea:focus:not([readonly]){border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:orange;box-shadow:orange 0px 1px 0px 0px;}.col:empty, #myForm .col:empty{display:table-cell;height:75px;}#myForm .col:empty{position:relative;}#myForm .col:empty::after{content:"Add form elements here";color:rgb(136, 136, 136);position:absolute;left:10px;top:10px;display:block;width:400px;}.button-collapse{color:rgb(38, 166, 154);}.badge-icon{font-size:30px;}.icon-block{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.c11146{margin-top:0px;margin-right:0px;margin-bottom:15px;margin-left:0px;padding-top:13px;padding-right:40px;padding-bottom:0px;padding-left:40px;text-align:justify;color:rgb(0, 0, 0);font-family:"Open Sans", Arial, sans-serif;font-size:14px;}.c11155{margin-top:0px;margin-right:0px;margin-bottom:15px;margin-left:0px;padding-top:0px;padding-right:40px;padding-bottom:0px;padding-left:40px;text-align:justify;color:rgb(0, 0, 0);font-family:"Open Sans", Arial, sans-serif;font-size:14px;}.c11164{margin-top:0px;margin-right:0px;margin-bottom:15px;margin-left:0px;padding-top:0px;padding-right:40px;padding-bottom:0px;padding-left:40px;text-align:justify;color:rgb(0, 0, 0);font-family:"Open Sans", Arial, sans-serif;font-size:14px;}.parallax-container .section{width:100%;}.c733{height:400px;touch-action:pan-y;-webkit-user-drag:none;-webkit-tap-highlight-color:rgba(0, 0, 0, 0);}@media only screen and (max-width: 992px){.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}}',
                'html'              => '<div class="section no-pad-bot gjs-hovered" data-gjs-type="default" id="banner-gradient" data-highlightable="1"><nav class="bg-none" data-gjs-type="default" role="navigation" data-highlightable="1"><div class="nav-wrapper container" data-gjs-type="default" data-highlightable="1"><a class="brand-logo white-text" data-gjs-type="link" id="logo-container" href="./'.$template.'" data-highlightable="1">Home Page</a><ul class="right hide-on-med-and-down" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="" data-highlightable="1">Home Page</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text gjs-comp-selected" data-gjs-type="link" href="./'.$template.'/page-about" data-highlightable="1" contenteditable="false">About Page</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="./'.$template.'/page-contact" data-highlightable="1">Contact Page</a></li></ul><ul class="side-nav" data-gjs-type="default" id="nav-mobile" data-highlightable="1" style="transform:translateX(-100%);"><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1">Navbar Link</a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1">Navbar Link 2</a></li></ul><a class="button-collapse white-text" data-gjs-type="link" href="#" data-activates="nav-mobile" data-highlightable="1"><i class="material-icons" data-gjs-type="text" data-highlightable="1">menu</i></a></div></nav><div class="container" data-gjs-type="default" data-highlightable="1"><br data-gjs-type="default" data-highlightable="1"><br data-gjs-type="default" data-highlightable="1"><h1 class="header center white-text" data-gjs-type="text" data-highlightable="1">Home Page</h1><div class="row center" data-gjs-type="default" data-highlightable="1"><h5 class="header col s12 light white-text" data-gjs-type="text" data-highlightable="1">Modern starter home page design with page builder</h5></div><div class="row center" data-gjs-type="default" data-highlightable="1"><a class="btn-large waves-effect waves-light light-blue" data-gjs-type="link" href="#" id="download-button" data-highlightable="1">Get Started</a></div><br data-gjs-type="default" data-highlightable="1"><br data-gjs-type="default" data-highlightable="1"></div><div class="row" data-gjs-type="default" data-highlightable="1"></div></div><script class="null">
                        $(".button-collapse").sideNav();
                        </script><div data-gjs-type="default" data-highlightable="1"><h3 data-gjs-type="text" data-highlightable="1" style="padding:22px 0 0 0;min-height:1px;float:none;position:relative;text-align:center;"><b data-gjs-type="text" data-highlightable="1">Home Page</b></h3><p data-gjs-type="text" data-highlightable="1" style="padding:0 0 0 0;text-align:right;margin:0 0 0 0;"></p><p class="c11146" data-gjs-type="text" data-highlightable="1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempus ipsum massa, nec aliquet nunc bibendum eget. Ut nisi nisi, aliquam quis ipsum eget, tristique blandit justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec eget nisl suscipit, suscipit nisl at, vestibulum velit. Sed ornare porttitor tortor, ut convallis enim efficitur ut. Donec mattis, leo sed pellentesque sodales, sem nibh venenatis purus, ut condimentum mi ante quis sapien. Vestibulum ac erat orci. Phasellus lobortis lacinia sapien quis ultricies. Nunc vitae sem elementum, hendrerit urna vel, vulputate ipsum. Nunc eget euismod nunc. Aliquam porta mi in nibh mollis, nec ultrices lorem fermentum. Donec ultrices erat id urna semper, nec tempor neque congue. Donec aliquet, lacus sed ornare dapibus, est turpis rhoncus magna, et malesuada orci orci at erat. Fusce iaculis feugiat nibh in fringilla. Maecenas maximus purus vel magna ullamcorper, ac pretium ex elementum. Fusce ac tempus nibh.</p><p class="c11155" data-gjs-type="text" data-highlightable="1">Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis gravida nisl quis felis tempus scelerisque. Proin efficitur sapien in vulputate sagittis. Aenean pellentesque diam id posuere tincidunt. Ut sagittis bibendum dignissim. Sed volutpat tempor pretium. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse in erat sem. Donec et fermentum justo, a laoreet ligula. Vestibulum dictum nulla at tellus commodo pretium. In laoreet interdum congue. Vestibulum eget odio fermentum, imperdiet erat nec, efficitur ligula.</p><p class="c11164" data-gjs-type="text" data-highlightable="1">Nulla sed orci lacus. Quisque a ex vitae orci fringilla ultrices. Phasellus accumsan lacinia eros, sit amet consequat arcu volutpat ac. Vivamus lorem nisl, pulvinar id odio sit amet, tincidunt interdum urna. Donec consequat, odio sed commodo gravida, leo erat pharetra elit, id varius arcu libero ac tellus. Fusce vulputate porttitor luctus. Suspendisse lacinia fermentum nisl luctus porttitor. Ut placerat quam ut tincidunt varius. Proin ultrices condimentum porta. Sed iaculis magna luctus, interdum sem id, dignissim tortor. Integer viverra, urna vel mattis sodales, augue orci viverra elit, vel placerat sem mi id ex. Suspendisse nec dolor eget leo interdum ultrices.</p><p data-gjs-type="default" data-highlightable="1"></p></div><div class="row" data-gjs-type="default" data-highlightable="1"></div><div class="slider c733" data-gjs-type="default" data-highlightable="1" style="height: 400px; touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><ul class="slides" data-gjs-type="default" data-highlightable="1" style="height:400px;"><li data-gjs-type="default" data-highlightable="1" style="opacity: 0; transform: translateX(0px) translateY(0px);" class=""><img data-gjs-type="image" src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" onmousedown="return false" style="background-image:url(&quot;https://res.cloudinary.com/ronaldaug/image/upload/v1515419441/background2_gjvaxs.jpg&quot;);"> <div class="caption center-align" data-gjs-type="default" data-highlightable="1" style="opacity: 0; transform: translateY(-100px) translateX(0px);"><h3 data-gjs-type="text" data-highlightable="1">This is our big Tagline!</h3><h5 class="light grey-text text-lighten-3" data-gjs-type="text" data-highlightable="1">Heres our small slogan.</h5></div></li><li data-gjs-type="default" data-highlightable="1" style="opacity: 0; transform: translateX(0px) translateY(0px);" class=""><img data-gjs-type="image" src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" onmousedown="return false" style="background-image:url(&quot;https://res.cloudinary.com/ronaldaug/image/upload/v1515419443/background_ckgyqe.jpg&quot;);"> <div class="caption left-align" data-gjs-type="default" data-highlightable="1" style="opacity: 0; transform: translateX(-100px) translateY(0px);"><h3 data-gjs-type="text" data-highlightable="1">Left Aligned Caption</h3><h5 class="light grey-text text-lighten-3" data-gjs-type="text" data-highlightable="1">Heres our small slogan.</h5></div></li><li data-gjs-type="default" data-highlightable="1" style="opacity: 0; transform: translateX(0px) translateY(0px);" class=""><img data-gjs-type="image" src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" onmousedown="return false" style="background-image:url(&quot;https://res.cloudinary.com/ronaldaug/image/upload/v1515419443/background3_d0ghix.jpg&quot;);"> <div class="caption right-align" data-gjs-type="default" data-highlightable="1" style="opacity: 0; transform: translateX(100px) translateY(0px);"><h3 data-gjs-type="text" data-highlightable="1">Right Aligned Caption</h3><h5 class="light grey-text text-lighten-3" data-gjs-type="text" data-highlightable="1">Heres our small slogan.</h5></div></li><li class="active" data-gjs-type="default" data-highlightable="1" style="opacity: 1; transform: translateX(0px) translateY(0px);"><img data-gjs-type="image" src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" onmousedown="return false" style="background-image:url(&quot;https://res.cloudinary.com/ronaldaug/image/upload/v1515419446/background4_pzh5ou.jpg&quot;);"> <div class="caption center-align" data-gjs-type="default" data-highlightable="1" style="opacity: 1; transform: translateY(0px) translateX(0px);"><h3 data-gjs-type="text" data-highlightable="1">This is our big Tagline!</h3><h5 class="light grey-text text-lighten-3" data-gjs-type="text" data-highlightable="1">Heres our small slogan.</h5></div></li></ul></div><script class="null">$(".slider").slider({full_width:!0,indicators:!1}),$(".slider").hover(function(){$(".slider").slider("pause")}),$(".slider").mouseleave(function(){$(".slider").slider("start")});</script><div class="section" data-gjs-type="default" data-highlightable="1"><div class="container" data-gjs-type="default" data-highlightable="1"><div class="row" data-gjs-type="default" data-highlightable="1"><div class="col s12 m4" data-gjs-type="default" data-highlightable="1"><div class="icon-block" data-gjs-type="default" data-highlightable="1"><h2 class="center light-blue-text" data-gjs-type="default" data-highlightable="1"><i class="material-icons badge-icon" data-gjs-type="text" data-highlightable="1">flash_on</i></h2><h5 class="center" data-gjs-type="text" data-highlightable="1">Speeds up development</h5><p class="light" data-gjs-type="text" data-highlightable="1">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p></div></div><div class="col s12 m4" data-gjs-type="default" data-highlightable="1"><div class="icon-block" data-gjs-type="default" data-highlightable="1"><h2 class="center light-blue-text" data-gjs-type="default" data-highlightable="1"><i class="material-icons badge-icon" data-gjs-type="text" data-highlightable="1">group</i></h2><h5 class="center" data-gjs-type="text" data-highlightable="1">User Experience Focused</h5><p class="light" data-gjs-type="text" data-highlightable="1">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p></div></div><div class="col s12 m4" data-gjs-type="default" data-highlightable="1"><div class="icon-block" data-gjs-type="default" data-highlightable="1"><h2 class="center light-blue-text" data-gjs-type="default" data-highlightable="1"><i class="material-icons badge-icon" data-gjs-type="text" data-highlightable="1">settings</i></h2><h5 class="center" data-gjs-type="text" data-highlightable="1">Easy to work with</h5><p class="light" data-gjs-type="text" data-highlightable="1">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p></div></div></div></div></div><script class="null">$(".parallax").parallax();</script><footer class="page-footer light-blue gram-footer" data-gjs-type="default" data-highlightable="1"><div class="container" data-gjs-type="default" data-highlightable="1"><div class="row" data-gjs-type="default" data-highlightable="1"><div class="col l6 s12" data-gjs-type="default" data-highlightable="1"><h5 class="white-text" data-gjs-type="text" data-highlightable="1">Company Bio</h5><p class="grey-text text-lighten-4" data-gjs-type="text" data-highlightable="1">We are a team of college students working on this project like its our full time job.Any amount would help support and continue development on this project and is greatly appreciated. </p></div><div class="col l3 s12" data-gjs-type="default" data-highlightable="1"><h5 class="white-text" data-gjs-type="text" data-highlightable="1">Settings</h5><ul class="collection light-blue" data-gjs-type="default" data-highlightable="1"><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 1</a></li><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 2</a></li><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 3</a></li><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 4</a></li></ul></div><div class="col l3 s12" data-gjs-type="default" data-highlightable="1"><h5 class="white-text" data-gjs-type="text" data-highlightable="1">Connect</h5><ul class="collection light-blue with-header" data-gjs-type="default" data-highlightable="1"><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 1</a></li><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 2</a></li><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 3</a></li><li class="collection-item" data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#!" data-highlightable="1">Link 4</a></li></ul></div></div></div><div class="footer-copyright" data-gjs-type="default" data-highlightable="1"><div class="container" data-gjs-type="text" data-highlightable="1">Made by <a class="white-text text-lighten-3" data-gjs-type="link" href="http://materializecss.com" data-highlightable="1">Materialize</a></div></div></footer>',
                'tanggal_dibuat'    => date('Y-m-d H:i:s'),
                'type_page'         => 'index'
            ),
            array(
                'id_template'       => $id_template,
                'judul_page'        => 'Page About',
                'slug_id'           => $this->clean('Page About'),
                'css'               => '* { box-sizing: border-box; } body {margin: 0;}#nav-mobile{transform:translateX(-100%);}#icpyb{display:block;transform:translate3d(-50%, 281px, 0px);}#ict7f{display:block;transform:translate3d(-50%, 4px, 0px);}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;background-color:rgb(255, 255, 255);}#nav-mobile{transform:translateX(-100%);}nav .brand-logo, nav ul a{color:rgb(68, 68, 68);}footer.gram-footer ul.collection > li.collection-header, footer.gram-footer ul.collection > li.collection-item{background-image:initial;background-position-x:0px;background-position-y:0px;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-top-style:initial;border-right-style:initial;border-bottom-style:initial;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:initial;border-left-color:initial;border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}footer.gram-footer ul.collection{border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-top-style:initial;border-right-style:initial;border-bottom-style:initial;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:initial;border-left-color:initial;border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}footer.page-footer{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}#contact input#your-email, #contact textarea#your-message{color:rgb(255, 255, 255);}section#members{width:100%;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(246, 247, 249);padding-top:40px;padding-right:0px;padding-bottom:40px;padding-left:0px;}.single-member .profile-img{width:80px;height:80px;border-top-left-radius:100%;border-top-right-radius:100%;border-bottom-right-radius:100%;border-bottom-left-radius:100%;}.single-member h5{font-size:16px;}.single-member p{font-size:12px;color:rgb(119, 119, 119);}ul.social-icons{width:100%;}ul.social-icons li{display:inline-block;}ul.social-icons li a{margin-top:10px;margin-right:10px;margin-bottom:10px;margin-left:10px;}ul.social-icons li a img{width:20px;height:20px;}.col:empty{display:table-cell;height:75px;}#myForm .input-field [type="checkbox"] + label, #myForm .input-field [type="radio"]:checked + label, #myForm .input-field [type="radio"]:not(:checked) + label{pointer-events:auto;}input:not([type]):focus:not([readonly]), input[type="date"]:not(.browser-default):focus:not([readonly]), #myForm input[type="datetime-local"]:not(.browser-default):focus:not([readonly]), #myForm input[type="datetime"]:not(.browser-default):focus:not([readonly]), #myForm input[type="email"]:not(.browser-default):focus:not([readonly]), #myForm input[type="number"]:not(.browser-default):focus:not([readonly]), #myForm input[type="password"]:not(.browser-default):focus:not([readonly]), #myForm input[type="search"]:not(.browser-default):focus:not([readonly]), #myForm input[type="tel"]:not(.browser-default):focus:not([readonly]), #myForm input[type="text"]:not(.browser-default):focus:not([readonly]), #myForm input[type="time"]:not(.browser-default):focus:not([readonly]), #myForm input[type="url"]:not(.browser-default):focus:not([readonly]), #myForm textarea.materialize-textarea:focus:not([readonly]){border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:orange;box-shadow:orange 0px 1px 0px 0px;}.col:empty, #myForm .col:empty{display:table-cell;height:75px;}#myForm .col:empty{position:relative;}#myForm .col:empty::after{content:"Add form elements here";color:rgb(136, 136, 136);position:absolute;left:10px;top:10px;display:block;width:400px;}.button-collapse{color:rgb(38, 166, 154);}.parallax-container .section{width:100%;}.parallax{position:static;}.parallax-container{min-height:380px;line-height:0;height:auto;color:rgba(255, 255, 255, 0.9);}.section-title{color:rgb(38, 46, 65);margin-top:40px;margin-right:0px;margin-bottom:40px;margin-left:0px;}.single-member{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(255, 255, 255);padding-top:60px;padding-right:20px;padding-bottom:40px;padding-left:20px;text-align:center;border-top-left-radius:3px;border-top-right-radius:3px;border-bottom-right-radius:3px;border-bottom-left-radius:3px;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.single-member:hover{margin-top:-10px;box-shadow:rgba(167, 176, 211, 0.38) 0px 1px 10px;}@media only screen and (max-width: 992px){.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}.parallax-container .section{position:absolute;top:40%;}}',
                'html'              => '<div class="parallax-container" data-gjs-type="default" data-highlightable="1"><script class="null">$("a.dropdown-button").dropdown();$(".button-collapse").sideNav();</script><nav class="light-blue lighten-1" data-gjs-type="default" role="navigation" data-highlightable="1"><div class="nav-wrapper container" data-gjs-type="default" data-highlightable="1"><a class="brand-logo white-text" data-gjs-type="link" id="logo-container" href="" data-highlightable="1">About</a><ul class="right hide-on-med-and-down" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a class="white-text gjs-comp-selected" data-gjs-type="link" href="../'.$template.'" data-highlightable="1">Home Page</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="page-about" data-highlightable="1">About Page</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text gjs-hovered" data-gjs-type="link" href="page-contact" data-highlightable="1">Contact Page</a></li></ul><ul class="side-nav light-blue" data-gjs-type="default" id="nav-mobile" data-highlightable="1" style="transform:translateX(-100%);"><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#" data-highlightable="1">Navbar Link</a></li><li data-gjs-type="default" data-highlightable="1"><a class="white-text" data-gjs-type="link" href="#" data-highlightable="1">Navbar Link</a></li></ul><a class="button-collapse white-text" data-gjs-type="link" href="#" data-activates="nav-mobile" data-highlightable="1"><i class="material-icons" data-gjs-type="text" data-highlightable="1">menu</i></a></div></nav><script class="null">
                        $(".button-collapse").sideNav();
                        </script><div class="parallax" data-gjs-type="default" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1515419443/background_ckgyqe.jpg" onmousedown="return false" style="display: block; transform: translate3d(-50%, 281px, 0px);"></div></div><div class="section white" data-gjs-type="default" data-highlightable="1"><div class="row container" data-gjs-type="default" data-highlightable="1"><h2 class="header" data-gjs-type="text" data-highlightable="1">About Us</h2><p class="grey-text text-darken-3 lighten-3" data-gjs-type="text" data-highlightable="1">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p></div><section data-gjs-type="default" id="members" data-highlightable="1"><div class="container" data-gjs-type="default" data-highlightable="1"><div class="row" data-gjs-type="default" data-highlightable="1"><div class="col m12" data-gjs-type="default" data-highlightable="1"><h2 class="section-title center" data-gjs-type="text" data-highlightable="1">Our Team</h2></div></div><div class="row" data-gjs-type="default" data-highlightable="1"><div class="col m4 s6" data-gjs-type="default" data-highlightable="1"><div class="single-member" data-gjs-type="default" data-highlightable="1"><img class="profile-img" data-gjs-type="image" src="https://randomuser.me/api/portraits/women/82.jpg" alt="" onmousedown="return false"><h5 data-gjs-type="text" data-highlightable="1">Marian Holmes</h5><p data-gjs-type="text" data-highlightable="1">Developer</p><ul class="social-icons" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/facebook_xufb3l.png" alt="facebook" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/twitter_cxpl2b.png" alt="twitter" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/linkedin_vkgoom.png" alt="linkedin" onmousedown="return false"></a></li></ul></div></div><div class="col m4 s6" data-gjs-type="default" data-highlightable="1"><div class="single-member" data-gjs-type="default" data-highlightable="1"><img class="profile-img" data-gjs-type="image" src="https://randomuser.me/api/portraits/women/74.jpg" alt="" onmousedown="return false"><h5 data-gjs-type="text" data-highlightable="1">Peggy Henry</h5><p data-gjs-type="text" data-highlightable="1">Marketing manager</p><ul class="social-icons" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/facebook_xufb3l.png" alt="facebook" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/twitter_cxpl2b.png" alt="twitter" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/linkedin_vkgoom.png" alt="linkedin" onmousedown="return false"></a></li></ul></div></div><div class="col m4 s6" data-gjs-type="default" data-highlightable="1"><div class="single-member" data-gjs-type="default" data-highlightable="1"><img class="profile-img" data-gjs-type="image" src="https://randomuser.me/api/portraits/men/13.jpg" alt="" onmousedown="return false"><h5 data-gjs-type="text" data-highlightable="1">Eduardo Carter</h5><p data-gjs-type="text" data-highlightable="1">Director</p><ul class="social-icons" data-gjs-type="default" data-highlightable="1"><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/facebook_xufb3l.png" alt="facebook" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/twitter_cxpl2b.png" alt="twitter" onmousedown="return false"></a></li><li data-gjs-type="default" data-highlightable="1"><a data-gjs-type="link" href="#" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1530271176/linkedin_vkgoom.png" alt="linkedin" onmousedown="return false"></a></li></ul></div></div></div></div></section></div><div class="parallax-container" data-gjs-type="default" data-highlightable="1"><div class="parallax" data-gjs-type="default" data-highlightable="1"><img data-gjs-type="image" src="https://res.cloudinary.com/ronaldaug/image/upload/v1515419441/background2_gjvaxs.jpg" onmousedown="return false" style="display:block;transform:translate3d(-50%, 4px, 0px);"></div></div><script class="null">$(".parallax").parallax();</script>',
                'tanggal_dibuat'    => date('Y-m-d H:i:s'),
                'type_page'         => ''
            ),
            array(
                'id_template'       => $id_template,
                'judul_page'        => 'Page Contact',
                'slug_id'           => $this->clean('Page Contact'),
                'css'               => '',
                'html'              =>  'Contact Template',
                'tanggal_dibuat'    => date('Y-m-d H:i:s'),
                'type_page'         => ''
            ),
        );
        $this->db->insert_batch('table_template_page', $data);
        // $insert = $this->Model_template_page->insert_page($data);
    }

    function create_new_page()
    {
        $judul_page  = $this->input->post('judul_page');
        $id_template = $this->input->post('id_template');

        $cek_slug_page = $this->Model_template_page->cek_slug_page($id_template,$this->clean($judul_page))->num_rows();
        if ($cek_slug_page>0) {
            $this->session->set_flashdata('message','exist');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $data = array(
                    'id_template'       => $id_template,
                    'judul_page'        => $judul_page,
                    'slug_id'           => $this->clean($judul_page),
                    'css'               => '',
                    'html'              =>  '',
                    'tanggal_dibuat'    => date('Y-m-d H:i:s'),
                );
            $this->db->insert('table_template_page', $data);
            $this->session->set_flashdata('message','add');
            redirect($_SERVER['HTTP_REFERER']);
            $insert = $this->Model_template_page->insert_page($data);
        }

        
    }


    function update_index()
    {
        $id_page     = $this->input->get('id_page');
        $id_template = $this->input->get('id_template');

        $data = array(
            'type_page' => 'index'
        );

        // Remove Index First
        $data_remove = array(
            'type_page' => ''
        );
        $remove = $this->Model_template_page->remove_index($id_template,$data_remove);
        // Update Index
        $update        = $this->Model_template_page->update_index($id_page,$id_template,$data);
        redirect($_SERVER['HTTP_REFERER']);
    }


    function update_detail_template()
    {
        $id_template    = $this->input->post('id');
        $nama_template  = $this->input->post('nama_template');
        $id_kategori    = $this->input->post('id_kategori');
        $id_type        = $this->input->post('id_type');

        $data = array(
            'nama_template'         => $nama_template,
            'slug_id'               => $this->clean($nama_template),
            'id_kategori'           => $id_kategori,
            'id_type'               => $id_type,
        );

        $where = array(
            'ID' => $id_template
        );
        $update = $this->Model_template->update_data($where,$data);
        redirect($_SERVER['HTTP_REFERER']);
        
    }


    function delete_template()
    {
        $id = $this->input->post('id');
        $where = array(
            'ID' => $id
        );
        $delete = $this->Model_template->delete_data($where);
        $this->session->set_flashdata('message','delete');
        echo '{}';
    }

    function create_session($data_admin) {
        
        // 1. Daftarkan Session
        $sess = array(
            'adminLogged'       => TRUE,
            'adminID'           => $data_admin->ID,
            'adminUsername'     => $data_admin->username,
            'adminNamaTampilan' => $data_admin->nama_tampilan,
            'adminLevel'        => $data_admin->level,
            'adminGambar'       => $data_admin->gambar


        );
        $this->session->set_userdata($sess);
            
        // 2. Redirect ke home
        redirect('admin-panel');

    }





   
	      
	    

	
}
