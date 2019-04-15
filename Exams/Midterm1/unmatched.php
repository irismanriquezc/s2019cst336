<?php
    include "./connect.php";
    
    $db = getDBConnection();
    
    $query = "SELECT * FROM user";
    
    
    
    $statement = $db->prepare($query);
    $statement->execute();
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>