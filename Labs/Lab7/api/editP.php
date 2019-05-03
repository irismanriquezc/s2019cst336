<?php
    include 'connection.php';
    
    $conn = getDBConnection("ottermart");
    
    $sql = "UPDATE om_product 
                SET om_product.productName = :pName, om_product.productDescription = :pDescription, 
                om_product.price = :pPrice, om_product.catId = :pCategory
                WHERE om_product.productId= :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':pName' => $_GET['pName'], ':pDescription' => $_GET['pDescription'], 
    ':pPrice' => $_GET['pPrice'], ':pCategory' => $_GET['pCategory'], ':id' => $_GET['id'] ));
    
    // $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // echo json_encode($records);
?>