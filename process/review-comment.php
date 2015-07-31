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
	if(isset($_POST['review_btn']))
	{
		if(isset($_POST['check_comment']))
		{
			$check_comment = $_POST['check_comment'];
			foreach ($check_comment as $album_id)
			{
				$sql = "UPDATE `comment_details` SET status='1' WHERE album_id='$album_id'";
				$result = Database::getInstance()->updateRecord($sql);
			}	
		}
		else
		{
			$url="../review-comment.php?error=1&success=0";
			header("Refresh:0;URL=$url");
			exit(0);
		}
	}
	$url="../review-comment.php?error=0&success=1";
	header("Refresh:0;URL=$url");
	exit(0);
?>
