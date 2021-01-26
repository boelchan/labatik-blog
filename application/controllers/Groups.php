<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Groups';
        $this->areaUrl = site_url('Groups/');
        
        $this->load->model([
            'GroupsModel'
        ]);
    }

    public function index()
    {
        $this->template('Groups/vList');
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

        $t = $this->GroupsModel->getData();
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $checkbox,
					btnRead($id, $d->name),
					$d->description,
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
        $row = $this->GroupsModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $this->template('Groups/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        $data['action']    = $this->areaUrl.'store';
        $this->template('Groups/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('description','description','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                    );
            if ($this->GroupsModel->insert($data))
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
        $row = $this->GroupsModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id'] = $row->id;
            $this->template('Groups/vEdit',$data);
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
        
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('description','description','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                    );

            $row = $this->GroupsModel->get($this->input->post('id'));
            if ($row) 
            {
                if ($this->GroupsModel->update($data,$this->input->post('id')))
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
            $row = $this->GroupsModel->get($id);

            if ($row) {
                $this->GroupsModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file Groups.php */
/* Location: ./application/controllers/Groups.php */