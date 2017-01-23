<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title ?> :: Website Audit Checker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo(CSS.'bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo(CSS.'style.css'); ?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo(JS.'addon/jquery.js'); ?>"></script>
	<script src="<?php echo(JS.'process.js'); ?>"></script>
  </head>
  <body>
    <!-- NAV -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <div class="btn-group btn-group btn-lg">
              <button class="btn btn-default" type="button" disabled="disabled"><span class="glyphicon glyphicon-home"></span></button>
              <button class="btn btn-default" type="button" onclick="window.location='<?php echo (URL.'dashboard'); ?>';">Home</button>
            </div>
			 <div class="btn-group btn-group btn-lg">
			  <button class="btn btn-default" type="button" disabled="disabled"><span class="glyphicon glyphicon-wrench"></span></button>
			  <div class="btn-group">
				<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button"> Tools &nbsp;<span class="caret"></span></button>
				<ul class="dropdown-menu">
				  <li><a href="<?php echo (URL.'urlanalysis?tab=url'); ?>">URL Checker</a></li>
				  <li><a href="<?php echo (URL.'metaanalysis?tab=meta'); ?>">Meta Checker</a></li>
				  <li><a href="<?php echo (URL.'wordcountanalysis?tab=word'); ?>">Word Count Checker</a></li>
				</ul>
			  </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <h4 class="navbar-text navbar-right">Website Audit Checker v1.3</h4>
        </div>
    </nav>
    <!-- END NAV -->
    <div style="margin:20px;">
	  <?php if(isset($_GET['tab'])): ?>
      <!-- TAB NAV -->
      <ul class="nav nav-tabs nav-justified">
        <li <?=($_GET['tab'] == "url") ? 'class="active"' : '';  ?> ><a class="tab" href="<?php echo (URL.'urlanalysis?tab=url'); ?>"><span class="glyphicon glyphicon-link"></span> URL Checker</a></li>
        <li <?=($_GET['tab'] == "meta") ? 'class="active"' : '';  ?>><a class="tab" href="<?php echo (URL.'metaanalysis?tab=meta'); ?>"><span class="glyphicon glyphicon-tag"></span> Meta Checker</a></li>
        <li <?=($_GET['tab'] == "word") ? 'class="active"' : '';  ?>><a class="tab" href="<?php echo (URL.'wordcountanalysis?tab=word'); ?>"><span class="glyphicon glyphicon-list"></span> Word Count Checker</a></li>
      </ul>
	  <?php endif; ?>
      <!-- END TAB NAV -->
	  	<script src="<?php echo(JS.'default.js'); ?>"></script>
		<!-- TAB Content -->
		<div class="tab-content">