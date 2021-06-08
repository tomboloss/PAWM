<?php
    require_once('config.php');
?>
<?php

/* SELECT chalet.chalet_id, chalet.ragione_sociale, chalet.numero_concessione, chalet.telefono, chalet.cellulare,
chalet.provincia, chalet.citta, users.username FROM chalet INNER JOIN users ON chalet.user_id = users.user_id */

if(isset($_POST['Submit'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $cellulare = $_POST['cellulare'];
    $email = $_POST['email'];
	$num_ombrellone = $_POST['ombrellone_id'];
    $qta_lettini = $_POST['qta_lettini'];
    $qta_sdraie = $_POST['qta_sdraie'];
	$qta_registe = $_POST['qta_registe'];
    $chalet_id  = $_POST['chalet_id'];
	$data_a = $_POST['data_arrivo'];
	$data_p = $_POST['data_partenza'];
    $rs = mysqli_query($conn, "SELECT chalet.user_id
    FROM chalet
    WHERE chalet.chalet_id= '$chalet_id' ");

    foreach($rs as $row){
        $user_id = $row['user_id'];
    }
	

	$data_arrivo = strtotime($_POST['data_arrivo']);
	$data_partenza = strtotime($_POST['data_partenza']);

	if ($data_arrivo > $data_partenza){
		echo"<font color='red'>La data di partenza non è valida. Per favore inserire una data maggiore di quella di arrivo</font><br>";
		
			echo "<br><a href='javascript:self.history.back();'>Go Back</a>";
	}else{ 
	
	 
	// checking empty fields
		if(empty($nome) || empty($cognome) || empty($cellulare) || empty($email) || empty($data_arrivo) || empty($data_partenza) || empty($num_ombrellone) ) {

			if(empty($nome)) {
				echo "<font color='red'>Il campo Nome è vuoto</font><br>";
			}
			
			if(empty($cognome)) {
				echo "<font color='red'>Il campo Cognome è vuoto</font><br>";
			}

			if(empty($cellulare)) {
				echo "<font color='red>Il campo Cellulare è vuoto</font><br>";
			}

			if(empty($email)) {
				echo "<font color='red'>Il campo Email è vuoto</font><br>";
			}

			if(empty($data_arrivo)) {
				echo "<font color='red'>Il campo Data Arrivo è vuoto</font><br>";
			}

			if(empty($data_partenza)) {
				echo "<font color='red'>Il campo Data Partenza è vuoto</font><br>";
			}

			if($data_arrivo < $data_partenza){
				echo"<font color='red'>La data di partenza non è valida. Per favore inserire una data maggiore di quella di arrivo</font><br>";
			}

			if(empty($num_ombrellone)) {
				echo "<font color='red'>Il campo Ombrelloni è vuoto</font><br>";
			}

			//link to the previous page
			echo "<br><a href='javascript:self.history.back();'>Go Back</a>";
		} else {

			//$res = mysqli_query($conn, "SELECT * FROM prenotazioni WHERE cellulare = '$cellulare '");
			//if($res->num_rows== 0) {
				$rs = mysqli_query($conn, "INSERT INTO prenotazioni (nome,cognome,cellulare,email,data_arrivo,data_partenza,ombrelloni,qta_lettini,qta_sdraie,qta_registe, chalet, user_id)
													VALUES ('$nome', '$cognome', '$cellulare', '$email', '$data_a', '$data_p', '$num_ombrellone', '$qta_lettini', '$qta_sdraie', '$qta_registe', '$chalet_id', '$user_id')");
				
				
				
				header('Location: conferma.php');
				exit;
			/*} else {
				
				echo "Cellulare già esistente";
			}*/

		}
	}
}
?>