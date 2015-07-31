<?php
include "header.php";
?>
<html prefix="og: http://ogp.me/ns#">
<head>
	<meta property="og:title" content="Amar Ela" />
	<meta property="og:description" content="Bishnupriya Manipuri online music store under KAAKAI newspaper." /> 
	<meta property="og:image" content="img/logo/songs_logo.png" />
	<meta property="fb:app_id" content="1407103222879429"/> 
	<meta property="fb:admins" content=" 100002233601582"/>
<?php
if(isset($_GET['album_id']))
{
	$album_id = $_GET['album_id'];
	$result = Database::getInstance()->query("SELECT * FROM album_details WHERE id='$album_id'");
	while($row = mysql_fetch_array($result))
	{						
		$album_name = $row['album_name'];
	}
	echo "<title>". $album_name ." | Amar Ela</title>";
}
else
{
	echo "<title>Amar Ela | Song List</title>";
}
?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="Keywords" content="amar ela, Bishnupriya Manipuri Online Song, Bishnupriya, songs, Vishnupriya, Ela, manipuri ela, BM ela, Amar Thator Ela, songs.kaakai.in">
		<meta name="Description" content="Site of online Bishnupriya Manipuri music store under KAAKAI newspaper.">
</head>
<?php
	if(isset($_GET['album_id']))
	{
		$album_id = textSafety($_GET['album_id']);
		$result = Database::getInstance()->query("SELECT * FROM album_details WHERE id='$album_id'");
		$row = mysql_fetch_array($result, MYSQLI_ASSOC);
		if(! $row)
		{
			$url="index.php";
			header("Refresh:0;URL=$url");
			exit(0);
		} 
	}
	else
	{
		$url="index.php";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	$detect = new Mobile_Detect;
	$mobile_browser = false;
	if ($detect->isMobile() && !$detect->isTablet()) 
	{
		$mobile_browser = true;
	}
	$empty_name = false;
	$empty_email = false;
	$invalid_email = false;
	$empty_comment_box = false;
	$comment_awaiting = false;
	
	if(isset($_GET['code']) && isset($_GET['error']) && $_GET['error']== "1")
	{
		$empty_name = true;
	}
	if(isset($_GET['code']) && isset($_GET['error']) && $_GET['error']== "2")
	{
		$empty_email = true;
	}
	if(isset($_GET['code']) && isset($_GET['error']) && $_GET['error']== "3")
	{
		$invalid_email = true;
	}
	if(isset($_GET['code']) && isset($_GET['error']) && $_GET['error']== "4")
	{
		$empty_comment_box = true;
	}
	if(isset($_GET['error']) && $_GET['error']==0 && isset($_GET['msg']) && $_GET['msg']=='wait')
	{
		$comment_awaiting = true;
	}
	if(isset($_GET['comment_box']))
	{
		$comment_box = $_GET['comment_box'];
	}
	if(isset($_GET['name']))
	{
		$name = $_GET['name'];
	}
	if(isset($_GET['email']))
	{
		$email = $_GET['email'];
	}
?>
<!DOCTYPE html>
<html lang="en">
	<body>
		<script language="javascript" type="text/javascript">
			$(document).ready(function() {
					$('#search').keyup(function() {
							searchTable($(this).val());
					});
			});
			function goBack()
			{
				window.history.back()
			}
		</script>
		<script type="text/javascript">
			function resetMarks(id){
				$('#confirm_popup').removeClass("hide"); 
				$("#confirm_popup").show();
				//$("#confirm_popup").css('top',$(window).scrollTop()+90);
				$.get( "ajax/search-user.php?user_id="+id, function( data ) {
					$('#confirm_content').html(data);
				});
				
				$('#confirm_no').click(function(){
						 $("#confirm_popup").hide();
						return false;
				});			
			}
			
			function songDetails(id){
				$.get( "ajax/song-details.php?id="+id, function( data ) {
					$('#songDetails').html(data);
				});			
			}
			
			function userDetails(id){
				$.get( "ajax/user-details.php?id="+id, function( data ) {
					$('#userDetails').html(data);
				});			
			}
		</script>
		<style>
			img.pg_thumb,
			img#pg_large,
			.pg_title h1,
			.pg_content .pg_description div
			{
				margin-top:20px;
			}
			.pg_title h2{				
				*font-size:14px;
				*width:500px;
				overflow:hidden;
				background:transparent url(bg.png) repeat top left;
				padding:5px 5px;
				color:#fff;
				font-weight:bold;
			}
			
			.pg_title h4{				
				*font-size:14px;
				*width:500px;
				overflow:hidden;
				background:transparent url(bg.png) repeat top left;
				padding:5px 5px;
				color:#fff;
				font-weight:bold;
			}
			
			.pg_title h5{				
				*font-size:14px;
				*width:500px;
				overflow:hidden;
				background:transparent url(bg.png) repeat top left;
				padding:5px 5px;
				color:#fff;
				font-weight:bold;
			}
			
			.pg_description p{
				color:#000;
				*font-size:22px;
				margin-bottom:10px;
				background:transparent url(bg2.png) repeat top left;
				padding:5px;
			}
			
			.pg_description{
				color:#000;
				*font-size:22px;
				margin-bottom:10px;
				background:transparent url(bg2.png) repeat top left;
				padding:5px;
			}

			img.pg_thumb{
				*top:90px;
				*left:805px;
				padding:10px;
				background:transparent url(bg.png) repeat top left;
				*cursor:pointer;
			}
		</style>
	
	<br/><br/><br/><br/>
	
		<div id="confirm_popup" class="hide">
			<div id="confirm_content"></div>
			<br/><br/>
			<input id='confirm_no' type='button' class="btn btn-primary" value='Close' />
		</div>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1407103222879429";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
	<?php
		if(isset($_GET['album_id']))
		{
			$album_id = $_GET['album_id'];
			
			/* Check whether previous comments are available r not. */
			$commment_available = false;
			$result = Database::getInstance()->query("SELECT * FROM comment_details where album_id=$album_id && status=1");
			$row = mysql_fetch_array($result, MYSQLI_ASSOC);
			if($row) 
			{
				$commment_available = true;
			}
	?>
			<div class="container">
				<div class="row">
					<div class="span6">
<?php						
						$result = Database::getInstance()->query("SELECT * FROM album_details WHERE id='$album_id'");
						while($row = mysql_fetch_array($result))
						{
							echo "<img class='pg_thumb' src='album-image/$row[file_name]'  alt='$row[album_name]' width='400' border='5' height='600' />";
							//echo "<img class='pg_thumb' src='display-image.php?id=$row[id]&tableName=album_details' border='5' alt='not available' width='400' height='600' />";
						}						
?>
<?php							
						$result = Database::getInstance()->query("SELECT * FROM album_details WHERE id='$album_id'");
						while($row = mysql_fetch_array($result))
						{
							echo "<div class='pg_title'><h2>";							
							echo $row['album_name'];
							echo "</h2></div>";
						}
					
						$result = Database::getInstance()->query("SELECT * FROM album_details WHERE id='$album_id'");
						while($row = mysql_fetch_array($result))
						{
							echo "<div class='pg_description'>";	
							echo "<p><b>Album Tags: </b><br/><i>". $row['album_description'] . "</i></p></div>";	
						}

					if(!$mobile_browser)
					{
						if($commment_available)
						{
?>
							<br/>
							<a href='#disqus_comment'>Please leave comment</a>
							<br/>
							<a name="comment"></a>
							<div class="row">
								<div class="span6">
									<div class='pg_title'><h4>Comments:</h4></div>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<div class='pg_description'>
<?php
											$result = Database::getInstance()->query("SELECT * FROM comment_details where album_id=$album_id && status=1");
											while($row = mysql_fetch_array($result))
											{
												echo 
												"<div class='row'>
													<div class='span1'>";
														if($row['name'] == "Admin")
														{
															echo "<b><font color='blue'>Admin :</font></b>";
														}
														else
														{
															echo "<b>$row[name] :</b>";
														}
														
													echo "</div>
													<div class='span5'>
														$row[comment]
													</div>
												</div><br/>";
											}
?>
									</div>
								</div>
							</div>
<?php
						}
?>
					</div>
							<div class="span6"><br/>
<?php									
								$result1 = Database::getInstance()->query("SELECT * FROM song_details WHERE album_id='$album_id'");
								$rowCount = mysql_num_rows($result1);
								if(empty($rowCount) || $rowCount=="")
								{
									echo "<a class='btn btn-large' href='#' onclick='goBack()'>Album is empty. Go to previous page</a>";
								}
								else
								{
									echo "<input style='' type='text' placeholder='search here . . .' id='search'>";
?>
									<div class="fb-like" data-href="https://www.facebook.com/bm.amarela" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
										
<?php
									echo "<table class='table table-striped' id='searchTable'>
										<tr>
											<th>Song Name</th>
											<th>Artist</th>
											<th>Contr. Artist</th>
											<th>Year</th>
											<th>Genre</th>
											<th>Added By <br/><font size='2px'>&nbsp;&nbsp;(Details)</font></th>
										</tr>";					
									while($row1 = mysql_fetch_array($result1))
									{
										echo "<tr><tbody><td><a href='$row1[song_link]' target='_blank'>" . $row1['song_name'] . "</a></td>";
										echo "<td>" . $row1['song_artist'] . "</td>";
										echo "<td>" . $row1['song_contributing_artist'] . "</td>";
										echo "<td>" . $row1['song_year'] . "</td>";
										echo "<td>" . $row1['song_genre'] . "</td>";
										$added_by = $row1['added_by'];
										$user_result = Database::getInstance()->query("SELECT * FROM user_details WHERE name='$added_by'");
										while($user_sql = mysql_fetch_array($user_result))
										{
											$user_id =  $user_sql['id'];
										}
										echo "<td><a href='#' onclick='resetMarks($user_id)'>" . $row1['added_by'] . "</td></tbody></tr>";
									}						
									echo "</table>";
									echo "<a class='btn btn-large' href='index.php'>Go to previous page</a>";
								}
?>
								<br/><br/>
<?php
								if($commment_available)
								{
									$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of show list' && status=1");
									$row = mysql_fetch_array($result, MYSQLI_ASSOC);
									if($row) 
									{
?>
										<div id="ad-right">
											<div style="text-align:right;"><font size=1>Advertisement</font></div>
<?php
												$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of show list' && status=1 order by rand() LIMIT 1");
												while($row = mysql_fetch_array($result))
												{
													echo "<a href='$row[ad_link]' target='_blank'><img src='advertise-image/$row[file_name]'  alt='$row[ad_title]' style='height:400px; width:710px' /></a>";
												}
?>
										</div>
<?php
									}
								}
?>
							</div>
<?php
						}
						else
						{
?>
							<br/>
							<div class="fb-like" data-href="https://www.facebook.com/bm.amarela" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
							<div class="span2"><br/>
<?php									
								$result1 = Database::getInstance()->query("SELECT * FROM song_details WHERE album_id='$album_id'");
								$rowCount = mysql_num_rows($result1);
								if(empty($rowCount) || $rowCount=="")
								{
									echo "<a class='btn btn-large' href='#' onclick='goBack()'>Album is empty. Go to previous page</a>";
								}
								else
								{
									echo "<input style='' type='text' placeholder='search here . . .' id='search'>";
									echo "<table class='table table-striped' id='searchTable'>
										<tr>
											<th>Song Name</th>
											<th>Added By <br/><font size='2px'>&nbsp;&nbsp;(Details)</font></th>
											<th>Song Details</th>										
										</tr>";					
									while($row1 = mysql_fetch_array($result1))
									{
										echo "<tr><tbody><td><a href='$row1[song_link]' target='_blank'>" . $row1['song_name'] . "</a></td>";
										$added_by = $row1['added_by'];
										$user_result = Database::getInstance()->query("SELECT * FROM user_details WHERE name='$added_by'");
										while($user_sql = mysql_fetch_array($user_result))
										{
											$user_id =  $user_sql['id'];
										}
										echo "<td><a href='#user_desc' onclick='userDetails($user_id)'>" . $row1['added_by'] . "</td>";
										echo "<td><a href='#song_desc' onclick='songDetails($row1[id])'>Know me</a></td></tbody></tr>";
									}						
									echo "</table>";
									echo "<a name='song_desc'></a>";
									echo "<div class='pg_title'><h5><div id='songDetails'></div></h5></div>";
									echo "<a name='user_desc'></a>";
									echo "<div class='pg_description'><p><div id='userDetails'></div></p></div>";
								}
								
								
								/* Advertisement: under song list in of each and every page for mobile */
								
								$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of show list' && status=1");
								$row = mysql_fetch_array($result, MYSQLI_ASSOC);
								if($row) 
								{
?>
									<div id="ad-right">
										<div style="text-align:right;"><font size=2>Advertisement</font></div>
<?php
											$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of show list' && status=1 order by rand() LIMIT 1");
											while($row = mysql_fetch_array($result))
											{
												echo "<a href='$row[ad_link]' target='_blank'><img src='advertise-image/$row[file_name]'  alt='$row[ad_title]' style='height:250px; width:710px' /></a>";
											}
?>
									</div>
<?php
								}
								
?>
							</div>
							<br/><br/>
<?php
							if($commment_available)
							{
?>
							<a name="comment"></a>
							<div class="row">
								<div class="span6">
									<div class='pg_title'><h4>Comments:</h4></div>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<div class='pg_description'>
										<?php
											$result = Database::getInstance()->query("SELECT * FROM comment_details where album_id=$album_id && status=1");
											while($row = mysql_fetch_array($result))
											{
												echo 
												"<div class='row'>
													<div class='span1'>";
														if($row['name'] == 'Admin')
														{
															echo "<b><font color='blue'>Admin :</font></b>";
														}
														else
														{
															echo "<b>$row[name] :</b>";
														}
												?>
													</div>
													<div class='span5'>
														<?php echo $row['comment']; ?>
													</div>
												</div><br/>
										<?php
											}
										?>
									</div>
								</div>
							</div>
<?php
							}
						}
?>
				</div>
			</div>
<?php
		}
?>
		<a name="disqus_comment"></a>
		<div class="container">
			<div class="row">
				<div class="span6">
					<div id="disqus_thread"></div>
					<script type="text/javascript">
						/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
						var disqus_shortname = 'amarelakaakain'; // required: replace example with your forum shortname

						/* * * DON'T EDIT BELOW THIS LINE * * */
						(function() {
							var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
							dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
							(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						})();
					</script>
					<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
					<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
				</div>
				<div class="span6">
<?php
				/* Advertisement: right side of discuss box only for desktop */
				
				if(!$mobile_browser && !$commment_available)
				{
					$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of disqus box' && status=1");
					$row = mysql_fetch_array($result, MYSQLI_ASSOC);
					if($row) 
					{
?>
						<div id="ad-right">
							<div style="text-align:right;"><font size=1>Advertisement</font></div>
							<?php
								$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='Right side of disqus box' && status=1 order by rand() LIMIT 1");
								while($row = mysql_fetch_array($result))
								{
									echo "<a href='$row[ad_link]' target='_blank'><img src='advertise-image/$row[file_name]'  alt='$row[ad_title]' style='height:350px; width:600px' /></a>";
								}
							?>
						</div>
							
			<?php
					}
				}
			?>
				</div>
			</div>
		</div>
		<br/>
<?php
		$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='footer' && status=1");
		$row = mysql_fetch_array($result, MYSQLI_ASSOC);
		if($row) 
		{
?>
			<div class="container">
				<div class="row">
					<div class="span12">
						<div id="ad-right">
							<div style="text-align:right;"><font size=1>Advertisement</font></div>
							<?php
								$result = Database::getInstance()->query("SELECT * FROM ad_details WHERE ad_place='footer' && status=1 order by rand() LIMIT 1");
								while($row = mysql_fetch_array($result))
								{
									echo "<a href='$row[ad_link]' target='_blank'><img src='advertise-image/$row[file_name]'  alt='$row[ad_title]' style='height:170px; width:1200px' /></a>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
<?php
		}
?>
	</body>	
</html>
	<script>
		function validateText()
		{
			var x=document.forms["comment_form"]["name"].value;
			if (x==null || x=="")
			{
				alert("Name must be filled out");
				return false;
			}
			var x=document.forms["comment_form"]["comment_box"].value;
			if (x==null || x=="")
			{
				alert("Comment box should not be empty");
				return false;
			}
			var x=document.forms["comment_form"]["email"].value;
			if (x==null || x=="")
			{
				alert("Email id  must be filled out");
				return false;
			}
			else
			{
				var x=document.forms["comment_form"]["email"].value;
				var atpos=x.indexOf("@");
				var dotpos=x.lastIndexOf(".");
				if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
				{
					alert("Please enter a valid email-id");
					return false;
				}
			}
		}
	</script>
 <?php include "footer.php"; ?>