<?php
Class managermodel extends CI_Model{
	function getUserCount(){
		$this->db->select('*');
		$this->db->from('ticket');

		$query = $this->db->get();
		return $query->num_rows();
	}

	function getDayUsers(){
		$query = $this->db->query("select * from ticket where dateoforder between date_sub(now(),INTERVAL 1 day) and now()");

		return $query->num_rows();		
	}

	function getAge(){
		$this->db->select('dob');
		$this->db->from('user');
		$query = $this->db->get();
		$dob = $query->result();
	}
	function getSelectedCount(){
		if(!empty($POST)){
			$time = $_POST['time'];
		}else{
			$time = 'day';
		}

		$ids = $this->getId($time);

		$j = count($ids);
		for ($i=0; $i < $j; $i++) { 
			$id[] = $ids[$i];

			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('id', $id[$i]->user_id);

			$query = $this->db->get();
			$result = $query->result();
		  foreach ($result as $results) {
				return $results; 	
			}
		}
	}

	function getId($time){
		$query = $this->db->query("select user_id from ticket where dateoforder between date_sub(now(),INTERVAL 1 $time) and now()");
		return $query->result();
	}

	function getUsers($time){
		$query = $this->db->query("select * from ticket where dateoforder between date_sub(now(),INTERVAL 1 $time) and now()");
		return $query->result();
	}

	function getNameById($id){
		$this->db->select("firstname, prefix, lastname, CONCAT(firstname, ' ', prefix, ' ', lastname) AS name", FALSE);
		//select('user_id, user_telephone, user_email, CONCAT(user_firstname, '.', user_surname) AS name', FALSE);
		$this->db->from('user');
		$this->db->where('id', $id);

		$query = $this->db->get();
		return $query->result();
	}

	function managerExcel(){
		$this->db->select('*');
		$this->db->from('ticket');

		$query = $this->db->get();
		return $query->result();
	}
}
?>

