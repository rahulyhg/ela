<?php 
    include_once("database.class.php");
    include_once("common.class.php");
    
    $create_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    Database::getInstance()->query($create_db);
    
    $create_playable_album_table = "CREATE TABLE IF NOT EXISTS streamable_album (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
            . "album_id INT(11), album_name VARCHAR(250), album_image_location VARCHAR(255), album_type VARCHAR(50), meta_fb_desc TEXT)";
    Database::getInstance()->query($create_playable_album_table);
    
    $create_playable_songs_table = "CREATE TABLE IF NOT EXISTS streamable_songs (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
            . "streamable_album_id INT(11), song_id INT(11))";
    Database::getInstance()->query($create_playable_songs_table);
	
	
	// Delete this in dev. Only for testing
	
	// $insert_playable_album_data = "INSERT INTO streamable_album (`album_id`, `album_name`, `album_image_location`, `album_type`, `meta_fb_desc`)
	// VALUES (42, 'Pungning', 'Pungning - Pocha Ojha  Bina Sinha.jpg', 'Devotional', '- By Pocha Ojha'), (0, 'Manipuri Mix', 'aar-koi-din-amarela.jpg', 'Meshup Manipuri', '- Mix by DJ Shantanu'), (50, 'Tor Ninge', 'tor ninge.jpg', '- By Alsi', 'Opopas')";
	// Database::getInstance()->query($insert_playable_album_data);
	
	// $insert_playable_songs = "INSERT INTO streamable_songs (`streamable_album_id`, `song_id`) VALUES (1, 160), (1, 161), (1, 162), (1, 163), (1, 164), (2, 210), (2, 211), (2, 212), (3, 243), (3, 244), (3, 245)";
	// Database::getInstance()->query($insert_playable_songs);
    // exit();
?>