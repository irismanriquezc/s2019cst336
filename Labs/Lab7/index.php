<?php
    session_start();

    if (!isset($_SESSION['email'])){
      header("Location: ./login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart Admin </title>
        <!--<link href="css/styles.css" rel="stylesheet" type="text/css" />-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <!--ag-grid-->
        <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-grid.css">
        <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-theme-balham.css">
        
        <!--sweet alert message-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        
    </head>
    <body>
        
        <div id="content" class="mx-auto text-center" style="width: 80%;" >
        <!-- Image and text -->
        <nav class="navbar navbar-light" style="background-color:#F5CECD;">
            <a class="navbar-brand" href="#">
                <!--<img src="img/csumb_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">-->
                <span id="heading">OtterMart Admin</span>
            </a>
            <a href="add.php"><button type="button" class="btn btn-warning" onClick="addNewProduct()">Add New Product</button></a>
            <button class="btn btn-success" id="logoutBtn">Logout</button>
        </nav>
        
       <div id="myGrid" style="height: 600px; width:100%;" class="ag-theme-balham"></div>
            
        <br>
        <hr>
        <button class="btn btn-info" id="infoBtn">Information</button>
        <button class="btn btn-danger" id="deleteBtn">Delete</button>
        <br />
        <br />
        <br />
        
        </div>
        
        <div class="modal" id="purchaseHistoryModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="history"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
    <script type="text/javascript">
        /*global $*/

$(document).ready(function() {
    console.log("js file connected success");
    var columnDefs = [
        { headerName: "Select", field: "pDelete", checkboxSelection: true, width: 25 },
        { headerName: "Product ID", field: "pId", width: 30, hide: true, suppressToolPanel: true },
        { headerName: "Product Name", field: "pName", width: 100 },
        { headerName: "Product Description", field: "pDescription", width: 200 },
        { headerName: "Price", field: "pPrice", width: 70 },
    ];

    // gridOptions.columnApi.setColumnVisible('pId', false);

    var gridOptions = {
        defaultColDef: {
            editable: true,
        },
        columnDefs: columnDefs,
        rowData: null,
        rowSelection: 'single', //-->multiple
        suppressRowClickSelection: true,
        onGridSizeChanged: onGridSizeChanged,
        onCellValueChanged: function(data) {
            updateBug(data);
        }
    };


    $.ajax({
        type: "GET",
        url: "api/getP.php",
        dataType: "json",
        data: {},
        success: function(data, status) {
            console.log(data);
            console.log("ajax call for every products");

            var counter = 1;
            var rowData = [];

            data.forEach(function(key) {
                //insert data
                var eachData = {
                    pId: key['productId'],
                    pName: key['productName'],
                    pDescription: key['productDescription'],
                    pPrice: key['price']
                };

                rowData.push(eachData);
            });

            var gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);

            gridOptions.api.setRowData(rowData);
        },
        error:function(data, status){
            console.log("All products load failed");
            
        }
    }); //ajax call for loading list of all products in the beginning

    $("#infoBtn").on('click', function() {
        const selectedNodes = gridOptions.api.getSelectedNodes()
        const selectedData = selectedNodes.map(function(node) { return node.data })

        var selectedDataStringID = selectedData.map(function(node) { return node.pId }).join('&')

        console.log('Selected nodes: ' + parseInt(selectedDataStringID));

        $("#purchaseHistoryModal").modal("show");
        $.ajax({
            type: "POST",
            url: "api/getP.php",
            dataType: "json",
            data: {
                "productId": parseInt(selectedDataStringID)
            },
            success: function(data, status) {
                console.log(data);

                if (data.length != 0) {
                    $("#history").html("");
                    $("#history").append(data[0]['productName'] + "<br />");
                    $("#history").append("<img src='" + data[0]['productImage'] + "' width='200' /> <br />");
                    data.forEach(function(key) {
                        $("#history").append("Product Name: " + key['productName'] + "<br />");
                        $("#history").append("Product Description: " + key['productDescription'] + "<br />");
                        $("#history").append("Unit Price: $" + key['price'] + "<br />");
                    });
                }
                else {
                    $("#history").html("No product information for this item.");
                }
            }
        });


    }); //Information Button Click Event


    $("#logoutBtn").on('click', function() {
        console.log("Redirect to logout page");
        window.location = "./logout.php";

    }); //Logout Button Click Event

    $("#deleteBtn").on('click', function() {

        const selectedNodes = gridOptions.api.getSelectedNodes()
        const selectedData = selectedNodes.map(function(node) { return node.data })

        const selectedDataStringID = selectedData.map(function(node) { return node.pId })

        console.log('Delete - Selected nodes: ' + selectedDataStringID);


        $.ajax({
            type: "DELETE",
            url: "api/getP.php",
            dataType: "",
            data: {
                "productId": selectedDataStringID,
            },
            success: function(data, status) {
                //delete
                console.log(data);
                Swal.fire({
                    type: 'success',
                    title: 'Items have been deleted',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    console.log("Deleted sql sent out");

                    onRemoveSelected();

                })

                // var counter = 1;
                // var rowData = [];

                // data.forEach(function(key) {
                //     //insert data
                //     var eachData = {
                //         pName: key['productName'],
                //         pDescription: key['productDescription'],
                //         pPrice: key['price']
                //     };

                //     rowData.push(eachData);
                // });

                // var gridDiv = document.querySelector('#myGrid');
                // new agGrid.Grid(gridDiv, gridOptions);

                // gridOptions.api.setRowData(rowData);
            }
        }); //ajax call for loading list of all products in the beginning



    }); //Delete Button Click Event




    //AG-Grid resize
    function onGridSizeChanged(params) {
        // get the current grids width
        var gridWidth = document.getElementById('myGrid').offsetWidth;

        // keep track of which columns to hide/show
        var columnsToShow = [];
        var columnsToHide = [];

        // iterate over all columns (visible or not) and work out
        // now many columns can fit (based on their minWidth)
        var totalColsWidth = 0;
        var allColumns = params.columnApi.getAllColumns();
        for (var i = 0; i < allColumns.length; i++) {
            let column = allColumns[i];
            totalColsWidth += column.getMinWidth();
            if (totalColsWidth > gridWidth) {
                columnsToHide.push(column.colId);
            }
            else {
                columnsToShow.push(column.colId);
            }
        }

        // show/hide columns based on current grid width
        params.columnApi.setColumnsVisible(columnsToShow, true);
        params.columnApi.setColumnsVisible(columnsToHide, false);

        // fill out any available space to ensure there are no gaps
        params.api.sizeColumnsToFit();
    }

    function addNewProduct() {
        window.location = "add.php";
    }

    function onRemoveSelected() {
        var selectedData = gridOptions.api.getSelectedRows();
        var res = gridOptions.api.updateRowData({ remove: selectedData });
    }

    function updateBug(data) {
        data = data.data;
        console.log("Editable data below: ");
        console.log(data);


        console.log("product ID:");
        console.log(data["pId"]);
        console.log(data["pName"]);
        console.log(data["pDescription"]);
        console.log(data["pPrice"]);

        $.ajax({
            url: 'api/editProducts.php',
            type: 'GET',
            data: {
                'id': data['pId'],
                'pName': data['pName'],
                'pDescription': data['pDescription'],
                'pPrice': data['pPrice']
            },
            success: function(data) {
                Swal.fire({
                    type: 'success',
                    title: 'Items have been edited',
                    showConfirmButton: false,
                    timer: 1000
                });
            },
            error: function(data) {
                Swal.fire({
                    title: 'Error',
                    type: 'error',
                    text: data.responseText
                })
            }
        });


    }



}); //Document ready Event

    </script>
    </body>
    
</html>