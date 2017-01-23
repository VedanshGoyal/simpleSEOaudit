					<!-- TAB Content (META - REPORT - Google Analytics) -->
					<?php if($ga_check){ ?>
					<div class="panel panel-info">
						<p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
						<div class="panel-heading">
						  <h3 class="panel-title">Google Analytics Result</h3>
						</div>
						<div class="panel-body">
						  <table class="table table-striped" style="text-align:center;">
							<thead>
							  <tr>
								<th>Google Analytics Code</th>
							  </tr>
							</thead>
							<tbody>
								<tr>
								  <td>
									<?php
										if ($ua_id){
											$countSecondLayer = count($ua_id[0]);
											if($countSecondLayer > 0){
												for($x = 0; $x < $countSecondLayer; $x++){
													echo $ua_id[0][$x]."<br /><br />";
												}
											}else{
												echo "None";
											}
										}
									?>
								  </td>
								</tr>
							</tbody>
						  </table>
						</div>
					</div>
					<?php } ?>
					<!-- END TAB Content (META - REPORT - Google Analytics) -->
					<!-- TAB Content (META - REPORT - Webmaster) -->
					<?php if($web_check){ ?>
					<div class="panel panel-info">
					<p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
					<div class="panel-heading">
					  <h3 class="panel-title">Webmaster Result</h3>
					</div>
					<div class="panel-body">
					  <table class="table table-striped" style="text-align:center;">
						<thead>
						  <tr>
							<th>Google Webmaster Meta</th>
							<th>Bing Webmaster Meta</th>
						  </tr>
						</thead>
						<tbody>
							<tr>
							  <td>
								<?php
									if($metaHome){
										foreach ($metaHome as $metaContent)
										{
											if ($metaContent->getAttribute('name') === 'google-site-verification')
											{
												echo $metaContent->getAttribute('content')."<br /><br />";
											}
										}
									}else{
										echo "None";
									}							
								?>
							  </td>
							  <td>
								<?php
									if($metaHome){
										foreach ($metaHome as $metaContent)
										{
											if ($metaContent->getAttribute('name') === 'msvalidate.01')
											{
												echo $metaContent->getAttribute('content')."<br /><br />";
											}
										}//end foreach
									}else{
										echo "None";
									}
								?>
							  </td>
							</tr>
						</tbody>
					  </table>
					</div>
					</div>
					<?php } ?>
					<!-- END TAB Content (META - REPORT - Webmaster) -->
					<!-- TAB Content (META - REPORT - Meta) -->
					<?php if($pdk_check){ ?>
					<?=$meta_result;?>
					<?php } ?>
					<!-- END TAB Content (META - REPORT - Meta) -->
					<!-- TAB Content (META - REPORT - Header) -->
					<?php if($header_check){ ?>
					<?=$header_result;?>
					<?php } ?>
					<!-- END TAB Content (META - REPORT - Header) -->
					