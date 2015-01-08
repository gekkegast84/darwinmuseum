<?php
Class loginmodel extends CI_Model{
  function login($email){
    $this->db->select('*');
    $this->db->from('employee');
    $this->db->where('email', $email);
    $this->db->limit(1);

    return $this->db->get()->result();
  }

  function findRole($id){
      //select 'role_id' from 'give_roles' where 'username' == $username;
      $this->db->select('role_id');
      $this->db->from('give_roles');
      $this->db->where('employee_id', $id);

      $query = $this->db->get();

      //if result > 0 : array push role_id
      if ($query->num_rows() > 0){
        $returnArray = array();
        foreach ($query->result() as $key){
          array_push($returnArray, $key->role_id);
        }
        return $returnArray;
      } else {
        return FALSE;
    }
  }

  function getRoleId($permid){
    //select query...
    $this->db->select('role_id');
    $this->db->from('give_roles');
    $this->db->where('employee_id', $permid);

    $query = $this->db->get();

    if ($query->num_rows() > 0){
      return TRUE;
    }else {
        return FALSE;
    }
  }


  //alles opvragen uit login_error
  function getErrors(){
    $query = $this->db->get('login_error');
    return $query->result();
  }

  function checkIfBlocked($info){
    $this->db->select('*');
    $this->db->from('login_error');
    $this->db->where('email', $info['email']);

    $query = $this->db->get();
    return $query->result();
  }

  function getBlocked(){
    $this->db->select('*');
    $this->db->from('login_error');
    $this->db->where('blocked', TRUE);
    $query = $this->db->get();
    return $query->result();
  }

  function setError($error, $info){
    //vraag alle errorlogs uit db op. Waarvan email en password 
    //gelijk is aan de zojuist ingevulde gegevens.
    $this->db->select('*');
    $this->db->from('login_error');
    $this->db->where('email', $info['email']);
    //$this->db->or_where('password', $info['password']);

    $query = $this->db->get();
    $result = $query->result();

    if ($query->num_rows() > 0){
      $id = $result[0]->id;
      //wanneer gegevens 3x zijn ingevuld. block
      if ($result[0]->count == 3) {
        $this->db->query("UPDATE login_error SET blocked = TRUE WHERE id = '$id'");

        //zorgt dat ook na het de-blokeren er staat dat hij ooit geblokkeerd was.
        $this->db->query("UPDATE login_error SET wasblocked = TRUE WHERE id = '$id'");
        $this->session->set_flashdata('flashWarning', 'Account geblokeerd. Neem contact op met de administator.');
        redirect('login');
        return false;
      }
      //1 optellen bij count als zelfde gegevens worden ingevoerd.
      $this->db->query("UPDATE login_error SET count = count+1 WHERE id = '$id'");
    //gegevens nooit ingevoerd. alles naar db, count op 1
    }else{
    $data = array(
       'id' => NULL,
       'email' => $info['email'],
       'password' =>$info['password'],
       'status' => $error,
       'count' => '1'
    );   

    $this->db->insert('login_error', $data); 
    }
  }
  function unblock($id){
    $this->db->set('blocked', FALSE);
    $this->db->set('count', 0);
    $this->db->where('id', $id);
    $this->db->update('login_error');
    redirect('badLogins', 'refresh');
  }
}

?>

