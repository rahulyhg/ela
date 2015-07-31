<?php
include "header.php";
?>
	<title>Amar Ela | Song List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="Keywords" content="amar ela, Bishnupriya Manipuri Online Song, Bishnupriya, songs, Vishnupriya, Ela, manipuri ela, BM ela, Amar Thator Ela, songs.kaakai.in">
	<meta name="Description" content="Site of online Bishnupriya Manipuri music store under KAAKAI newspaper.">
<?php
$mobile_browser = false;
if(isMobile()){
		$mobile_browser = true;
	}
	else{
		$mobile_browser = false;
	}
?>
<?php
	if(isset($_GET['recent']))
		{$recent = $_GET['recent'];}
	else
		{$recent = 0;}
		
	if(isset($_GET['show']))
		{$show = $_GET['show'];}
	else
		{$show = 0;}
	
?>
<!DOCTYPE html>	
    <head>
		<script language="javascript" type="text/javascript">
			$(document).ready(function() {
				$('#search').keyup(function() {
						searchTable($(this).val());
				});
			});
			var recentAlbum = "<?php echo $recent; ?>";
			var showAlbum = "<?php echo $show; ?>";
			function showMore(counter){
				counter = counter + 5;
				window.location.href = "show-all.php?show="+showAlbum+"&recent="+recentAlbum + "&counter=" + counter;
			}			
		</script>
    </head>
		
	<?php		
		if(isset($_GET['counter']))
		{
			$counter = $_GET['counter'];
			$counter = intval($counter);
		}
		else
		{
			$counter = 5;
		}
	if($mobile_browser)
		{
			
	?>
			<div class="container">
				<div class="row">
					<div class="row">
						
						<table class="table table-striped" id='searchTable'>
							<thead>
								<tr>
									<?php
										$showAll = false;
										if(isset($_GET['recent']) && $_GET['recent']=="yes"){echo "<th>Recently Added</th>";}
										elseif(isset($_GET['show']) && $_GET['show']=="0"){echo "<th>Albums / Movies</th>"; $showAll = true;}
										elseif(isset($_GET['show'])){echo "<th>$_GET[show]</th>"; $album_type=$_GET['show'];}
										else{$showAll = true;}										
									?>									
								</tr>
							</thead>
							<tbody>
							<?php
								$counter = intval($counter);
								$count_album = 1;
								if(isset($_GET['recent']) && $_GET['recent']=="yes")
								{
									$result = Database::getInstance()->query("SELECT * FROM album_details WHERE recent='yes' LIMIT $counter");
								}
								elseif($showAll)
								{
									$result = Database::getInstance()->query("SELECT * FROM album_details LIMIT $counter");
									
								}
								else
								{
									$result = Database::getInstance()->query("SELECT * FROM album_details WHERE album_type='$album_type' LIMIT $counter");
									
								}
								while($row = mysql_fetch_array($result))
								{
									$count_album++;
									echo "<tr><td><a href='show-list.php?album_id=$row[id]' style='text-decoration:none'><div class='span4 btn btn-lg btn-block' style='text-align: justify;'><img src='display-image.php?id=$row[id]&tableName=album_details'  alt='album image' width='80' height='100' />&nbsp;&nbsp;&nbsp;&nbsp;<b>$row[album_name]</b></div></a></td>";
								}
							?>
							</tbody>
						</table>
						<?php 
							if($counter < $count_album)
							{
						?>
								<div align='center'>
									<a href='#' class='btn btn-large' onclick='showMore(<?php echo $counter; ?>)'>Load More +</a>
								</div>
						<?php
							}
						?>
					</div>
				</div>		
			</div>
	<?php
		}
		else
		{
			$url="index.php";
			header("Refresh:0;URL=$url");
			exit(0);
		}
	?>
</html>
<?php include "footer.php"; ?>