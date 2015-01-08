<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class home extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['main_content'] = 'homeView';     
		$this->load->view('template', $data);
	}

	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}
}
?>

