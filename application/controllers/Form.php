<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function index()
	{

	}

	public function dd($m='')
	{

		$this->load->model($m);
		$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 30 ;
		$page   = ($this->input->get('page')) ? $this->input->get('page') : 1 ;
		$page	= $page - 1;
		if ($this->input->get('q')) {
			$this->db->like($this->$m->label, $this->input->get('q'));
		}
		$this->db->limit($limit,($page*$limit));
		$data_db =$this->{$m}->order_by('created_at', 'desc')->get_all();
		$res     =array();
		if ($data_db) {
			foreach ($data_db as $r) {
				$item=array();
				$item['id']    = $r->{$this->$m->primary_key};
				$item['title'] = $r->{$this->$m->label};
				$res[] = $item;
			}
		}
		$output["items"]=$res;
		$output["total_count"]=$this->{$m}->count_rows();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}


	// summernote

	//Upload image summernote
	function upload_img_summernote(){
        $this->load->helper('security');

		if(isset($_FILES["image"]["name"])){
			$config['upload_path'] = './uploads/summernote/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size']      = '3000';
			// $config['file_name']     = do_hash(date("Y/m/d h:i:sa"));

			$this->load->library('upload', $config);
	
			if(!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'],0775,true);
			}
			
			// $this->upload->initialize($config);
			if(!$this->upload->do_upload('image')){
				$this->upload->display_errors();
				return FALSE;
			}else{
				$data = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./uploads/summernote/'.$data['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= TRUE;	
				$config['quality']= '80%';
				$config['width']= 800;
				$config['height']= 800;
				$config['new_image']= './uploads/summernote/'.$data['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				echo base_url().'uploads/summernote/'.$data['file_name'];
			}
		}
	}

	//Delete image summernote
	function delete_img_summernote(){
		$src = $this->input->post('src');
		$file_name = str_replace(base_url(), '', $src);
		if(unlink($file_name))
		{
			echo 'File Delete Successfully';
		}
	}

}

/* End of file Form.php */
/* Location: ./application/controllers/Form.php */
