<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BlogPostModel extends MY_Model
{
    public $table       = 'blog_post';
    public $primary_key = 'id_post';
    public $label       = 'banner_img';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id_post'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
        $this->has_one['blogKategori'] = array('blogKategoriModel','id_kategori','blog_kategori_id');
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
        $dataOrder[$i++] = 'banner_img';
        $dataOrder[$i++] = 'judul_seo';
        $dataOrder[$i++] = 'judul';
        $dataOrder[$i++] = 'blog_kategori_id';
        $dataOrder[$i++] = 'konten';
        $dataOrder[$i++] = 'status';
        $dataOrder[$i++] = 'status_date'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('banner_img')) )
        {
            $where[] = " LOWER(banner_img) LIKE '%".strtolower($this->input->post('banner_img'))."%'";
        }
        if( !empty($this->input->post('judul_seo')) )
        {
            $where[] = " LOWER(judul_seo) LIKE '%".strtolower($this->input->post('judul_seo'))."%'";
        }
        if( !empty($this->input->post('judul')) )
        {
            $where[] = " LOWER(judul) LIKE '%".strtolower($this->input->post('judul'))."%'";
        }
        if( !empty($this->input->post('blog_kategori_id')) )
        {
            $where[] = " blog_kategori_id = ". $this->input->post('blog_kategori_id');
        }
        if( !empty($this->input->post('konten')) )
        {
            $where[] = " LOWER(konten) LIKE '%".strtolower($this->input->post('konten'))."%'";
        }
        if( !empty($this->input->post('status')) )
        {
            $where[] = " LOWER(status) LIKE '%".strtolower($this->input->post('status'))."%'";
        }
        if( !empty($this->input->post('status_date_start')) )
        {
            $where[] = " status_date >= '". $this->input->post('status_date_start') . "'";
        }
        if( !empty($this->input->post('status_date_end')) )
        {
            $where[] = " status_date <= '". $this->input->post('status_date_end') . "'";
        }

        $q .= "
    		LEFT JOIN blog_kategori ON blog_kategori_id = id_kategori ";

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

/* End of file BlogPostModel.php */
/* Location: ./application/models/BlogPostModel.php */