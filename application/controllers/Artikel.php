<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends FrontendController
{
    function __construct()
    {
        parent::__construct();
        $this->title   = 'Blog';
        $this->areaUrl = site_url('artikel/');
        $this->load->library('pagination');

        $this->load->model([
            'blogPostModel'
        ]);
    }

    public function index()
    {
        $s = $this->input->get('s');
        
        $where = array('status' => 'publish');
        $data['populer'] = $this->blogPostModel->where($where)->order_by('status_date', 'DESC')->limit(6)->get_all();
        if ($s) $where['LOWER(judul) LIKE '] = "%".strtolower($s)."%";
        

        //konfigurasi pagination
        $config['base_url']             = site_url('artikel'); //site url
        $config['total_rows']           = $this->db->where($where)->count_all_results('blog_post'); //total row
        $config['per_page']             = 6;  //show record per halaman
        $config["uri_segment"]          = 2;  // uri parameter
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = floor($choice);
        $config["use_page_numbers"]     = TRUE;
        $config["page_query_string"]    = TRUE;
        $config["reuse_query_string"]   = TRUE;
        $config['query_string_segment'] = 'page';


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $page = ($this->input->get('page')) ? $this->input->get('page') - 1 : 0;
        $data['page'] = $page * $config['per_page'];

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['artikel'] = $this->blogPostModel
                                ->where($where)
                                ->order_by('status_date', 'DESC')
                                ->limit($config["per_page"],  $data['page'])
                                ->get_all();
 
        $data['pagination'] = $this->pagination->create_links();

        $this->foTemplate('front/vHome', $data);
    }

    public function read($judul)
    {
        $data['terbaru'] = $this->blogPostModel->where('status', 'publish')->order_by('status_date', 'DESC')->limit(5)->get_all();
        $data['populer'] = $this->blogPostModel->where('status', 'publish')->order_by('status_date', 'DESC')->limit(6)->get_all();

        $data['artikel'] = $this->blogPostModel->where('status', 'publish')->where('judul_seo', $judul)->get();
        if ($data['artikel']) {
            $this->foTemplate('front/vRead', $data);
        } else {
            show_error('Artikel yg anda cari tidak ada');
        }
        
    }

    public function page($tipe= '')
    {
        $data['populer'] = $this->blogPostModel->where('status', 'publish')->order_by('status_date', 'DESC')->limit(6)->get_all();
        $data['no_wa'] = $this->db->where('page', 'wa')->get('page')->row()->link;
        $data['about'] = $this->db->where('page', 'about')->get('page')->row()->link;
        
        
        if ( $tipe == 'about' )
        {
            $this->title   = 'About us';
            
            $this->foTemplate('front/vAbout', $data);            
        }
        if ( $tipe == 'contact' )
        {
            $this->title   = 'Contact us';

            $this->foTemplate('front/vContact', $data);            
        }
        
    }


    
    
}