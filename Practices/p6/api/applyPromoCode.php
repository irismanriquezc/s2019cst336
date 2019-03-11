<?php
session_start();

  $httpMethod = strtoupper($_SERVER["REQUEST_METHOD"]);

  switch($httpMethod) {
    case "OPTIONS":
      onOptions();
      exit();                    
    case "GET":
      onGet();
      break;    
    case "POST":  
      onPost();
      break;       
    case "DELETE":
      onDelete();
      break ;
    default:
      // Add default handling
      break;
  }
    function onGet() {
      // Allow any client to access
      header("Access-Control-Allow-Origin: *");
    
      // Let the client know the format of the data being returned
      header("Content-Type: application/json");
            
    $eachPromo = array();
    $eachPromo["promo"] = "getFifty";
    $eachPromo["val"] = 0.5;
    
    $promoList = array();
    array_push($promoList, $eachPromo);
    
    $eachPromo["promo"] = "halfPrice";
    $eachPromo["val"] = 0.5;
    array_push($promoList, $eachPromo);
      
    $eachPromo["promo"] = "sand30";
    $eachPromo["val"] = 0.3;
    array_push($promoList, $eachPromo);
    
    $eachPromo["promo"] = "spring30";
    $eachPromo["val"] = 0.3;
    array_push($promoList, $eachPromo);
    
    $eachPromo["promo"] = "beach";
    $eachPromo["val"] = 0.2;
    array_push($promoList, $eachPromo);
    
    $eachPromo["promo"] = "sunny";
    $eachPromo["val"] = 0.2;
    array_push($promoList, $eachPromo);
        
    $result = 0.0;
    for($i = 0; $i < count($promoList); ++$i) {
        if ($promoList[$i]["promo"] == $_GET["code"]) {
            $result = $promoList[$i]["val"];
        }
    }    
        
      // Sending back down as JSON
      echo json_encode($result);

    }
?>