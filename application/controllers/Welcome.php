<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends FrontendController
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function index()
    {

        $this->load->view('vHome');
    }
    public function register()
    {
        $this->load->view('vRegister');
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
