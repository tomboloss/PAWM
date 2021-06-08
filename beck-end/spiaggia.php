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

        <title>Spiaggia</title>
<!-- Datatables -->
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
				
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Spiaggia</h2>
									<ul class="nav navbar-right panel_toolbox">
										<button class="btn btn-primary btn-block">
											<a href="add_ombrellone.php" style="color: white">Aggiungi Ombrellone</a>
										</button>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="row">
										<div class="col-sm-12">
											<div class="card-box table-responsive">
											
												<table id="datatable" class="table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th>Numero Ombr.</th>
                                                            <th>Fila Ombr.</th>
                                                            <th>Nome</th>
                                                            <th>Cognome</th>
                                                            <th>Saldato</th>
															<th>Chalet</th>
														</tr>
                                                    </thead>
                                                    <tboydy>
                                                        <?php
                                                            if(isset($_SESSION['user_id'])) {
                                                                $user_id = $_SESSION['user_id'];
                                                                $rs3 = mysqli_query($conn, "SELECT *  
                                                                FROM ombrelloni INNER JOIN chalet ON ombrelloni.chalet_id = chalet.chalet_id 
                                                                INNER JOIN users ON chalet.user_id = users.user_id 
                                                                left JOIN prenotazioni ON ombrelloni.ombrellone_id = prenotazioni.ombrelloni 
                                                                WHERE users.user_id= $user_id and prenotazioni.nome is not null && prenotazioni.cognome is not null");  
                                                                if (!$rs3) {
                                                                    printf("Error: %s\n", mysqli_error($conn));
                                                                    exit();
                                                                }
                                                                
                                                                foreach($rs3 as $row1){  
                                                                            $data_scadenza = time();

                                                                            //echo "<br> data scadenza: ".$data_scadenza ;

                                                                            $data_partenza = strtotime($row1['data_partenza']);

                                                                            //echo '<br>  data Partenza:'. $data_partenza;

                                                                            if($data_scadenza > $data_partenza){
                                                                                
                                                                                $rs3 = mysqli_query($conn, "DELETE  FROM prenotazioni WHERE prenotazioni.prenotazione_id=$row1[prenotazione_id]");
                                                                            }
                                                                }
                                                               
                                                                $rs = mysqli_query($conn, "SELECT ombrelloni.numero,ombrelloni.fila_id, ombrelloni.flag_saldo, chalet.ragione_sociale, users.username, prenotazioni.nome, prenotazioni.cognome
                                                                FROM ombrelloni INNER JOIN chalet ON ombrelloni.chalet_id = chalet.chalet_id 
                                                                INNER JOIN users ON chalet.user_id = users.user_id 
                                                                INNER JOIN prenotazioni ON ombrelloni.ombrellone_id = prenotazioni.ombrelloni 
                                                                WHERE users.user_id= $user_id");
                                                                
                                                                $rs1 = mysqli_query($conn, "SELECT ombrelloni.numero,ombrelloni.fila_id, ombrelloni.flag_saldo, chalet.ragione_sociale, users.username, prenotazioni.nome, prenotazioni.cognome, prenotazioni.ombrelloni
                                                                FROM ombrelloni INNER JOIN chalet ON ombrelloni.chalet_id = chalet.chalet_id 
                                                                INNER JOIN users ON chalet.user_id = users.user_id 
                                                                left JOIN prenotazioni ON ombrelloni.ombrellone_id = prenotazioni.ombrelloni 
                                                                WHERE users.user_id= $user_id ");  

                                                                    while($row = mysqli_fetch_array($rs)){ //stampo i prenotati
                                                                        echo "<tr>";
                                                                        echo "<td>".$row['numero']."</td>";
                                                                        echo "<td>".$row['fila_id']."</td>";
                                                                        echo "<td>".$row['nome']."</td>";
                                                                        echo "<td>".$row['cognome']."</td>";
                                                                        echo "<td>".$row['flag_saldo']."</td>";
                                                                        echo "<td>".$row['ragione_sociale']."</td>";
                                                                        echo "</tr>";
                                                                    }

                                                                     while($row = mysqli_fetch_array($rs1)){ //stampo i liberi
                                                                            $prenotazioni = $row["ombrelloni"];
                                                                            if($prenotazioni == null){
                                                                           
                                                                            echo "<tr>";
                                                                            echo "<td>".$row['numero']."</td>";
                                                                            echo "<td>".$row['fila_id']."</td>";
                                                                            echo "<td> </td>";
                                                                            echo "<td> </td>";
                                                                            echo "<td>".$row['flag_saldo']."</td>";
                                                                            echo "<td>".$row['ragione_sociale']."</td>";
                                                                            echo "<tr>";
                                                                        }
                                                                    }
                                                            }
                                                        
                                                        ?>
                                                    </tbody>
													<!--<tbody>
                                                        <tr>
                                                            <td>aaa</td>
                                                            <td>aaa</td>
                                                            <td>aaa</td>
                                                            <td>aaa</td>
                                                        </tr>
													</tbody>-->
												</table>
											</div>
										</div>
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
    <!-- Datatables -->
	<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src="../build/js/custom.min.js"></script>
	
	</body>
</html>
