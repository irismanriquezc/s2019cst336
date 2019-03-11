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
            
    $eachProdcut = array();
    $eachProdcut["product"] = "Microfiber Beach Towel";
    $eachProdcut["price"] = 40;
    $eachProdcut["qty"] = 2;
    
    $productList = array();
    array_push($productList, $eachProdcut);
    
    $eachProdcut["product"] = "Flip-flop Sandals";
    $eachProdcut["price"] = 30;
    $eachProdcut["qty"] = 5;
    array_push($productList, $eachProdcut);
    
    $eachProdcut["product"] = "Sunscreen 80SPF";
    $eachProdcut["price"] = 25;
    $eachProdcut["qty"] = 3;
    array_push($productList, $eachProdcut);
    
    $eachProdcut["product"] = "Plastic Flying Disc";
    $eachProdcut["price"] = 15;
    $eachProdcut["qty"] = 4;
    array_push($productList, $eachProdcut);
    
    $eachProdcut["product"] = "Beach Umbrella";
    $eachProdcut["price"] = 75;
    $eachProdcut["qty"] = 1;
    array_push($productList, $eachProdcut);
    

      // Sending back down as JSON
      echo json_encode($productList[rand(0,4)]);
    }
?>