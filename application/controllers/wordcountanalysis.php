<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wordcountanalysis extends CI_Controller {

	public function index($page = NULL)
	{
		if ( ! file_exists('application/views/wordcountanalysis/index.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('wordcountanalysis/index', $data);
		$this->load->view('templates/footer', $data);

	}
}