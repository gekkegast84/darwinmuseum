<?php
Class ticketmodel extends CI_Model{

	function addTicket($ticket, $barcodeID){
		date_default_timezone_set('Europe/Amsterdam');
		$date = date("Y/m/d");
		$firstname = $ticket['0'];
		$lastname = $ticket['2'];

		if($this->equalsUser($firstname, $lastname)){	
			$this->db->query("UPDATE user SET orders = orders+1 WHERE firstname = '$firstname' AND lastname = '$lastname'");
		}else{
			if($this->session->userdata['logged_in']['roles'] = '9'){   
				$userInfo = array( 
				'id' => NULL,
				'firstname' => $ticket['0'],
				'prefix' => $ticket['1'],
				'lastname' => $ticket['2'],
				'dob' => $ticket['3'],
				'zipcode' => '2501CB',
				'residence' => 'Den Haag',
				'orders' => '1'
				);
			}else{
				$userInfo = array(
					'id' => NULL,
					'firstname' => $ticket['0'],
					'prefix' => $ticket['1'],
					'lastname' => $ticket['2'],
					'dob' => $ticket['3'],
					'zipcode' => $ticket['4'],
					'residence' => $ticket['5'],
					'orders' => '1'
				);
			}
			$this->db->insert('user', $userInfo);
		}

			$userId = mysql_insert_id();
			if($userId == '0'){
				$user = $this->equalsUser($firstname, $lastname);
				$userId = $user[0]->id;
			}

			$ticketInfo = array(
				'id' => $NULL,
				'user_id' => $userId,
				'dateoforder' => $date,
				'barcode_id' => $barcodeID
			);		
			$this->db->insert('ticket', $ticketInfo);
	}

	function getTicket(){
		$query = $this->db->get('Ticket');

		foreach ($query->result() as $row){
			echo $row->dateoforder.'<br/>';
		}
	}

	function getAverageAge(){
		$query = $this->db->query("SELECT AVG( YEAR(now()) - YEAR(dob)) as avg_age FROM Ticket WHERE dob IS NOT NULL;");
		foreach ($query->result() as $row)
		{
			echo $row->avg_age;
		}
	}

	function getTicketCount(){
		$this->db->select('*');
		$this->db->from('ticket');
		$this->db->where("dateoforder >= DATE_SUB(NOW(),INTERVAL 1 WEEK)", NULL, FALSE);
	}

	function equalsUser($firstname, $lastname){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where("firstname", $firstname);
		$this->db->where("lastname", $lastname);

		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}
?>