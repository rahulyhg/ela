<?php
include "../inc/database.class.php";
include "../inc/common.class.php";
	if(isset($_POST['loginBtn']))
	{
		$email = textSafety($_POST['email']);
		$password = md5(textSafety($_POST['password']));	
		if(isset($_POST['keep_me']))
		{
			$keep_me = textSafety($_POST['keep_me']);	
		}
		else
		{
			$keep_me = "no";
		}
		$sql = "SELECT * FROM admin WHERE email='$email' && password='$password'";
		$result = Database::getInstance()->query($sql);
		$row = mysql_fetch_array($result, MYSQLI_ASSOC);
		if($row)
		{
			if($keep_me == "yes")
			{
				setcookie("songs_email",$email,time() + (86400 * 30)); // 86400 = 1 day
				setcookie("songs_keep",$keep_me,time() + (86400 * 30)); // 86400 = 1 day
			}
			else
			{
				if(isset($_COOKIE['songs_email'])) 
				{
					unset($_COOKIE['songs_email']);
					setcookie('songs_email', '', time() - 3600); // empty value and old timestamp
				}
				if(isset($_COOKIE['songs_keep']))
				{
					unset($_COOKIE['songs_keep']);
					setcookie('songs_keep', '', time() - 3600); // empty value and old timestamp
				}
			}			
			session_start();
			$_SESSION['flag'] = true;
			$_SESSION['email'] = $email;
			$url="../review-comment.php?success=1";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		else
		{
			$url="../login.php?invalid=1&error=1";
			header("Refresh:0;URL=$url");
			exit(0);
		}
	}
?>