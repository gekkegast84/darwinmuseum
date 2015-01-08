<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class verifyLogin extends CI_Controller{

function __construct(){
    parent::__construct();
    $this->load->model('loginmodel');
}

 function index(){
    //validatie class van codeigniter
  $this->load->library('form_validation');

  $this->form_validation->set_rules('email', 'Email', 'required');
    //als password voldoet aan check_database class...
  $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_checkDatabase');


  if($this->form_validation->run() == FALSE){
      //validatie FAIL : terug naar loginpage
    $data['main_content'] = 'loginView';
    $this->load->view('template', $data);
  }else{
    if (!empty($this->session->userdata['logged_in'])) {
      $role = $this->session->userdata['logged_in']['roles'];    
      switch ($role) {
        case "1":
        redirect('collection', 'refresh');
        break;
        case "6":
        redirect('manager', 'refresh');
        break;
        case "9":
        redirect('ticket', 'refresh');
        break;
      }
    }
  }
}

function checkDatabase($email, $password){
  $this->load->library('phpass');
  $email = $this->input->post('email');
  $password = $this->input->post('password');

  $info = array(
    "email" => $email,
    "password" => $password
  );

    //query de database
  $result = $this->loginmodel->login($email);
  $blocked = $this->loginmodel->checkIfBlocked($info);

    if (empty($blocked) || $blocked[0]->blocked == 0){
      if($result){
        $hashpw = $result[0]->password;
        if($this->phpass->checkpassword($password, $hashpw)){
          $sess_array = array();       
          foreach($result as $row){
            $find_role = $this->loginmodel->findRole($row->id);
            $role = array_shift($find_role);  

            $sess_array = array(
              'username' => $row->username,
              'roles' => $role
              );
            $this->session->set_userdata('logged_in', $sess_array);
              //logfile
              $file = 'logfile.txt';
              // Open the file to get existing content
              $current = file_get_contents($file);
              // Append a new person to the file

              $user = $this->session->userdata['logged_in'];

              date_default_timezone_set('Europe/Amsterdam');
              $date = date('m/d/Y h:i:s a', time());

              $current .= 'naam: '.$user['username'] .' tijd: '.$date.' '." \r\n";
              // Write the contents back to the file
              file_put_contents($file, $current);
          }
          return TRUE;
        }else{
          $this->form_validation->set_message('checkDatabase', 'Invalid password');
          $this->loginmodel->setError('errorW', $info);
          $this->errorLog($info, 'errorW');

          return false;        
        }
      }else{
        $this->form_validation->set_message('checkDatabase', 'Invalid Emailadress');
        $this->loginmodel->setError('errorE', $info);
        $this->errorLog($info, 'errorE');

        return false;
      }
    }else{
        $this->form_validation->set_message('checkDatabase', 'account is geblokkeerd. Neem contact op met de admin.');
        $this->loginmodel->setError('blocked', $info);
        $this->errorLog($info, 'blocked');

        return false;
    }
  }



  function errorLog($info, $error){
          //errorlogfile
    $file = 'errorlogfile.txt';
      // Open the file to get existing content
    $current = file_get_contents($file);
      // Append a new person to the file

    date_default_timezone_set('Europe/Amsterdam');
    $date = date('m/d/Y h:i:s a', time());

    $current .= 'email: '.$info['email'].' password: '.$info['password'].' tijd: '.$date.' errortype: '.$error.' '." \r\n";
      // Write the contents back to the file
    file_put_contents($file, $current);
  }
}
?>
