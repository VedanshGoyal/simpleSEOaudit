<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index($page = "Dashboard")
	{

		if ( ! file_exists('application/views/dashboard/index.php'))
		{
			show_404();
		}

		$this->load->model('Announcement');
		$data['result'] = $this->Announcement->get_announcement();
		
		
		$data['title'] = ucfirst($page);

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer', $data);

	}
	
	public function post($page = "Dashboard")
	{	
	
		if(isset($_POST['process'])){
			
			$this->load->model('Announcement');		
			
			if($_POST['process'] == "add"){
			
				$data['announcement'] = stripslashes(htmlspecialchars($_POST['announce']));	
				$data['name'] = $_POST['user'];
				$this->Announcement->insert_entry($data);
			
			}elseif($_POST['process'] == "delete"){
				$id = $_POST['id'];
				$this->Announcement->delete_entry($id);
				
			}			
			
			$data['result'] = $this->Announcement->get_announcement();
			$this->load->view('dashboard/post', $data);
		}
		
		
	}
}