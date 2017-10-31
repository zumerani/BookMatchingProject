<?php
session_start();

$first_name = '';
$last_name = '';
$email    = "";
$password = '';
$errors = array(); 
$userType = "";

$_SESSION['success'] = "";

$db = mysqli_connect('dbserver.engr.scu.edu', 'kbhimjiy', '00001082101', 'sdb_kbhimjiy');

if (isset($_POST['reg_user'])) {
	// receive all input values from the form
	$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	echo "We are here.";

	foreach ($_POST['UserType'] as $select)
	{
		$userType = mysqli_real_escape_string($db, $select);
	}
	if (empty($first_name)) { array_push($errors, "First name is required"); }
	if (empty($last_name)) { array_push($errors, "Last name is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password)) { array_push($errors, "Password is required"); }

	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database

		$query = "INSERT INTO $userType (email, password, first_name, last_name) 
				  VALUES('$email', '$password', '$first_name', '$last_name')";

		mysqli_query($db, $query);

		if ($userType == "Student") 
		{
			$_SESSION['uid'] = $row[0];
			//header('location: student.php'); // Uncomment once done
		}
		else 
		{
			$_SESSION['pid'] = $row[0];
			//header('location: professor.php'); // Uncomment once done
		}
	}
}

?>
