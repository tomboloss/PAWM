<?php
	session_start();

	if(!isset($_SESSION['user_id'],$_SESSION['role_id']))
	{
		header('location:index.php?lmsg=true');
		exit;
	}

	require_once('../config.php');
  	
?>

<?php

    //deleting the row from table
    $rs = mysqli_query($conn, "DELETE FROM users WHERE users.user_id=$_GET[user_id]");
    header('Location: utenti.php');
    exit;
?>