<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends AdminController
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Page';
        $this->areaUrl = site_url('Page/');
        
        $this->load->model([
            'PageModel'
        ]);
    }

    public function index()
    {
        $data['pages'] = $this->PageModel->order_by('order', 'asc')->get_all();
        $this->template('Page/vList', $data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('page','page','trim|required');
        $this->form_validation->set_rules('content','content','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'page' => $this->input->post('page'),
                        'content' => $this->input->post('content'),
                    );
            if ($this->PageModel->insert($data))
            {
                $res['url']     = $this->areaUrl;
                $res['success'] = true;
                $res['message'] = 'Tambah data berhasil';
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }


    public function edit($id=null)
    {
        $data['action'] = $this->areaUrl.'update';
        $row = $this->PageModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id'] = $row->id;
            $this->template('Page/vEdit',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }   

    public function update()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';

        $this->form_validation->set_rules('id','id','required');
        
        $this->form_validation->set_rules('page','page','trim|required');
        $this->form_validation->set_rules('content','content','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'page' => $this->input->post('page'),
                        'content' => $this->input->post('content'),
                    );

            $row = $this->PageModel->get($this->input->post('id'));
            if ($row) 
            {
                if ($this->PageModel->update($data,$this->input->post('id')))
                {
                    
                    $res['url']     = $this->areaUrl;
                    $res['success'] = true;
                    $res['message'] = 'Ubah data berhasil';
                }
            } 
            else 
            {
                $res['success'] = false;
                $res['message'] = 'Data tidak ditemukan';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    } 


    public function destroy()
    {
        $ids = $this->input->post('id[]');
        foreach ($ids as $id) 
        {
            $row = $this->PageModel->get($id);

            if ($row) {
                $this->PageModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */