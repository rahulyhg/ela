<?php
	ob_start();
	include "../inc/database.class.php";
	include "../inc/common.class.php";
	session_start();
	if(!isset($_SESSION['flag']) || empty($_SESSION['flag']) || !isset($_SESSION['email']) || empty($_SESSION['email']))
	{
		$url="../index.php";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	if(isset($_GET['album_id']) && isset($_GET['delete']) && $_GET['delete']=="yes")
	{
		$album_id = textSafety($_GET['album_id']);
		$sql_album = "DELETE FROM album_details WHERE id=$album_id";
		$result = Database::getInstance()->deleteRecord($sql_album);
		$sql_song = "DELETE FROM song_details WHERE album_id=$album_id";
		$result = Database::getInstance()->deleteRecord($sql_song);
		$url="../create-album-admin.php?error=0&delete=success#album_list";					
		header("Refresh:0;URL=$url");
		exit(0);
		
	}
	if(isset($_POST['update_album_btn']))
	{
		$album_name = textSafety($_POST['album_name']);
		$album_description = textSafety($_POST['album_description']);
		$album_type = textSafety($_POST['album_type']);
		$album_id = textSafety($_POST['album_id']);
		$recent = textSafety($_POST['recent']);
		if($album_name=="")
		{
			$url="../update-album-admin.php?error=1&empty=album";					
			header("Refresh:0;URL=$url");
			exit(0);
		}
		
		/*
		$filesize=$_FILES['ufile']['size'] / 1024;
		$filetype=$_FILES['ufile']['type'];
		$filename=$_FILES['ufile']['name'];
		$tmp_file=$_FILES['ufile']['tmp_name'];
		$filename=addslashes($filename);
		*/
		
		$file_name = "";
		$file_name = uploadImage("album-image");
		$content = "";
		
		if($file_name == "")
		{
			$sql = "UPDATE `album_details` SET album_name='$album_name', album_description='$album_description', album_type='$album_type', recent='$recent' WHERE id='$album_id'";
			$result = Database::getInstance()->updateRecord($sql);
		}
		else
		{
			//$content  = addslashes (file_get_contents($_FILES['ufile']['tmp_name']));
			$sql = "UPDATE `album_details` SET album_name='$album_name', album_description='$album_description', album_image='$content', album_type='$album_type', recent='$recent', file_name='$file_name' WHERE id='$album_id'";
			$result = Database::getInstance()->updateRecord($sql);
		}
		$url="../create-album-admin.php?error=0&access=update#$album_name";	
		header("Refresh:0;URL=$url");
		exit(0);
	}
	
	

?>