<?php

//include this in all the files -- include_once("inc/create-db-structure.php");
include 'mobile/Mobile_Detect.php';
session_start();
$detect = new Mobile_Detect;
$mobile_browser = false;
if ($detect->isMobile() && !$detect->isTablet()) 
{
	$mobile_browser = true;
}
else
{
	$mobile_browser = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo PAGE_TITLE; ?></title>
	<meta name="Description" content="<?php echo PAGE_DESCRIPTION; ?>">
	<meta name="Keywords" content="<?php echo PAGE_KEYWORDS; ?>, amar ela, Bishnupriya Manipuri Online Song, Bishnupriya, Vishnupriya, Ela, manipuri ela, BM ela, Amar Thator Ela, amarela.kaakai.in">	
	<link rel="shortcut icon" href="img/logo/icon_songs.png" type="image/x-icon" />
	<link rel="image_src" href="<?php echo ALBUM_IMAGE; ?>" />
	<meta name="thumbnail" content="<?php echo ALBUM_IMAGE; ?>" />
	
	<meta property="og:title" content="<?php echo PAGE_TITLE; ?>" />
	<meta property="og:image" content="<?php echo ALBUM_IMAGE; ?>" />
	<meta property="og:image:width" content="600" />
	<meta property="og:image:height" content="315" />
	<meta property="og:site_name" content="<?php echo BASE_URL; ?>" />
	<meta property="fb:app_id" content="<?php echo FB_APP_ID; ?>" />
	<meta property="fb:admins" content="<?php echo FB_ADMIN_ID; ?>"/>
	<meta property="og:description" content="<?php echo PAGE_DESCRIPTION; ?>" />
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="js/header.js"></script>
	<link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<body>
	<div class="container">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
					
					<a href="index.php" class="brand">Amar Ela</a>
					<div class="nav-collapse collapse navbar-responsive-collapse">
						<ul class="nav">
							<li><a href="index.php">Home</a></li>
							<!--<li><a href="radio.php">Radio</a></li>-->
							<li class="dropdown">
								<a href="#" data-toggle="dropdown" class="dropdown-toggle">Browse<b class="caret"></b></a>
								<ul class="dropdown-menu">
	<?php 
										if($mobile_browser)
										{
											echo "<li><a href='show-all.php?show=0'>Albums / Movies</a></li>";
											
											echo "<li><a href='show-all.php?recent=yes'>Recently Added</a></li>";
											echo "<li class='divider'></li>";
											echo "<li><a href='show-all.php?show=Devotional'>Devotional</a></li>";
											echo "<li><a href='show-all.php?show=Modern'>Modern</a></li>";
											
											echo "<li><a href='show-all.php?show=Unknown'>Unknown</a></li>";
										}
										else
										{
											echo "<li><a href='album-wise.php'>Albums / Movies</a></li>";

											echo "<li><a href='album-wise.php?code=559&access=1'>Recently Added</a></li>";
											echo "<li class='divider'></li>";
											echo "<li><a href='album-wise.php?album_type=Modern'>Modern</a></li>";
											echo "<li><a href='album-wise.php?album_type=Devotional'>Devotional</a></li>";
								
											echo "<li><a href='album-wise.php?album_type=Unknown'>Unknown</a></li>";
										}
	?>
								</ul>
							</li>
							<li><a href="contributors.php">Contributors</a></li>
							<li><a href="http://www.kaakai.in">Visit kaakai.in</a></li>
							<li><a href="contact-us.php">Contact Us</a></li>
						</ul>
						<?php
							if(!$mobile_browser)
							{
						?>
								<form action="" class="navbar-search pull-left content">
									<input type="text" id="searchid" placeholder="Search. . ." class="search-query search">
									<div id="result"></div>
								</form>
						<?php
							}
						?>
						
						
						<?php
							
							if(isset($_SESSION['flag']) || isset($_SESSION['email']))
							{
						?>
								<ul class="nav pull-right">
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="#" data-toggle="dropdown" class="dropdown-toggle">Admin <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="create-album-admin.php">Create Album</a></li>
											<li><a href="create-album-admin.php#album_list">Add New Songs</a></li>
											<li><a href="add-user.php">Add User</a></li>
											<li class="divider"></li>
											<li><a href="upload-advertise.php">Upload Ad.</a></li>
											<li><a href="manage-advertise.php">Manage Ad.</a></li>
											<li class="divider"></li>
											<li><a href="review-comment.php">Review Comment</a></li>
											<li class="divider"></li>
											<li><a href="logout.php">Sign Out</a></li>
										</ul>
									</li>
								</ul>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>