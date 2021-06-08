<?php
require_once('config.php');

if (isset($_GET['term'])) {
     
    $query = "SELECT * FROM chalet WHERE ragione_sociale LIKE '{$_GET['term']}%'";
     $result = mysqli_query($conn, $query);
  
     if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
       $res[] = $row['ragione_sociale'];
      }
     } else {
       $res = array();
     }
     //return json res
     echo json_encode($res);
 }
?>

