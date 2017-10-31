<?php
	session_start();
	ini_set('display_errors','On');
	error_reporting(E_ALL);

	$db_host = "dbserver.engr.scu.edu";
	$db_user = "kbhimjiy";
	$db_pass = "00001082101";
	$db_name = "sdb_kbhimjiy";
	$order_by = "";
	$search_text = "";

	$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name)
	        or die("Error" . mysqli_error($conn)); ?>

<?php if (isset($_POST['searchterm'])) { ?>
		<?php if (!empty($_POST['searchterm'])) { ?>
			<?php $search_text = mysqli_real_escape_string($conn, $_POST['searchterm']);
			$query = "SELECT title FROM Book WHERE title LIKE" . "'%$search_text%'".";";
			$result = $conn->query($query); ?>
			<?php if (mysqli_num_rows($result) == 0) { ?>
				<ul>
					<li>There are no books with that string pattern. Please search again!</li>
				</ul>
			<?php } else { ?>
				<ul>
					<?php while($row = mysqli_fetch_assoc($result)) { ?>
						<li><?php echo $row['title'] ?></li>	        	
					<?php } ?>
				</ul>
			<?php } ?>
		<?php } ?>
<?php } ?>

<?php if (isset($_POST['factorsearch'])) { ?>
		<?php if (!empty($_POST['factorsearch'])) { ?>
			<?php $search_text = mysqli_real_escape_string($conn, $_POST['factorsearch']);
			$query = "SELECT title FROM Book WHERE";
			$commaSplitted = explode(",", $search_text);
			$commaSplittedString = '';
			for ($x = 0; $x < sizeof($commaSplitted); $x++) {
				if ($x == sizeof($commaSplitted) - 1) {
					$splittedColon = explode(":", $commaSplitted[$x]);
			    	$commaSplittedString = $commaSplittedString . $splittedColon[1];
					if ($splittedColon[1] == 'lexile' || $splittedColon[1] == 'pages') {
						$query = $query . " " . $splittedColon[1] . "=" . $splittedColon[0] . " ";
					}else {
						$query = $query . " AND " . $splittedColon[1] . " LIKE " . "'" . "%" . $splittedColon[0] . "%" . "'" . " ";
					}
				}else {
			    	$splittedColon = explode(":", $commaSplitted[$x]);
			    	$commaSplittedString = $commaSplittedString . $splittedColon[1] . ",";
			    	if ($splittedColon[1] == 'lexile' || $splittedColon[1] == 'pages') {
						$query = $query . " " . $splittedColon[1] . "=" . $splittedColon[0] . " ";
					}else {
						$query = $query . " AND " . $splittedColon[1] . " LIKE " . "'" . "%" . $splittedColon[0] . "%" . "'" . " ";
					}
				}
			} 
			$query = $query . "ORDER BY $commaSplittedString" . ";";
			$result = $conn->query($query); ?>
			<?php if (mysqli_num_rows($result) == 0) { ?>
				<ul>
					<li>There are no books with that factor. Please search again!</li>
				</ul>
			<?php } else { ?>
				<ul>
					<?php while($row = mysqli_fetch_assoc($result)) { ?>
						<li><?php echo $row['title'] ?></li>	        	
					<?php } ?>
				</ul>
			<?php } ?>
		<?php } ?>
<?php } ?>

<?php
mysqli_close($conn);
?>
