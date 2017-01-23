<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Urlanalysis extends CI_Controller {

	public function index($page = "URL Analysis")
	{
		if ( ! file_exists('application/views/urlanalysis/index.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('urlanalysis/index', $data);
		$this->load->view('templates/footer', $data);

	}
	
	public function check()
	{	
		if(isset($_POST['url'])){
		
			$data['url_result'] = $this->url_result($_POST['url']);
			$this->load->view('urlanalysis/check', $data);
		}
	}
	
	public function report()
	{	
	
		if(isset($_POST['url'])){
		
			$data['report_result'] = $this->report_result($_POST['url']);
			$this->load->view('urlanalysis/report', $data);

		}
	}
	
	public function report_result($URL)
	{
	
	$split_urls = preg_split("/[\r\n,]+/", $URL, -1, PREG_SPLIT_NO_EMPTY);//get all entered URL
	$totalURLs = count($split_urls);	
	
	$totalRedirect = 0;
	$totalOK = 0;
	$totalCanonical = 0;
	$totalRobots = 0;
	for($x = 0; $x < $totalURLs; $x++){
		$header_response = get_headers($split_urls[$x]);		
		
		if(strpos($header_response[0],'301') !== false || strpos($header_response[0],'302') !== false){
			$final_url = $this->getLastEffectiveUrl($split_urls[$x]);
		}else{
			$final_url = $split_urls[$x];
		}
		
		$loadURLs = $this->getContent($final_url);
		$DOM = new DOMDocument;
		$DOM->recover = true;
		$DOM->strictErrorChecking = false;
		@$DOM->loadHTML($loadURLs);
		$loadLink = $DOM->getElementsByTagName('link');
		$loadMeta = $DOM->getElementsByTagName('meta');
		
		
		
		if(strpos($header_response[0],'200') == true ){
			$okURLs[] = $this->getLastEffectiveUrl($split_urls[$x]);
			$totalOK = count($okURLs);
		}
		
		if(strpos($header_response[0],'301') == true ){
			$redirectURLs[] = $this->getLastEffectiveUrl($split_urls[$x]);
			$totalRedirect = count($redirectURLs);
		}
		
		
		foreach ($loadLink as $canonical)
		{
			if ($canonical->getAttribute('rel') === 'canonical')
			{
				$canonicalURLs[] = $canonical->getAttribute('href');
				$totalCanonical = count($canonicalURLs);
			}
		}
		
		foreach ($loadMeta as $robots)
		{
			if ($robots->getAttribute('name') === 'robots')
			{
				$robotsURLs[] = $robots->getAttribute('content');
				$totalRobots = count($robotsURLs);
			}
		}
		
	}
	
	?>
						<ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge"><?=$totalURLs;?></span>
                            No. of URLs Checked
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?=$totalOK;?></span>
                            No. of 200 OK URLs
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?=$totalRedirect;?></span>
                            No. of 301 Redirect URLs
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?=$totalCanonical;?></span>
                            No. of URLs with Canonical
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?=$totalRobots;?></span>
                            No. of URLs restricted by robots
                          </li>
                        </ul>
	
	<?php	
	}
	
	public function url_result($URL){
	?>
				<div class="table-responsive">
                  <table class="table table-striped" style="text-align:center;">
                    <thead>
                      <tr>
                        <th>Main URL</th>
                        <th>Redirect URL</th>
                        <th>Canonical</th>
                        <th>Robots Meta</th>
                        <th>Header Response</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$data['split_urls'] = preg_split("/[\r\n,]+/", $URL, -1, PREG_SPLIT_NO_EMPTY);//get all entered URL
					$data['count_urls'] = count($data['split_urls']);				
					
						for($data['x'] = 0; $data['x'] < $data['count_urls']; $data['x']++){
							
							$data['header_response'] = get_headers($data['split_urls'][$data['x']]);
							
							if(strpos($data['header_response'][0],'301') !== false || strpos($data['header_response'][0],'302') !== false){
								$data['final_url'] = $this->getLastEffectiveUrl($data['split_urls'][$data['x']]);
							}else{
								$data['final_url'] = $data['split_urls'][$data['x']];
							}
							
							$data['loadURLs'] = $this->getContent($data['final_url']);
							$DOM = new DOMDocument;
							$DOM->recover = true;
							$DOM->strictErrorChecking = false;
							@$DOM->loadHTML($data['loadURLs']);
							$data['loadLink'] = $DOM->getElementsByTagName('link');
							$data['loadMeta'] = $DOM->getElementsByTagName('meta');
							
					?>
						<tr>
                          <td><?=$data['split_urls'][$data['x']];?></td>
						  <td><?=(strpos($data['header_response'][0],'301') !== false || strpos($data['header_response'][0],'302') !== false) ? "<a href='".$this->getLastEffectiveUrl($data['split_urls'][$data['x']])."'>".$this->getLastEffectiveUrl($data['split_urls'][$data['x']])."</a>" : "None"; ?></td>
                          <td>
							<?php
								foreach ($data['loadLink'] as $data['canonical'])
								{
									if ($data['canonical']->getAttribute('rel') === 'canonical')
									{
										if($data['final_url'] === $data['canonical']->getAttribute('href')):
											$data['differ'] = 'style="color:rgb(0,176,240);"';
										else:
											$data['differ'] = 'style="color:red;"';
										endif;
										
										echo "<span><a ". $data['differ'] ." href='".$data['canonical']->getAttribute('href')."'>".$data['canonical']->getAttribute('href')."</a><br /><br /></span>";
										
										
									}
								}
								
							?>
						  </td>
                          <td>
							<?php
								foreach ($data['loadMeta'] as $data['robots'])
								{
									if ($data['robots']->getAttribute('name') === 'robots')
									{
										if(strpos($data['robots']->getAttribute('content'),'noindex') !== false):
											$data['differ'] = 'style="color:red;"';
										elseif(strpos($data['robots']->getAttribute('content'),'nofollow') !== false):
											$data['differ'] = 'style="color:red;"';
										elseif(strpos($data['robots']->getAttribute('content'),'noindex,nofollow') !== false):
											$data['differ'] = 'style="color:red;"';
										elseif(strpos($data['robots']->getAttribute('content'),'index,nofollow') !== false):
											$data['differ'] = 'style="color:red;"';
										elseif(strpos($data['robots']->getAttribute('content'),'noindex,follow') !== false):
											$data['differ'] = 'style="color:red;"';
										else:
											$data['differ'] = 'style="color:rgb(0,176,240);"';
										endif;
										
										echo "<span ". $data['differ'] .">".$data['robots']->getAttribute('content')."<br /><br /></span>";
										
									}
								}
							?>
						  </td>
                          <td><?=(strpos($data['header_response'][0],'302') !== false) ? '<span style="color:red;">'. $data['header_response'][0] .'</span>' : $data['header_response'][0]; ?></td>
                        </tr>
					<?php
						}//end for
					?>
                    </tbody>
                  </table>
				</div>
	<?php
	}
	
	public function getOKurls($URL){
		
	}
	
	public function getLastEffectiveUrl($url)
	{
		// initialize cURL
		$curl = curl_init($url);
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_FOLLOWLOCATION  => true,
			CURLOPT_ENCODING		=> '',
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
	
	public function getContent($URL)
	{
		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($ch, CURLOPT_URL, $URL);
		  curl_setopt($ch, CURLOPT_ENCODING, '');
		  $data = curl_exec($ch);
		  curl_close($ch);
		  return $data;
	}
	
	
}