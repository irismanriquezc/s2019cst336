<?php
    session_start();
    //default
    if (empty($_SESSION["data"])) {
      $_SESSION["data"] = array();
      $_SESSION["data"][] = "bar";
      $_SESSION["data"][] = "id";
      $_SESSION["data"][] = "ID";
      $_SESSION["data"][] = "foo";
      $_SESSION["data"][] = "user";
    }
    
    

    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);

    switch($httpMethod) {
      case "OPTIONS":
        // Allows anyone to hit your API, not just this c9 domain
        header("Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description");
        header("Access-Control-Allow-Methods: POST, GET");
        header("Access-Control-Max-Age: 3600");
        exit();
      case "GET":
        // Allow any client to access
        header("Access-Control-Allow-Origin: *");
        // Let the client know the format of the data being returned
        header("Content-Type: application/json");
        
        // Sending back down as JSON
        switch(true){
          case isset($_GET['userID']):
            $result = array($_SESSION, array("User Name GET method", $_GET['userID']));
            break;
          case isset($_GET['passWord']):
            $result = array($_SESSION, array("Pass Word GET method"));
            break;
          default:
            $result = array($_SESSION, array("Default GET method"));
            break;
        }
        echo json_encode($result);

        break;
      case 'POST':
        // Get the body json that was sent
        $rawJsonString = file_get_contents("php://input");
        
        // Make it a associative array (true, second param)
        $jsonData = json_decode($rawJsonString, true);

        // Allow any client to access
        header("Access-Control-Allow-Origin: *");
        // Let the client know the format of the data being returned
        header("Content-Type: application/json");
  
  
        // TODO: Update my user ID list, which is a session
        $result = $_POST["userID"];
        $_SESSION["data"][] = $result;
        $result = array($_SESSION, array("POST method"));
        // Sending back down as JSON
        echo json_encode($result);

        break;
      case 'PUT':
        // TODO: Access-Control-Allow-Origin
        http_response_code(401);
        echo "Not Supported";
        break;
      case 'DELETE':
        // TODO: Access-Control-Allow-Origin
        http_response_code(401);
        break;
    }
?>
