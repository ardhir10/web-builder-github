<?php
// application/controllers/Zip.php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Zip extends CI_Controller {
    private function _load_zip_lib()
    {
        $this->load->library('zip');
    }
     
    private function _archieve_and_download($filename)
    {
        // create zip file on server
        $this->zip->archive(FCPATH.'/uploads/'.$filename);
         
        // prompt user to download the zip file
        $this->zip->download($filename);
    }
 
    public function data()
    {
        $this->_load_zip_lib();
         
        $this->zip->add_data('name.txt', 'Sajal Soni');
        $this->zip->add_data('profile.txt', 'Web Developer');
         
        $this->_archieve_and_download('my_info.zip');
    }
 
    public function data_array()
    {
        $this->_load_zip_lib();
         
        $files = array(
                'name.txt' => 'Sajal Soni',
                'profile.txt' => 'Web Developer'
        );
         
        $this->zip->add_data($files);
         
        $this->_archieve_and_download('my_info.zip');
    }


    





 
    public function data_with_subdirs()
    {
        $this->_load_zip_lib();
         
        $this->zip->add_data('info/name.txt', 'Sajal Soni');
        $this->zip->add_data('info/profile.txt', 'Web Developer');
         
        $this->_archieve_and_download('my_info.zip');
    }
 
    public function files()
    {
        $this->_load_zip_lib();
         
        // pass second argument as TRUE if want to preserve dir structure
        $this->zip->read_file(FCPATH.'/uploads/1.jpg');
        $this->zip->read_file(FCPATH.'/uploads/2.jpg');
         
        $this->_archieve_and_download('images.zip');
    }
     
    public function dir()
    {
        $this->_load_zip_lib();
         
        // pass second argument as FALSE if want to ignore preceding directories
        $this->zip->read_dir(FCPATH.'/uploads/images/');
         
        $this->_archieve_and_download('dir_images.zip');
    }


    function css()
    {
        $this->load->library('cssbeautifier');
        $this->load->library('malasngoding');



        $uglyCSS = "foo{foo:bar;}";
        $css = $this->cssbeautifier->run($uglyCSS);
        // $css = $this->malasngoding->nama();
        echo $uglyCSS;

    }


    public function download_asset_website($id_website = '')
    {
        $this->load->model('Model_website_page');
        $this->load->model('Model_website');
        $this->load->library('cssbeautifier');



        $files = array();
        $data_page = $this->Model_website_page->edit_data(array('id_website'=>$id_website))->result(); 
        $data_website = $this->Model_website->edit_data(array('ID'=>$id_website))->row();
        // href="./unicorn-website-modern/page-about"
            foreach ($data_page as $row) {

                if ($row->type_page == 'index') {
                    $nama_file = 'index';
                }else{
                    $nama_file = $row->slug_id;
                }


                // Merapihkan Coding html
                $html_min = str_replace('./'.$data_website->slug_id.'/','./', $row->html );

                $dom = new DOMDocument();

                // $dom->preserveWhiteSpace = false;
                // $dom->loadHTML($html_min,LIBXML_HTML_NOIMPLIED);
                // $dom->formatOutput = true;


                // $html = $dom->saveXML($dom->documentElement);

                // Merapihkan Coding css
                $uglyCSS = $row->css;
                $css = $this->cssbeautifier->run($uglyCSS);



                $files[$data_website->slug_id.'/'.$nama_file.'.html'] = '<!DOCTYPE html>
                                                    <html>
                                                    <head>
                                                      <title>'.$data_website->nama_website .' : '.$row->judul_page.'</title>
                                                      <style type="text/css">'.
                                                        $css.'
                                                      </style>
                                                      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
                                                      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                                                      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                                                      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
                                                      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                                      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
                                                    </head>

                                                    <body>

                                                        '.str_replace('./'.$data_website->slug_id.'/','./', $row->html ).'
                                                    </body>
                                                    </html>';
            }

            // Membuat file Htaccess
            $files['.htaccess'] = 'RewriteEngine On
RewriteCond %{REQUEST_URI} !\.[a-zA-Z0-9]{3,4}
RewriteCond %{REQUEST_URI} !/$
RewriteRule ^(.*)$ $1.html';

            $this->_load_zip_lib();
             
            

            // print_r($files);
             
            $this->zip->add_data($files);
             
            $this->_archieve_and_download($data_website->slug_id.'.zip');
    }
}