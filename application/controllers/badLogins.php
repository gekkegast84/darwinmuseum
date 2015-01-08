<?php
class badLogins extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->helper('form_helper');
    $this->load->model('loginmodel', '', TRUE);
    if(!$this->session->userdata('logged_in')){
      $this->session->set_flashdata('flashWarning', 'U Heeft geen toegang tot deze pagina.');
      redirect('login');
      if($login['roles'] != "1"){
        $this->session->set_flashdata('flashWarning', 'U Heeft geen toegang tot deze pagina.');
        redirect('login');
      }
    }
  }

  function index(){
    $data['main_content'] = 'badLoginsView';
    $data['all'] = $this->loginmodel->getErrors();
    $data['blocked'] = $this->loginmodel->getBlocked();
    $this->load->view('template', $data);
  }

  function unblock($id){
    $this->loginmodel->unblock($id);
  }
}
?>