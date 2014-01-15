<?php
include "Table.php";
include "PopulateObjects.php";
?>
<!DOCTYPE html>
<!-- saved from url=(0035)http://getbootstrap.com/css/#tables -->
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title> LemnaDB Database </title>

		<!-- Bootstrap core CSS -->
		<link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet">

		<!-- Documentation extras -->
		<link href="bootstrap_files/docs.css" rel="stylesheet">
		<link href="bootstrap_files/pygments-manni.css" rel="stylesheet">

		<link rel="apple-touch-icon-precomposed" href="http://getbootstrap.com/assets/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.png">

		<!-- Place anything custom after this. -->
		<style id="holderjs-style" type="text/css">
			.holderjs-fluid {
				font-size: 16px;
				font-weight: bold;
				text-align: center;
				font-family: sans-serif;
				margin: 0
			}
		</style>
	</head>
	<body style="" data-twttr-rendered="true">

		</header>
		<!-- Callout for the old docs link -->
		<div class="bs-old-docs"></div>

		<div class="container bs-docs-container">
			<div class="row">
				<div class="col-md-3">
					<div class="bs-sidebar hidden-print affix" role="complementary" style="position:fixed;">
						<ul class="nav bs-sidenav">
							<li>
								<a href="#overview">Overview</a>
							</li>
							<li>
								<a href="#maintables">User Databases</a>
								<ul class="nav">
									<?php 
									$maintableset = $MainTables->getTables();
									foreach($maintableset as $title => $table){
										echo "<li class=''>
												<a href='#".$title."'>".$title."</a>
											 </li>";
									}?>
								</ul>
							</li>
							<!--  Do again for the global tables, LemnaSystem -->
							<li>
								<a href="#systemtables">LTSystem</a>
								<ul class="nav">
									<?php 
									$systemtableset = $SystemTables->getTables();
									foreach($systemtableset as $title => $table){
										echo "<li class=''>
												<a href='#".$title."'>".$title."</a>
											 </li>";
									}?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-9" role="main">
					<!-- Global Bootstrap settings
					================================================== -->
						<div class="bs-docs-section">
						<div class="page-header">
							<h1 id="overview">Overview</h1>
						</div>
						<p class="lead">
							This document contains discovered information about the LemnaTec Database System. This system contains two primary databases, 
							one for global settings and system information (LTSystem), and the other for jobs being pushed through the system.
						</p>
						</div>
						<div class="page-header">
						<div class="bs-docs-section">
							<h1 id="maintables">User Databases</h1>
							<p class ="lead">
								The following is documentation on relevant tables found in the job specific databases. All image analysis tables will being with "r_", they are
								not documented, as they are generated at runtime. The primary purpose of these tables is to perform the image analysis. The following are the key
								tables involved with the actual processing of the job.
							</p>
							</div>
						</div>

						<?php foreach($maintableset as $title => $table){
						
							echo $table->generateTableHTML();
						}?>
						
						<div class="page-header">
						<div class="bs-docs-section">
							<h1 id="systemtables">LTSystem</h1>
							<p class ="lead">
								The last section is for the database LTSystem. This database is primarily used for global and system settings, such as watering, usernames, and different
								objects which are in use.
							</p>
							</div>
						</div>

						<?php foreach($systemtableset as $title => $table){
						
							echo $table->generateTableHTML();
						}?>
						
						
				</div>
			</div>
		</div>

		<!-- JS and analytics only. -->
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="dist/js/jquery-2.0.3.min.js"></script>
		<script src="./bootstrap_files/bootstrap.js"></script>

		<script src="./bootstrap_files/widgets.js"></script>
		<script src="./bootstrap_files/holder.js"></script>

		<script src="./bootstrap_files/application.js"></script>

		<!-- Analytics
		================================================== -->
		<script>
var _gauges = _gauges || [];
(function() {
var t   = document.createElement('script');
t.async = true;
t.id    = 'gauges-tracker';
t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
t.src = '//secure.gaug.es/track.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(t, s);
})();
		</script>

	</body>
</html>