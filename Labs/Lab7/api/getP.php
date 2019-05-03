<?php
    include 'connection.php';
    
    $conn = getDBConnection();

    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    switch($httpMethod) {
        
        case "GET":
            // $debugg = "GET is called";
            // echo $debugg;
            
            $sql = "SELECT * FROM om_product ORDER BY productId"; //-->productName
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($records);
            
            break;
            
        case "POST":
            $productId = $_POST['productId'];
            
            $sql = "SELECT * FROM om_product WHERE productId = :pId";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':pId' => $productId));
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($records);
            break;
            
        case "DELETE":
            
            $_DELETE = file_get_contents('php://input');
            $sql = "DELETE FROM om_product WHERE productId = :pId";
        
            $val_list = explode('=',$_DELETE);
            var_dump($val_list[1]);
            
            $productId = intval($val_list[1]);

            
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':pId' => $productId));
            
            // var_dump($stmt);
            echo "Delete Successful";
            break;
            
    }
?>