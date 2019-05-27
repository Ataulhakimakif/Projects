<?php require_once("includes/header.php");?>

<?php

	$user= new Users();
	
	if(isset($_POST['submit']))
	{
		if($user)
		{
		$user->username   =	$_POST['username'];
		$user->first_name =	$_POST['first_name'];
		$user->last_name  =	$_POST['last_name'];
		$user->password   =	$_POST['password'];
		
		$user->set_files($_FILES['user_image']);
		
		
		
		$user->save_user_and_image();
		?>
		
		<script>
		
		alret("New user has been added to the system");
		</script>
		<?php
		redirect("login.php");
		}
	}


//$users= user::find_all();

 ?>

<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"></h4>
	
<form id="login-id" action="" method="post" enctype="multipart/form-data">

<div class="col-md-6 col-md-offset-3">

<div class="foem-group">

<input type="file" name="user_image">

</div>

<div class="form-group">
	<label for="first_name">First Name</label>
	<input type="text" class="form-control" name="first_name" >

</div>	

<div class="form-group">
	<label for="last_name">Last Name</label>
	<input type="text" class="form-control" name="last_name">

</div>

<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</div>

</form>


</div>