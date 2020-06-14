<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
    public function index()
    {   
        $this->load->model('Login_model');
        
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        
      
        if ($this->form_validation->run() == FALSE)
        {
            $data['title']='Login';
            $this->load->view('login/index_view', $data);           
        } 
        else 
        {
            $username=$this->input->post('username');
            $password=md5($this->input->post('password'));
            
            $where = array('username' => $username , 'password' => $password);
    
            $cek = $this->Login_model->cek_login($where);
            
            if ($cek > 0)
            {
                
                $data_session = array(
                    'status' => 'logged in'
                );
                
                $this->session->set_userdata( $data_session );
                // sekali dibuat dan dire load berulang kali session akan tetap ada
                redirect('Buku/index');
                
            }
            else 
            {
                $this->session->set_flashdata('pesan', 'Username atau password salah');
                //flashdata itu sekali pakai, jika dire load pasti hilang   
                redirect('Login/index');      
            }
        }

    }

    public function logout()
    {
       $this->session->sess_destroy();
       redirect('Login/index');
    }
}


?>