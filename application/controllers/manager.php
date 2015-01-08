<?php
class manager extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->helper('form_helper');
    $this->load->model('managerModel', '', TRUE);
    if(!$this->session->userdata('logged_in')){
      $this->session->set_flashdata('flashWarning', 'U Heeft geen toegang tot deze pagina.');
      redirect('Login');
      if($login['roles'] != "6"){
        $this->session->set_flashdata('flashWarning', 'U Heeft geen toegang tot deze pagina.');
        redirect('Login');
      }
    }
  }

  function index(){
    if(isset($_POST['time'])){
      $time = $_POST['time'];
    }else{$time = 'day';}
    $data['getUser'] = $this->managerModel->getUsers($time);
    $user = $this->managerModel->getUsers($time);

    foreach ($user as $users) {
       $getUserName = $this->managerModel->getNameById($users->user_id);
       $data['getUserName'][] = $getUserName;
    }

    
    $data['dayCount'] = $this->managerModel->getDayUsers(); 
    $data['count'] = $this->getUserCount();

    $data['main_content'] = 'managerView';
    $this->load->view('template', $data);
   
  }

  function getUserCount(){  
    return $this->managerModel->getUserCount();
  }

  function getAverageAge(){
    $age = $this->managerModel->getAge();
  }
  
  function toExcel(){
    $info = $this->managerModel->managerExcel();
    $array = json_decode( json_encode($info), true);
    $fp = fopen('manageroverzicht.csv', 'w');
    while ( !feof($f) ){
      foreach ($array as $value) {
        fputcsv($fp, $value);
      }
    }
    fclose($fp);
    print_r(fgetcsv($fp));
  }
}
?>