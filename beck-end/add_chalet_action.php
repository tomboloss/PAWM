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
    $ragione_sociale = $_POST['ragione_sociale'];
    $numero_concessione = $_POST['numero_concessione'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
	$citta = $_POST['citta'];
	$cap = $_POST['cap'];
	$indirizzo = $_POST['indirizzo'];
    $user_id = $_POST['user_id'];
	


	// checking empty fields
    if(empty($ragione_sociale) || empty($numero_concessione) || empty($telefono) || empty($provincia) || empty($citta) || empty($cap) || empty($indirizzo) || empty($user_id)) {

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
			echo "<font color='red'>Il campo Provincia è vuoto</font><br/>";
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
       
		//link to the previous page
		
	} else {
		$res = mysqli_query($conn, "SELECT * FROM chalet WHERE ragione_sociale = '$ragione_sociale'");
		if($res->num_rows== 0) {
			$rs = mysqli_query($conn, "INSERT INTO chalet (ragione_sociale,numero_concessione,telefono, 
                                                            provincia,citta,cap,indirizzo,user_id)
												VALUES ('$ragione_sociale','$numero_concessione','$telefono','$provincia',
														'$citta', '$cap', '$indirizzo', '$user_id')");
													
									 while($row = mysqli_fetch_array($rs)) {
										echo "<tr>";
										echo "<td>".$row['ragione_sociale']."</td>";
										echo "<td>".$row['numero_concessione']."</td>";
										echo "<td>".$row['telefono']."</td>";
										echo "<td>".$row['indirizzocompleto']."</td>";
										echo "<td>".$row['username']."</td>";
										echo "<td>".$row['email']."</td>";
										echo "<td>
												<a href=\"update_chalet.php?chalet_id=$row[chalet_id]\"><i class='fa fa-pencil fa-2x'></i></a>
												<a href=\"delete_chalet.php?chalet_id=$row[chalet_id]\" onClick=\"return confirm('Sei sicuro di voler eliminare questo Chalet?')\"><i class='fa fa-trash fa-2x'></i></a>
											</td>";
										echo "</tr>";
									}	
			
			header('Location: chalet.php');
			exit;
		} else {
			echo "Regione Sociale già esistente";
		}

	}
}
?>