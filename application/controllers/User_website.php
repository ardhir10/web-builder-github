<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_website extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->model('Model_template');
        $this->load->model('Model_website');
        $this->load->model('Model_template_page');
        $this->load->model('Model_website_page');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        date_default_timezone_set("Asia/Jakarta");

        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
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
            'type_template' => $data_template->id_type
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
            'type_template' => $data_template->id_type
        );



        // Update Digunakan
        $data['in_use'] = array(
            'digunakan' => $data_template->digunakan+1
        );

        $update = $this->Model_template->update_data($where['data_template'],$data['in_use']);

        $this->use_page($id_template,$slug_awal);

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
                
                if ($cek_data_page>0) {
                    // print_r($data['data_page']);
                    $this->load->view('vu_website_page_editor',$data);
                }else{
                    echo "Page Not Found";
                }
            }else{
                echo "Website Not Found";
            }







        }else{
            $id_user = $this->session->userdata('userID');
            $cek_data_website           = $this->Model_website->get_data_website($slug_id,$id_user)->num_rows();
            $data['data_website']       = $this->Model_website->get_data_website($slug_id,$id_user)->row();
            if ($cek_data_website > 0) {
                //==== Inisiasi Awal 
                $data['controller'] = $this->controller;
                $data['title_page'] = 'Website : '.$data['data_website']->nama_website.' | Goodeva';

                $data['data_page']  = $this->Model_website_page->get_page($data['data_website']->ID,$id_user)->result();

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
                    'css'               => '',
                    'html'              =>  '',
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
    
    
    
     function update_detail_website()
    {
        $id_website   = $this->input->post('id');
        $nama_website  = $this->input->post('nama_website');
      

        $data = array(
            'nama_website'         => $nama_website,
            'slug_id'               => $this->clean($nama_website),
           
        );

        $where = array(
            'ID' => $id_website
        );
         
         //ambil slug awal
         $data_website = $this->Model_website->edit_data($where)->row();
         $slug_awal=$data_website->slug_id;
         $slug_baru=$this->clean($nama_website);

         //
         $this->update_link_page($id_website,$slug_awal,$slug_baru);
         
         print_r($data);
         
         $update = $this->Model_website->update_data($where,$data);

         $this->session->set_flashdata('message','update');
         redirect( base_url().$this->controller.'/website/'.$slug_baru);
       
        
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



