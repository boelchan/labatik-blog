<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UsersModel extends MY_Model
{

    public $table       = 'users';
    public $primary_key = 'id';
    public $label       = 'first_name';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

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

        $i=1;
        $dataOrder[$i++] = 'first_name';
        $dataOrder[$i++] = 'email';
        $dataOrder[$i++] = '';
        $dataOrder[$i++] = 'last_login';
        $dataOrder[$i++] = 'active';

        $q = "SELECT $this->table.* FROM $this->table ";
        
        if( !empty($this->input->post('email')) )
        {
            $where[] = " LOWER(email) LIKE '%".strtolower($this->input->post('email'))."%'";
        }
        if( !empty($this->input->post('active')) )
        {
            $where[] = " active = ". ($this->input->post('active') == 1 ? 1 : 0);
        }
        
        $where[] = " id <> 1 ";

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

/* End of file UsersModel.php */
/* Location: ./application/models/UsersModel.php */