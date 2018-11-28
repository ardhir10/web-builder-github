<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiGambar extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->model('Model_website_page');
        $this->load->model('ApiModelImage');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        date_default_timezone_set('Asia/Jakarta');

        // cek session
        if ($this->session->userdata('userLogged') != TRUE) {
            redirect(base_url('user-panel'));
        }
    }

    



    private $controller = 'ApiEditor';
   

    public function index()
    {
        // // ambil cookie
      
        // //==== Inisiasi Awal 
        // $data['controller'] = $this->controller;
        // $data['title_page'] = 'Live Editor | Goodeva';

        // $this->load->view('vu_editor',$data);

    	
    }

    function read_image_json()
    {
        $data = $this->ApiModelImage->get_data()->result();
        echo json_encode($data);
    }

    function read_image_array()
    {
        $data = $this->ApiModelImage->get_data()->result();
        // echo json_encode($data);
    }


    function upload()
    {
        if($_FILES)
        {
        $uploaddir = './image-server/website/';
        $id_user = $this->session->userdata('userID');
        $resultArray = array();
            foreach ( $_FILES as $file){
                        $fileName   = $file['name'];
                        $tmpName    = $file['tmp_name'];
                        $fileSize   = $file['size'];
                        $fileType   = $file['type'];
                        // move_uploaded_file(filename, destination);
                        if ($file['error'] != UPLOAD_ERR_OK)
                        {
                                error_log($file['error']);
                                echo JSON_encode(null);
                        }

                        $fp = fopen($tmpName, 'r');
                        $content = fread($fp, filesize($tmpName));


                        $extractFile = pathinfo($file['name']);

                        $sameName = 0; // Menyimpan banyaknya file dengan nama yang sama dengan file yg diupload
                        $handle = opendir($uploaddir);
                        while(false !== ($filee = readdir($handle))){ // Looping isi file pada directory tujuan
                            // Apabila ada file dengan awalan yg sama dengan nama file di uplaod
                            if(strpos($filee,$extractFile['filename']) !== false)
                            $sameName++; // Tambah data file yang sama
                        }

                        /* Apabila tidak ada file yang sama ($sameName masih '0') maka nama file pakai 
                        * nama ketika diupload, jika $sameName > 0 maka pakai format "namafile($sameName).ext */
                        $newName = empty($sameName) ? date('d-m-Y').'-'.$id_user.'-'.$file['name'] : date('d-m-Y').'-'.$id_user.'-'.$extractFile['filename'].'('.$sameName.').'.$extractFile['extension'];

                        // $newName = str_replace(' ', '-', $newName);

                        // $newName = strtolower($newName);

                        $uploadfile = $uploaddir.$id_user.$newName;


                        fclose($fp);
                        move_uploaded_file($tmpName,$uploaddir.$newName);

                        $result=array(
                                'name'  =>$newName,
                                'type'  =>'image',
                                // 'src'=>"data:".$fileType.";base64,".base64_encode($content),
                                'src'   => base_url().'image-server/website/'.$newName,
                                'date'  => date('Y-m-d'),
                                'height'=>350,
                                'width' =>250,
                        ); 

                        $data = array(
                            'gambar'        => $newName,
                            'id_user'       => $id_user,
                            'tanggal_dibuat'=> date('Y-m-d'),
                        );
                        $insert = $this->ApiModelImage->insert_data($data);


                        

                        //     echo 'File berhasil diupload dengan nama: '.$newName;
                        // }
                        // else{
                        //     echo 'File gagal diupload';
                        // }

                        // move_uploaded_file($tmpName, $uploadfile);


                        // Upload Ke server dan database
                        // $nama_file = $id_user.$file['name'];
                        

                        // we can also add code to save images in database here.
                        array_push($resultArray,$result);
            }    
        $response = array( 'data' => $resultArray );
        echo json_encode($response);
        }
    }


    function delete()
    {
        $id         = $this->input->post('id_file');
        $nama_file  = $this->input->post('nama_file');
        $id_user     = $this->session->userdata('userID');


        $data = array(
            'id'        => $id,
            'gambar'    => $nama_file,
        );
        unlink("./image-server/website/".$nama_file);

        $this->ApiModelImage->delete_image($nama_file,$id_user);

        echo json_encode($data);
    }

    // function uploadss()
    // {
    //     if($_FILES)
    //     {
    //     $resultArray = array();
    //         foreach ( $_FILES as $file){
    //                     $fileName = $file['name'];
    //                     $tmpName = $file['tmp_name'];
    //                     $fileSize = $file['size'];
    //                     $fileType = $file['type'];
    //                     if ($file['error'] != UPLOAD_ERR_OK)
    //                     {
    //                             error_log($file['error']);
    //                             echo JSON_encode(null);
    //                     }

    //                     $fp = fopen($tmpName, 'r');
    //                     $content = fread($fp, filesize($tmpName));
    //                     fclose($fp);

    //                     $uploaddir = base_url().'image-server/website/';
    //                     $uploadfile = $uploaddir . basename(md5($file['name']['name']));

                       

    //                     if (move_uploaded_file($tmpName, $uploadfile)) {
    //                         $result=array(
    //                                 'name'=>md5($file['name']),
    //                                 'type'=>'image',
    //                                 'src'=>"data:".$fileType.";base64,".base64_encode($content),
    //                                 'height'=>350,
    //                                 'width'=>250
    //                         ); 
    //                         // we can also add code to save images in database here.
    //                         array_push($resultArray,$result);
                          
    //                     } else {
    //                         error_log($file['error']);
    //                         echo JSON_encode(null);
    //                     }
    //         }    
    //     $response = array( 'data' => $resultArray );
    //     echo json_encode($response);
    //     }
    // }


    function save()
    {
            $css         =   $this->input->post('css');
            // $html    = $_POST['html'];

            $html_firts  = str_replace("'", "---?---?", $this->input->post('html'));
            $html        = str_replace('---?---?', '"', $html_firts);
       


        $data = array(
            'css'  => $css,
            'html' => $html
        );

        $create = $this->Model_editor->create($data);

        echo "{}";
    }

    function update_page()
    {
            $id          = $this->input->post('id');
            $id_user     = $this->session->userdata('userID');
            $judul_page  = $this->input->post('judul_page');   
            $css         = $this->input->post('css');
            $html_firts  = str_replace("'", "---?---?", $this->input->post('html'));
            $html        = str_replace('---?---?', '"', $html_firts);
       


        $data = array(

            // 'title'             => $title,
            'css'               => $css,
            'judul_page'        => $judul_page,
            'slug_id'           => $this->clean($judul_page),
            'html'              => $html,
            'tanggal_dibuat'    => date("Y-m-d H:i:s")
        );

        


        

        $update = $this->Model_website_page->update_page($id,$id_user,$data);
        echo json_encode($data);

    }

    function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string)); // Removes special chars.
    }

	
}
