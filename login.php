<!DOCTYPE HTML>

    <?php
    // Starts the session
    session_start();

    // Get the database instance to check login
    $db = mysqli_connect('dbserver.engr.scu.edu', 'kbhimjiy', '00001082101', 'sdb_kbhimjiy');

    // Put dummy values for now, we can also retrieve later.
    $username = "";
    $password = "";
    $userType = "";

    // Error message
    $error = "";

    // Checks to see if user and password entered, matches or not. Here we pull from the database and check.
    if (isset($_POST['email']) && isset($_POST['password'])) 
    {
        $password = md5($_POST['password']);
        $password = mysqli_real_escape_string($db, $password);
        $email = mysqli_real_escape_string($db, $_POST['email']);

        foreach ($_POST['UserType'] as $select)
        {
            $userType = mysqli_real_escape_string($db, $select);
        }

        $result = mysqli_query($db, "SELECT * FROM $userType WHERE email = '$email' AND password = '$password'");
        $row = mysqli_fetch_row($result);

        if ($email == $row[1] && $password == $row[2]) // If matches pull from dB
        {
            session_start();

            $_SESSION['loggedIn'] = true;
            if ($userType == "User") {
				$_SESSION['uid'] = $row[0];
				echo "<script>window.location.href = 'student-view.php';</script>";

            }
            else {
				$_SESSION['pid'] = $row[0];   
                echo "<script>window.location.href = 'form.php';</script>";

            }
			echo 'SUCCESS';        
        } else { 
            $_SESSION['loggedIn'] = false;
            $error = "Invalid username and password!";
        }
    }

    ?>


<html>
    <head>
        <title>Login Page</title>
    </head>
    
    <body>
        <!-- Output error message -->
        <?php echo $error; ?>
        
        <!-- form for login -->
        <form method="post" action="login.php">
            <label >Email:</label>
            <br />
            <input type="text" name="email" id="email"><br/>

            <label >Password:</label>
            <br />
            <input type="password" name="password" id="password"><br/>

            <select name="UserType[]" single>
                <option value="User">Student</option>
                <option value="Professor">Professor</option>
            </select>

            <input type="submit" value="Log In">
        </form>
    </body>
</html>
