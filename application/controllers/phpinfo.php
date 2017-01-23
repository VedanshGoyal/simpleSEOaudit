<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phpinfo extends CI_Controller {

	public function index($page = "PHP Info")
	{

		$data['title'] = ucfirst($page); // Capitalize the first letter
		$this->load->view('info/index', $data);
	}

}