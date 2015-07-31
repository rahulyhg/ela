<?php
	ob_start();
	session_start();
	if(!isset($_SESSION['flag']) || empty($_SESSION['flag']) || !isset($_SESSION['email']) || empty($_SESSION['email']))
	{
		$url="../index.php";
		header("Refresh:0;URL=$url");
		exit(0);
	}
	else
	{
		include "../inc/database.class.php";
		include "../inc/common.class.php";
		
		if(isset($_POST['upload_ad']))
		{
			$ad_title = textSafety($_POST['ad_title']);
			$ad_link = textSafety($_POST['ad_link']);
			$ad_place = textSafety($_POST['ad_place']);
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
				$ad_link = "http://amarela.kaakai.in";
			}
			
			$file_name = "";
			$file_name = uploadImage("advertise-image");
			$content = "";
			
			/*
			if(empty($file_name))
			{
				$url="../upload-advertise.php?error=3&empty=image&ad_title=$ad_title&ad_link=$ad_link";					
				header("Refresh:0;URL=$url");
				exit(0);
			}
			*/
			
			//$content  = addslashes (file_get_contents($_FILES['ufile']['tmp_name']));
			$result = Database::getInstance()->insertRecord("insert into ad_details (ad_title, ad_link, ad_place, album_image, status, file_name) values ('$ad_title','$ad_link', '$ad_place', '$content','1', '$file_name')");

			$url="../upload-advertise.php?error=0&success=1";
			header("Refresh:0;URL=$url");
			exit(0);
		}
	}
?>