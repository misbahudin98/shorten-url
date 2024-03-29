<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('status') != "login") {
			redirect('masuk');
		}
		
		$this->load->model('Model_user');
		
		date_default_timezone_set("Asia/Bangkok");//		
	}

	public function index()
	{
		$this->load->view('s');	
	}

	public function pagination()
	{
		$this->load->library('Pagination');
		
		$config['per_page']	= 7;
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
        
        
        return $config;
	}

	public function profile(){
	 	$where = array('id' => $this->session->userdata('id'));
	  	$data['user'] = 
	  		$this->Model_user->check($where,"user")->result();
		
		$this->load->view('admin_panel/header',$data);
	 	$this->load->view('admin_panel/side_bar',$data);
	 	$this->load->view('profile/show',$data);
	 	$this->load->view('admin_panel/footer',$data);
	 }

	public function edit_profile(){
		$where = array('id' => $this->session->userdata('id'));
		$data['user'] = 
			$this->Model_user->check($where,'user')->result();
		
		$this->load->view('admin_panel/header', $data, FALSE);
		$this->load->view('admin_panel/side_bar', $data, FALSE);
		$this->load->view('profile/edit',$data);
		$this->load->view('admin_panel/footer', $data, FALSE);
	}

	public function update_profile(){
		$id = $this->session->userdata('id');	
		$where = array('id' => $id);
		$data=$this->Model_user->check($where,'user')->row_array();
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		if (md5($this->input->post('password')) == $data['password'] ||
			empty(md5($this->input->post['password']))) {
			$password =  md5($this->input->post('password'));			
		} else {$password = $data['password'];}

		$email = $this->input->post('email');
		if ((!stristr($email,"@") OR !stristr($email,"."))){
 			redirect('profil');
 		}

		$updatedAt	 = date('Y-m-d G:i:s');;
		$data = array(
			'nama' => $nama,
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'updatedAt' => $updatedAt
			);
		

		$where_username = array('username '=> $username);
		$user = $this->Model_user->unique_check( $where_username,"user");
		$self = $this->Model_user->check( $where_username,"user")->row_array();

		if ($user == 0 || $username == $self['username']){
			$this->Model_user->update_data($where,$data,'user');
		}
	
		redirect('profil');
	}

	public function show_url()
	{

		$where = array('id_user' => $this->session->userdata('id'));
 	   	$count = $this->Model_user->count_where($where,'url');
		
		$config = $this->pagination();
		$config['base_url'] = base_url('url');
	
		$config['total_rows'] = $count;
		$this->pagination->initialize($config);
	
		$data['from'] = $this->uri->segment(2);

 		$data['user'] =  	
		$this->Model_user->get_limit($config['per_page'],$data['from'],$where,"url")->result();
	
		if($this->session->userdata('is') == "admin"){
			$data['user'] =
			$this->db->get('url',$config['per_page'],$data['from'])->result();
		}

		$this->load->view('admin_panel/header', $data, FALSE);
		$this->load->view('admin_panel/side_bar', $data, FALSE);
		$this->load->view('url/show', $data, FALSE);
		$this->load->view('admin_panel/footer', $data, FALSE);
	}

	public function get_data_url()
	{
		$this->load->view('admin_panel/header');
		$this->load->view('admin_panel/side_bar');
		$this->load->view('url/input');
		$this->load->view('admin_panel/footer');
	} 

	
	function random_string($length = 10) 
	{
   		$random=  substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

   		$check=$this->Model_user->unique_check(['short_url'=>$random],'url'); 	
   	
   			if ($check >0)
   				return $this->random_string();
   			else 
   				return $random;
   	}
	

	function add_url(){
		$url = $this->input->post('url');
		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			redirect('tambah_url');
		}

		$id_user = $this->session->userdata('id');
		$short = $this->random_string();
		$url = $this->input->post('url');
		$updatedAt	 = date('Y-m-d G:i:s');
		$data = array(
			'id_user' => $id_user,
			'short_url' =>$short,
			'url' => $url,
			'updatedAt' => $updatedAt
		);

		$this->Model_user->input_data($data,'url');
		redirect('url');
	}


	
	function delete_url($id){
		$where = array('id' => $id);
		$this->Model_user->delete_data($where,'url');
		redirect('url');
	}	

	function edit_url($id){
		$where = array('id' => $id);
		$data['user'] = 
			$this->Model_user->check($where,'url')->result();
		
		$this->load->view('admin_panel/header', $data, FALSE);
		$this->load->view('admin_panel/side_bar', $data, FALSE);
		$this->load->view('url/edit',$data);
		$this->load->view('admin_panel/footer', $data, FALSE);
	}

	function update_url(){
		$id = $this->input->post('id');
		$id_user = $this->session->userdata('id');
		$short_url =$this->input->post('short_url');
		$updatedAt	 = date('Y-m-d G:i:s');
		$hit = intval($this->input->post('hit'));
		
		$data = array(
			'id_user' => $id_user,
			'short_url' => $short_url,
			'hit' => $hit,
			'updatedAt'=> $updatedAt,	             
		);		
		$where = array('id' => $id);

		$this->form_validation->set_rules('short_url','Short Url','required|min_length[3]|max_length[25]|is_unique[url.short_url]');
 
		if ($this->form_validation->run() != false) 
		$this->Model_user->update_data($where,$data,'url');

		redirect('url');
	}


	public function dashboard_user(){
		$data['url']=$this->Model_user->count_url();
		$id = $this->session->userdata('id');
		$data['most_visited'] = $this->Model_user->count_max();
		$data['most_visited_mine']=$this->Model_user->count_max_user($id);

		$dataUrl = $this->Model_user->check(['id_user'=> $this->session->userdata('id')],'url')->result();
			$chartLabel = [];
			$chartValue = [];

		foreach($dataUrl as $row) {
			array_push($chartLabel, $row->short_url);
			array_push($chartValue, $row->hit);
		}

		$data['chartLabel'] = json_encode($chartLabel);
		$data['chartValue'] = json_encode($chartValue);
		
		$this->load->view('admin_panel/header',$data);
		$this->load->view('admin_panel/side_bar',$data);
		$this->load->view('admin_panel/user_dashboard',$data);
		
	}
	

}