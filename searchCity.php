<?php


	require_once('config.php');
  	
    if (isset($_GET['term'])) {
     
        $query = "SELECT * FROM chalet WHERE citta LIKE '{$_GET['term']}%' group by citta";
         $result = mysqli_query($conn, $query);
      
         if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
           $res[] = $row['citta'];
          }
         } else {
           $res = array();
         }
         //return json res
         echo json_encode($res);
     }
?>