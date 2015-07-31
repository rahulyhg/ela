<?php
include "../inc/database.class.php";
include "../inc/common.class.php";
if($_POST)
{
$q=textSafety($_POST['search']);
$result = Database::getInstance()->query("select album_name, id, album_image from album_details where album_name like '%$q%' or album_type like '%$q%' or album_description like '%$q%' order by id LIMIT 8");
while($row = mysql_fetch_array($result))
{
$album_name=$row['album_name'];
$b_username='<strong>'.$q.'</strong>';
$final_username = str_ireplace($q, $b_username, $album_name);
?>
<a href="show-list.php?album_id=<?php echo $row['id']; ?>">
<div class="show" align="left">
<span class="name"><?php echo $final_username; ?></span>
</div>
</a>
<?php
}
}
?>
