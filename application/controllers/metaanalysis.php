<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metaanalysis extends CI_Controller {

	public function index($page = "Meta Analysis")
	{
		if ( ! file_exists('application/views/metaanalysis/index.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('metaanalysis/index', $data);
		$this->load->view('templates/footer', $data);

	}
	
	public function check($page = "URL Analysis")
	{
		$data['title'] = ucfirst($page);
		
		// $this->load->view('metaanalysis/top', $data);
		
		if(isset($_POST['url'])){
		
			$data['ga_check'] = $_POST['ga_check'];
			$data['web_check'] = $_POST['web_check'];
			$data['pdk_check'] = $_POST['pdk_check'];
			$data['header_check'] = $_POST['header_check'];
		
			$data['split_urls'] = preg_split("/[\r\n,]+/", $_POST['url'], -1, PREG_SPLIT_NO_EMPTY);//get all entered URL
			$data['header_response'] = get_headers($data['split_urls'][0]);
			
			if(strpos($data['header_response'][0],'301') !== false || strpos($data['header_response'][0],'302') !== false){
				$data['homepage_url'] = $this->getLastEffectiveUrl($data['split_urls'][0]);
			}else{
				$data['homepage_url'] = $data['split_urls'][0];
			}
			
			// Google Analytics Checking
			if($_POST['ga_check']){
				$data['ua_id'] = $this->get_ga_implemented($data['homepage_url']);
				$data['countGAfirstlayer'] = count($data['ua_id']);
			}
			
			// Webmaster Checking			
			if($_POST['web_check']){
			
				$data['homepageOnly'] = $this->getContent($data['homepage_url']);
				$DOM = new DOMDocument;
				$DOM->recover = true;
				$DOM->strictErrorChecking = false;
				@$DOM->loadHTML($data['homepageOnly']);
				$data['metaHome'] = $DOM->getElementsByTagName('meta');
				
			}
			
			// Meta Checking
			
			if($_POST['pdk_check']){
				$data['meta_result'] = $this->meta_result($_POST['url']);
			}
			
			// Headings Checking
			if($_POST['header_check']){
				$data['header_result'] = $this->header_result($_POST['url']);
			}
			
			$this->load->view('metaanalysis/check', $data);
		
		}	
	}
	
	public function report()
	{	
	
		if(isset($_POST['url'])){
		
			$data['report_result'] = $this->report_result($_POST['url']);
			$this->load->view('metaanalysis/report', $data);

		}
	}
	
	public function report_result($URL)
	{
			$split_urls = preg_split("/[\r\n,]+/", $URL, -1, PREG_SPLIT_NO_EMPTY);//get all entered URL
			$totalURLs = count($split_urls);

			$header_response = get_headers($split_urls[0]);
			
			if(strpos($header_response[0],'301') !== false || strpos($header_response[0],'302') !== false){
				$homepage_url = $this->getLastEffectiveUrl($split_urls[0]);
			}else{
				$homepage_url = $split_urls[0];
			}
			
			$ua_id = $this->get_ga_implemented($homepage_url);
			$totalGA = count($ua_id[0]);
			
			
			$homepageOnly = $this->getContent($homepage_url);
			$DOM = new DOMDocument;
			$DOM->recover = true;
			$DOM->strictErrorChecking = false;
			@$DOM->loadHTML($homepageOnly);
			$webmasters = $DOM->getElementsByTagName('meta');
			
			
			$totalGoogleWeb = 0;
			$totalBingWeb = 0;
			foreach ($webmasters as $metaContent)
			{
				if ($metaContent->getAttribute('name') === 'google-site-verification')
				{
					$countGoogleWeb[] = $metaContent->getAttribute('content');
					$totalGoogleWeb = count($countGoogleWeb);
				}
				// else
				// {
					// $totalGoogleWeb = 0;
				// }
				
				if ($metaContent->getAttribute('name') === 'msvalidate.01')
				{
					$countBingWeb[] = $metaContent->getAttribute('content');
					$totalBingWeb = count($countBingWeb);
				}
				// else
				// {
					// $totalBingWeb = 0;
				// }
			}
				
	
	?>		
						<ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge"><?=$totalURLs;?></span>
                            No. of URLs Checked
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?=$totalGA;?></span>
                            No. of Google Analytics Code
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?=$totalGoogleWeb;?></span>
                            No. of Google Webmaster Meta Code
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?=$totalBingWeb;?></span>
                            No. of Bing Webmaster Meta Code
                          </li>
                        </ul>
	
	<?php
	}
	
	public function meta_result($URL){
	?>
					<?php 
						$data['split_urls'] = preg_split("/[\r\n,]+/", $_POST['url'], -1, PREG_SPLIT_NO_EMPTY);//get all entered URL
						$data['count_urls'] = count($data['split_urls']);
					?>
					<div class="panel panel-info">
					<p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
					<div class="panel-heading">
					  <h3 class="panel-title">Meta Result</h3>
					</div>
					<div class="panel-body">
					<div class="table-responsive">
					  <table class="table table-striped" style="text-align:center;">
						<thead>
						  <tr>
							<th>URL</th>
							<th>Page Title</th>
							<th>Length</th>
							<th>Meta Description</th>
							<th>Length</th>
						  </tr>
						</thead>
						<tbody>
						<?php
							for($data['x'] = 0; $data['x'] < $data['count_urls']; $data['x']++){
														
							$data['url_header_response'] = get_headers($data['split_urls'][$data['x']]);
							if(strpos($data['url_header_response'][0],'301') !== false || strpos($data['url_header_response'][0],'302') !== false){
								$data['final_url'] = $this->getLastEffectiveUrl($data['split_urls'][$data['x']]);
							}else{
								$data['final_url'] = $data['split_urls'][$data['x']];
							}
						
							// $data['homepage'] = $this->getContent($data['final_url']);
							// @$DOM->loadHTML($data['homepage']);
							// $data['meta'] = $DOM->getElementsByTagName('meta');
							// $data['title'] = $DOM->getElementsByTagName('title');
							
							$data['homepage'] = $this->getContent($data['final_url']);
							$DOM = new DOMDocument;
							$DOM->recover = true;
							$DOM->strictErrorChecking = false;
							@$DOM->loadHTML($data['homepage']);
							$data['meta'] = $DOM->getElementsByTagName('meta');
							$data['title'] = $DOM->getElementsByTagName('title');
							
							
						?>
							<tr>
							  <td><a href="<?php echo $data['split_urls'][$data['x']];?>"><?php echo $data['split_urls'][$data['x']];?></a></td>
							  <td>
								<?php
									if ($data['title']->length > 0) {
										foreach ($data['title'] as $data['titleContent']) {
											echo $data['titleContent']->nodeValue."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							  <td>
								<?php
									if ($data['title']->length > 0) {
										foreach ($data['title'] as $data['titleContent']) {
											echo strlen($data['titleContent']->nodeValue)."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							  <td>
								<?php
									if(isset($data['meta'])):
										foreach ($data['meta'] as $data['metaContent'])
										{
											if ($data['metaContent']->getAttribute('name') === 'description')
											{
												echo $data['metaContent']->getAttribute('content')."<br /><br />";
											}
										}
									else:
										echo "&nbsp;";
									endif;
								?>
							  </td>
							  <td>
								<?php
									if(isset($data['meta'])):
										foreach ($data['meta'] as $data['metaContent'])
										{
											if ($data['metaContent']->getAttribute('name') === 'description')
											{
												echo strlen($data['metaContent']->getAttribute('content'))."<br /><br />";
											}
										}
									else:
										echo "&nbsp;";
									endif;
								?>
							  </td>
							</tr>
						<?php } ?>
						</tbody>
					  </table>
					</div>
					</div>
					</div>
	
	<?php
	}
	
	public function header_result($URL){
	?>
					<?php 
						$data['split_urls'] = preg_split("/[\r\n,]+/", $_POST['url'], -1, PREG_SPLIT_NO_EMPTY);//get all entered URL
						$data['count_urls'] = count($data['split_urls']);
					?>
					<div class="panel panel-info">
					<p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
					<div class="panel-heading">
					  <h3 class="panel-title">Header Result</h3>
					</div>
					<div class="panel-body">
					<div class="table-responsive">
					  <table class="table table-striped">
						<thead>
						  <tr>
							<th>URL</th>
							<th>H1</th>
							<th>H2</th>
							<th>H3</th>
							<th>H4</th>
							<th>H5</th>
							<th>H6</th>
						  </tr>
						</thead>
						<tbody>
					<?php
						for($data['x'] = 0; $data['x'] < $data['count_urls']; $data['x']++){

						$data['url_header_response'] = get_headers($data['split_urls'][$data['x']]);
						if(strpos($data['url_header_response'][0],'301') !== false || strpos($data['url_header_response'][0],'302') !== false){
							$data['final_url'] = $this->getLastEffectiveUrl($data['split_urls'][$data['x']]);
						}else{
							$data['final_url'] = $data['split_urls'][$data['x']];
						}			
						
						$data['homepage'] = $this->getContent($data['final_url']);
						$DOM = new DOMDocument;
						$DOM->recover = true;
						$DOM->strictErrorChecking = false;
						@$DOM->loadHTML($data['homepage']);

						
						
					?>
							<tr>
							  <td><a href="<?php echo $data['split_urls'][$data['x']];?>"><?php echo $data['split_urls'][$data['x']];?></a></td>
							  <td>
								<?php
									$data['h1Val'] = $DOM->getElementsByTagName('h1');
									if ($data['h1Val']->length > 0) {
										foreach ($data['h1Val'] as $data['h1Content']) {
											echo $data['h1Content']->nodeValue."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							  <td>
								<?php
									$data['h2Val'] = $DOM->getElementsByTagName('h2');
									if ($data['h2Val']->length > 0) {
										foreach ($data['h2Val'] as $data['h2Content']) {
											echo $data['h2Content']->nodeValue."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							  <td>
								<?php
									$data['h3Val'] = $DOM->getElementsByTagName('h3');
									if ($data['h3Val']->length > 0) {
										foreach ($data['h3Val'] as $data['h3Content']) {
											echo $data['h3Content']->nodeValue."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							  <td>
								<?php
									$data['h4Val'] = $DOM->getElementsByTagName('h4');
									if ($data['h4Val']->length > 0) {
										foreach ($data['h4Val'] as $data['h4Content']) {
											echo $data['h4Content']->nodeValue."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							  <td>
								<?php
									$data['h5Val'] = $DOM->getElementsByTagName('h5');
									if ($data['h5Val']->length > 0) {
										foreach ($data['h5Val'] as $data['h5Content']) {
											echo $data['h5Content']->nodeValue."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							  <td>
								<?php
									$data['h6Val'] = $DOM->getElementsByTagName('h6');
									if ($data['h6Val']->length > 0) {
										foreach ($data['h6Val'] as $data['h6Content']) {
											echo $data['h6Content']->nodeValue."<br /><br />";
										}
									}else{
										echo "&nbsp;";
									}
								?>
							  </td>
							</tr>
					<?php } ?>
						</tbody>
					  </table>
					</div>
					</div>
					</div>
	
	<?php	
	}
	
	
	
	public function get_ga_implemented($url)
	{
		$options = array(
			CURLOPT_RETURNTRANSFER => TRUE, // return web page
			CURLOPT_HEADER => TRUE, // don't return headers
			CURLOPT_ENCODING => "", // handle all encodings
			CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64)", // who am i
			CURLOPT_SSL_VERIFYHOST => FALSE, //ssl verify host
			CURLOPT_SSL_VERIFYPEER => FALSE, //ssl verify peer
			CURLOPT_NOBODY => FALSE,
		);
		$ch = curl_init($url);
		curl_setopt_array($ch, $options);
		$content = curl_exec($ch);
			$flag1_trackpage = false; //FLag for the phrase '_trackPageview'
		$flag2_ga_js = false; //FLag for the phrase 'ga.js'
		$script_regex = "/<script\b[^>]*>([\s\S]*?)<\/script>/i";
		$ua_regex = "/UA-[0-9]{5,8}-[0-9]{1,2}/";
			preg_match_all($script_regex, $content, $inside_script);
			preg_match_all($ua_regex, $content, $ua_id);

			$count_ga = count($ua_id);
		if ($count_ga > 0)
			return($ua_id);
		else
			return false;
	}
	
	public function getContent($URL)
	{
		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($ch, CURLOPT_URL, $URL);
		  $data = curl_exec($ch);
		  curl_close($ch);
		  return $data;
	}
	
	public function getLastEffectiveUrl($url)
	{
		// initialize cURL
		$curl = curl_init($url);
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_FOLLOWLOCATION  => true,
		));
	 
		// execute the request
		$result = curl_exec($curl);
	 
		// fail if the request was not successful
		if ($result === false) {
			curl_close($curl);
			return null;
		}
	 
		// extract the target url
		$redirectUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
		curl_close($curl);
	 
		return $redirectUrl;
	}
}