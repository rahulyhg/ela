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
	if(isset($_POST['submit_details_btn']))
	{
		$song_name = textSafety($_POST['song_name']);
		$song_link = textSafety($_POST['song_link']);
		$album_id = textSafety($_POST['album_id']);
		$song_artist = textSafety($_POST['song_artist']);
		$song_contributing_artist = textSafety($_POST['song_contributing_artist']);
		$song_year = textSafety($_POST['song_year']);
		$song_genre = textSafety($_POST['song_genre']);
		$added_by = textSafety($_POST['added_by']);
		
		if($song_name=="" || $song_link=="")
		{
			$url="../upload-admin.php?error=1&empty=song&access=valid&album_id=$album_id&song_link=$song_link&song_name=$song_name&song_artist=$song_artist&song_contributing_artist=$song_contributing_artist&song_year=$song_year&song_genre=$song_genre&added_by=$added_by";					
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$song_link))
		{
			$url="../upload-admin.php?access=valid&invalid=url&album_id=$album_id&song_link=$song_link&song_name=$song_name&song_artist=$song_artist&song_contributing_artist=$song_contributing_artist&song_year=$song_year&song_genre=$song_genre&added_by=$added_by";	
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($song_year=="")
		{
			$song_year = "0000";
		}
		if(!is_numeric($song_year) || strlen($song_year) != 4)
		{
			$url="../upload-admin.php?error=1&year=invalid&access=valid&album_id=$album_id&song_link=$song_link&song_name=$song_name&song_artist=$song_artist&song_contributing_artist=$song_contributing_artist&song_year=$song_year&song_genre=$song_genre&added_by=$added_by";					
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
			$song_genre = "Unknown";
		}
		$result = Database::getInstance()->insertRecord("insert into song_details (album_id, song_name, song_link, song_artist, song_contributing_artist, song_year, song_genre, added_by) values ('$album_id','$song_name','$song_link','$song_artist','$song_contributing_artist','$song_year','$song_genre', '$added_by')");
		$url="../upload-admin.php?success=1&access=valid&album_id=$album_id";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	
	

?>