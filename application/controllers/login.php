<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class login extends CI_Controller {
  function __construct() {
    parent::__construct();
    session_start();
    //check of gebruiker is ingelogd
    if ($this->session->userdata('logged_in')){
      redirect('home');
    }
  }

  function index(){
    $this->load->helper(array('form'));
    $data['main_content'] = 'loginView';
    $this->load->view('template', $data);
  }
}

?>