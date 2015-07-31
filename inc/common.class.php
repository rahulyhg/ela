<?php
/*
*	similar to mysql_real_escape_string
*/
function textSafety($value)
{
	$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
	$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
	return trim(str_replace($search, $replace, $value));
}

function passwordSafety($value)
{
	$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
	$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
	return md5(str_replace($search, $replace, $value));
}

/*	
*	checking whether the browser is mobile browser or not
*/
function isMobile() 
{
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

/*
*	It will return the array of albums. e.g.: name_descriptio_id
*/
function getAlbumList($album_type)
{
	$album_list = array();
	if($album_type === "Recently Added"){
		$check = Database::getInstance()->query("SELECT * FROM album_details WHERE recent='yes'");
	} else {
		$check = Database::getInstance()->query("SELECT * FROM album_details WHERE album_type='$album_type'");
	}
	while($row = mysql_fetch_array($check))
	{
		$album_list[] = $row['album_name'] . "_" . $row['album_description'] . "_" . $row['id'];
	}		
	return $album_list;
}

/*
*	It is used in index for basic loading basic html
*	It will return the table of albums with css
*/
function getAlbumTable($album_type)
{
	$album_list = getAlbumList($album_type);
	echo "<table class='table table-striped' id='searchTable'>";
	echo "<tr><thead><th>$album_type</th></thead></tr>";
	foreach($album_list as $album_details)
	{
		$album = explode("_", $album_details);									
		echo "<tr>";
		echo "<td title='".$album[1]."'><a href='show-list.php?album_id=$album[2]' target='_blank'>$album[0]</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}

/*
*	Used in index.php
*	It will display the album list with proper css for desktop browser
*/
function getAlbumListWithContainer($album_type, $carousel_id)
{
	echo "<div class='container demo-1'>";
		echo "<div class='main'>";
			
				if($album_type=="All Albums")
				{
					$result = Database::getInstance()->query("SELECT * FROM album_details order by rand()");
					echo "<h4><font color='#6B786C'>$album_type</font> <a class='btn btn-success' href='album-wise.php'> See All</a></h4>";
			echo "<ul id='$carousel_id' class='elastislide-list'>";
				}
				elseif($album_type=="Recently Added")
				{
					$result = Database::getInstance()->query("SELECT * FROM album_details WHERE recent='yes' order by id DESC");
					echo "<h4><font color='#6B786C'>$album_type</font> <a class='btn btn-success' href='album-wise.php?code=559&access=1'> See All</a></h4>";
			echo "<ul id='$carousel_id' class='elastislide-list'>";
				}
				else
				{
					$result = Database::getInstance()->query("SELECT * FROM album_details WHERE album_type='$album_type' order by rand()");
					echo "<h4><font color='#6B786C'>$album_type</font> <a class='btn btn-success' href='album-wise.php?album_type=$album_type'> See All</a></h4>";
			echo "<ul id='$carousel_id' class='elastislide-list'>";
				}
				while($row = mysql_fetch_array($result))
				{
					echo "<li><a href='show-list.php?album_id=$row[id]'><img src='album-image/$row[file_name]'  alt='$row[album_name]' title='$row[album_name]' width='160' height='180' /></a></li>";
				}
			echo "</ul>";
		echo "</div>";
	echo "</div>";
}

/*
*	Used in index.php
*	It will display the album list with proper css for mobile browser
*/
function getMobileAlbumList($album_type)
{
	echo "<div class='container'>";
		echo "<div class='row'>";
			echo "<div class='span2'>";
				
			
		if($album_type == "Recently Added")
		{
			echo "<a href='show-all.php?recent=yes'>$album_type</a>";
			$result = Database::getInstance()->query("SELECT * FROM album_details WHERE recent='yes' LIMIT 3");
		}
		elseif($album_type == "All Albums")
		{
			echo "<a href='show-all.php?show=0'>$album_type</a>";
			$result = Database::getInstance()->query("SELECT * FROM album_details order by rand() LIMIT 5");
		}
		else
		{
			echo "<a href='show-all.php?show=$album_type'>$album_type</a>";
			$result = Database::getInstance()->query("SELECT * FROM album_details WHERE album_type='$album_type' order by rand() LIMIT 3");
		}
			echo "</div>";
		echo "</div>";
		while($row = mysql_fetch_array($result))
		{
			echo "<div class='row'><a href='show-list.php?album_id=$row[id]' style='text-decoration:none'><div class='span4 btn btn-lg btn-block' style='text-align: justify;'><img src='album-image/$row[file_name]'  alt='$row[album_name]' width='80' height='100' />&nbsp;&nbsp;&nbsp;&nbsp;$row[album_name]</div></a></div>";
		}		
	echo "</div>";
}

function uploadImage($folder_name)
{
	$file_name = "";
	if ($_FILES["file"]["error"] > 0) 
	{
	  echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 200000000)
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		} 
		else 
		{
			if (file_exists("../".$folder_name."/" . $_FILES["file"]["name"])) 
			{
				echo $_FILES["file"]["name"] . " already exists. ";
				//$file_name = $_FILES["file"]["name"];
			} 
			else 
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"../".$folder_name."/" . $_FILES["file"]["name"]);
				$file_name = $_FILES["file"]["name"];
			}
		}
	}
	return $file_name;
}
?>