<?php 
    include_once("database.class.php");
    include_once("common.class.php");
    
    //Database::getInstance()->begin();
    $create_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    Database::getInstance()->query($create_db);
    
    $create_playable_album_table = "CREATE TABLE IF NOT EXISTS streamable_album (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
            . "album_name VARCHAR(250), album_image_location VARCHAR(255), album_type VARCHAR(50))";
    Database::getInstance()->query($create_playable_album_table);
    
    $create_playable_songs_table = "CREATE TABLE IF NOT EXISTS streamable_songs ()"
    
?>