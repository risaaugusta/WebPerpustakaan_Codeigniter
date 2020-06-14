<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct() { //apapun yang ditaruh di conrtruct pasti dijalankan terlebih dahulu
        parent::__construct();
        $this->load->model('Buku_model');

        if($this->session->userdata('status') != 'logged in')
        {    
            redirect('Login/index');
        }
    }

    public function index()
    {
        $data['title']='Index';

        if ($this->input->get('keyword')) 
        {
            $keyword = $this->input->get('keyword');
            
            $data['buku']=$this->Buku_model->search($keyword);   
        }
        else
        {          
            $data['buku'] = $this->Buku_model->getBuku();
        }
        
        // var_dump($data['buku']);
        $this->load->view('templates/header',$data);
        $this->load->view('buku/index_view', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {   
        $data['title']='Tambah Data';
        $this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required',array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|exact_length[4]',array('required' => '%s harus diisi', 'exact_length'=>'Format tahun : YYYY'));
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[5]',array('required' => '%s harus diisi','min_length'=>'Harga minimal 5 digit angka'));

        if ($this->form_validation->run() == FALSE) 
        {
            $data['genre']=$this->Buku_model->getGenre();
            

            $this->load->view('templates/header', $data);
            $this->load->view('buku/tambah_view');
            $this->load->view('templates/footer');
        } 
        else 
        {
            $judul = $this->input->post('judul');
            $penulis = $this->input->post('penulis');
            $tahun_terbit = $this->input->post('tahun_terbit');
            $harga = $this->input->post('harga');
            $id_genre = $this->input->post('id_genre');
            
            
            $data = array('judul' => $judul,
                        'penulis' => $penulis,
                        'tahun_terbit' => $tahun_terbit,
                        'harga' => $harga,
                        'id_genre' => $id_genre);

            $this->Buku_model->tambah_data($data);
            $this->session->set_flashdata('sukses', 'ditambahkan');

            redirect('Buku/index','refresh');
        }
        
  
        
    }

    // function edit($id_buku){
    //     $where = array('id_buku' => $id_buku);
    //     $data['buku'] = $this->Buku_model->edit_data($where,'buku');
    //     $this->load->view('edit_view',$data);
    // }

    function edit($id_buku){
        $data['title']='Edit Data';

        $this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required',array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|exact_length[4]',array('required' => '%s harus diisi', 'exact_length'=>'Format tahun : YYYY'));
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[5]',array('required' => '%s harus diisi','min_length'=>'Harga minimal 5 digit angka'));
        
        $where = array('id_buku' => $id_buku);
        
        if ($this->form_validation->run() == FALSE) {
            
            $data['buku']=$this->Buku_model->getBukubyId($where);
            $data['genre']=$this->Buku_model->getGenre();

            $this->load->view('templates/header', $data);
            $this->load->view('buku/edit_view',$data);
            $this->load->view('templates/footer');
        } else {
            $judul = $this->input->post('judul');
            $penulis = $this->input->post('penulis');
            $tahun_terbit = $this->input->post('tahun_terbit');
            $harga = $this->input->post('harga');
            $id_genre = $this->input->post('id_genre');
            // parameter untuk method uodate data di Buku_model.php
    
            $data = array(
                'id_buku' => $id_buku,
                'judul' => $judul,
                'penulis' => $penulis,
                'tahun_terbit' => $tahun_terbit,
                'harga' => $harga,
                'id_genre'=>$id_genre
            );
    
            $this->Buku_model->update_data($where, $data);   
            $this->session->set_flashdata('sukses', 'diubah');
            
            redirect('Buku/index');
        }
     
        // $this->load->view('edit_view',$data);
    }


    // function update(){
    //     $id_buku = $this->input->post('id_buku');
    //     $judul = $this->input->post('judul');
    //     $penulis = $this->input->post('penulis');
    //     $tahun_terbit = $this->input->post('tahun_terbit');
    //     $harga = $this->input->post('harga');
     
    //     $data = array(
    //         'judul' => $judul,
    //         'penulis' => $penulis,
    //         'tahun_terbit' => $tahun_terbit,
    //         'harga' => $harga
    //     );
     
    //     $where = array(
    //         'id_buku' => $id_buku
    //     );
     
    //     $this->Buku_model->update_data($where,$data,'buku');
    //     redirect('Buku/index','refresh');
    // }

    function hapus($id_buku){
		$where = array('id_buku' => $id_buku);
        $this->Buku_model->hapus_data($where,'buku');
        
        $this->session->set_flashdata('sukses', 'dihapus');
        
		redirect('Buku/index');
    }
    
    public function search ()
    {
        $keyword = $this->input->get('keyword');

        $data['buku']=$this->Buku_model->search($keyword);        

        $this->load->view('buku/index_view', $data);  
    }

    public function detail($id_buku)
    {
        $data['title']='Detail Buku';

        $where = array('id_buku' => $id_buku);
        $data['buku']=$this->Buku_model->getBukuById($where);
        
        $this->load->view('templates/header',$data);
        $this->load->view('buku/detail_view', $data);
        $this->load->view('templates/footer');    
    }

}

?>