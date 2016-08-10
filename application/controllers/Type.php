<?php
class Type extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('answer_model');
	}
	public function index()
	{
		$data['type'] = $this->Type_Model->get_last_ten_type();
		$this->load->view('type', $data);
	}
}