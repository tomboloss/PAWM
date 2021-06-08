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
    $rs = mysqli_query($conn, "DELETE FROM chalet WHERE chalet.chalet_id=$_GET[chalet_id]");
    header('Location: chalet.php');
    exit;
?>