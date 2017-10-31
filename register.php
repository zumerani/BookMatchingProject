<?php include('authenticate.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php"> 

		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="first_name">
		</div>
		<div class="input-group">
			<label>Last Name</label>
			<input type="text" name="last_name">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<select name="UserType[]" single> 
			<option value="User">Student</option>
			<option value="Professor">Professor</option>
		</select>
		<div>
			<?php if (count($errors) != 0) { ?>
				<?php foreach ($errors as $err) { ?>
					<p><?php $err ?></p>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>

		<p>
			Already a member? <a href="index.php">Sign in</a>
		</p>
	</form>
</body>
</html>
