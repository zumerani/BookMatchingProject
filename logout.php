<?php
session_start();

if ($_SESSION['loggedIn'])
{
    unset($_SESSION['loggedIn']);
}

if ($_SESSION['uid'])
{
    unset($_SESSION['uid']);
}
else
{
    unset($_SESSION['pid']);
}

echo "<script>window.location.href = 'login.php';</script>";
?>
