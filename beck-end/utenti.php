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

        <title>Utenti</title>

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
<!-- Datatables -->
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
				<?php 
                    if($_SESSION['role_id'] == 1){
                ?>
                    
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Users</h2>
									<ul class="nav navbar-right panel_toolbox">
										<button class="btn btn-primary btn-block">
											<a href="add_user.php" style="color: white">Aggiungi User</a>
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
															<th>Username</th>
															<th>Email</th>
                                                            <th>Password Criptata Md5</th>
															<th>Ruolo Utente</th>
															<th>Azioni</th>
															<!--<th>Azioni</th>-->
														</tr>
                                                    </thead>
                                                    <tboydy>
                                                        <?php
                                                            $rs = mysqli_query($conn, "SELECT users.user_id, users.username, users.email, users.password, roles.ruolo_user
                                                                                        FROM users INNER JOIN roles ON users.role_id = roles.role_id");

                                                            foreach ($rs as $row) {
																echo "<tr>";
                                                                echo "<td>".$row['username']."</td>";
                                                                echo "<td>".$row['email']."</td>";
                                                                echo "<td>".$row['password']."</td>";
																echo "<td>".$row['ruolo_user']."</td>";
																echo "<td>
																		<a href=\"update_user.php?user_id=$row[user_id]\"><i class='fa fa-pencil fa-2x'></i></a>
																		<a href=\"delete_user.php?user_id=$row[user_id]\" onClick=\"return confirm('Sei sicuro di voler eliminare questo User?')\"><i class='fa fa-trash fa-2x'></i></a>
																	</td>";
                                                                echo "</tr>";
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
                    <?php
                    }else{
                        echo "NON HAI PERMESSI NECESSARI PER ACCEDERE A QUESTA PAGINA";
                    }
                    ?>
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
