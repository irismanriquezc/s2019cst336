<!DOCTYPE html>
<html>
    <head>
        <title>Media Upload</title>
     <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!--<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">-->
    <!--<link rel="stylesheet" type="text/css" href="css/styles.css">-->
    </head>
    <body>
      <div id="content">
          
       
         <?php
            if (isset($_POST['uploadForm'])) {
                if ($_FILES["fileName"]["error"] > 0) {
                  echo "Error: " . $_FILES["fileName"]["error"] . "<br>";
                }
                else {
                  echo "Upload: " . $_FILES["fileName"]["name"] . "<br>";
                  echo "Type: " . $_FILES["fileName"]["type"] . "<br>";
                  echo "Size: " . ($_FILES["fileName"]["size"] / 1024) . " KB<br>";
                  echo "Stored in: " . $_FILES["fileName"]["tmp_name"];
                  echo "<br>";

                  $time = date('Y-m-d G:i:s');
            echo $time;
            echo "<br>";

            // $email = 
                 $emailA= $_POST['email'];
                 echo $emailA;
                 echo "<br>";

                 $captionP= $_POST['caption'];
                 echo $captionP;
                 
                 
                include 'connection.php';
                $db = getDBConnection();

              $binaryData = base64_encode(file_get_contents($_FILES["fileName"]["tmp_name"]));
             $sql = "INSERT INTO info (email_address , caption ,media, timestamp)"." 
                                VALUES( :emailA, :captionP, :fileData, :timestamp)";
              $stm= $db->prepare($sql);
              $stm->execute(array (":emailA"=>$_POST['email'],
                       ":captionP"=>$_POST['caption'],
                       ":fileData"=>$binaryData,
                       ":timestamp"=>date('Y-m-d G:i:s')));
            
              echo "<br />File saved into database <br /><br />";   
                }  
            } //endIf form submission
            
    
        ?>
        


        <form method="POST" enctype="multipart/form-data"> 
        <label >Email Address: </label>
         <input type="text" name="email"/>
         <br>
        Select file: <input type="file" name="fileName" /> <br />
        <label>Caption: </label>
        <input type="text" name="caption"/>
        <input type="submit"  name="uploadForm" value="Upload File" /> 
        </form>
        <br>
        
        <br>
        <br>
        
        <button id="all">see all</button>
        
        
        
        



         
      </div>
      
      <script>
      
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "./downloadFile.php",
                dataType: "json",
                data: {
                },
                
                success: function(data, status) {
                    console.log("work");
                    // data = arguments[0];
                    console.log(data);
                    // var randInt = Math.floor((Math.random() * 18) + 1); // 1~18
                    // console.log(data[randInt]["productName"]);
                    
                    // $("#itemName").html(data[randInt]["productName"]);
                    // priceRandom = data[randInt]["productPrice"];
                    // //var q = data["qty"];
                    // $("#itemPrice").html("$" + priceRandom);
                    // // console.log($("#itemQty").val());
                    // // totalT = q * priceRandom;
                    // // $("#totalPrice").html("$" + totalT);
                    // // $("#subtotal").html("$" + totalT);
                    // // tax = Math.floor(totalT * .10);
                    // // $("#tax").html("$" + tax);
                    // // allTotal = tax + totalT;
                    // // $("#total").html("$" + allTotal);
                    // console.log(data);

                    // for (var i = 0; i < data.length; i++) {
                    //     var o = new Option(data[i]["productName"], i);
                    //     $(o).html(data[i]["productName"] + " ($" + data[i]["productPrice"] + ")");
                    //     $("#productMenu").append(o);
                    // }
                },
                complete: function(data, status) { //optional, used for debugging purposes
                    //console.log(status);
                }
            });
        });

    
       
      </script>
    </body>
</html>