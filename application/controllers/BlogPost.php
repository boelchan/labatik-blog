<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class BlogPost extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'BlogPost';
        $this->areaUrl = site_url('blogPost/');
        
        $this->load->model([
            'blogPostModel',
			'blogKategoriModel'
        ]);
    }

    public function index()
    {
        $this->template('BlogPost/vList');
    }

    public function getDatatable()
    {
        $customActionName = $this->input->post('customActionName');
        $records          = array();

        if ($customActionName == "destroy") 
        {
            $records=$this->destroy();
        }

        $records["data"] = array();

        $t = $this->blogPostModel->getData();
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id_post;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $checkbox,
                    '<a href="'. load_image("blog_post_banner/".$d->banner_img) .'" target="_blank">
                        <img style="max-width: 50px; max-height: 50px;" src="'. load_image("blog_post_banner/".$d->banner_img, "thumb") .'"  title="Klik untuk perbesar gambar" alt="image"> </a>',
					btnRead($id, $d->judul),
					$d->status,
                    btnEditTable($id)
                );
            }
        }
        $records["draw"]            = $t['draw'];
        $records["recordsTotal"]    = $t['total_rows'];
        $records["recordsFiltered"] = $t['total_rows'];

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function read($id=null)
    {
        $row = $this->blogPostModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $this->template('BlogPost/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        $data['action']       = $this->areaUrl.'store';
        $data['optionStatus'] = array('publish' => 'Publish', 'draft' => 'Draft');
        $this->template('BlogPost/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('judul_seo','judul seo','trim');
        $this->form_validation->set_rules('judul','judul','trim|required');
        $this->form_validation->set_rules('blog_kategori_id','blog kategori id','trim|integer');
        $this->form_validation->set_rules('konten','konten','trim|required');
        $this->form_validation->set_rules('status','status','trim');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'judul_seo' => url($this->input->post('judul')),
                        'judul' => $this->input->post('judul'),
                        'blog_kategori_id' => $this->input->post('blog_kategori_id'),
                        'konten' => $this->input->post('konten'),
                        'status' => $this->input->post('status'),
                        'status_date' => date('Y-m-d'),
                    );
            if (!empty($_FILES['image']['name']) ) 
            {
                $this->load->model('m_public_function');
                $upload_result = $this->m_public_function->doupload('blog_post_banner');
                if ($upload_result['success']) 
                {
                    $data['banner_img'] = $upload_result['data']['file_name'];
                } 
                else 
                {
                    $data['banner_img'] = '';
                    $res['message'] = $upload_result['message'];
                }
            }
        
            if ($this->blogPostModel->insert($data))
            {
                $res['url']     = $this->areaUrl;
                $res['success'] = true;
                $res['message'] = 'Tambah data berhasil';
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }


    public function edit($id = 0)
    {
        $data['action']       = $this->areaUrl.'update';
        $data['optionStatus'] = array('publish' => 'Publish', 'draft' => 'Draft');
        $row = $this->blogPostModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id_post'] = $row->id_post;
            $this->template('BlogPost/vEdit',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }   

    public function update()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';

        $id = $this->input->post('id_post');
        $this->form_validation->set_rules('id_post','id post','required');
        $this->form_validation->set_rules('judul_seo','judul seo','trim');
        $this->form_validation->set_rules('judul','judul','trim|required');
        $this->form_validation->set_rules('blog_kategori_id','blog kategori id','trim|integer');
        $this->form_validation->set_rules('konten','konten','trim|required');
        $this->form_validation->set_rules('status','status','trim');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'judul_seo' => url($this->input->post('judul')),
                        'judul' => $this->input->post('judul'),
                        'blog_kategori_id' => $this->input->post('blog_kategori_id'),
                        'konten' => $this->input->post('konten'),
                        'status' => $this->input->post('status'),
                        'status_date' => date('Y-m-d'),
                    );

            if (!empty($_FILES['image']['name']) ) 
            {
                $this->load->model('m_public_function');
                $upload_result = $this->m_public_function->doupload('blog_post_banner');
                if ($upload_result['success']) 
                {
                    $data['banner_img'] = $upload_result['data']['file_name'];
                }
                else 
                {
                    $data['banner_img'] = '';
                    $res['message'] = $upload_result['message'];
                }
            }
        
            $row = $this->blogPostModel->get($id);
            if ($row) 
            {
                if ($this->blogPostModel->update($data, $id))
                {
                    if (!empty($_FILES['image']['name']) ) delete_image('blog_post_banner/'.$row->banner_img);
                    
                    $res['url']     = $this->areaUrl;
                    $res['success'] = true;
                    $res['message'] = 'Ubah data berhasil';
                }
            } 
            else 
            {
                $res['success'] = false;
                $res['message'] = 'Data tidak ditemukan';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    } 


    public function destroy()
    {
        $ids = $this->input->post('id[]');
        foreach ($ids as $id) 
        {
            $row = $this->blogPostModel->get($id);

            if ($row) {
                $this->blogPostModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file BlogPost.php */
/* Location: ./application/controllers/BlogPost.php */