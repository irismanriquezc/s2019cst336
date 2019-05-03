<?php
    session_start();

    if (!isset($_SESSION['email'])){
      header("Location: ./login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head><title> OtterMart Admin </title>
        <!--<link href="css/styles.css" rel="stylesheet" type="text/css" />-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <!--sweet alert message-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    </head>
    
    <body>
        <div id="content" class="mx-auto" style="width: 80%;">
        <nav class="navbar navbar-light" style="background-color:#F5CECD;">
            <a class="navbar-brand" href="#">
                <!--<img src="img/csumb_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">-->
                <span id="heading">Add Product Form</span>
            </a>
            <button class="btn btn-success" id="logoutBtn">Logout</button>
        </nav>
            <br>
            <form>
                <div class="form-group">
                    <label for="inputName"><strong>Product Name</strong></label>
                    <input type="text" class="form-control" id="inputName" placeholder="Enter Product Name">
                </div>
                <div class="form-group">
                    <label for="inputDes"><strong>Product Description</strong></label>
                    <input type="text" class="form-control" id="inputDes" placeholder="Enter Product Description">
                </div>
                <div class="form-group">
                    <label for="inputImg"><strong>Product Image URL</strong></label>
                    <input type="text" class="form-control" id="inputImg" placeholder="Enter Image URL">
                    <small id="help" class="form-text text-muted">Please enter full url link to an image</small>
                </div>
                <div class="form-group">
                    <label for="inputName"><strong>Product Price</strong></label>
                    <input type="text" class="form-control" id="inputName" placeholder="Enter Unit Price">
                    <small id="help" class="form-text text-muted">Please enter an unite price as number</small>
                </div>
                
                <strong>Product Category</strong>     
                
                <select id="categoryInput" class="custom-select">
                    <option selected value="0">Choose Category</option>
                    <option value="1">Electronics</option>
                    <option value="2">Video Games</option>
                    <option value="3">Sports</option>
                    <option value="4">Computers</option>
                    <option value="5">Books</option>
                    <option value="6">Toys</option>
                    <option value="7">Movies</option>
                </select>
            </form>
            <br>
            <button class="btn btn-primary" onClick="formSubmit()">Submit</button>
        
        </div>
        <script  type="text/javascript">
            /*global $*/

function formSubmit() {
    var catVal = $("#categoryInput").find("option:selected").val();
    var values = $("input[type=text]").map(function() {
        return this.value;
    }).get();
    console.log(typeof values[0]);



    //call ajax with form data
    $.ajax({
        type: "GET",
        url: "api/addProducts.php",
        dataType: "",
        data: {
            "pName": values[0],
            "pDescription": values[1],
            "pImg": values[2],
            "pPrice": values[3],
            "pCategory": catVal
        },
        success: function(data, status) {
            console.log(data);
            //redirect back to index.php
            console.log("Redirect to logout page");
            window.location = "index.php";


        }
    }); //ajax call

} //function form submit
$("#logoutBtn").on('click', function() {
    console.log("Redirect to logout page");
    window.location = "./logout.php";

}); //Logout Button Click Event

        </script>
    </body>

</html>