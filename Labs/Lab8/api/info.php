<?php
    include "../connection.php";
    
    $db = getDBConnection();
    
    $query = "select * catId, catName FROM om_category ORDER BY catName";
    
    $statement = $db->prepare($query);
    $statement->execute();
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>