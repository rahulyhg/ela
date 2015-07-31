<?php
include "inc/database.class.php";
include "inc/common.class.php";
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
	<link rel="shortcut icon" href="img/logo/icon_songs.png" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript">
		$(function(){
		$(".search").keyup(function() 
		{
		var searchid = $(this).val();
		var dataString = 'search='+ searchid;
		if(searchid!='')
		{
			$.ajax({
			type: "POST",
			url: "ajax/search.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#result").html(html).show();
			}
			});
		}return false;    
		});

		jQuery("#result").live("click",function(e){ 
			var $clicked = $(e.target);
			var $name = $clicked.find('.name').html();
			var decoded = $("<div/>").html($name).text();
			$('#searchid').val(decoded);
		});
		jQuery(document).live("click", function(e) { 
			var $clicked = $(e.target);
			if (! $clicked.hasClass("search")){
			jQuery("#result").fadeOut(); 
			}
		});
		$('#searchid').click(function(){
			jQuery("#result").fadeIn();
		});
		});
	</script>
	<style type="text/css">
		#result
		{
			z-index:9999;
			position:absolute;
			width:221px;
			padding:5px;
			display:none;
			margin-top:-1px;
			border-top:0px;
			overflow:hidden;
			border:1px #CCC solid;
			background-color: white;
			border-radius: 10px;
		}
		.show
		{
			padding:5px; 
			*border-bottom:1px #999 dashed;
			font-size:12px; 
			height:23px;
		}
		.show:hover
		{
			background:#4c66a4;
			color:#FFF;
			cursor:pointer;
		}
	</style>
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
</body>
</html>  