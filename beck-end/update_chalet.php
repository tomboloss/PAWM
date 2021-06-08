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
        $chalet_id = $_POST['chalet_id'];
        $ragione_sociale = $_POST['ragione_sociale'];
        $numero_concessione = $_POST['numero_concessione'];
        $telefono = $_POST['telefono'];
        $provincia = $_POST['provincia'];
        $citta = $_POST['citta'];
        $cap = $_POST['cap'];
        $indirizzo = $_POST['indirizzo'];
        $user_id = $_POST['user_id'];

        // checking empty fields
        if(empty($ragione_sociale) || empty($numero_concessione) || empty($telefono) || empty($provincia) || empty($citta)  || empty($cap) || empty($indirizzo) || empty($user_id)) {

            if(empty($ragione_sociale)) {
                echo "<font color='red'>Il campo Ragione Sociale è vuoto</font><br/>";
            }
            
            if(empty($numero_concessione)) {
                echo "<font color='red'>Il campo Numero Concessione è vuoto</font><br/>";
            }
    
            if(empty($telefono)) {
                echo "<font color='red'>Il campo Telefono è vuoto</font><br/>";
            }
    
            if(empty($provincia)) {
                echo "<font color='red'>Il campo Provicnia è vuoto</font><br/>";
            }
    
            if(empty($citta)) {
                echo "<font color='red'>Il campo Città è vuoto</font><br/>";
            }

            if(empty($cap)) {
                echo "<font color='red'>Il campo Città è vuoto</font><br/>";
            }
    
            if(empty($indirizzo)) {
                echo "<font color='red'>Il campo Città è vuoto</font><br/>";
            }
    
            if(empty($user_id)) {
                echo "<font color='red'>Il campo User Associato è vuoto</font><br/>";
            }

        } else {
            //updating the table
            /*
            $rs = mysqli_query($conn, "UPDATE users SET users.username='$username', users.email='$email', users.role_id='$role_id', 
                                            users.password='$password' WHERE users.user_id='$user_id'");
            */

                $rs = mysqli_query($conn, "UPDATE chalet SET chalet.ragione_sociale='$ragione_sociale', chalet.numero_concessione='$numero_concessione',
                                            chalet.telefono='$telefono', chalet.provincia ='$provincia',
                                            chalet.citta='$citta', chalet.cap='$cap', chalet.indirizzo='$indirizzo', chalet.user_id='$user_id'
                                            WHERE chalet.chalet_id='$chalet_id'");

                header('Location: chalet.php');
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

        <title>Modifica Chalet </title>

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
                                        if(isset($_GET["chalet_id"])) {
                                            $chalet_id = $_GET["chalet_id"];
                                            $rs = mysqli_query($conn, "SELECT chalet.ragione_sociale, chalet.numero_concessione, chalet.telefono,
                                                                        chalet.provincia, chalet.citta, chalet.cap, chalet.indirizzo, chalet.user_id
                                                                        FROM chalet WHERE chalet.chalet_id=$chalet_id");
                                            while($row = mysqli_fetch_array($rs)) {
                                                $ragione_sociale = $row['ragione_sociale'];
                                                $numero_concessione = $row['numero_concessione'];
                                                $telefono = $row['telefono'];
                                                
                                                $provincia = $row['provincia'];
                                                $citta = $row['citta'];
                                                $cap = $row['cap'];
                                                $indirizzo = $row['indirizzo'];
                                                $user_id = $row['user_id'];
                                            }
                                        }
                                        ?>
                                        <form action="update_chalet.php" method="POST">
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ragione Sociale <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="ragione_sociale" name="ragione_sociale" required="required" class="form-control" value="<?php echo $ragione_sociale; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Numero concessione <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="numero_concessione" name="numero_concessione" required="required" class="form-control" value="<?php echo $numero_concessione; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Telefono <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="telefono" name="telefono" required="required" class="form-control" value="<?php echo $telefono; ?>">
                                                </div>
                                            </div>
                                         
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Provincia <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="provincia" name="provincia" required="required" class="form-control" value="<?php echo $provincia; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Città <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="citta" name="citta" required="required" class="form-control" value="<?php echo $citta; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Cap <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="cap" name="cap" required="required" class="form-control" value="<?php echo $cap; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Indirizzo <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="indirizzo" name="indirizzo" required="required" class="form-control" value="<?php echo $indirizzo; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">User Associato</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <select class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                                                        <?php
                                                            $rs = mysqli_query($conn, "SELECT * FROM users WHERE role_id = '2'");
                                                            foreach($rs as $row){
                                                                $selected = "";
                                                                $user_id = "";
                                                                if($user_id == $row["user_id"]){
                                                                    $selected = "selected";
                                                                }
                                                                echo '<option '.$selected.' value="' .$row["user_id"].'">'.$row["username"].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="text" hidden value="<?php echo $chalet_id; ?>" name="chalet_id" />
                                            <button type="submit" class="btn btn-success" name="update">Modifica chalet</button>
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
