<?php
	include "../inc/database.class.php";
	include "../inc/common.class.php";
	if(isset($_POST['submit_comment']))
	{
		$comment_box = textSafety($_POST['comment_box']);
		$name = textSafety($_POST['name']);
		$email = textSafety($_POST['email']);
		$album_id = textSafety($_POST['album_id']);
		if($comment_box=="")
		{
			$url="../show-list.php?error=4&code=360&email=$email&comment_box=$comment_box&album_id=$album_id&name=$name#comment_box";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($name=="")
		{
			$url="../show-list.php?error=1&code=360&email=$email&comment_box=$comment_box&album_id=$album_id&name=$name#comment_box";
			header("Refresh:0;URL=$url");
			exit(0);
		}		
		if($email=="")
		{
			$url="../show-list.php?error=2&code=400&name=$name&email=$email&comment_box=$comment_box&album_id=$album_id#comment_box";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) && $email != "")
		{
			$url="../show-list.php?error=3&code=420&name=$name&email=$email&comment_box=$comment_box&album_id=$album_id#comment_box";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		$sql = "insert into comment_details (name, email, comment, album_id, status) values ('$name','$email','$comment_box', '$album_id', 0)";
		$result = Database::getInstance()->insertRecord($sql);
		$url="../show-list.php?error=0&msg=wait&album_id=$album_id#comment";
		header("Refresh:0;URL=$url");
		exit(0);
	}
?>
