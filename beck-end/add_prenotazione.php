<?php
	session_start();

	if(!isset($_SESSION['user_id'],$_SESSION['role_id']))
	{
		header('location:index.php?lmsg=true');
		exit;
	}

	require_once('../config.php');
  	
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

        <title>Aggiungi Chalet </title>
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress 
		<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">-->
		<!-- iCheck 
		<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">-->

		<!-- bootstrap-progressbar 
		<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">-->
		<!-- JQVMap 
		<link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>-->
		<!-- bootstrap-daterangepicker 
		<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">-->

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
                                        <h2>Aggiungi Prenotazione</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                      
                                        <form action="add_prenotazione_action.php" method="POST">
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Nome<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="nome" name="nome" required="required" class="form-control" placeholder="Inserisci il nome">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Cognome <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="cognome" name="cognome" required="required" class="form-control" placeholder="Inserisci il cognome">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Telefono <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="cellulare" name="cellulare" required="required" class="form-control" placeholder="Inserisci il numero di telefono">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Inserire la propria email">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Data Arrivo <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="date" id="data_arrivo" name="data_arrivo" required="required" class="form-control" placeholder="Inserisci la data di arrivo">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">data_partenza <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="date" id="data_partenza" name="data_partenza" required="required" class="form-control" placeholder="Inserisci la data di partenza">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ombrelloni Disponibili <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <select class="form-control" id="ombrellone_id" name="ombrellone_id">

                                                        <?php
                                                        $user = $_SESSION['user_id'];

                                                        $rs = mysqli_query($conn, "SELECT *
                                                        FROM ombrelloni INNER JOIN chalet ON ombrelloni.chalet_id = chalet.chalet_id 
                                                        INNER JOIN users ON chalet.user_id = users.user_id 
                                                        left JOIN prenotazioni ON ombrelloni.ombrellone_id = prenotazioni.ombrelloni 
                                                        WHERE users.user_id= $user and prenotazioni.nome is null and prenotazioni.cognome is null "); 

                                                            foreach($rs as $row){

                                                                    $selected = "";
                                                                    $ombrellone = "";
                                                                 
                                                                    if($ombrellone == $row["ombrellone_id"]){
                                                                        $selected = "selected";
                                                                    }
                                                                echo '<option '.$selected.' value="' .$row["ombrellone_id"].'">'.$row["numero"].'</option>';                                                                
                                                            }
                                                        ?>
                                                    </select>                                                
                                                
                                                </div>
                                            </div>
                                        
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Quantit?? lettini<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="qta_lettini" name="qta_lettini" required="required" class="form-control" placeholder="Inserisci la quantit?? di lettini">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Quantit?? sdraie<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="qta_sdraie" name="qta_sdraie" required="required" class="form-control" placeholder="Inserisci la quantit?? di sdraie">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Quantit?? registe<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="qta_registe" name="qta_registe" required="required" class="form-control" placeholder="Inserisci la quantit?? di registe">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Chalet</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <select class="form-control" id="chalet_id" name="chalet_id">

                                                        <?php
                                                        $user = $_SESSION['user_id'];
                                                        $rs = mysqli_query($conn, "SELECT * FROM chalet WHERE user_id = $user ");
                                                            foreach($rs as $row){
                                                                $selected = "";
                                                                $chalet = "";
                                                                if($chalet == $row["chalet.id"]){
                                                                    $selected = "selected";
                                                                } 
                                                                echo '<option '.$selected.' value="' .$row["chalet_id"].'">'.$row["ragione_sociale"].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">User Associato</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <select class="form-control" id="user_id" name="user_id">

                                                        <?php
                                                        $user = $_SESSION['user_id'];
                                                        $rs = mysqli_query($conn, "SELECT * FROM users inner join chalet on users.user_id = chalet.user_id WHERE users.user_id = $user ");
                                                            foreach($rs as $row){
                                                                $selected = "";
                                                                $chalet = "";
                                                                if($chalet == $row["user.id"]){
                                                                    $selected = "selected";
                                                                } 
                                                                echo '<option '.$selected.' value="' .$row["user_id"].'">'.$row["username"].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success" name="Submit">Aggiungi Prenotazione</button>
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
		<!-- FastClick 
		<script src="../vendors/fastclick/lib/fastclick.js"></script>-->
		<!-- NProgress 
		<script src="../vendors/nprogress/nprogress.js"></script>-->
		<!-- Chart.js 
		<script src="../vendors/Chart.js/dist/Chart.min.js"></script>-->
		<!-- gauge.js 
		<script src="../vendors/gauge.js/dist/gauge.min.js"></script>-->
		<!-- bootstrap-progressbar -->
		<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
		<!-- iCheck 
		<script src="../vendors/iCheck/icheck.min.js"></script>-->
		<!-- Skycons 
		<script src="../vendors/skycons/skycons.js"></script>-->
		<!-- Flot 
		<script src="../vendors/Flot/jquery.flot.js"></script>
		<script src="../vendors/Flot/jquery.flot.pie.js"></script>
		<script src="../vendors/Flot/jquery.flot.time.js"></script>
		<script src="../vendors/Flot/jquery.flot.stack.js"></script>
		<script src="../vendors/Flot/jquery.flot.resize.js"></script>-->
		<!-- Flot plugins 
		<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
		<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
		<script src="../vendors/flot.curvedlines/curvedLines.js"></script>-->
		<!-- DateJS 
		<script src="../vendors/DateJS/build/date.js"></script>-->
		<!-- JQVMap 
		<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
		<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
		<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>-->
		<!-- bootstrap-daterangepicker 
		<script src="../vendors/moment/min/moment.min.js"></script>
		<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>-->

		<!-- Custom Theme Scripts -->
		<script src="../build/js/custom.min.js"></script>

    </body>
</html>