<?php
require_once(APPPATH . '/controllers/test/Toast.php');
require_once(APPPATH . '/controllers/VerifyLogin.php'); //Require the tested class's file

class Test_login extends Toast
{
    private $ticket;

    function __construct()
    {
        parent::__construct(__FILE__);
        $this->VerifyLogin = new VerifyLogin(true);    //Instantiate class
    }

    function _pre()
    {
        $data = array(
          'id' => '198',
          'email' => 'Unittest@test.nl',
          'password' => 'geheim',
          'status' => 'errorE',
          'count' => '2',
          'blocked' => '0',
          'wasblocked' => '0'
        );
        $this->db->insert('login_error', $data);
    }


    function test_blocked(){

			$email = 'test@gmail.com';
			$password = 'geheim';

		  $info = array(
		    "email" => $email,
		    "password" => $password
		  );

        $this->_assert_true($this->VerifyLogin->loginModel->checkIfBlocked($info));
    }

    function test_role(){
    	$permid = '1';

      $this->_assert_true($this->VerifyLogin->loginModel->getRoleId($permid));
    }

    function _post()
    {

        //Remove unit test office from database
        $this->db->delete('login_error', array('id' => '198'));
    }
}