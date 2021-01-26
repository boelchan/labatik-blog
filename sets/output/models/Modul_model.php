<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modul_model extends MY_Model
{

    public $table = 'modul';
    public $primary_key = 'id';
    public $label = 'nama';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array('id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
    }
    
    // get total rows
    function get_limit_data($limit, $start) {
        $order            = $this->input->post('order');
        $dataorder = array();
        $where = array();

        $i=1;
        $dataorder[$i++] = 'controller';
        $dataorder[$i++] = 'nama';
        $dataorder[$i++] = 'cover_img';
        $dataorder[$i++] = 'keterangan';
        $dataorder[$i++] = 'link_youtube';
        if(!empty($this->input->post('controller'))){
            $where['LOWER(controller) LIKE'] = '%'.strtolower($this->input->post('controller')).'%';
        }
        if(!empty($this->input->post('nama'))){
            $where['LOWER(nama) LIKE'] = '%'.strtolower($this->input->post('nama')).'%';
        }
        if(!empty($this->input->post('cover_img'))){
            $where['LOWER(cover_img) LIKE'] = '%'.strtolower($this->input->post('cover_img')).'%';
        }
        if(!empty($this->input->post('keterangan'))){
            $where['LOWER(keterangan) LIKE'] = '%'.strtolower($this->input->post('keterangan')).'%';
        }
        if(!empty($this->input->post('link_youtube'))){
            $where['LOWER(link_youtube) LIKE'] = '%'.strtolower($this->input->post('link_youtube')).'%';
        }

        $this->where($where);
        $result['total_rows'] = $this->count_rows();
        
        $this->where($where);
        if ($order) {
            $this->order_by( $dataorder[$order[0]["column"]],  $order[0]["dir"]);
        }
        $this->limit($start, $limit);
        $result['get_db']=$this
                            ->get_all();
        return $result;
    }

    public function link_youtube($modul_id='')
    {
        $dt = $this->fields('link_youtube')->get($modul_id);
        if ($dt) {
            if ($dt->link_youtube == null) {
                return array('link_youtube'=>'');
            }
            return array('link_youtube'=>$dt->link_youtube);
        }
        return array('status' => false);
    }


}

/* End of file Modul_model.php */
/* Location: ./application/models/Modul_model.php */
/* Please DO NOT modify this information : */
/* http://harviacode.com */