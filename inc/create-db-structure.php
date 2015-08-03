<?php 
    include_once("database.class.php");
    include_once("common.class.php");
    
    $create_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    Database::getInstance()->query($create_db);
    
    $create_playable_album_table = "CREATE TABLE IF NOT EXISTS streamable_album (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
            . "album_id INT(11), album_name VARCHAR(250), album_image_location VARCHAR(255), album_type VARCHAR(50), meta_fb_desc VARCHAR(255))";
    Database::getInstance()->query($create_playable_album_table);
    
    $create_playable_songs_table = "CREATE TABLE IF NOT EXISTS streamable_songs (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
            . "streamable_album_id INT(11), song_id INT(11))";
    Database::getInstance()->query($create_playable_songs_table);
    
?>