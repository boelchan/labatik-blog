<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{


    public function index()
    {
        $this->title = 'Dashboard';
        $data['total_artikel'] = $this->db->where('status', 'publish')->count_all_results('blog_post');
        $this->template('welcome_message', $data);
    }
    public function laporan()
    {
        $this->load->library('livedjasperreport');

        try {
            $this->livedjasperreport->createReport("", "spm-permohonan", "PDF-STREAM", "id_musren_kgtn=3161901289355494&idopd=10101&idbidang=&SUBREPORT_DIR=D:\WWW\7\htdocs\simral\lived/jasper/musren/");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $this->livedjasperreport->showReport();
        $this->livedjasperreport->closeConnection();
    }
}
