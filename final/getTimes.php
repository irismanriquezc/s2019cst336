<?php
    include "connect.php";
    
    $db = getDBConnection();
    
    $idnum=$_POST['id'];
    
    $query = "SELECT date,start_time, end_time from appt_slots where id=:id"; 

    $namedParamters = array();
    $namedParamters[":id"] = $idnum;
    
    $stmt = $db -> prepare ($query);
    $stmt -> execute ($namedParamters);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo $idnum;
    // Sending back down as JSON
    echo json_encode($results);

    
?>