<?php
/*	define("HOST","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","prenotazioni_ombrelloni");
*/
	define("HOST","localhost");
	define("DB_USER","prenotospiaggia");
	define("DB_PASS","");
	define("DB_NAME","my_prenotospiaggia");

	$conn = mysqli_connect(HOST,DB_USER,DB_PASS,DB_NAME);

	if(!$conn)
	{
		die(mysqli_error());
	}



	function getUserAccessRoleByID($id)
	{
		global $conn;

		$query = "select ruolo_user from roles where role_id = ".$role_id;

		$rs = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($rs);

		return $row['ruolo_user'];
	}

?>
