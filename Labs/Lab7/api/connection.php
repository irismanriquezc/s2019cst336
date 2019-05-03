<?php
    function getDBConnection(){
        $host = "localhost";
        $dbName = "ottermart";//the database I want
        $user = "irismanriquezc";
        $pass = "";
        $dsn = "mysql:host=$host;dbname=$dbName";
        
       
       
       $opt =[
           PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
           PDO::ATTR_EMULATE_PREPARES => false,
           ];
           
          $pdo = new PDO($dsn,$user,$pass, $opt);
          
          return $pdo;
    }
    
// getDBConnection(); //Gives you the error message
?>