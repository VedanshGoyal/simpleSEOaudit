		<!-- TAB Content (URL) -->
        <div id="url" <?=($_GET['tab'] == "url") ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"';  ?> >
            <!-- TAB Content (URL - FORM) -->
            <div class="panel panel-primary" style="margin-top: 20px;">
                <div class="panel-heading">
                  <h3 class="panel-title">Form</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <!-- TAB Content (URL - FORM - INPUT) -->
                    <div class="col-md-6">
                          <div class="input-group">
                            <textarea class="form-control" id="url-check" placeholder="Enter URL here..."></textarea>
							<div class="input-group-btn">
								<div class="btn-group-vertical">
									<button style="width:100px;height:96px;margin-top:0px;border-top-right-radius:4px;border-top-left-radius:0px;border-bottom-left-radius:0px;" type="button" class="btn btn-default" onClick="getURLResult()">Check</button>
									<button style="width:100px;height:96px;margin-top:0px;border-bottom-right-radius:4px;border-top-left-radius:0px;border-bottom-left-radius:0px;" type="button" class="btn btn-default" id="open-links-url">Open Links</button>
								</div>
							</div>
                          </div>
                      </div>
                      <!-- END TAB Content (URL - FORM - INPUT) -->
                      <!-- TAB Content (URL - FORM - DATA) -->
                      <div class="col-md-6" id="url-data">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of URLs Checked
                          </li>
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of 200 OK URLs
                          </li>
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of 301 Redirect URLs
                          </li>
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of URLs with Canonical
                          </li>
                          <li class="list-group-item">
                            <span class="badge">0</span>
                            No. of URLs restricted by robots
                          </li>
                        </ul>
                      </div>
                      <!-- END TAB Content (URL - FORM - DATA) -->
                  </div>
                </div>
              </div>
              <!-- END TAB Content (URL - FORM) -->
              <!-- TAB Content (URL - REPORT) -->
              <div class="panel panel-success">
                <p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
                <div class="panel-heading">
                  <h3 class="panel-title">Result</h3>
                </div>
                <div class="panel-body" id="url-result-data">
					<div class="table-responsive">
					  <table class="table table-striped">
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
              <!-- END TAB Content (URL - REPORT) -->
        </div>
        <!-- END TAB Content (URL) -->