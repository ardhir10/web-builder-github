<?php
class Email extends CI_Model
{


    
    function send_email_google($email,$content)
    {
       
            //Load email library
    $this->load->library('email');

    //SMTP & mail configuration
    $config = array(
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'faiznyo12@gmail.com',
        'smtp_pass' => 'faizfawaaz12',
        'mailtype'  => 'html',
        'charset'   => 'utf-8'
    );
    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->set_newline("\r\n");

    //Email content
    $htmlContent = '<h1>Notification from Goodeva Web-Builder</h1>';
    $htmlContent = '<hr>';
    $htmlContent .= "<p>$content</p>";
  

    $this->email->to($email);
    $this->email->from('faiznyo12@gmail,com','web-builder@goodeva.com');
    $this->email->subject('Notification from Goodeva Web-Builder');
    $this->email->message($htmlContent);

    //Send email
    $this->email->send();

        
    }
    
    function send_email($email,$nama,$pesan)
    {
				    
        $email = 'seegunsnyo@gmail.com';
        $nama = 'faiz';

        $pengirim ="brian@goodeva.co.id";
        $judul="Notification From ";
        $pesan="Halo ".$nama." saya mencoba untuk mengirim email kepada anda.";

        $kirim=mail($email,$judul,$pesan,"From: " . $pengirim ."\nContent-Type : text/html; charset=iso-8859-1");
								
			
				if ($kirim){
                    echo $email.$judul.$pesan.$pengirim;
                    echo "<br>";
                    echo "succeess";
                }			
//			echo "<script>window.location=history.go(-1);</script>";
	
        
    }
    
    function email_3d()//3day before trial end
    {
        
         $where= array(
         'id_status' => '1'//1=trial
         );
        $cek = $this->Model_user->edit_data($where)->result();
        foreach ($cek as $data){
            
            $awal  = date_create($data->expired);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff(  $akhir,$awal);
            
            if ($diff->days == 3){
                $email=$data->email;
                $nama=$data->nama;
                $content="Hi $nama Waktu trial anda kurang dari 3 hari , silahkan berlangganan layanan kami ";
                $this->send_email_google($email,$content);
            }
        }     
    }
    
     function email_0d()//0day end trial date 
    {
        
         $where= array(
         'id_status' => '1'//1=trial
         );
        $cek = $this->Model_user->edit_data($where)->result();
        foreach ($cek as $data){
            
            $awal  = date_create($data->expired);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff(  $akhir,$awal);
            
            if ($diff->days <= 0){
                $email=$data->email;
                $nama=$data->nama;
                $content="hi $nama Waktu trial anda berakhir , silahkan berlangganan layanan kami ";
                $this->send_email_google($email,$content);
            }
        }     
    }
    
    function email_suspend($id)//status = suspend 
    {
        
         $where= array(
         'ID' => $id
         );
        $data = $this->Model_user->edit_data($where)->row();
        
        $email=$data->email;
        $nama=$data->nama;
        $content="hi $nama Akun Goodeva Web-Builder anda SUSPEND, silahkan Berlangganan untuk menikmati layanan kami<hr>
                  <img src='https://goodeva.co.id/my-assets/images/logo.png'> ";
        $this->send_email_google($email,$content);
        
        }    
    
    function email_aktiv($id)//status = aktiv 
    {
        
         $where= array(
         'ID' => $id//2=aktiv
         );
        $data = $this->Model_user->edit_data($where)->row();
        
        $email=$data->email;
        $nama=$data->nama;
        $content="hi $nama Akun Goodeva Web-Builder anda sudah AKTIV , silahkan Menikmati layanan               kami<hr>
                  <img src='https://goodeva.co.id/my-assets/images/logo.png'> ";
        $this->send_email_google($email,$content);
        
        }     
    
    function email_order($id_user,$pesanan)
    {
        
         $where= array(
         'ID' => $id_user
         );
        
        $data = $this->Model_user->edit_data($where)->row();
       
                $email=$data->email;
                $nama=$data->nama;
                $content="
                Hi $nama Pesanan Anda Sudah Masuk ,
                <hr>
                $pesanan
                <hr>
                silahkan tunggu kami sedang proses <hr>
                  <img src='https://goodeva.co.id/my-assets/images/logo.png'>  ";
                
    
                $this->send_email_google($email,$content);
                $this->email_to_admin($id_user,$pesanan);
          
    }  
    
    function email_to_admin($id_user,$pesanan)
    {
        
        
        $where2= array(
         'ID' => $id_user
         );
        $data = $this->db->query("SELECT * from table_admin order by ID Desc ")->row();
        
        $data_user = $this->Model_user->edit_data($where2)->row();
        
        
                $email=$data->email;
                $nama=$data->nama_tampilan;
                $nama_user=$data_user->nama;
                $content="
                Hi $nama , $nama_user telah membuat pesanan , silahkan cek <hr>
                $pesanan
                <hr>
                  <img src='https://goodeva.co.id/my-assets/images/logo.png'>  ";
                $this->send_email_google($email,$content);
            
    }
    
    //email for subscription
     function email_7d()
    {
        
         $where= array(
         'type_order' => 'package'
         );
        $cek = $this->Model_order->edit_data($where)->result();
         foreach ($cek as $data){
            
            
            $awal  = date_create($data->update_date);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff(  $akhir,$awal);
            
            if ($diff->days == 7){
                
                $id_user=$data->id_user;
                $data_user=$this->Model_user->edit_data(array('ID' => $id_user))->row();
                $email=$data_user->email;
                $nama=$data_user->nama;
                $content="Hi $nama Waktu subscription anda kurang dari 7 hari , silahkan berlangganan layanan kami ";
                $this->send_email_google($email,$content);
            }
        }     
    }
     function email_1d()
    {
        
         $where= array(
         'type_order' => 'package'
         );
        $cek = $this->Model_order->edit_data($where)->result();
       
         
        foreach ($cek as $data){
            
            
            $awal  = date_create($data->update_date);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff(  $akhir,$awal);
            
            if ($diff->days == 1){
                $id_user=$data->id_user;
                $data_user=$this->Model_user->edit_data(array('ID' => $id_user))->row();
                $email=$data_user->email;
                $nama=$data_user->nama;
                $content="Hi $nama Waktu subscription anda kurang dari 1 hari , silahkan berlangganan layanan kami ";
                $this->send_email_google($email,$content);
            }
        }     
    }
     function email_30d()
    {
        
         $where= array(
         'type_order' => 'package'
         );
        $cek = $this->Model_order->edit_data($where)->result();
        foreach ($cek as $data){
            
            
            $awal  = date_create($data->update_date);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff(  $akhir,$awal);
            
            if ($diff->days == 30){
                $id_user=$data->id_user;
                $data_user=$this->Model_user->edit_data(array('ID' => $id_user))->row();
                $email=$data_user->email;
                $nama=$data_user->nama;
                $content="Hi $nama Waktu subscription anda kurang dari 30 hari , silahkan berlangganan layanan kami ";
                $this->send_email_google($email,$content);
            }
        }       
    }
    
}
?>
