<?php
	include "../inc/database.class.php";
	include "../inc/common.class.php";
	session_start();
	if(!isset($_SESSION['flag']) || empty($_SESSION['flag']) || !isset($_SESSION['email']) || empty($_SESSION['email']))
	{
		$url="../index.php";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	if(isset($_GET['id']) && isset($_GET['delete']) && $_GET['delete']=="yes")
	{
		$id = textSafety($_GET['id']);
		$album_id = textSafety($_GET['album_id']);
		$sql_song = "DELETE FROM song_details WHERE id=$id";
		$result = Database::getInstance()->deleteRecord($sql_song);
		$url="../upload-admin.php?error=0&delete=success&album_id=$album_id&access=valid";					
		header("Refresh:0;URL=$url");
		exit(0);
	}
	if(isset($_POST['update_details_btn']))
	{
		$song_name = textSafety($_POST['song_name']);
		$song_link = textSafety($_POST['song_link']);
		$id = textSafety($_POST['id']);
		$song_artist = textSafety($_POST['song_artist']);
		$song_contributing_artist = textSafety($_POST['song_contributing_artist']);
		$song_year = textSafety($_POST['song_year']);
		$song_genre = textSafety($_POST['song_genre']);
		$added_by = textSafety($_POST['added_by']);
		
		if($song_name=="" || $song_link=="")
		{
			$url="../update-song--admin.php?error=1&empty=song&access=valid&id=$id&song_link=$song_link&song_name=$song_name&song_artist=$song_artist&song_contributing_artist=$song_contributing_artist&song_year=$song_year&song_genre=$song_genre&added_by=$added_by";					
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$song_link))
		{
			$url="../update-song-admin.php?access=valid&invalid=url&id=$id&song_link=$song_link&song_name=$song_name&song_artist=$song_artist&song_contributing_artist=$song_contributing_artist&song_year=$song_year&song_genre=$song_genre&added_by=$added_by";	
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($song_year=="")
		{
			$song_year = "0000";
		}
		if(!is_numeric($song_year) || strlen($song_year) != 4)
		{
			$url="../update-song-admin.php?error=1&year=invalid&access=valid&id=$id&song_link=$song_link&song_name=$song_name&song_artist=$song_artist&song_contributing_artist=$song_contributing_artist&song_year=$song_year&song_genre=$song_genre&added_by=$added_by";					
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($song_artist=="")
		{
			$song_artist = "Unknown";
		}
		if($song_contributing_artist=="")
		{
			$song_contributing_artist = "Unknown";
		}
		if($song_genre=="")
		{
			$song_genre = "Unknown";
		}	
		if($added_by=="")
		{
			$added_by = "Unknown";
		}		
		$sql = "UPDATE `song_details` SET song_name='$song_name', song_link='$song_link', song_artist='$song_artist', song_contributing_artist='$song_contributing_artist', song_genre='$song_genre', song_year='$song_year', added_by='$added_by' WHERE id='$id'";
		$result = Database::getInstance()->updateRecord($sql);

		$result = Database::getInstance()->getRecord("SELECT album_id FROM song_details WHERE id=$id");
		$album_id = $result['album_id'];
		$url="../upload-admin.php?success=1&access=valid&album_id=$album_id";					
		header("Refresh:0;URL=$url");
		exit(0);
	}
	
	

?>