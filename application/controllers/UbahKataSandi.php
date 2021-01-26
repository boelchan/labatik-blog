<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class UbahKataSandi extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('ion_auth_model');
        
        $this->title   = 'Ubah Kata Sandi';
        $this->areaUrl = site_url('UbahKataSandi/');
        $this->urlBack = $this->areaUrl;
    }

    public function index()
    {
        $data['action']    = $this->areaUrl.'action';
        $this->template('auth/change_password', $data);
    }

    public function action()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $id = $this->jwt->id;
        $row = $this->UsersModel->get( $id );

        $cekPass = $this->ion_auth_model->verify_password($this->input->post('old_password'), $row->password);
        if ( $cekPass ) 
        {
            $this->form_validation->set_message('matches', 'Kata sandi harus sama');
            $this->form_validation->set_message('required', 'Harus diisi');
    
            $this->form_validation->set_rules('old_password','Kata sandi','required|trim');
            $this->form_validation->set_rules('password','Kata sandi','required|trim');
            $this->form_validation->set_rules('rpassword','Kata sandi','required|trim|matches[password]');
    
            $res['message'] = 'Lengkapi inputan dengan benar';
            if ($this->form_validation->run() == FALSE) 
            {
                $res['field_error'] = $this->form_validation->error_array();
            } 
            else 
            {
                $data['password'] = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
                if ($this->UsersModel->update($data, $id ))
                {
                    $this->session->sess_destroy();
                    $res['success'] = true;
                    $res['message'] = 'Ubah data berhasil';
                    $res['url']     = site_url('auth/login');
                }
               
            }
        }
        else
        {
            $res['field_error'] = ['old_password' => 'Kata sandi lama salah'];
        }
        


        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }
   

}