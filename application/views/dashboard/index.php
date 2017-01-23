<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Announcement</h3>
  </div>
  <div class="panel-body">
	<div style="overflow-y:scroll;height:300px;border: 1px solid #DDDDDD;padding:15px;" id="chatbox">
		<?php 
			for($x = 0; $x < count($result); $x++){
		?>	<blockquote>
				<div class="row">
				  <div class="col-xs-12 col-md-8"><?=$result[$x]['announcement']; ?><br/><small><?=date("d, F Y g:i A",strtotime($result[$x]['datetime'])); ?></small></div>
				  <div class="col-xs-6 col-md-4" style="text-align:right;"><?=$result[$x]['name']; ?><a onClick="removeAnnouncement(<?=$result[$x]['id'] ?>)" href="javascript:void(0);"><span style="padding-left:50px;" class="glyphicon glyphicon-remove"></span></a></div>
				</div>
			</blockquote>
			<hr />
		<?php
			}
		?>
	</div>
	<p>&nbsp;</p>
		<div class="col-md-6">
			<textarea class="form-control" tabindex="1" name="announce" id="announce" placeholder="Enter announcement here..."></textarea>
		</div>
		<div class="col-md-6">
			<input type="text" tabindex="2" class="form-control" name="user" id="user" placeholder="Enter name here...">
			<p>&nbsp;</p>
			<button type="button" tabindex="3" onClick="getAnnouncementResult()" data-loading-text="Submitting..." class="btn btn-default">Submit</button>
			
		</div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Changelogs</h3>
  </div>
  <div class="panel-body">
	<dl>
          <dt>v.1.3 (01/23/2013)</dt>
		<dd>Announcement is now working. You can now add and delete announcements.</dd>
           <dd>Tables on URL Analysis and Meta Analysis Checker is now working.</dd>
		<hr />
	  <dt>v.1.2.1 (01/15/2013)</dt>
		<dd>Remove the clock</dd>
		<hr />
	  <dt>v.1.2 (01/14/2013)</dt>
		<dd>Change the submit buttons on URL Analysis and Meta Analysis</dd>
	</dl>
  </div>
</div>