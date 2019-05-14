<?php
    include "connect.php";
    
    $db = getDBConnection();
    
    $query = "SELECT * from appt_slots"; 

    $stmt = $db -> prepare ($query);
    $stmt -> execute ();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Sending back down as JSON
    echo json_encode($results);

    
?>