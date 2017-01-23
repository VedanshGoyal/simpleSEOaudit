		<!-- TAB Content (META) -->
        <div id="meta" <?=($_GET['tab'] == "meta") ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"';  ?> >
            <!-- TAB Content (META - FORM) -->
            <div class="panel panel-primary" style="margin-top: 20px;">
                <div class="panel-heading">
                  <h3 class="panel-title">Form</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <!-- TAB Content (META - FORM - INPUT) -->
                    <div class="col-md-6">
						<div class="table-responsive">
                          <div class="input-group">
                            <span class="input-group-addon" style="text-align:left;">
                              <ul class="list-unstyled">
                                  <li><input type="checkbox" id="ga-check"> Analytics</li>
                                  <li><input type="checkbox" id="webmaster-check"> Webmasters</li>
                                  <li><input type="checkbox" id="pdk-check"> Meta</li>
                                  <li><input type="checkbox" id="header-check"> Header</li>
                              </ul>
                            </span>
                            <textarea class="form-control" id="meta-check" placeholder="Enter URL here..."></textarea>
                            <div class="input-group-btn">
							  	<div class="btn-group-vertical">
									<button style="width:100px;height:64px;margin-top:0px;border-top-right-radius:4px;border-top-left-radius:0px;border-bottom-left-radius:0px;" type="button" class="btn btn-default" onClick="getMetaResult()">Check</button>
									<button style="width:100px;height:64px;margin-top:0px;border-radius:0;" type="button" class="btn btn-default" id="open-links-meta">Open Links</button>
									<button style="width:100px;height:64px;margin-top:0px;border-bottom-right-radius:4px;border-top-left-radius:0px;border-bottom-left-radius:0px;" type="button" class="btn btn-default" id="view-source">View Source</button>
								</div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END TAB Content (META - FORM - INPUT) -->
                      <!-- TAB Content (META - FORM - DATA) -->
                      <div class="col-md-6" id="meta-data">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of URLs Checked
                          </li>
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of Google Analytics Code
                          </li>
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of Google Webmaster Meta Code
                          </li>
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of Bing Webmaster Meta Code
                          </li>
                        </ul>
                      </div>
                      <!-- END TAB Content (META - FORM - DATA) -->
                  </div>
                </div>
              </div>
              <!-- END TAB Content (META - FORM) -->
			  <!-- TAB Content (META - REPORT) -->
              <div class="panel panel-success">
				<div class="panel-heading">
                  <h3 class="panel-title">Result</h3>
                </div>
				<div class="panel-body" id="meta-result-data">
					<!-- TAB Content (META - REPORT - Google Analytics) -->
					<div class="panel panel-info">
						<p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
						<div class="panel-heading">
						  <h3 class="panel-title">Google Analytics Result</h3>
						</div>
						<div class="panel-body">
						  <table class="table table-striped">
							<thead>
							  <tr>
								<th>Google Analytics Code</th>
							  </tr>
							</thead>
							<tbody>
								<tr>
								  <td>&nbsp;</td>
								</tr>
							</tbody>
						  </table>
						</div>
					</div>
					<!-- END TAB Content (META - REPORT - Google Analytics) -->
					<!-- TAB Content (META - REPORT - Webmaster) -->
					<div class="panel panel-info">
					<p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
					<div class="panel-heading">
					  <h3 class="panel-title">Webmaster Result</h3>
					</div>
					<div class="panel-body">
					  <table class="table table-striped">
						<thead>
						  <tr>
							<th>Google Webmaster Meta</th>
							<th>Bing Webmaster Meta</th>
						  </tr>
						</thead>
						<tbody>
							<tr>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>
						</tbody>
					  </table>
					</div>
					</div>
					<!-- END TAB Content (META - REPORT - Webmaster) -->
					<!-- TAB Content (META - REPORT - Meta) -->
					<div class="panel panel-info">
					<p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
					<div class="panel-heading">
					  <h3 class="panel-title">Meta Result</h3>
					</div>
					<div class="panel-body">
					<div class="table-responsive">
					  <table class="table table-striped">
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
							<tr>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>
						</tbody>
					  </table>
					</div>
					</div>
					</div>
					<!-- END TAB Content (META - REPORT - Meta) -->
					<!-- TAB Content (META - REPORT - Header) -->
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
							<tr>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>
						</tbody>
					  </table>
					</div>
					</div>
					</div>
					<!-- END TAB Content (META - REPORT - Header) -->
				</div>	
              </div>
			  <!-- END TAB Content (META - REPORT) -->
        </div>
        <!-- END TAB Content (META) -->