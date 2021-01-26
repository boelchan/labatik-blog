<?php
$m = lcfirst($m);
$string = "<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class " . $c . " extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        \$this->title   = '". $c ."';
        \$this->areaUrl = site_url('". lcfirst($c) ."/');
        ";
$string .="
        \$this->load->model([
            '$m'";
            foreach ($reference as $refer) {
                $string .= ','."\n\t\t\t". '\''.lcfirst($refer["r_model"]).'\'';
            }
$string .="
        ]);";
$string .="
    }";

if ($jenis_tabel == 'reguler_table') {

$string .= "\n\n    public function index()
    {
        \$q = urldecode(\$this->input->get('q'));
        \$start = intval(\$this->input->get('start'));

        if (\$q <> '') {
            \$config['base_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . '$c_url/index.html';
            \$config['first_url'] = base_url() . '$c_url/index.html';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$this->template('$c_url/$v_list', \$data);
    }";

} else {

$string .="\n\n    public function index()
    {
        \$this->template('$c_url/$v_list');
    }";

}
$string .="\n\n    public function getDatatable()
    {
        \$customActionName = \$this->input->post('customActionName');
        \$records          = array();

        if (\$customActionName == \"destroy\") 
        {
            \$records=\$this->destroy();
        }

        \$records[\"data\"] = array();

        \$t = \$this->" . $m . "->getData();
        \$i = \$this->input->get_post('length') + 1;

        if ( \$t['rows'] ) 
        {
            foreach (\$t['rows'] as \$d) 
            {
                \$id = \$d->$pk;

                \$checkbox = '<label class=\"mt-checkbox mt-checkbox-single mt-checkbox-outline\"> <input type=\"checkbox\" class=\"checkboxes\" name=\"id[]\" value=\"'.\$id.'\" /> <span></span> </label>';

                \$records[\"data\"][] = array(
                    \$checkbox,";
                $ipk = 0;
                foreach ($non_pk as $row) {
                    if($row['r_table'] ) {
                        $str = "\$d->{\$this->". lcfirst($row["r_table"]) ."Model->label}";
                    }elseif ($row["img"] ) {
                        $str = "'<a href=\"'. load_image(\"".$table_name.'_'.str_replace('_img','',$row["column_name"])."/\".\$d->" . $row["column_name"] . ") .'\" target=\"_blank\">
                        <img style=\"max-width: 50px; max-height: 50px;\" src=\"'. load_image(\"".$table_name.'_'.str_replace('_img','',$row["column_name"])."/\".\$d->" . $row["column_name"] . ", \"thumb\") .'\"  title=\"Klik untuk perbesar gambar\" alt=\"image\"> </a>'";
                    }else{
                        $str = "\$d->". $row['column_name'];
                    }

                    if ($ipk == 0) {
                        $str = "btnRead(\$id, $str)";
                    }
                    $string .= "\n\t\t\t\t\t".$str.",";
                    $ipk++;
                }
                $string .= "
                    btnEditTable(\$id)
                );
            }
        }
        \$records[\"draw\"]            = \$t['draw'];
        \$records[\"recordsTotal\"]    = \$t['total_rows'];
        \$records[\"recordsFiltered\"] = \$t['total_rows'];

        \$this->output->set_content_type('application/json')->set_output(json_encode(\$records));
    }

    public function read(\$id=null)
    {
        \$row = \$this->".$m."->get(\$id);

        if (\$row) 
        {
            \$data['row'] = \$row;
            \$this->template('$c_url/$v_read',\$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        \$data['action']    = \$this->areaUrl.'store';
        \$this->template('$c_url/$v_create',\$data);
    }

    public function store()
    {
        \$res['success'] = false;
        \$res['message'] = 'Simpan data gagal';
        ";
        // $this->form_validation->set_rules('tgl', 'tgl', "trim|callback_check_date_format");
foreach ($non_pk as $row) {
    $validation_arr=array();
    $validation_arr[]='trim';
    if ($row['is_nullable'] != "YES") {
        $validation_arr[]='required';
    }
    if ($row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal') {
        $validation_arr[]='integer';
    }
    if ($row['data_type'] == "date") {
        $validation_arr[]='callback_check_date_format';
        if ($row['is_nullable'] == "YES") {
            $string .= "\n\t\tif(!empty(\$this->input->post('".$row['column_name'] ."')))";
        }
    }
    if (!empty($row['validation'])) {
        $validation_arr[]=$row['validation'];
    }

    $string .= "
        \$this->form_validation->set_rules('" . $row['column_name'] . "','" . str_replace('_', ' ', $row['column_name']) . "','".implode("|",$validation_arr)."');";
}
$string .= "\n
        if (\$this->form_validation->run() == FALSE) 
        {
            \$res['message'] = 'Lengkapi inputan dengan benar';
            \$res['field_error'] = \$this->form_validation->error_array();
        } 
        else 
        {
            \$data = array(";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'date') {
        $string .= "
                        '" . $row['column_name'] . "' => sys_date(\$this->input->post('" . $row['column_name'] . "')),";
    }elseif(!$row["img"]){
        $string .= "
                        '" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "'),";

    }
}
$string .= "
                    );";
$delete_img = '';
foreach ($non_pk as $row) {
    if ($row["img"]) {
        $string .= "

            if (!empty(\$_FILES['image']['name']) ) 
            {
                \$this->load->model('m_public_function');
                \$upload_result = \$this->m_public_function->doupload('".$table_name."_".str_replace('_img','',$row['column_name'])."');
                if (\$upload_result['success']) 
                {
                    \$data['".$row['column_name']."'] = \$upload_result['data']['file_name'];
                } 
                else 
                {
                    \$data['".$row['column_name']."'] = '';
                    \$res['message'] = \$upload_result['message'];
                }
            }
        ";
        $delete_img = "if (!empty(\$_FILES['image']['name']) ) delete_image('".$table_name."_".str_replace('_img','',$row['column_name'])."/'.\$row->".$row['column_name'].");";

    }
}
$string .= "
            if (\$this->".$m."->insert(\$data))
            {
                \$res['url']     = \$this->areaUrl;
                \$res['success'] = true;
                \$res['message'] = 'Tambah data berhasil';
            }
        }
        
        \$this->output->set_content_type('application/json')->set_output(json_encode(\$res));
    }


    public function edit(\$id = 0)
    {
        \$data['action'] = \$this->areaUrl.'update';
        \$row = \$this->".$m."->get(\$id);

        if (\$row) 
        {
            \$data['row'] = \$row;
            \$data['".$pk."'] = \$row->".$pk.";
            \$this->template('$c_url/$v_edit',\$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }   

    public function update()
    {
        \$res['success'] = false;
        \$res['message'] = 'Simpan data gagal';

        \$id = \$this->input->post('$pk');
        \$this->form_validation->set_rules('" . $pk . "','" . str_replace('_', ' ', $pk) . "','required');";
foreach ($non_pk as $row) {
    $validation_arr=array();
    $validation_arr[]='trim';
    if ($row['is_nullable'] != "YES") {
        $validation_arr[]='required';
    }
    if ($row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal') {
        $validation_arr[]='integer';
    }
    if ($row['data_type'] == "date") {
        $validation_arr[]='callback_check_date_format';
        if ($row['is_nullable'] == "YES") {
            $string .= "\n\t\tif(!empty(\$this->input->post('".$row['column_name'] ."')))";
        }
    }
    if (!empty($row['validation'])) {
        $validation_arr[]=$row['validation'];
    }

    $string .= "
        \$this->form_validation->set_rules('" . $row['column_name'] . "','" . str_replace('_', ' ', $row['column_name']) . "','".implode("|",$validation_arr)."');";
}
$string .= "\n
        if (\$this->form_validation->run() == FALSE) 
        {
            \$res['message'] = 'Lengkapi inputan dengan benar';
            \$res['field_error'] = \$this->form_validation->error_array();
        } 
        else 
        {
            \$data = array(";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'date') {
        $string .= "
                        '" . $row['column_name'] . "' => sys_date(\$this->input->post('" . $row['column_name'] . "')),";
    }elseif(!$row["img"]){
        $string .= "
                        '" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "'),";
    }

}
$string .= "
                    );";
$delete_img = '';
foreach ($non_pk as $row) {
    if ($row["img"]) {
        $string .= "

            if (!empty(\$_FILES['image']['name']) ) 
            {
                \$this->load->model('m_public_function');
                \$upload_result = \$this->m_public_function->doupload('".$table_name."_".str_replace('_img','',$row['column_name'])."');
                if (\$upload_result['success']) 
                {
                    \$data['".$row['column_name']."'] = \$upload_result['data']['file_name'];
                }
                else 
                {
                    \$data['".$row['column_name']."'] = '';
                    \$res['message'] = \$upload_result['message'];
                }
            }
        ";
        $delete_img = "if (!empty(\$_FILES['image']['name']) ) delete_image('".$table_name."_".str_replace('_img','',$row['column_name'])."/'.\$row->".$row['column_name'].");";

    }
}
$string .= "

            \$row = \$this->".$m."->get(\$id);
            if (\$row) 
            {
                if (\$this->".$m."->update(\$data, \$id))
                {
                    ".@$delete_img."
                    \$res['url']     = \$this->areaUrl;
                    \$res['success'] = true;
                    \$res['message'] = 'Ubah data berhasil';
                }
            } 
            else 
            {
                \$res['success'] = false;
                \$res['message'] = 'Data tidak ditemukan';
            }
        }
        \$this->output->set_content_type('application/json')->set_output(json_encode(\$res));
    } 


    public function destroy()
    {
        \$ids = \$this->input->post('id[]');
        foreach (\$ids as \$id) 
        {
            \$row = \$this->".$m."->get(\$id);

            if (\$row) {
                \$this->".$m."->delete(\$id);
            }
        }

        \$result[\"customActionStatus\"]  = \"OK\";
        \$result[\"customActionMessage\"] = \"Hapus data berhasil\";
        
        return \$result;
    }
    ";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        \$col = 'A';
        \$row = 1;
        //load our new PHPExcel library
        \$this->load->library('excel');
        //activate worksheet number 1
        \$this->excel->setActiveSheetIndex(0);
        //name the worksheet
        \$this->excel->getActiveSheet()->setTitle('report worksheet');

        //set style
        \$styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    // 'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        \$this->excel->getActiveSheet()->getDefaultStyle()->applyFromArray(\$styleArray);
        \$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
        \$this->excel->getActiveSheet()->getStyle(\$row)->getFont()->setBold(true);

        //set header column";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "
        \$this->excel->getActiveSheet()->setCellValue(\$col++.\$row, \"$column_name\");";
}
$string .= "

        foreach (range('A', \$col) as \$col_id) {
            \$this->excel->getActiveSheet()->getColumnDimension(\$col_id)->setWidth(20);
        }

        //set data
        foreach (\$this->" . $m . "->get_all() as \$data) {
            \$col = 'A';
            \$row++;
            ";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        if($row["img"] ){
            $string .= "\n
            \$filename = './'.'uploads/temp/'.\$data->object_img;
            if (is_file(\$filename)  && file_exists(\$filename)) {
                \$this->excel->getActiveSheet()->getRowDimension(\$row)->setRowHeight(100);
                \$this->excel->getActiveSheet()->getColumnDimension(\$col)->setWidth(25);

                \$objDrawing = new PHPExcel_Worksheet_Drawing();
                \$objDrawing->setName(\$data->object_img);
                \$objDrawing->setDescription(\$data->object_img);
                \$objDrawing->setPath(\$filename);
                \$objDrawing->setCoordinates(\$col++.\$row);
                //setOffsetX works properly
                \$objDrawing->setOffsetX(5);
                \$objDrawing->setOffsetY(5);
                //set width, height
                \$objDrawing->setWidth(100);
                \$objDrawing->setHeight(100);
                \$objDrawing->setWorksheet(\$this->excel->getActiveSheet());
            }
            ";

        }else{
            $string .= "
            \$this->excel->getActiveSheet()->setCellValue(\$col++.\$row,  \$data->$column_name);";
        }
}
$string .= "
        }
        \$filename='report_$c.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename=\"'.\$filename.'\"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        \$objWriter = PHPExcel_IOFactory::createWriter(\$this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        \$objWriter->save('php://output');
    }";

}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$c_url.doc\");

        \$data = array(
            '" . $c_url . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );

        \$this->load->view('" . $c_url."/".$v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $c_url . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );

        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $c_url."/".$v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $c_url . ".pdf', 'D');
    }";
}

$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */";




$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>
