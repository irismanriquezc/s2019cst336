<?php
    include 'connection.php';
    
    $conn = getDBConnection("ottermart");

    $sql = "INSERT INTO om_product
                (om_product.productName, om_product.productDescription, om_product.productImage, om_product.price, om_product.catId ) 
                VALUES (:pName, :pDescription, :pImg, :pPrice, :pCategory)";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':pName' => $_GET['pName'], ':pDescription' => $_GET['pDescription'], 
    ':pImg' => $_GET['pImg'], ':pPrice' => $_GET['pPrice'], ':pCategory' => $_GET['pCategory']));
    
?>