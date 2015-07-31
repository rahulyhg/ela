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
	if(isset($_GET['id']) && isset($_GET['access']) && $_GET['access']==420)
	{
		
		$id = textSafety($_GET['id']);
		$sql_user = "DELETE FROM user_details WHERE id=$id";
		$result = Database::getInstance()->deleteRecord($sql_user);
		$url="../add-user.php?success=1&access=600";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	if(isset($_POST['update_details_btn']))
	{
		$name = textSafety($_POST['name']);
		$gender = textSafety($_POST['gender']);
		$age = textSafety($_POST['age']);
		$email_id = textSafety($_POST['email_id']);
		$mobile_number = textSafety($_POST['mobile_number']);
		$address = textSafety($_POST['address']);
		$id = textSafety($_POST['id']);
		
		if($name=="" || $gender=="")
		{
			$url="../update-user.php?error=1&code=360&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email_id) && $email_id != "")
		{
			$url="../update-user.php?error=2&code=120&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($age=="" || $age==0)
		{
			$age = "00";
		}
		if($mobile_number=="")
		{
			$mobile_number = "0000000000";
		}
		if(!is_numeric($age) || strlen($age) != 2)
		{				
			$url="../update-user.php?error=3&code=332&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if(!is_numeric($mobile_number) || strlen($mobile_number) != 10)
		{				
			$url="../update-user.php?error=4&code=440&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($email_id=="")
		{
			$email_id = "abc@xyz.com";
		}
		if($address=="")
		{
			$address = "Unknown";
		}
		
		$filesize=$_FILES['ufile']['size'] / 1024;
		$filetype=$_FILES['ufile']['type'];
		$filename=$_FILES['ufile']['name'];
		$tmp_file=$_FILES['ufile']['tmp_name'];
		$filename=addslashes($filename);
		if(empty($filesize) || empty($filetype) || empty($filename) || empty($tmp_file))
		{
			$sql = "UPDATE `user_details` SET name='$name', age='$age', gender='$gender', email_id='$email_id', mobile_number='$mobile_number', address='$address' WHERE id='$id'";
			$result = Database::getInstance()->updateRecord($sql);
		}
		else
		{
			$content  = addslashes (file_get_contents($_FILES['ufile']['tmp_name']));
			$sql = "UPDATE `user_details` SET name='$name', age='$age', gender='$gender', email_id='$email_id', mobile_number='$mobile_number', address='$address', album_image='$content' WHERE id='$id'";
			$result = Database::getInstance()->updateRecord($sql);
		}
		
		$url="../add-user.php?success=1&access=877";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	
	

?>