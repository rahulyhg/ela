<?php
include "header.php";
if(isset($_GET['load']) && $_GET['load']=="html")
{
	$_SESSION['html'] = 'yes';
}
else
{
	$_SESSION['html'] = 'no';
}
$detect = new Mobile_Detect;
$mobile_browser = false;
if ($detect->isMobile() && !$detect->isTablet()) {
		$mobile_browser = true;
	}
	else{
		$mobile_browser = false;
	?>
		<br/><br/><br/>
		<div class='container'>
			<div class='row'>
				<div class='span12' align='center'>
					<font size='1'>
						<?php
							if($_SESSION['html'] == "yes") { echo "<a href='index.php'>Click</a> to load full website";}
							else {echo "<a href='index.php?load=html'> Slow Connection? Click Here</a>";}
						?>		
					</font>
				</div>
			</div>
		</div>
<?php
	}
?>
<html prefix="og: http://ogp.me/ns#">	
    <head>
       <title>Amar Ela | Welcome - Bishnupriya Manipuri Online Songs</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="Keywords" content="Bishnupriya Manipuri Songs, amar ela, BM Radio, Bishnupriya Manipuri Online Song, Bishnupriya, songs, Vishnupriya, Ela, manipuri ela, BM ela, Amar Thator Ela, amarela.kaakai.in">
	<meta name="Description" content="Bishnupriya Manipuri online music store under KAAKAI newspaper.">
		<meta property="og:title" content="Amar Ela" />
		<meta property="og:description" content="Bishnupriya Manipuri online music store under KAAKAI newspaper." /> 
		<meta property="og:image" content="img/logo/songs_logo.png" />
		<meta property="fb:app_id" content="1407103222879429"/> 
		<meta property="fb:admins" content=" 100002233601582"/>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/elastislide.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		<link href="css/style.css" rel="stylesheet">
		<script src="js/modernizr.custom.17475.js"></script>
		<style>
			.background {
				
				background-color: #F3FAF3;
				 *background: url(img/back3.jpg) no-repeat center center fixed;
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover;
				  background-opacity:0.4;
				 
			}
			.main {
				width: 95%;
				max-width: 960px;
				padding: 0 10px;
				margin: 0 auto;
				position: relative;
			}
		</style>
		<script type="text/javascript">
			$(function(){
				$('#info').removeClass("hide"); 
				$("#info").show();
				$("#info").css('top',$(window).scrollTop()+90);
				$('#info_content').html("<img src='img/logo/songs_logo.png' width='150'/><br/><font size='2'>This site has lots of unknown songs. Please help us to make it known through comment or mail.</font><br/><br/> <font color='green' size='2'>Without taking owners permission we have collected songs from various sources. If anybody have any problem regarding that, please make us know. </font><br/><br/>Get Updates of our Recent Uploads. <a href='http://www.facebook.com/bm.amarela'>Please Like us on facebook.</a>");
				$('#confirm_no').click(function(){
						 $("#info").hide();
						return false;
				});			
			});
			function hideInfo(){
				$("#info").hide("slow");	
			}
			
			$(function(){
				$("#showAd").hide();
				$("#break").html("<br/><br/>");
			});
			
			function hideAd(){
				$("#indexAd").hide("slow");
				$("#showAd").show();
				$("#hideAd").hide();
				$("#break").hide("slow");
			}
			
			function showAd(){
				$("#indexAd").show("slow");
				$("#showAd").hide();
				$("#hideAd").show();
				$("#break").show("slow");
				$("#break").html("<br/><br/>");
				
			}
		</script>
		<script language="javascript" type="text/javascript">
			$(document).ready(function() {
					$('#search').keyup(function() {
							searchTable($(this).val());
					});
			});
		</script>
    </head>
	<body>
	<?php
		$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Top of the index' && status=1");
		$row = mysql_fetch_array($result, MYSQLI_ASSOC);
		if($row) 
		{
	?>
			<div class="container">
				<div class="row">
					<div class="span12" align="center">
						<div class="container">
							<div class="row">
								<div class="span10" id="hideAd" align="right"><a href="#" onclick="hideAd()"><font size='1'>Hide Ad.</font></a></div>
								<div class="span10" id="showAd" align="right"><a href="#" onclick="showAd()"><font size='1'>Show Ad.</font></a></div>
							</div>
						</div>
						<div id="indexAd">
							<?php
								$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Top of the index' && status=1 order by rand() LIMIT 1");
								while($row = mysql_fetch_array($result))
								{
									echo "<a href='$row[ad_link]'><img src='advertise-image/$row[file_name]'  alt='$row[ad_title]' style='height:150px; width:900px' /></a>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<br/>
	<?php
		}	
		if(!$mobile_browser)
		{
			if(isset($_SESSION['html']) && $_SESSION['html']=="yes")
			{
			?>				
				<div class='container'>
					<div class='row'>
						<div class='span2'>
							<?php getAlbumTable("Recently Added"); ?>
						</div>
						<div class='span2'>
							<?php getAlbumTable("Modern"); ?>
						</div>
						<div class='span2'>
							<?php getAlbumTable("Devotional"); ?>
						</div>
						<div class='span2'>
							<?php getAlbumTable("Unknown"); ?>
						</div>
												
					</div>
				</div>
			<?php
			}
			else
			{
	?>
				<div id="info" class="hide">
					<div id="info_content"></div>
					<br/><br/>
					<input id='confirm_no' type='button' class="btn btn-primary" value='Close' />
				</div>		
					<div class="background">
						<br/>
						<?php getAlbumListWithContainer("Recently Added", "carousel"); ?>
						<br/>
						<?php getAlbumListWithContainer("Devotional", "carousel1"); ?>
						<br/>
						<?php getAlbumListWithContainer("Modern", "carousel2"); ?>
						<br/>
						<?php getAlbumListWithContainer("Unknown", "carousel3"); ?>
						<br/>
						
						
						<br/>
					</div>
				</font>
					<br/><br/>
					<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
					<script type="text/javascript" src="js/jquerypp.custom.js"></script>
					<script type="text/javascript" src="js/jquery.elastislide.js"></script>
					<script type="text/javascript">			
						$( '#carousel' ).elastislide();					
					</script>
					
					<script type="text/javascript" src="js/jquery.elastislide.1.js"></script>
					<script type="text/javascript">
						$( '#carousel1' ).elastislide();
					</script>
					
					<script type="text/javascript" src="js/jquery.elastislide.2.js"></script>
					<script type="text/javascript">			
						$( '#carousel2' ).elastislide();					
					</script>
					
					<script type="text/javascript" src="js/jquery.elastislide.3.js"></script>
					<script type="text/javascript">			
						$( '#carousel3' ).elastislide();					
					</script>
				
		<?php
			}
		}
		else
		{
	?>
			<br/>
			<div class="fb-like" data-href="https://www.facebook.com/bm.amarela" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			<br/><br/>
			<?php getMobileAlbumList("Recently Added") ;?>
			<br/>
			<?php getMobileAlbumList("Devotional") ;?>
			<br/>
			<?php getMobileAlbumList("Modern") ;?>
			<br/>
			<?php getMobileAlbumList("Unknown") ;?>
			<br/>
			<?php getMobileAlbumList("All Albums") ;?>
			<br/>
	<?php
		}
	?>
	<!--
		<a name='comment'></a>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1407103222879429";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		-->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1407103222879429&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="container">
			<div class="row">
				<div class="span1">&nbsp;</div>
				<div class="span6">
				
				<br/>
					<?php
						if(!$mobile_browser)
						{
					?>
							<div class="fb-comments" data-href="http://songs.kaakai.in/index.php" data-numposts="6" data-width="500" data-colorscheme="light"></div>
					<?php
						}
						else
						{
					
							/* Advertisement: above comment box for mobile */
						
							$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of disqus box' && status=1");
							$row = mysql_fetch_array($result, MYSQLI_ASSOC);
							if($row)
							{
?>
								<div id="ad-right">
									<!-- <div style="text-align:right;"><font size=1>Advertisement</font></div> -->
<?php
										$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of disqus box' && status=1 order by rand() LIMIT 1");
										while($row = mysql_fetch_array($result))
										{
											// echo "<a href='$row[ad_link]' target='_blank'><img src='advertise-image/$row[file_name]'  alt='$row[ad_title]' style='height:200px; width:400px' /></a>";
										}
?>
								</div>						
<?php
							}
?>
							<br/>
							<div class="fb-comments" data-mobile="Auto-detected" data-width="300" data-href="http://songs.kaakai.in/index.php" data-numposts="3" data-colorscheme="light"></div>
					<?php
						}
					?>
					
				</div>

				<div class="span5">					
<?php
			/* Advertisement: above like box for desktop */
			if(!$mobile_browser)
			{
				$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of disqus box' && status=1");
				$row = mysql_fetch_array($result, MYSQLI_ASSOC);
				if($row)
				{
?>
					<div id="ad-right">
						<!-- <div style="text-align:right;"><font size=1>Advertisement</font></div> -->
<?php
							$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of disqus box' && status=1 order by rand() LIMIT 1");
							while($row = mysql_fetch_array($result))
							{
								//echo "<a href='$row[ad_link]' target='_blank'><img src='advertise-image/$row[file_name]'  alt='$row[ad_title]' style='height:200px; width:400px' /></a>";
							}
?>
					</div>
						
<?php
				}
?>
				<br/>
				<div class="fb-like-box" data-href="https://www.facebook.com/bm.amarela" data-width="450" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>
<?
			}
?>
				<br/>
					
					<!-- <div class="fb-like-box" data-href="https://www.facebook.com/bm.amarela" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div> -->					
				</div>

			</div>
		</div>
		<!--
		<div id="cp_widget_e619f9e3-c960-4caa-b05c-62197913a927">...</div><script type="text/javascript">
var cpo = []; cpo["_object"] ="cp_widget_e619f9e3-c960-4caa-b05c-62197913a927"; cpo["_fid"] = "AQDAJ-bgcd0y";
var _cpmp = _cpmp || []; _cpmp.push(cpo);
(function() { var cp = document.createElement("script"); cp.type = "text/javascript";
cp.async = true; cp.src = "//www.cincopa.com/media-platform/runtime/libasync.js";
var c = document.getElementsByTagName("script")[0];
c.parentNode.insertBefore(cp, c); })(); </script><noscript>Powered by Cincopa <a href='http://www.cincopa.com/video-hosting'>Video Streaming Hosting</a> solution.<span>Amar Ela</span><span>Bhaburi tor iyari </span><span>Ahir Paani, Hrishi</span><span>Jibone Morone</span><span>Ahir Paani, Hrishi</span><span>Jibone Morone</span><span>Ahir Paani, Zubeen</span><span>Mattu tore kisade</span><span>Ahir Paani, Hrishi</span><span>Maya ti nadile</span><span>Ahir Paani, Hrishi</span></noscript>
-->
	</body>
</html>
<?php include "footer.php"; ?>
                            
                            
                            
                            
                            