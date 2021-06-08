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

/* SELECT chalet.chalet_id, chalet.ragione_sociale, chalet.numero_concessione, chalet.telefono, chalet.cellulare,
chalet.provincia, chalet.citta, users.username FROM chalet INNER JOIN users ON chalet.user_id = users.user_id */

if(isset($_POST['Submit'])) {
    $num_ombrellone = $_POST['num_ombrellone'];
    $fila_id = $_POST['fila_id'];
    $saldato = $_POST['saldato'];
    $user_id = $_POST['user_id'];
    $chalet_id = $_POST['chalet_id'];
	


	// checking empty fields
    if(empty($num_ombrellone) || empty($fila_id) || empty($saldato) ||  empty($chalet_id)) {

		if(empty($num_ombrellone)) {
			echo "<font color='red'>Il campo Ombrellone è vuoto</font><br/>";
        }
        
        if(empty($fila_id)) {
			echo "<font color='red'>Il campo Fila è vuoto</font><br/>";
		}

		if(empty($saldato)) {
			echo "<font color='red'>Il campo Saldato è vuoto</font><br/>";
		}
		if(empty($chalet_id)) {
			echo "<font color='red'>Il campo Chalet è vuoto</font><br/>";
		}


		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {

        $res = mysqli_query($conn, "SELECT * FROM ombrelloni  WHERE numero = '$num_ombrellone' and chalet_id = '$chalet_id'");
		if($res->num_rows== 0) {
			if(strcmp($saldato, 'no') == 0){
				$saldato = 0;
			}else{
				$saldato = 1;
			}
			$rs = mysqli_query($conn, "INSERT INTO ombrelloni (numero, flag_saldo, fila_id, chalet_id)
												VALUES ('$num_ombrellone','$saldato','$fila_id', '$chalet_id')");
			header('Location: spiaggia.php');
			exit;
		} else {
			echo "<h1>OMBRELLONE GIA ESISTENTE IN QUESTA CONCESSIONE</h1>";
		}

	}
}
?>