<?php
	session_start();
	echo $_SESSION['pid'];
	ini_set('display_errors','On');
	error_reporting(E_ALL);

	$db_host = "dbserver.engr.scu.edu";
	$db_user = "kbhimjiy";
	$db_pass = "00001082101";
	$db_name = "sdb_kbhimjiy";

	$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name)
	        or die("Error" . mysqli_error($conn)); ?>

	<?php 
		//$professor_id = $_SESSION[pid];
		$professor_id = 2;
		$title = $_POST['title'];
		$first_name = $_POST['firstName'];
		$last_name = $_POST['lastName'];
		if(isset($_POST['recommended']) && $_POST['recommended'] == 'Yes'){
			$recommended = 'Y';
		}
		else{
			$recommended = 'N';
		}
		$copyright = $_POST['copyright'];
		$lexile = $_POST['lexile'];
		$pages = $_POST['pages'];
		$topic = $_POST['topic'];
		$primary_protag = $_POST['primary'];
		$secondary_protag = $_POST['secondary'];

		$query = "INSERT INTO Book (pid, title, author_first_name, author_last_name, recommended,copyright, lexile, pages, topic, primary_protagonist, secondary_protagonist) VALUES ('$professor_id', '$title', '$first_name', '$last_name', '$recommended', '$copyright', '$lexile', '$pages', '$topic', '$primary_protag', '$secondary_protag');";

		$retval = mysqli_query($conn, $query);
		if (!$retval){
			echo "Error";
		} 
		else{
			//echo "<script>window.location.href = 'list_list.html';</script>";
		}
	?>

	<?php
		mysqli_close($conn);
	?>
?>
