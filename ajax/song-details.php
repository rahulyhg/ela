<?php
	include "../inc/database.class.php";
	include "../inc/common.class.php";
	$id = textSafety($_GET['id']);
	$result = Database::getInstance()->query("SELECT * FROM song_details WHERE id='$id'");
	while($row = mysql_fetch_array($result))
	{
	
		if(isset($row['song_name'])){$song_name = $row['song_name'] ;}
		if(isset($row['song_artist'])){$song_artist = $row['song_artist'] ;}
		if(isset($row['song_contributing_artist'])){$song_contributing_artist = $row['song_contributing_artist'] ;}
		if(isset($row['song_year'])){$song_year = $row['song_year'] ;}
		if(isset($row['song_genre'])){$song_genre = $row['song_genre'] ;}
		if(isset($row['added_by'])){$added_by = $row['added_by'] ;}
	
	}	
	echo "<b>Song Name : </b>" . $song_name . "<br/>";
	echo "<b>Artist : </b>" . $song_artist . "<br/>";
	echo "<b>Contributing Artist : </b>" . $song_contributing_artist . "<br/>";
	echo "<b>Year : </b>" . $song_year . "<br/>";
	echo "<b>Genre : </b>" . $song_genre . "<br/>";
	echo "<b>Added By : </b>" . $added_by . "<br/><br/>";
?>