<?php
    include "connect.php";
    
    $db = getDBConnection();
    
    $idnum= $_POST['id'];
    $query = "DELETE FROM appt_slots WHERE id = :id"; 
    
    $namedParamters = array();
    $namedParamters[":id"] = $idnum;
    
     $statement = $db->prepare($query);
    $statement->execute($namedParamters);
    
    // $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
  
    
?>