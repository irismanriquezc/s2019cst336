<?php
    include "./connect.php";
    
    $db = getDBConnection();
    
    $query = "select * from mp_codes";
    
    $statement = $db->prepare($query);
    $statement->execute();
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>