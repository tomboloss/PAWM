<?php
session_start();

require_once('../config.php');

if(isset($_POST['login'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$email 		= trim($_POST['email']);
		$password 	= trim($_POST['password']);
		$md5Password = md5($password);

		$sql = "select * from users where email = '".$email."' and password = '".$md5Password."'";
		$rs = mysqli_query($conn,$sql);
		$getNumRows = mysqli_num_rows($rs);
		if($getNumRows == 1)
		{
			$getUserRow = mysqli_fetch_assoc($rs);
			unset($getUserRow['password']);

			$_SESSION = $getUserRow;

			header('location:dashboard.php');
			exit;
		}
		else{
			$errorMsg = "Email o password sbagliato";
		}
	}
}

if(isset($_GET['logout']) && $_GET['logout'] == true){
	session_destroy();
	header("location:index.php");
	exit;
}

if(isset($_GET['lmsg']) && $_GET['lmsg'] == true){
	$errorMsg = "Effettua il login per vedere questa pagina";
}

?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Log-in | </title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome 
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
        <!-- NProgress 
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">-->
        <!-- Animate.css 
        <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">-->

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <?php
                            if(isset($errorMsg)){
                            echo '<div class="alert alert-danger">';
                            echo $errorMsg;
                            echo '</div>';
                            unset($errorMsg);
                            }
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                            <h1>Login</h1>
                            <div class="form-group">
                                <input class="form-control" id="exampleInputEmail1" name="email" type="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password" required>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
