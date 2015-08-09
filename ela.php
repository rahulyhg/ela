<?php include_once("inc/create-db-structure.php"); ?>
<?php
    $album_name = "";
    $song_name = "";
    $is_streamable = FALSE;
    if (isset($_GET['a'])) {
        $album_name = textSafety($_GET['a']);
        $is_streamable = TRUE;
    } elseif (isset($_GET['s'])) {
        $song_name = textSafety($_GET['s']);
        $is_streamable = TRUE;
    } else {
        $is_streamable = FALSE;
        $url="index.php?err=UNKN_ENTRY";
		header("Refresh:0;URL=$url");
		exit(0);
    }
    if ($is_streamable && $album_name !== "") {
		$streamable_album_id = "";
		$album_id="";
		$album_image_location="";
		$album_type="";
		$get_streamable_album_details = "SELECT * FROM `streamable_album` WHERE album_name='$album_name'";
		$result = Database::getInstance()->query($get_streamable_album_details);
		while($row = mysql_fetch_array($result))
		{
			$streamable_album_id = $row['id'];
			$album_id = $row['album_id'];
			$album_image_name = $row['album_image_location'];
			$album_type = $row['album_type'];
			$meta_fb_desc = $row['meta_fb_desc'];
			$followers = $row['followers'];
		}
		if (!isset($streamable_album_id) || !$streamable_album_id || $streamable_album_id == "") {
			$url="index.php?err=NOT_STRMBLE";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		$PAGE_TITLE = $album_name . " | " . SITE_NAME;
		$PAGE_DESCRIPTION = $album_name . " " . $meta_fb_desc . " - A Bishnupriya Manipuri Album | Amar Ela - Site of Bishnupriya Manipuri songs under KAAKAI Newspaper.";
		$PAGE_KEYWORDS = $album_name . " songs , " + $album_name . " online songs, " . $album_name . "online play";
		$album_image_location = $ALBUM_IMAGE = "album-image/".$album_image_name;
		$is_ip_exist = FALSE;
		$current_ip_address = getIpAddress();
		$check_ip_address = "SELECT EXISTS(SELECT 1 FROM follower_details WHERE streamable_album_id = '$streamable_album_id' && ip_address = '$current_ip_address')";
		$check_ip_address_result = Database::getInstance()->query($check_ip_address);
		while($row = mysql_fetch_array($check_ip_address_result)){
			if ($row[0]){
				$is_ip_exist = TRUE;
			}
		}		
	}
	include "header-v2.php";
?>
    <script src="audioplayerengine/jquery.js"></script>
    <script src="audioplayerengine/amazingaudioplayer.js"></script>
    <link rel="stylesheet" type="text/css" href="audioplayerengine/initaudioplayer-1.css">
    <script src="audioplayerengine/initaudioplayer-1.js"></script>
	<script>
		$(document).ready(function(){
			$(".playBtnClass").hide();
			$("#spinner").hide();
		});
	</script>
		<br/><br/><br/>
		<div style="width:100%;">
			<div class="row">
				<div class="span10 bg-header-player" style="margin-left:2.8%">
				<br/>
					<div class='player-head'>
						<div class="" style="float:left">
							<img width="220px" src="<?php echo $album_image_location; ?>"/>
						</div>
						<div class="" style="float:left;">
								<p class="less-margin">&nbsp;&nbsp;&nbsp; <font size="6px"><?php echo $album_name; ?></font></p>
								<p class="less-margin">&nbsp;&nbsp;&nbsp; <i><?php echo $meta_fb_desc; ?></i></p>
								<br/>
								<p class="less-margin">&nbsp;&nbsp;&nbsp; 
									<a onclick="follow('<?php echo $streamable_album_id ;?>')" class="btn btn-info" style="border-radius: 0px;">
										<span id="followOrUnfollow"><?php if($is_ip_exist) {echo "Following"; } else { echo "Follow"; } ?></span>
										<img id="spinner" src="img/ajax-loader.gif"/>
									</a>
								</p>
								<p class="less-margin">&nbsp;&nbsp;&nbsp; Total <span id="totalFollowers"><?php echo $followers; ?></span> followers</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span10">
					<hr/>
					<div id="amazingaudioplayer-1" style="display:block;width:100%;height:auto;" class="">
						<ul class="amazingaudioplayer-audios" style="display:none;">
							<?php
							$get_streamable_songs_details = "SELECT song_details.song_name, song_details.song_link, song_details.song_artist, song_details.song_contributing_artist, song_details.song_genre, song_details.added_by FROM song_details INNER JOIN streamable_songs ON streamable_songs.streamable_album_id='$streamable_album_id' AND streamable_songs.song_id=song_details.id";
							$result = Database::getInstance()->query($get_streamable_songs_details);
							$countTotalTracks = 0;
							while($row = mysql_fetch_array($result))
							{
								$countTotalTracks++;
								$song_name = $row['song_name'];
								// $song_location = "audios/".$row['song_link'];
								$song_location = "audios/".$album_name."/".$song_name.".mp3";
								$song_artist = $row['song_artist'];
								$song_contribution_artist = $row['song_contributing_artist'];
								$song_genre = $row['song_genre'];
								$song_added_by = $row['added_by'];
							?>
							<li data-artist="<?php echo $song_artist; ?>" data-title="<?php echo $song_name ?>" data-album="<?php echo $album_name ?>" data-info="" data-image="<?php echo $album_image_location; ?>" data-duration="">
								<div class="amazingaudioplayer-source" data-src="<?php echo $song_location; ?>" data-type="audio/mpeg" />
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
				<div class="span3">
					<p class="text-center" style="font-size: 16px;"><u> Explore Similar Albums </u></p>
					<br/>
					<?php
						$maximum_albums_to_be_shown = $countTotalTracks;
						$get_similar_albums = "SELECT * FROM streamable_album WHERE album_type LIKE '%$album_type%' AND album_name != '$album_name' ORDER BY RAND() LIMIT $maximum_albums_to_be_shown";
						$get_similar_albums_result = Database::getInstance()->query($get_similar_albums);
						
						while($row = mysql_fetch_array($get_similar_albums_result))
						{
							$id = $row['id'];
								$image_location = "album-image/".$row['album_image_location'];
								$url = "http://localhost/ela/ela.php?a=$row[album_name]";
							?>
							<a href="<?php echo $url; ?>" target="_blank" style="position: relative; left: 0; top: 0; text-decoration:none;">
								<img width="60px" src="<?php echo $image_location; ?>" id="mainImageId<?php echo $id; ?>" onmouseover="mouseOnImage(<?php echo $id; ?>)" onmouseout="mouseOutOfImage(<?php echo $id; ?>)" style="position: relative; top: 0; left: 0;"/>
								<img width="20px" onmouseover="mouseOnImage(<?php echo $id; ?>)" class="playBtnClass" src="img/play_btn.png" id="playBtnId<?php echo $id; ?>" style="position: absolute; top: -1px; left: 21px;"/>
								<span onmouseover="mouseOnImage(<?php echo $id; ?>)" onmouseout="mouseOutOfImage(<?php echo $id; ?>)" id="albumNameId<?php echo $id; ?>">&nbsp;<?php echo $row['album_name']; ?></span>
							</a>
							
							<br/><br/>
							<?php
						}
						$total_no_of_similar_albums = mysql_num_rows($get_similar_albums_result);
						if ($total_no_of_similar_albums < $maximum_albums_to_be_shown) {
							$no_of_albums_left = $maximum_albums_to_be_shown - $total_no_of_similar_albums;
							$get_similar_albums = "SELECT * FROM streamable_album WHERE album_type != '$album_type' ORDER BY RAND() LIMIT $no_of_albums_left";
							$get_similar_albums_result = Database::getInstance()->query($get_similar_albums);
							
							while($row = mysql_fetch_array($get_similar_albums_result))
							{
								$id = $row['id'];
								$image_location = "album-image/".$row['album_image_location'];
								$url = "http://localhost/ela/ela.php?a=$row[album_name]";
							?>
							<a href="<?php echo $url; ?>" target="_blank" style="position: relative; left: 0; top: 0; text-decoration:none;">
								<img width="60px" src="<?php echo $image_location; ?>" id="mainImageId<?php echo $id; ?>" onmouseover="mouseOnImage(<?php echo $id; ?>)" onmouseout="mouseOutOfImage(<?php echo $id; ?>)" style="position: relative; top: 0; left: 0;"/>
								<img width="20px" onmouseover="mouseOnImage(<?php echo $id; ?>)" class="playBtnClass" src="img/play_btn.png" id="playBtnId<?php echo $id; ?>" style="position: absolute; top: -1px; left: 21px;"/>
								<span onmouseover="mouseOnImage(<?php echo $id; ?>)" onmouseout="mouseOutOfImage(<?php echo $id; ?>)" id="albumNameId<?php echo $id; ?>">&nbsp;<?php echo $row['album_name']; ?></span>
							</a>
							
							<br/><br/>
							<?php
							}
						}
							
					?>
					<br/><br/><br/><br/><br/>
					<script>
						function follow(streamableId){
							$("#spinner").show();
							var dataString = 'id='+ streamableId+"&add=follower";
							$.ajax({
								type: "POST",
								url: "ajax/follow.php",
								data: dataString,
								cache: false,
								success: function(html)
								{
									if (html.hasOwnProperty('isFollowed') && html.hasOwnProperty('followers')) {
										$("#spinner").hide();										
										$("#totalFollowers").html(html.followers);
										if (html.isFollowed) {
											$("#followOrUnfollow").html("Following");
										} else {
											$("#followOrUnfollow").html("Follow");
										}
									}
								}
							});
						}
						
						function mouseOnImage(imageId) {
							$("#mainImageId"+imageId).addClass("contrast sidebarlink");
							$("#playBtnId"+imageId).show().addClass("sidebarlink");
							$("#albumNameId"+imageId).addClass("invert sidebarlink");
						}
						
						function mouseOutOfImage(imageId) {
							$(".playBtnClass").hide();
							$("#mainImageId"+imageId).removeClass("contrast");
							$("#albumNameId"+imageId).removeClass("invert");
						}
					</script>
				</div>
			</div>
		<?php	
		if ($is_streamable && $song_name !== "") {
			
		}			
		?>
		</div>
	</body>
</html>