<?php
    include "./connect.php";
    
    $db = getDBConnection();
    
    $query = "SELECT * from `match`";
    // echo "ws" . $query;
    $statement = $db->prepare($query);
    $statement->execute();
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>