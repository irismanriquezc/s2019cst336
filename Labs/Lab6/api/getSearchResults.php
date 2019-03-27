<?php
    include "../dbConnection.php";
    
    $conn = getDBConnection();
    
    // $query = "select * FROM om_product WHERE 1 And productName Like '%",$_GET['product']."%'";
 /* 
LIKE ‘var%’
This will find anything in the database that starts with “var”
LIKE ‘%var’
This will find anything in the database that ends with “var
LIKE ‘%var%’
This will find anything in the database that has “var” somewhere (start, end, middle,etc.)
*/
    $namedParameters= array();
    
    $query = "SELECT * FROM om_product WHERE 1 ";
    
    if (!empty($_GET['product'])) {
        $query .= "AND productName LIKE :productName";
        $namedParameters[":productName"]="%" . $_GET['product'] . "%";
    }
    
    if (!empty($_GET['category'])) {
        $query .= "AND catId = :categoryId";
        $namedParameters[":categoryId"]= $_GET['product'];
    }
    if (!empty($_GET['priceFrom'])) {
        $query .= "AND price >= :priceFrom";
        $namedParameters[":priceFrom"]= $_GET['priceFrom'];
    }
    
    if (!empty($_GET['priceTo'])) {
        $query .= "AND price <= :priceFrom";
        $namedParameters[":priceTo"]= $_GET['priceTo'];
    }
    
    if(isset($_GET['orderBy'])){
        if($_GET['orderBy']==price){
            $query .= "ORDER by price";
        }
        else if($_GET['orderBy']=="name"){
            $query .= "ORDER by productName";
        }
    }
    $stmt = $conn->prepare($query);
    $stmt->execute($namedParameters); // We NEED to include $namedParameters here
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
	echo json_encode($records);

?>