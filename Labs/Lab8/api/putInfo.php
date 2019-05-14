<?php
    include "../connection.php";
    
    $db = getDBConnection();
    
    $query = "insert into user_data (email, password, first_name, last_name)
    values (";
//     INSERT INTO table_name (column1, column2, column3, ...)
// VALUES (value1, value2, value3, ...);
    $statement = $db->prepare($query);
    $statement->execute();
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>