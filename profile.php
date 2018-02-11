<?php
//profile.php

include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header("location:login.php");
}

$query = "
SELECT * FROM user_details 
WHERE user_id = '".$_SESSION["user_id"]."'
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$name = '';
$email = '';
$user_id = '';
foreach($result as $row)
{
	$name = $row['user_name'];
	$email = $row['user_email'];
}

include('header.php');


?>

<div class="panel panel-default">
			<div class="panel-heading">Edit Profile</div>
			<div class="panel-body">
				<form method="post" id="edit_profile_form">
					<span id="message"></span>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $name; ?>" required />
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="user_email" id="user_email" class="form-control" required value="<?php echo $email; ?>" />
					</div>
					<hr />
					<label>Leave Password blank if you do not want to change</label>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" name="user_new_password" id="user_new_password" class="form-control" />
					</div>
					<div class="form-group">
						<label>Re-enter Password</label>
						<input type="password" name="user_re_enter_password" id="user_re_enter_password" class="form-control" />
						<span id="error_password"></span>	
					</div>
					<div class="form-group">
						<input type="submit" name="edit_prfile" id="edit_prfile" value="Edit" class="btn btn-info" />
					</div>
				</form>
			</div>
		</div>

<?php
include ('./footer.php');

?>