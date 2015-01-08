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

    $j = count($this->incidentmodel->getIncident());
    for ($i=0; $i < $j; $i++){ 
      $involved = $this->incidentmodel->getId($j);
      $data['involved'] = $involved;
    }

    $data['user'] = $this->giveUsers;
    $data['emergency'] = $this->giveEmergency($data['user']->involved_id);
    $data['allUsers'] = $this->incidentmodel->getUser();
    $data['incidents'] = $this->incidentmodel->getIncident();

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

  function giveUsers(){
    $i = 0;
    foreach ($involved as $key => $value) {
      $users[$i] = $this->incidentmodel->getNameById($value->involved_id)[0];
      $i++;
    }
  }

  function giveEmergency($param){
    foreach ($involved as $key => $value) {
      return $emergency[$param] = $this->incidentmodel->getId($value->involved_id)[0];
    }
  }
}

?>