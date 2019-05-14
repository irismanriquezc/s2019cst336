<?php
    include "connect.php";
    
    $db = getDBConnection();
    
    $query = "INSERT into appt_slots (date, start_time, end_time, duration, booker)
    values('".$_POST["date"]."','".$_POST["start"]."','".$_POST["end"]."','".$_POST["duration"]."','".$_POST["booker"]."')"; 
     $statement = $db->prepare($query);
    $statement->execute();
    
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
  
    
    echo json_encode($records); 
?>