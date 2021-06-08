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

if(isset($_POST['Submit'])) {
	$username = $_POST['username'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];
	$password = $_POST['password'];
	$md5Password = md5($password);
	


	// checking empty fields
	if(empty($username) || empty($email) || empty($role_id) || empty($md5Password)) {

		if(empty($username)) {
			echo "<font color='red'>Il campo Nome è vuoto</font><br/>";
		}

		if(empty($email)) {
			echo "<font color='red'>Il campo Email è vuoto</font><br/>";
		}

        if(empty($role_id)) {
			echo "<font color='red'>Il campo Ruolo User è vuoto</font><br/>";
        }
        
		if(empty($md5Password)) {
			echo "<font color='red'>Il campo Password è vuoto</font><br/>";
        }
       
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {

		$res = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
		if($res->num_rows== 0) {
			$rs = mysqli_query($conn, "INSERT INTO users (users.username, users.email, users.role_id, users.password)
												VALUES ('$username','$email', '$role_id', '$md5Password')");
			header('Location: utenti.php');
			exit;
		} else {
			echo "Utente già esistente";
		}

	}
}
?>