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
	if(isset($_GET['id']) && isset($_GET['id']) && $_GET['delete']=="yes")
	{
		$id = textSafety($_GET['id']);
		$sql_album = "DELETE FROM ad_details WHERE id=$id";
		$result = Database::getInstance()->deleteRecord($sql_album);

		$url="../manage-advertise.php?error=0&delete=success";
		header("Refresh:0;URL=$url");
		exit(0);
		
	}
	
	if(isset($_POST['update_ad']))
	{
		$ad_title = textSafety($_POST['ad_title']);
		$ad_link = textSafety($_POST['ad_link']);
		$ad_place = textSafety($_POST['ad_place']);
		$id = textSafety($_POST['id']);
		if($ad_title=="")
		{
			$url="../upload-advertise.php?error=1&empty=title&ad_link=$ad_link";					
			header("Refresh:0;URL=$url");
			exit(0);
		}

		if($ad_link != "")
		{
			if(!filter_var($ad_link, FILTER_VALIDATE_URL))
			{
				$url="../upload-advertise.php?error=2&invalid=link&ad_title=$ad_title&ad_link=$ad_link";					
				header("Refresh:0;URL=$url");
				exit(0);
			}
		}
		else
		{
			$ad_link = "http://songs.kaakai.in";
		}
		/*
		$filesize=$_FILES['ufile']['size'] / 1024;
		$filetype=$_FILES['ufile']['type'];
		$filename=$_FILES['ufile']['name'];
		$tmp_file=$_FILES['ufile']['tmp_name'];
		$filename=addslashes($filename);
		
		if(empty($filesize) || empty($filetype) || empty($filename) || empty($tmp_file))
		{
			$sql = "UPDATE `ad_details` SET ad_title='$ad_title', ad_link='$ad_link', ad_place='$ad_place', status=1 WHERE id='$id'";
			$result = Database::getInstance()->updateRecord($sql);
		}
		else
		{
			$content  = addslashes (file_get_contents($_FILES['ufile']['tmp_name']));
			$sql = "UPDATE `ad_details` SET ad_title='$ad_title', ad_link='$ad_link', ad_place='$ad_place', album_image='$content', status=1 WHERE id='$id'";
			$result = Database::getInstance()->updateRecord($sql);
		}	
		*/
		
		
		$file_name = "";
		$file_name = uploadImage("advertise-image");
		$content = "";
		
		if(empty($file_name))
		{
			$sql = "UPDATE `ad_details` SET ad_title='$ad_title', ad_link='$ad_link', ad_place='$ad_place', status=1 WHERE id='$id'";
			$result = Database::getInstance()->updateRecord($sql);				
		}
		else
		{
			$content  = addslashes (file_get_contents($_FILES['ufile']['tmp_name']));
			$sql = "UPDATE `ad_details` SET ad_title='$ad_title', ad_link='$ad_link', ad_place='$ad_place', album_image='$content', status=1, file_name='$file_name' WHERE id='$id'";
			$result = Database::getInstance()->updateRecord($sql);
		}

		$url="../manage-advertise.php?error=0&success=1";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	
	

?>