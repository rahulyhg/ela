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
	if(isset($_POST['user_details_btn']))
	{
		$name = textSafety($_POST['name']);
		$gender = textSafety($_POST['gender']);
		$age = textSafety($_POST['age']);
		$email_id = textSafety($_POST['email_id']);
		$mobile_number = textSafety($_POST['mobile_number']);
		$address = textSafety($_POST['address']);
		
		if($name=="" || $gender=="")
		{
			$url="../add-user.php?error=1&code=360&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email_id) && $email_id != "")
		{
			$url="../add-user.php?error=2&code=120&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($age=="")
		{
			$age = "00";
		}
		if($mobile_number=="")
		{
			$mobile_number = "0000000000";
		}
		if(!is_numeric($age) || strlen($age) != 2)
		{				
			$url="../add-user.php?error=3&code=332&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if(!is_numeric($mobile_number) || strlen($mobile_number) != 10)
		{				
			$url="../add-user.php?error=4&code=440&name=$name&age=$age&email_id=$email_id&mobile_number=$mobile_number&address=$address";
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
		
		
		$file_name = "";
		$file_name = uploadImage("user-image");
		$content = "";
		
		$sql = "insert into user_details (name, gender, age, email_id, mobile_number, address, album_image, file_name) values ('$name','$gender','$age','$email_id','$mobile_number','$address', '$content', '$file_name')";		
		$result = Database::getInstance()->insertRecord($sql);
		$url="../add-user.php?success=1&access=699";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	
	

?>