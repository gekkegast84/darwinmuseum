<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class incident extends CI_Controller {
  function __construct() {
    parent::__construct();
    session_start();
    $this->load->model('incidentmodel', '', TRUE);
    //check of gebruiker is ingelogd
    if(!$this->session->userdata('logged_in')){
      $this->session->set_flashdata('flashWarning', 'U Heeft geen toegang tot deze pagina.');
      redirect('login');
    }
    elseif($this->session->userdata['logged_in']['roles'] !== '9' ){
      $this->session->set_flashdata('flashWarning', 'U Heeft geen toegang tot deze pagina.');
      redirect('home');
    }
  }
  
  function index(){
    $this->load->helper(array('form'));

    $incidents = $this->incidentmodel->getIncident();
    foreach ($incidents as $incident) {
      $involved[] = $this->incidentmodel->giveInvolved($incident->id);
      $data['involved'] = $involved;
    }
    $allUsers = $this->incidentmodel->getUser();

    $data['incidents'] = $incidents;
    
    $data['allUsers'] = $allUsers;

    $data['main_content'] = 'incidentView';
    $this->load->view('template', $data);
  }

  function reportIncident(){
    if(isset($_POST)){
      if(!empty($_POST)){
        $incident = $_POST;
        $id = $this->incidentmodel->reportIncident($incident);
        $this->incidentmodel->insertInvolved($incident, $id);

        $this->session->set_flashdata('flashSucces', 'Incident succesvol gemeld.');
        redirect('incident');        
      }
    }
  }

  function giveEmergency($param){
    foreach ($param as $key => $value) {
      $emergency[] = $this->incidentmodel->getId($value->involved_id);
    }
    return $emergency;
  }
}

?>