<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller
{
    public $data = array();
    public $res = array();
    public $jwt;
    public $areaUrl;
    public $title;
    public $read = true;
    public $create = true;
    public $edit = true;
    public $destroy = true;
    public $group_id;
    public $is_admin = false;
    public $is_operator = false;
    public $is_pelanggan = false;
    public $loged_in = false;

    protected $middlewares = array();

    public function __construct($cek_auth = true)
    {
        parent::__construct();
        $this->load->model(
            array(
                'ion_auth_model',
                'usersModel',
                'groupsModel',
                // 'usersGroupsModel',
                // 'userGroupAccessModel'
            )
        );

        $this->load->library(['ion_auth']);

        $this->ion_auth->logged_in();

        if ($cek_auth) {
            $this->_run_middlewares($cek_auth);
        }


    }

    protected function _run_middlewares($cek_auth)
    {

        $valid_auth = false;

        $without_login = array('auth');
        if (in_array($this->router->class, $without_login)) {
            $valid_auth = true;
        } else {
            // return true;
            $cookie_token = $this->session->userdata($this->config->item('jwt_key'));
        

            // $cookie_token = get_cookie('authorization');
            // echo $cookie_token;

            if ($cookie_token ) {
                if ($this->jwt = JWT::decode($cookie_token, $this->config->item('jwt_key'))) {
                    if ($this->jwt->ion_auth_session_hash == $this->config->item('session_hash', 'ion_auth')) {
                        if ($this->data['user'] = $this->ion_auth->user($this->jwt->user_id)->row()) {
                            // var_dump($this->data['user']);exit();
                            $valid_auth = true;
                            $this->data['user']->logged_in = true;
                            $this->group_id = $this->ion_auth->get_users_groups($this->jwt->user_id)->row()->id;
                            if ( $this->group_id == 1 ) $this->is_admin = true;
                            if ( $this->group_id == 2 ) $this->is_operator = true;
                            if ( $this->group_id == 10 ) $this->is_pelanggan = true;

                            // $this->check_new_token();
                        } else {
                            show_error('Oooops! something wrong');
                        }
                    }
                }
            } else {
                redirect('auth/login', 'refresh');
            }

        }

        if (!$valid_auth) {
            
            if ($this->input->is_ajax_request()) {
                $response['success'] = false;
                $response['message'] = 'Unauthorized';
                $this->output->set_content_type('application/json')->set_output(json_encode($response));
            } else {
                redirect('auth/login', 'refresh');
            }
        }
    }


    public function notif($tipe='', $link, $pesan)
    {
        $data = array(
            'id_pemberitahuan' => get_id(),
            'tipe'             => $tipe,
            'pesan'            => $pesan,
            'link'             => $link,
            'read'             => 'tidak'
        );
        $this->tPemberitahuanModel->insert($data);
    }

    public function check_new_token()
    {
        // $time_limit = strtotime('+1 hour');
        // if ( time() < $this->jwt->exp && $this->jwt->exp < $time_limit)
        // {
        $data = array(
            'user_id'        => $this->jwt->user_id,
            // 'old_last_login' => $this->jwt->old_last_login,
            'last_check'     => $this->jwt->last_check,
            // 'exp'            => strtotime('+10 hour'),
        );
        $token = JWT::encode($data, $this->config->item('jwt_key'));
        $this->session->set_userdata($this->config->item('jwt_key'), $token);
        // }
    }

    public function cek_create()
    {
        if ( $this->create ) {
            return true;
        } else {
            // $this->ion_auth->logout();
            redirect('dashboard', 'refresh');
        }
    }

    public function cek_edit()
    {
        if ( $this->edit ) {
            return true;
        } else {
            // $this->ion_auth->logout();
            redirect('dashboard', 'refresh');
        }
    }

    public function cek_destroy()
    {
        if ( $this->destroy ) {
            return true;
        } else {
            // $this->ion_auth->logout();
            redirect('dashboard', 'refresh');
        }
    }

    public function cek_read()
    {
        if ( $this->read ) {
            return true;
        } else {
            // $this->ion_auth->logout();
            redirect('dashboard', 'refresh');
        }
    }

    public function cekGroup($groups)
    {
        if ( !is_array( $groups ) ) $groups = array($groups ); 
        if ( in_array($this->group_id, $groups) ) {
            return true;
        } else {
            $this->ion_auth->logout();
            redirect('auth/login', 'refresh');
        }
    }

    public function json_output($arr)
    {
        if (isset($arr['token'])) {
            $arr['token'] = $this->jwt;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function template($view_file, $local_data = null)
    {

        if ($local_data != null) {
            $this->data = array_merge($this->data, $local_data);
        }
        if ($view_file) {
            $this->data['page_content'] = $this->load->view($view_file, $this->data, true);
        }
        if ($this->input->post('modal')) {
            $this->load->view('template/v_modal_main', $this->data);
        } else {
            $this->load->view('template/v_bo_template', $this->data);
        }
    }

    public function foTemplate($view_file, $local_data = null)
    {
        if ($local_data != null) {
            $this->data = array_merge($this->data, $local_data);
        }
        if ($view_file) {
            $this->data['page_content'] = $this->load->view($view_file, $this->data, true);
        }
        $this->load->view('front/main', $this->data);
    }

    public function template_blank($view_file, $local_data = null)
    {
        if ($local_data != null) {
            $this->data = array_merge($this->data, $local_data);
        }
        if ($view_file) {
            $this->data['page_content'] = $this->load->view($view_file, $this->data, true);
        }
        $this->load->view('template/v_blank_template', $this->data);
    }

    public function check_date_format($str)
    {
        if (!DateTime::createFromFormat('d-m-Y', $str)) //yes it's YYYY-MM-DD
        {
            $this->form_validation->set_message('check_date_format', 'Format harus benar');
            return false;
        } else {
            return true;
        }
    }

    public function format_uang($numeric = 0)
    {
        return (is_numeric($numeric)) ? number_format($numeric, 0, ',', '.') : ' ';
    }

    public function _upload($targetPath = "")
    {
        $this->load->helper('security');

        if (empty($targetPath)) {
            $targetPath = "uploads/temp";
        }
        $config['upload_path'] = "./" . $targetPath;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['overwrite'] = true;
        $config['file_name'] = do_hash(date("Y/m/d h:i:sa"));

        $this->load->model('m_public_function');
        $response = $this->m_public_function->upload($config);

        return $response;
    }

    // public function load_img($file='')
    // {
    //     if (empty($file)) {
    //         return "data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==";
    //     }else{
    //         $filename = './'.$file;
    //
    //         if (is_file($filename)  && file_exists($filename) ) {
    //             return base_url($file);
    //         } else {
    //             return "data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==";
    //         }
    //     }
    // }

    protected function _encryptIt($q)
    {
        $cryptKey = 'bjtm!@123';
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return ($qEncoded);
    }

    protected function _decryptIt($q)
    {
        $cryptKey = 'bjtm!@123';
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return ($qDecoded);
    }

}

class FrontendController extends MY_Controller
{
    public $page_c;
    public $kategori_opt;

    public function __construct()
    {
        parent::__construct(false);

        $this->page_c['telepon']   = $this->db->where('page', 'telepon')->get('page')->row()->content;
        $this->page_c['wa']        = $this->db->where('page', 'wa')->get('page')->row()->content;
        $this->page_c['facebook']  = $this->db->where('page', 'facebook')->get('page')->row()->content;
        $this->page_c['instagram'] = $this->db->where('page', 'instagram')->get('page')->row()->content;
        $this->page_c['youtube']   = $this->db->where('page', 'youtube')->get('page')->row()->content;



        $cookie_token = $this->session->userdata($this->config->item('jwt_key'));
        if ($cookie_token) {
            $this->jwt = JWT::decode($cookie_token, $this->config->item('jwt_key'));
            $this->group_id = $this->ion_auth->get_users_groups($this->jwt->user_id)->row()->id;
            if ( $this->group_id == 10 ) $this->is_pelanggan = true;
            
        }

    }
}

class MemberController extends MY_Controller
{
    public $page_c;
    public $kategori_opt;

    public function __construct()
    {
        parent::__construct();

        $this->load->model( 'kategoriModel' );
        
        $this->page_c['telepon']   = $this->db->where('page', 'telepon')->get('page')->row()->content;
        $this->page_c['wa']        = $this->db->where('page', 'wa')->get('page')->row()->content;
        $this->page_c['facebook']  = $this->db->where('page', 'facebook')->get('page')->row()->content;
        $this->page_c['instagram'] = $this->db->where('page', 'instagram')->get('page')->row()->content;
        $this->page_c['youtube']   = $this->db->where('page', 'youtube')->get('page')->row()->content;


        $this->kategori_opt = $this->kategoriModel->get_all();


        $this->cekGroup(10);
    }
}

class AdminController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->cekGroup([1,2]);
    }
}
