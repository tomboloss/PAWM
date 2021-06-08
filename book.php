<!--<?php
	
	require_once('config.php');
  	
?> -->

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
       <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />

        <title>Aggiungi Prenotazione </title>

        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Theme Style 
        <link href="../build/css/custom.min.css" rel="stylesheet">-->
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                
                <!-- page content -->
                <div class="right_col" role="main" style = "margin-left : 0px; padding: 40px 20px 40px 20px;">
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
                                       
                                        <form action="add_book_action.php" method="POST">
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
                                                    <input type="date" id="data_arrivo" name="data_arrivo"  min = "2019-01-01" max = "2025-01-01" required="required" class="form-control" placeholder="Inserisci la data di arrivo">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Data Partenza <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="date" id="data_partenza" name="data_partenza"  min = "2019-01-01" max = "2025-01-01" required="required" class="form-control" placeholder="Inserisci la data di partenza">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ombrelloni Disponibili <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                   
                                                    <select class="form-control" id="ombrellone_id" name="ombrellone_id">

                                                        <?php
                                                         if(isset($_POST['Submit'])) {
                                                            $chalet_id = $_POST['Submit']; //recupero il nome dello chalet per andare a prendere poi gli ombrelloni disponibili

                                                            $rs3 = mysqli_query($conn, "SELECT *  
                                                            FROM ombrelloni INNER JOIN chalet ON ombrelloni.chalet_id = chalet.chalet_id 
                                                            INNER JOIN users ON chalet.user_id = users.user_id 
                                                            left JOIN prenotazioni ON ombrelloni.ombrellone_id = prenotazioni.ombrelloni 
                                                            WHERE prenotazioni.chalet = $chalet_id and prenotazioni.nome is not null && prenotazioni.cognome is not null");   //tiro fuori tutti le prenotazioni relativi a quello chalet 
                                                            if (!$rs3) {
                                                                printf("Error: %s\n", mysqli_error($conn));
                                                                exit();
                                                            }
                                                            
                                                            foreach($rs3 as $row1){  //controllo se le prenotazioni sono scadute
                                                                        $data_scadenza = time();

                                                                        //echo "<br> data scadenza: ".$data_scadenza ;

                                                                        $data_partenza = strtotime($row1['data_partenza']);

                                                                        //echo '<br>  data Partenza:'. $data_partenza;

                                                                        if($data_scadenza > $data_partenza){ //se la prenotazione è scaduta la elimino e l'ombrellone tornerà libero, pronto per una nuova prenotazione
                                                                            
                                                                            $rs3 = mysqli_query($conn, "DELETE  FROM prenotazioni WHERE prenotazioni.prenotazione_id=$row1[prenotazione_id]");
                                                                        }
                                                            }  

                                                            $rs = mysqli_query($conn, "SELECT * 
                                                                                FROM chalet inner join ombrelloni on chalet.chalet_id = ombrelloni.chalet_id
                                                                                left JOIN prenotazioni ON ombrelloni.ombrellone_id = prenotazioni.ombrelloni 
                                                                                WHERE chalet.chalet_id = '$chalet_id'  and prenotazioni.nome is null and prenotazioni.cognome is null  ");
                                                            while($row = mysqli_fetch_array($rs)){

                                                                    $selected = "";
                                                                    $ombrellone = "";
                                                                 
                                                                    if($ombrellone == $row["ombrellone_id"]){
                                                                        $selected = "selected";
                                                                    }
                                                                echo '<option '.$selected.' value="' .$row["ombrellone_id"].'">'.$row["numero"].'</option>';                                                                
                                                            }
                                                        }
                                                        ?>
                                                    </select>                                                
                                                
                                                </div>
                                            </div>
                                        
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Quantità lettini<span >*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="qta_lettini" name="qta_lettini"  class="form-control" placeholder="Inserisci la quantità di lettini">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Quantità sdraie<span >*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="qta_sdraie" name="qta_sdraie"  class="form-control" placeholder="Inserisci la quantità di sdraie">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Quantità registe<span >*</span></label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="qta_registe" name="qta_registe" class="form-control" placeholder="Inserisci la quantità di registe">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 ">
                                                        <?php
                                                            if(isset($_POST['Submit'])) {
                                                                $user = $_POST['Submit'];
                                                                $rs = mysqli_query($conn, "SELECT chalet.ragione_sociale, chalet.chalet_id FROM chalet WHERE chalet.chalet_id = '$user' ");
                                                                
                                                                    foreach($rs as $row){
                                                                    echo"<input type='hidden' class='form-control' id='chalet_id' name='chalet_id' value= ". $row['chalet_id'].">";
                                                                    }
                                                            }
                                                                
                                                        ?>
                                                       
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
                <!-- /page content <?php require_once('menu/footer.php'); ?> -->
            </div>
        </div>

        <!-- jQuery 
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
         Bootstrap 
        <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
         FastClick 
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
         NProgress 
        <script src="../vendors/nprogress/nprogress.js"></script>
         bootstrap-progressbar 
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        iCheck 
        <script src="../vendors/iCheck/icheck.min.js"></script>
         bootstrap-daterangepicker 
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
         bootstrap-wysiwyg 
        <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../vendors/google-code-prettify/src/prettify.js"></script>
         jQuery Tags Input 
        <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
         Switchery 
        <script src="../vendors/switchery/dist/switchery.min.js"></script>
         Select2 
        <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
         Parsley 
        <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
         Autosize 
        <script src="../vendors/autosize/dist/autosize.min.js"></script>
         jQuery autocomplete 
        <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <script src="../vendors/starrr/dist/starrr.js"></script>
         Custom Theme Scripts 
        <script src="../build/js/custom.min.js"></script>-->

    </body>
</html>