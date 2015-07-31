<?php
	include "../inc/database.class.php";
	include "../inc/common.class.php";
	
	if(isset($_POST['submit_message']))
	{
		$name = textSafety($_POST['name']);
		$email = textSafety($_POST['email']);
		$phone = textSafety($_POST['phone']);
		$subject = textSafety($_POST['subject']);
		$message = textSafety($_POST['message']);
		$address = textSafety($_POST['address']);
		if($name=="")
		{
			$url="../contact-us.php?error=1&empty=name&email=$email&phone=$phone&subject=$subject&message=$message&address=$address";					
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($email=="")
		{
			$url="../contact-us.php?error=2&empty=email&name=$name&email=$email&phone=$phone&subject=$subject&message=$message&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) && $email != "")
		{
			$url="../contact-us.php?error=5&invalid=email&name=$name&email=$email&phone=$phone&subject=$subject&message=$message&address=$address";			
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($address=="")
		{
			$url="../contact-us.php?error=6&empty=address&name=$name&email=$email&phone=$phone&subject=$subject&message=$message&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($subject=="")
		{
			$url="../contact-us.php?error=3&empty=subject&name=$name&email=$email&phone=$phone&subject=$subject&message=$message&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		if($message=="")
		{
			$url="../contact-us.php?error=4&empty=message&name=$name&email=$email&phone=$phone&subject=$subject&message=$message&address=$address";
			header("Refresh:0;URL=$url");
			exit(0);
		}
		
		$result = Database::getInstance()->insertRecord("insert into contact_message (name, email, phone, subject, message, address) values ('$name','$email', '$phone', '$subject','$message', '$address')");

		$url="../contact-us.php?error=0&success=1";
		header("Refresh:0;URL=$url");
		exit(0);
	}
?>