<?php
class Main_controller extends CI_Controller {
    // 생성자, 해당 모델이 생성될때 항상 실행되는 초기화작업
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('data_model');
		$this->load->helper('url');
	}

	// 컨트롤러에 별다른 요청이 없는 경우 제공되는 인덱스 페이지
	function index(){
		$data['action'] = site_url("form_receiver/search");
		$data['link_to_insert'] = site_url("form_receiver/insert");
	    $this->load->view('templates/header');
		$this->load->view('main/index', $data);
		$this->load->view('templates/footer');
	}
}

?>