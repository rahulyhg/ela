<?php
include "header.php";
if(!isset($_SESSION['flag']) || empty($_SESSION['flag']) || !isset($_SESSION['email']) || empty($_SESSION['email']))
{
	$url="index.php";
	header("Refresh:0;URL=$url");
	exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Amar Ela | Add User</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<script language="javascript" type="text/javascript">
		$(document).ready(function() {
				$('#search').keyup(function() {
						searchTable($(this).val());
				});
		});
	</script>
  </head>
	<?php
		$empty_name = false;
		$invalid_email = false;
		$age_error = false;
		$mobile_number_error = false;
		$user_added= false;
		$user_deleted= false;
		if(isset($_GET['code']) && isset($_GET['error']) && $_GET['code']==360 && $_GET['error']==1)
		{
			$empty_name = true;
		}
		if(isset($_GET['code']) && isset($_GET['error']) && $_GET['code']==120 && $_GET['error']==2)
		{
			$invalid_email = true;
		}
		if(isset($_GET['code']) && isset($_GET['error']) && $_GET['code']==332 && $_GET['error']==3)
		{
			$age_error = true;
		}
		if(isset($_GET['code']) && isset($_GET['error']) && $_GET['code']==440 && $_GET['error']==4)
		{
			$mobile_number_error= true;
		}
		if(isset($_GET['success']) && isset($_GET['access']) && $_GET['success']==1 && $_GET['access']==699)
		{
			$user_added= true;
		}
		if(isset($_GET['success']) && isset($_GET['access']) && $_GET['success']==1 && $_GET['access']==600)
		{
			$user_deleted= true;
		}
		if(isset($_GET['name'])){$name = $_GET['name'];}
		if(isset($_GET['age'])){$age = $_GET['age'];}
		if(isset($_GET['email_id'])){$email_id = $_GET['email_id'];}
		if(isset($_GET['mobile_number'])){$mobile_number = $_GET['mobile_number'];}
		if(isset($_GET['address'])){$address = $_GET['address'];}
	?>
	<body>
		<br/><br/><br/>
		<div style="width:1200px; margin:0 auto;">
			<div class="container">
				<div class="row">
					<div class="span5">
						<form method="POST" action="process/add-user.php" enctype="multipart/form-data" name="myform" id="myform">
							<h4>Please enter the details</h2>
							<?php
								if($empty_name){echo "<span class='text-error'>Please enter the name</span><br/>";}
								if($invalid_email){echo "<span class='text-error'>Please enter a valid email id</span><br/>";}
								if($age_error){echo "<span class='text-error'>Please enter valid age</span><br/>";}
								if($mobile_number_error){echo "<span class='text-error'>Please enter a valid mobile number</span><br/>";}
								if($user_added){echo "<span class='text-info'>User added successfully</span><br/>";}
								if($user_deleted){echo "<span class='text-info'>User deleted successfully</span><br/>";}
							?>
							<br/>
							<div class="container">
								<div class="row">
									<div class="span2">Full Name<font size="2px"><i>(Required)</i></font></div>
									<div class="span9"><input type="text" tabindex="1" maxlength="60" id="name" name="name" value="<?php if(isset($name)){echo $name;} ?>"/></div>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="span2">Gender</font></div>
									<div class="span9">
										<input type="radio" tabindex="2" name="gender" value="Male" checked> Male
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="gender" value="Female"> Female
									</div>
								</div>
							</div>
							<br/>
							<div class="container">
								<div class="row">
									<div class="span2">Age</div>
									<div class="span9"><input type="text" tabindex="3" maxlength="60" id="name" name="age" value="<?php if(isset($age)){echo $age;} ?>"/></div>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="span2">Email-id</div>
									<div class="span9"><input type="text" tabindex="4" maxlength="60" id="name" name="email_id" value="<?php if(isset($email_id)){echo $email_id;} ?>"/></div>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="span2">Mobile No.</div>
									<div class="span9"><input type="text" tabindex="5" maxlength="60" id="name" name="mobile_number" value="<?php if(isset($mobile_number)){echo $mobile_number;} ?>"/></div>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="span2">Address</div>
									<div class="span9"><input type="text" tabindex="6" maxlength="60" id="name" name="address" value="<?php if(isset($address)){echo $address;} ?>"/></div>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="span2">Select User Image</div>
									<div class="span9"><input tabindex="7" class="btn btn-danger" type="file" name="file" id="file"><span class="text-error"></span></div>
									
								</div>
							</div>	
							<div class="container">
								<div class="row">
									<div class="span2">										
										<input class="btn" tabindex="8" type="submit" name="user_details_btn" value="Submit">
									</div>
								</div>
							</div>	
						</form>
					</div>	
				</div>	
				<div class="row">
					<div class="span7">
						<br/>
						<div class="container">
							<div class="row">
								<div class="span10">
									<input style="" type="text" placeholder="search here . . ." id="search">
									<table class='table table-bordered table-striped' id='searchTable'>
										<tr>
											<th>Name</th>
											<th>Gender</th>
											<th>Age</th>
											<th>Email-id</th>
											<th>Mobile Number</th>
											<th>Address</th>
											<th>User Image</th>
											<th>Update</th>
											<th>Delete</th>
										</tr>											
										<?php
											$result = Database::getInstance()->query("SELECT * FROM user_details");
											while($row = mysql_fetch_array($result))
											{
												echo "<tr><td>$row[name]</td>";
												echo "<td>$row[gender]</td>";
												echo "<td>$row[age]</td>";
												echo "<td>$row[email_id]</td>";
												echo "<td>$row[mobile_number]</td>";
												echo "<td>$row[address]</td>";
												echo "<td><img src='user-image/$row[file_name]'  alt='$row[name]' width='130' height='200' /></td>";
												echo "<td><a href='update-user.php?name=$row[name]&gender=$row[gender]&age=$row[age]&email_id=$row[email_id]&mobile_number=$row[mobile_number]&address=$row[address]&id=$row[id]'>Update</a></td>";
												echo "<td><a href='process/update-user.php?id=$row[id]&access=420'>Delete</a></td></tr>";
											}
										?>
									</table>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>					
		</div>
	</body>	
</html>
