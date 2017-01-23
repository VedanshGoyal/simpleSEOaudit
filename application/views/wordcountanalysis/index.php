<!-- TAB Content (WORD) -->
		<script src="<?php echo(JS.'addon/jquery.density.js'); ?>"></script>
        <div id="word" <?=($_GET['tab'] == "word") ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"';  ?>>
          <!-- TAB Content (WORD - FORM) -->
          <div class="panel panel-primary" style="margin-top: 20px;">
              <div class="panel-heading">
                <h3 class="panel-title">Form</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <!-- TAB Content (WORD - FORM - INPUT) -->
                  <div class="col-md-6">
                          <textarea id="box" class="form-control" placeholder="Enter content here..."></textarea>                         
                    </div>
                    <!-- END TAB Content (WORD - FORM - INPUT) -->
                    <!-- TAB Content (WORD - FORM - DATA) -->
                    <div class="col-md-6">
                      <ul class="list-group">
                        <li class="list-group-item">
                          <span class="badge"><input type="text" value="0" style="background: none repeat scroll 0% 0% transparent; border: medium none; color: rgb(255, 255, 255); width: 60px; text-align: center;" disabled="true" id="character_count"></span>
                          Characters
                        </li>
                        <li class="list-group-item">
                          <span class="badge"><input type="text" value="0" style="background: none repeat scroll 0% 0% transparent; border: medium none; color: rgb(255, 255, 255); width: 60px; text-align: center;" disabled="true" id="word_count"></span>
                          Words
                        </li>
                        <li class="list-group-item">
                          <span class="badge"><input type="text" value="0" style="background: none repeat scroll 0% 0% transparent; border: medium none; color: rgb(255, 255, 255); width: 60px; text-align: center;" disabled="true" id="sentence_count"></span>
                          Sentence
                        </li>
                        <li class="list-group-item">
                          <span class="badge"><input type="text" value="0" style="background: none repeat scroll 0% 0% transparent; border: medium none; color: rgb(255, 255, 255); width: 60px; text-align: center;" disabled="true" id="paragraph_count"></span>
                          Paragraphs
                        </li>
                        <li class="list-group-item">
                          <span class="badge"><input type="text" value="0" style="background: none repeat scroll 0% 0% transparent; border: medium none; color: rgb(255, 255, 255); width: 60px; text-align: center;" disabled="true" id="avg_sentence_length"></span>
                          Avg. Sentence Length
                        </li>
                      </ul>
                    </div>
                    <!-- END TAB Content (WORD - FORM - DATA) -->
                </div>
              </div>
            </div>
            <!-- END TAB Content (WORD - FORM) -->
            <!-- TAB Content (WORD - REPORT) -->
			<div class="panel panel-success">
              <p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
              <div class="panel-heading">
                <h3 class="panel-title">Count</h3>
              </div>
              <div class="panel-body" style="text-align:center;">
				<h3><span id="counted"><span class="label label-default">0</span> &nbsp;words &nbsp;&nbsp;<span class="label label-default">0</span> &nbsp;characters</span></h3>
              </div>
            </div>
            <div class="panel panel-success">
              <p class="navbar-text navbar-right" style="margin-top:11px;"><a href="javascript:void(0)" onClick="window.print()"><span class="glyphicon glyphicon-print"></span></a></p>
              <div class="panel-heading">
                <h3 class="panel-title">Keyword Density</h3>
              </div>
              <div class="panel-body">
				<span id="keywords-list">
					<table style="text-align:center;" class="table table-striped">
						<thead>
							<tr>
								<th>Mention</th>
								<th>Keywords</th>
								<th>Percent(%)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</span>
              </div>
            </div>
            <!-- END TAB Content (WORD - REPORT) -->
        </div>
        <!-- END TAB Content (WORD) -->