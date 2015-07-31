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
	if(isset($_POST['create_album_btn']))
	{
		$album_name = textSafety($_POST['album_name']);
		$album_description = textSafety($_POST['album_description']);
		$album_type = textSafety($_POST['album_type']);
		$recent = textSafety($_POST['recent']);
		if($album_name=="")
		{
			$url="../create-album-admin.php?error=1&empty=album";					
			header("Refresh:0;URL=$url");
			exit(0);
		}
		$result = Database::getInstance()->getRecord("SELECT * FROM album_details where album_name='$album_name'");
		if($result['album_name']==$album_name)
		{
			$album_id = $result['id'];
			$url="../create-album-admin.php?error=exist&invalid=access&album_id=$album_id";					
			header("Refresh:0;URL=$url");
			exit(0);
		}	
		
		
		$file_name = "";
		$file_name = uploadImage("album-image");
		$content = "";		
		
		$result = Database::getInstance()->insertRecord("insert into album_details (album_name, album_image, album_description, album_type, recent, file_name) values ('$album_name','$content', '$album_description', '$album_type', '$recent', '$file_name')");
		$result = Database::getInstance()->getRecord("SELECT id FROM album_details where album_name='$album_name'");
		$album_id = $result['id'];
		$url="../create-album-admin.php?error=0&access=valid&album_id=$album_id";					
		header("Refresh:0;URL=$url");
		exit(0);
	}
	
	

?>