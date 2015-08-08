<?php
	include "../inc/create-db-structure.php";
	header('Content-Type: application/json');
	if(isset($_POST['add']) && $_POST['add']=="follower" && isset($_POST['id'])) {
		$streamable_album_id = textSafety($_POST['id']);
		$ip_address = getIpAddress();
		$isFollowed = 0;
		$add_follower_query = "INSERT INTO follower_details (streamable_album_id, ip_address) SELECT * FROM (SELECT '$streamable_album_id', '$ip_address') AS tmp WHERE NOT EXISTS (SELECT ip_address FROM follower_details WHERE ip_address = '$ip_address' AND streamable_album_id = '$streamable_album_id') LIMIT 1";
		$add_follower_result = Database::getInstance()->query($add_follower_query);
		if (mysql_affected_rows()) {
			$increase_album_follower_count_query = "UPDATE streamable_album SET followers = followers + 1 WHERE id='$streamable_album_id'";
			$increase_album_follower_count_reselt = Database::getInstance()->query($increase_album_follower_count_query);
			$isFollowed = 1;
		} else {
			$remove_follower_query = "DELETE FROM follower_details WHERE streamable_album_id='$streamable_album_id' && ip_address='$ip_address'";
			$remove_follower_result = Database::getInstance()->query($remove_follower_query);
			if ($remove_follower_result) {
				$increase_album_follower_count_query = "UPDATE streamable_album SET followers = followers - 1 WHERE id='$streamable_album_id'";
				$increase_album_follower_count_reselt = Database::getInstance()->query($increase_album_follower_count_query);
				$isFollowed = 0;
			}
		}
		$select_total_followers = "SELECT followers FROM streamable_album WHERE id='$streamable_album_id'";
		$select_total_followers_result = Database::getInstance()->query($select_total_followers);		
		while($row = mysql_fetch_array($select_total_followers_result)) {
			$total_followers = $row['followers'];
		}
		$response = [
			"isFollowed" => $isFollowed,
			"followers" => $total_followers
		];
		echo json_encode($response);
	}
?>