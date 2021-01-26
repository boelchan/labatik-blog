<?php 

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . ucfirst($m) . " extends MY_Model
{
    public \$table       = '$table_name';
    public \$primary_key = '$pk';
    public \$label       = '$label';
    public \$fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public \$protected   = array('$pk'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        \$this->soft_deletes = FALSE;";
foreach ($reference as $row) {
    $string .= "
        \$this->has_one['". lcfirst($row['r_table']) ."'] = array('". lcfirst($row['r_model']) ."','".$row['r_column']."','".$row['column_name']."');";
}
$string .="
    }
    
    // get dataTable
    function getData() 
    {
        \$order  = \$this->input->post('order');
        \$length = \$this->input->post('length');
        \$start  = \$this->input->post('start');

        \$result['draw'] = \$this->input->post('draw');
        
        \$dataOrder = array();
        \$where     = array();

        \$i = 0;
        \$dataOrder[\$i++] = \$this->primary_key;";

foreach ($non_pk as $row) {
    $string .= "
        \$dataOrder[\$i++] = '". $row['column_name'] ."';";
}
$string .=" 

        \$q = \"SELECT * FROM \$this->table \";
        ";

foreach ($non_pk as $row) 
{
    if ($row["data_type"] == 'numeric') 
    {
        $string .= "
        if ( !empty(\$this->input->post('" . $row['column_name'] ."_start')) )
        {
            \$where[] = \" " .$row['column_name']." >= \". \$this->input->post('" . $row['column_name'] ."_start');
        }
        if( !empty(\$this->input->post('" . $row['column_name'] ."_end')) )
        {
            \$where[] = \" " .$row['column_name']." <= \". \$this->input->post('" . $row['column_name'] ."_end');
        }";
    }
    else if ($row["data_type"] == 'date' || $row["data_type"] == 'year' ) 
    {
        $string .= "
        if( !empty(\$this->input->post('" . $row['column_name'] ."_start')) )
        {
            \$where[] = \" " .$row['column_name']." >= '\". \$this->input->post('" . $row['column_name'] ."_start') . \"'\";
        }
        if( !empty(\$this->input->post('" . $row['column_name'] ."_end')) )
        {
            \$where[] = \" " .$row['column_name']." <= '\". \$this->input->post('" . $row['column_name'] ."_end') . \"'\";
        }";
    }
    else if ($row['r_table'])
    {
        $string .= "
        if( !empty(\$this->input->post('" . $row['column_name'] ."')) )
        {
            \$where[] = \" " .$row['column_name']." = \". \$this->input->post('" . $row['column_name'] ."');
        }";
    }
    else
    {
        $string .= "
        if( !empty(\$this->input->post('" . $row['column_name'] ."')) )
        {
            \$where[] = \" LOWER(" .$row['column_name']. ") LIKE '%\".strtolower(\$this->input->post('" . $row['column_name'] ."')).\"%'\";
        }";
    }
}    

$string .= "

        \$q .= \"";
foreach ($reference as $row) {
    $string .= "
    \t\tLEFT JOIN ".$row['r_table_ori']." ON ".$row['column_name']." = ".$row['r_column']."";
}
$string.=" \";";

$string.="

        if ( count(\$where) > 0 ) 
        {
            \$where = implode(' AND ', \$where);
            \$q .= \" WHERE \$where\"; 
        }

        \$result['total_rows'] = \$this->db->query(\$q)->num_rows();

        if (\$order)
        {
            \$q .= \" ORDER BY \". \$dataOrder[\$order[0]['column']] .\" \". \$order[0]['dir'];
        }
        else
        {
            \$q .= \" ORDER BY created_at DESC \";
        }

        \$q .= \" LIMIT \$start , \$length \";

        \$result['rows'] = \$this->db->query(\$q)->result();

        return \$result;
    }

}

/* End of file $m_file */
/* Location: ./application/models/$m_file */";




$hasil_model = createFile($string, $target."models/" . $m_file);

?>