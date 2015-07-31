<?php
	include "../inc/database.class.php";
	include "../inc/common.class.php";
	$id = textSafety($_GET['user_id']);
	$result = Database::getInstance()->query("SELECT * FROM user_details WHERE id='$id'");
	while($row = mysql_fetch_array($result))
	{
		$id = $row['id'];
		if(isset($row['name'])){$name = $row['name'] ;}
		if(isset($row['gender'])){$gender = $row['gender'] ;}
		if(isset($row['age'])){$age = $row['age'] ;}
		if(isset($row['email_id'])){$email_id = $row['email_id'] ;}
		if(isset($row['mobile_number'])){$mobile_number = $row['mobile_number'] ;}
		if(isset($row['address'])){$address = $row['address'] ;}
		if(isset($row['album_image'])){$album_image = $row['album_image'] ;}
		if(isset($row['file_name'])){$file_name = $row['file_name'] ;}
	}
	//echo "<img src='display-image.php?id=$id&tableName=user_details' border='5' alt='User Image' width='130' height='180' /><br/><br/>";
	echo "<img src='user-image/$file_name'  alt='$row[name]' border='5' width='130' height='180' /><br/><br/>";
	echo "<b>Name : </b>" . $name . "<br/>";
	echo "<b>Gender : </b>" . $gender . "<br/>";
	echo "<b>Age : </b>" . $age . "<br/>";
	echo "<b>Email : </b>" . $email_id . "<br/>";
	echo "<b>Dial : </b>" . $mobile_number . "<br/>";
	echo "<b>Address : </b>" . $address . "<br/>";
?>