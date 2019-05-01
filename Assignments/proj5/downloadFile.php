        <?php
            include 'connection.php';
                $db = getDBConnection();
        
        // $sql = "SELECT media FROM info WHERE caption LIKE '%@'"; 
        //  $stmt = $db->prepare($sql);
        //  $stmt->execute( array(":media"=> $_GET['media']));
        
        //  $stmt->bindColumn('wMedia', $data, PDO::PARAM_LOB);
        //  $record = $stmt->fetch(PDO::FETCH_BOUND);
         
        //  if (!empty($record)){
        // 	//specifies the mime type
        //     header('Content-Type:' . $record['fileType']);   
        //     header('Content-Disposition: inline;');
        //     echo $data; 
        //   } 

            
            $sql = "SELECT * FROM info"; // 1
            $res = $db->query($sql);
            $data= array();
            // $result=mysqli_fetch_array($res);

            while($row = $res->fetch(PDO::FETCH_ASSOC))
             { 
             $emailA = $row['email_address'];
             array_push($data,$emailA);

           
              
             $captionP =  $row['caption'];
            //  $data[ ]= $row['caption'];

           
             array_push($data,$captionP);

             $media = $row['media'];
             
            $src = 'data: '.mime_content_type($media).';base64,'.$media;
            // echo '<img src="', $src, '">';


            // $decoded_image= base64_decode($media);
           

            // echo "<img src=data:image/jpg;$decoded_image>";

              array_push($data,  $src);


             $timeS = $row['timestamp'];
            array_push($data,$timeS);

            
             }

          echo json_encode($data);
          
        //     // echo $captionP;
        //     // echo $timeS;
        //     //   echo $media;
        //       exit();   
   ?>