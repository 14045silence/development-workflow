<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{		
		echo "Home";
	}
	function submit(){
		if ($this->input("email")) {
			$data['email']=$this->input('email');
			$this->user->insert_normal();
			$this->sendmailnored('Selamat datang di Arkana','Selamat datang di Arkana', $data['email'], 'Sukses coba');
			echo json_encode($data);
		}
		else{
			redirect(base_url());
		}
	}
}
