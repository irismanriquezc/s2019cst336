<?php
    function getDBConnection(){
        $host = "localhost";
        $dbName = "ottermart";
        $user = "irismanriquezc";
        $pass = "";
        $dsn = "mysql:host=$host;dbname=$dbName";
        
       
       
       $opt =[
           PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
           PDO::ATTR_EMULATE_PREPARES => false,
           ];
           
            //  if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
            //     $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            //     $host = $url["host"];
            //     $dbname = substr($url["path"], 1);
            //     $username = $url["user"];
            //     $password = $url["pass"];
            // } 
    

           
          $pdo = new PDO($dsn,$user,$pass, $opt);
          
          return $pdo;
    }
    
// getDBConnection(); //Gives you the error message
?>