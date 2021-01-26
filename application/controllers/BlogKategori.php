<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class BlogKategori extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'BlogKategori';
        $this->areaUrl = site_url('blogKategori/');
        
        $this->load->model([
            'blogKategoriModel'
        ]);
    }

    public function index()
    {
        $this->template('BlogKategori/vList');
    }

    public function getDatatable()
    {
        $customActionName = $this->input->post('customActionName');
        $records          = array();

        if ($customActionName == "destroy") 
        {
            $records=$this->destroy();
        }

        $records["data"] = array();

        $t = $this->blogKategoriModel->getData();
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id_kategori;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $checkbox,
					btnRead($id, $d->kategori_seo),
					$d->kategori,
                    btnEditTable($id)
                );
            }
        }
        $records["draw"]            = $t['draw'];
        $records["recordsTotal"]    = $t['total_rows'];
        $records["recordsFiltered"] = $t['total_rows'];

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function read($id=null)
    {
        $row = $this->blogKategoriModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $this->template('BlogKategori/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        $data['action']    = $this->areaUrl.'store';
        $this->template('BlogKategori/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('kategori_seo','kategori seo','trim');
        $this->form_validation->set_rules('kategori','kategori','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'kategori_seo' => $this->input->post('kategori_seo'),
                        'kategori' => $this->input->post('kategori'),
                    );
            if ($this->blogKategoriModel->insert($data))
            {
                $res['url']     = $this->areaUrl;
                $res['success'] = true;
                $res['message'] = 'Tambah data berhasil';
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }


    public function edit($id = 0)
    {
        $data['action'] = $this->areaUrl.'update';
        $row = $this->blogKategoriModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id_kategori'] = $row->id_kategori;
            $this->template('BlogKategori/vEdit',$data);
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

        $id = $this->input->post('id_kategori');
        $this->form_validation->set_rules('id_kategori','id kategori','required');
        $this->form_validation->set_rules('kategori_seo','kategori seo','trim');
        $this->form_validation->set_rules('kategori','kategori','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'kategori_seo' => $this->input->post('kategori_seo'),
                        'kategori' => $this->input->post('kategori'),
                    );

            $row = $this->blogKategoriModel->get($id);
            if ($row) 
            {
                if ($this->blogKategoriModel->update($data, $id))
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
            $row = $this->blogKategoriModel->get($id);

            if ($row) {
                $this->blogKategoriModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file BlogKategori.php */
/* Location: ./application/controllers/BlogKategori.php */