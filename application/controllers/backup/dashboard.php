<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index($page = "Dashboard")
	{

		if ( ! file_exists('application/views/dashboard/index.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		$file = 'log.'.date("Y-m-d").'.html';
		$logPath = 'public/others/'.$file;
		if(!file_exists($logPath)){
			$handle = fopen($logPath, 'w') or die('Cannot open file:  '.$logPath); //implicitly creates file
		}

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer', $data);

	}
	
	public function post($page = "Dashboard")
	{	
		$name = $_POST['user'];
		$announcement = $_POST['announce'];
		$time = $_POST['time'];
		$file = 'log.'.date("Y-m-d").'.html';
		$logPath = 'public/others/'.$file;
		
		$handle = fopen($logPath, "a+");
		fwrite($handle, "<blockquote><p>".stripslashes(htmlspecialchars($announcement))."</p><small>".$name." -- ".date("F j, Y, ".$time)."</small></blockquote>");
		fclose($handle);
		
		

		// $fp = fopen($logPath, 'a');
		// fwrite($fp, "<div class='msgln'>(".date(" Y-m-d g:i A").") <b>".$name."</b>: ".stripslashes(htmlspecialchars($announcement))."<br></div>");
		// fclose($fp);
	
		// $this->load->view('dashboard/post');

	}
}