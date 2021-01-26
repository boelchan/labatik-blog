<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BlogKategoriModel extends MY_Model
{
    public $table       = 'blog_kategori';
    public $primary_key = 'id_kategori';
    public $label       = 'kategori';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id_kategori'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
    }
    
    // get dataTable
    function getData() 
    {
        $order  = $this->input->post('order');
        $length = $this->input->post('length');
        $start  = $this->input->post('start');

        $result['draw'] = $this->input->post('draw');
        
        $dataOrder = array();
        $where     = array();

        $i = 0;
        $dataOrder[$i++] = $this->primary_key;
        $dataOrder[$i++] = 'kategori_seo';
        $dataOrder[$i++] = 'kategori'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('kategori_seo')) )
        {
            $where[] = " LOWER(kategori_seo) LIKE '%".strtolower($this->input->post('kategori_seo'))."%'";
        }
        if( !empty($this->input->post('kategori')) )
        {
            $where[] = " LOWER(kategori) LIKE '%".strtolower($this->input->post('kategori'))."%'";
        }

        $q .= " ";

        if ( count($where) > 0 ) 
        {
            $where = implode(' AND ', $where);
            $q .= " WHERE $where"; 
        }

        $result['total_rows'] = $this->db->query($q)->num_rows();

        if ($order)
        {
            $q .= " ORDER BY ". $dataOrder[$order[0]['column']] ." ". $order[0]['dir'];
        }
        else
        {
            $q .= " ORDER BY created_at DESC ";
        }

        $q .= " LIMIT $start , $length ";

        $result['rows'] = $this->db->query($q)->result();

        return $result;
    }

}

/* End of file BlogKategoriModel.php */
/* Location: ./application/models/BlogKategoriModel.php */