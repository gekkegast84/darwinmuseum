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
		$this->db->order_by('id', 'asc');

		$query = $this->db->get();
		return $query->result();		
	}

	function giveInvolved($id){
		$this->db->select('emergency.id, user.firstname, user.prefix, user.lastname');    
		$this->db->from('emergency');
		$this->db->join('involved', 'involved.emergency_id = emergency.id');
		$this->db->join('user', 'user.id = involved.involved_id');
		$this->db->where('emergency.id', $id);
		$this->db->order_by('emergency.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
}
?>