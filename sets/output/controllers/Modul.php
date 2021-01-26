<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modul extends MY_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('modul_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->template('modul/v_modul_list');
    }

    public function getDatatable()
    {
        $customActionName=$this->input->post('customActionName');
        $records         = array();

        if ($customActionName == "delete") {
            $records=$this-> delete_checked();
        }

        $iDisplayLength = ($this->input->get_post('length')) ? $this->input->get_post('length') : 10 ;
        $iDisplayStart  = ($this->input->get_post('start')) ? $this->input->get_post('start') : 0 ;
        $sEcho          = ($this->input->get_post('draw')) ? $this->input->get_post('draw') : 1 ;

        $t              = $this->modul_model->get_limit_data($iDisplayStart, $iDisplayLength);
        $iTotalRecords  = $t['total_rows'];
        $get_data       = $t['get_db'];

        $records["data"] = array();

        $i=$iDisplayStart+1;
        if ($get_data) {
            foreach ($get_data as $d) {
                $checkbok= '<input type="checkbox" name="id[]" value="'.$d->id.'">';
                $view    = anchor(site_url('modul/read/'.$d->id),'<i class="fa fa-search fa-lg"></i>',array('title'=>'detail','class'=>'btn btn-icon-only green'));
                $edit    = anchor(site_url('modul/form/'.$d->id),'<i class="fa fa-pencil fa-lg"></i>',array('title'=>'edit','class'=>'btn btn-icon-only blue'));
                $delete  = '<button class="btn btn-icon-only red delete" title="delete" data-title="'.$d->{$this->modul_model->label}.'" data-url="'.site_url('modul/delete/'.$d->id).'"><i class="fa fa-trash fa-lg"></i></button>';

                $records["data"][] = array(
                    $checkbok,
                
					$d->controller, 
					$d->nama, 
					'<img style="max-width: 100px; max-height: 100px;" src="'. load_image("uploads/temp/".$d->cover_img).'"  alt="Image">' , 
					$d->keterangan, 
					$d->link_youtube, 
                    $view.$edit.$delete
                );
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function read($id)
    {
        $row = $this->modul_model
                    ->get($id);
        if ($row) {
            $data['row'] = $row;
            $data['id'] = $id;
            $this->template('modul/v_modul_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('modul'));
        }
    }

    public function form($id=null)
    {
        $data['action']    = site_url('modul/form_action');
        if (empty($id)) {
            $data['row']       = null;
            $data['id']        = '';
        }else{
            $row = $this->modul_model->get($id);

            if ($row) {
                $data['row']       = $row;
                $data['id']        = $row->id;
            } else {
                show_error('Data not found');
            }
        }

        $this->template('modul/v_modul_form',$data);
    }

    public function form_action()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan gagal';
        
        $this->form_validation->set_rules('controller','controller','trim');
        $this->form_validation->set_rules('nama','nama','trim|required');
        $this->form_validation->set_rules('cover_img','cover_img','trim');
        $this->form_validation->set_rules('keterangan','keterangan','trim');
        $this->form_validation->set_rules('link_youtube','link_youtube','trim');

        if ($this->form_validation->run() == FALSE) {
            $res['message'] = 'Lengkapi form dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } else {
            $data = array(
                        'controller' => $this->input->post('controller'),
                        'nama' => $this->input->post('nama'),
                        'cover_img' => $this->input->post('cover_img'),
                        'keterangan' => $this->input->post('keterangan'),
                        'link_youtube' => $this->input->post('link_youtube'),
                    );
            if (empty($this->input->post('id'))) {
                if($this->modul_model->insert($data)){
                    $res['url']     = site_url('modul');
                    $res['success'] = true;
                    $res['message'] = 'Simpan berhasil';
                }
            }else{
                $row = $this->modul_model->get($this->input->post('id'));

                if ($row) {
                    if($this->modul_model->update($data,$this->input->post('id'))){
                        $res['url']     = site_url('modul');
                        $res['success'] = true;
                        $res['message'] = 'Simpan berhasil';
                    }
                } else {
                    $res['success'] = false;
                    $res['message'] = 'Data not found';
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    public function delete($id)
    {
        $res['success'] = false;
        $res['message'] = 'Hapus gagal';
        $row = $this->modul_model->get($id);

        if ($row) {
            $this->modul_model->delete($id);
            $res['success'] = true;
            $res['message'] = 'Hapus berhasil';
        } else {
            $res['message'] = 'Data tidak ditemukan';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    public function delete_checked()
    {
        $id_array=$this->input->post('id[]');
        foreach ($id_array as $id) {
            $row = $this->modul_model->get($id);

            if ($row) {
                $this->modul_model->delete($id);
            }
        }
        $result["customActionStatus"]="OK";
        $result["customActionMessage"]="Delete Record Success";
        return $result;
    }
    

}

/* End of file Modul.php */
/* Location: ./application/controllers/Modul.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */