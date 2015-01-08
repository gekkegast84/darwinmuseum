<?php
Class incidentmodel extends CI_Model{
	function getUser(){
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $query->result();
	}

	function reportIncident($incident){
		$emergencyInfo = array(
			'id' => NULL,
			'reported_by' => $incident['reported_by'],
			'emergency_description' => $incident['description'],
			'dateofemergency' => $incident['date'],
			'category' => $incident['category'],
			'status' => 'lopend'
			);

		$this->db->insert('emergency', $emergencyInfo);
		return $this->db->insert_id();

	}

	function insertInvolved($incident, $incidentId){
		$involved = $incident['involved'];
		$numOfInvolved = count($involved);

		for ($i = 0; $i <= $numOfInvolved-1; $i++){
			$involvedInfo = array(
				'id' => NULL,
				'emergency_id' => $incidentId,
				'involved_id' => $involved["$i"]
				);
			$this->db->insert('involved', $involvedInfo);
		}
	}

	function getIncident(){
		$this->db->select('*');
		$this->db->from('emergency');

		$query = $this->db->get();
		return $query->result();		
	}

	function getNameById($user_id){
			// $this->db->select("firstname, prefix, lastname, CONCAT(firstname, ' ', prefix, ' ', lastname) AS name", FALSE);

		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("id", $user_id);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}

   function getId($emergency_id){
		$this->db->select('*');
		$this->db->from('involved');
		$this->db->where('emergency_id', $emergency_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
}
?>