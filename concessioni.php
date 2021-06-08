<?php

	require_once('config.php');
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prenoto Mare</title>

        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">
         <link rel="stylesheet" href="css/style.css"> 
        <style>
            .ftco-navbar-light .navbar-nav > .nav-item > .nav-link:hover{
                color:#007bff !important;
            }
	    </style>
    </head>

	<body style="background-image: url('images/immagine-sfondo.jpg');">
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="background-color: #212529 !important; color: aliceblue;!important">
            <div class="container" >
                <a class="navbar-brand" href="index.php">PRENOTO SPIAGGIA<span>CONCESSIONI</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item "><a href="concessioni.php" class="nav-link">Concessioni</a></li>

                    </ul>
                </div>
            </div>
	    </nav>
        <!-- <br><br><br><br><br><br><br> -->
        <div class = "container" style  = "padding-top  : 200px;">
            <div class = "row">
                <div class="col-md-12">
                    <div class="card-box table-responsive">                     
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%; background-color : white;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Stabilimento Balneare</th>
                                    <th>Numero Concessione</th>
                                    <th>Telefono</th>
                                    <th>Indirizzo</th>
                                    <th>Prenota</th>
                                </tr>
                            </thead>
                            <tboydy>
                                <?php
                                    $rs = mysqli_query($conn, "SELECT chalet_id, ragione_sociale,numero_concessione, telefono, CONCAT(indirizzo,' , ',cap,' - ',citta, ' (',provincia, ')') AS indirizzocompleto 
                                    FROM chalet ");

                                    while($row = mysqli_fetch_array($rs)) {
                                        echo "<tr>";
                                        echo "<td>".$row['ragione_sociale']."</td>";
                                        echo "<td>".$row['numero_concessione']."</td>";
                                        echo "<td>".$row['telefono']."</td>";
                                        echo "<td>".$row['indirizzocompleto']."</td>";
                                        echo "<td> 
                                                <form action='book.php' class='search-property-1' method= 'POST'>
                                                    <a href='book.php' class='btn btn-primary' role = 'button'>
                                                        <button class='btn btn-primary' type='submit' value = ".$row['chalet_id']." id= 'Submit' name= 'Submit'  class='form-control btn btn-primary'>PRENOTA</button>
                                                    </a>
                                                </form>
                                            </td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
          
        <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Datatables -->
        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>


        <!-- Custom Theme Scripts -->
        <script src="build/js/custom.min.js"></script>
	</body>
</html>
