<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class contact extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['main_content'] = 'contactView';     
		$this->load->view('template', $data);
	}
}

?>

