<?php
    include "../connection.php";
    
    $db = getDBConnection();
    
    $query = "insert into keyword";
    
    $statement = $db->prepare($query);
    $statement->execute();
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>