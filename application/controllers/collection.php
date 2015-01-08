<?php

class collection extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url', 'directory'));

	}

	function index(){
		$data['images'] = glob('imgupload/*'); 
		$data['main_content'] = 'collectionView';
		$this->load->view('template', $data);
	}

	function doUpload(){
		$this->permission();
		$config['file_name'] = $this->nameImg();
		$config['upload_path'] = './imgupload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '500000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload()){
			$this->session->set_flashdata('flashWarning', $this->upload->display_errors());
			redirect('collection');
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$url = $data['upload_data']['file_name'];
			$this->session->set_flashdata('flashSucces', '<?=$url?> is succesvol geupload');
			redirect('collection');
		}
	}	

	function deleteImage(){
		$this->permission();
		if (array_key_exists('delete_file', $_POST)){
			$filename = $_POST['delete_file'];
			if (file_exists($filename)) {
				unlink($filename);
				$this->session->set_flashdata('flashSuccess', 'Het bestand is succesvol verwijderd');
     		redirect('collection', 'refresh');
			}else{
				$this->session->set_flashdata('flashWarning', 'Het bestand dat u probeerd te verwijderen bestaat niet');
     		redirect('collection');
			}
		}
	}

  function permission(){
		if($this->session->userdata('logged_in')){
			if($this->session->userdata['logged_in']['roles'] != '1' ){
				$this->session->set_flashdata('flashWarning', 'U Heeft geen permissie om deze functie uit te voeren.');
				redirect('login');
			}
		}else{
			$this->session->set_flashdata('flashWarning', 'U Heeft geen permissie om deze functie uit te voeren.');
			redirect('login');
		}
	}

  private function nameImg(){
		$map = directory_map('imgupload/');
		$name = count($map);
		return $name;
  }
}

