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
    if(isset($_POST['update'])){
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role_id = $_POST['role_id'];
        $password = $_POST['password'];
        $md5Password = md5($password);

        // checking empty fields
        if(empty($username) ||empty($email) || empty($role_id) || empty($md5Password)) {

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
        } else {
            //updating the table
                $rs = mysqli_query($conn, "UPDATE users SET users.username='$username', users.email='$email', users.role_id='$role_id', 
                                            users.password='$md5Password' WHERE users.user_id='$user_id'");

                header('Location: utenti.php');
                exit;
        }
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
        <link rel="icon" href="images/favicon.ico" type="image/ico" />

        <title>Modifica User </title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
        <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- starrr -->
        <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php
					require_once('menu/left-menu.php');
					require_once('menu/top-nav.php');
				?>
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Modifica User</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                        <?php
                                        if(isset($_GET["user_id"])) {
                                            $user_id = $_GET["user_id"];
                                            $rs = mysqli_query($conn, "SELECT users.username, users.email, users.role_id, users.password FROM users 
                                                                WHERE users.user_id=$user_id");
                                            foreach ($rs as $row) {
                                                $username = $row["username"];
                                                $email = $row["email"];
                                                $role_id = $row["role_id"];
                                                $password = $row["password"];
                                            }
                                        }
                                        ?>
                                        <form action="update_user.php" method="POST">
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Username <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="username" name="username" required="required" class="form-control" value="<?php echo $username; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="email" id="email" name="email" required="required" class="form-control" value="<?php echo $email;?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ruolo User</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <select class="form-control" id="role_id" name="role_id" >
                                                        <?php
                                                            $rs = mysqli_query($conn, "SELECT * FROM roles");
                                                            foreach($rs as $row){
                                                                $selected = "";
                                                                $role_id = "";
                                                                if($role_id == $row["role_id"]){
                                                                    $selected = "selected";
                                                                }
                                                                echo '<option '.$selected.' value="' .$row["role_id"].'">'.$row["ruolo_user"].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Password <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="password" id="password" name="password" required="required" class="form-control" value="<?php echo $password;?>">
                                                </div>
                                            </div>
                                            <input type="text" hidden value="<?php echo $user_id; ?>" name="user_id" />
                                            <button type="submit" class="btn btn-success" name="update">Modifica utente</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->
                <?php require_once('menu/footer.php'); ?>
            </div>
        </div>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../vendors/google-code-prettify/src/prettify.js"></script>
        <!-- jQuery Tags Input -->
        <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <!-- Switchery -->
        <script src="../vendors/switchery/dist/switchery.min.js"></script>
        <!-- Select2 -->
        <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
        <!-- Parsley -->
        <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Autosize -->
        <script src="../vendors/autosize/dist/autosize.min.js"></script>
        <!-- jQuery autocomplete -->
        <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <!-- starrr -->
        <script src="../vendors/starrr/dist/starrr.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>

    </body>
</html>
