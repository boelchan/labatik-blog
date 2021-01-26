<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UsersGroupsModel extends MY_Model
{

    public $table       = 'users_groups';
    public $primary_key = 'id';
    public $label       = 'id';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
        $this->has_one['Groups'] = array('GroupsModel','id','group_id');
        $this->has_one['Users'] = array('UsersModel','id','user_id');
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
        $dataOrder[$i++] = $this->primary_key;
        $dataOrder[$i++] = 'user_id';
        $dataOrder[$i++] = 'group_id'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('user_id')) )
        {
            $where[] = " user_id = ". $this->input->post('user_id');
        }
        if( !empty($this->input->post('group_id')) )
        {
            $where[] = " group_id = ". $this->input->post('group_id');
        }

        $q .= "
    		LEFT JOIN groups ON group_id = id
    		LEFT JOIN users ON user_id = id ";

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

/* End of file UsersGroupsModel.php */
/* Location: ./application/models/UsersGroupsModel.php */