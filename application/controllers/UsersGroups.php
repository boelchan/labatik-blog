<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class UsersGroups extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'UsersGroups';
        $this->areaUrl = site_url('UsersGroups/');
        
        $this->load->model([
            'UsersGroupsModel',
			'GroupsModel',
			'UsersModel'
        ]);
    }

    public function index()
    {
        $this->template('UsersGroups/vList');
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

        $t = $this->UsersGroupsModel->getData();
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $checkbox,
					btnRead($id, $d->{$this->UsersModel->label}),
					$d->{$this->GroupsModel->label},
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
        $row = $this->UsersGroupsModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $this->template('UsersGroups/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        $data['action']    = $this->areaUrl.'store';
        $this->template('UsersGroups/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('user_id','user id','trim|required|integer');
        $this->form_validation->set_rules('group_id','group id','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'user_id' => $this->input->post('user_id'),
                        'group_id' => $this->input->post('group_id'),
                    );
            if ($this->UsersGroupsModel->insert($data))
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
        $row = $this->UsersGroupsModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id'] = $row->id;
            $this->template('UsersGroups/vEdit',$data);
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
        
        $this->form_validation->set_rules('user_id','user id','trim|required|integer');
        $this->form_validation->set_rules('group_id','group id','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'user_id' => $this->input->post('user_id'),
                        'group_id' => $this->input->post('group_id'),
                    );

            $row = $this->UsersGroupsModel->get($this->input->post('id'));
            if ($row) 
            {
                if ($this->UsersGroupsModel->update($data,$this->input->post('id')))
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
            $row = $this->UsersGroupsModel->get($id);

            if ($row) {
                $this->UsersGroupsModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file UsersGroups.php */
/* Location: ./application/controllers/UsersGroups.php */