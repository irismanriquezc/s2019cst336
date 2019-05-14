


<?php
// Start the session
session_start();
?>




</body>
</html>
<html>
  <head>
    <title>Scheduler</title>
    <meta name="viewport" content="initial-scale=1.0">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link href="styles.css" rel="stylesheet" type="text/css" />


    <meta name="google-signin-client_id" content="296300619226-fggsbk2kqpnd15gd5874gb87sc57nkd4.apps.googleusercontent.com">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>



    <meta charset="utf-8">


  </head>
  <body>
    
    

    <h1>Schedule Page</h1>
    
  
  
    

    <div id="addSlot" class="modal">

  <!-- Modal content -->
      <div id= "wModal" class="insideModal"  data-backdrop="static" data-keyboard="false">
        <div class = "contentMd">
         <label for="date">Date: </label>   <input id="dateI" type="date" name="dayS">
        <br><br>
        <label for="sTime">Start Time: </label><input id="sTime" type="time" name="startTime">
        <br><br>
       <label for="eTime">End Time: </label> <input id="eTime" type="time" name="endTime"/>
        <br><br>
        <button id=cancelB>Cancel</button>
        <button id ="submit">Add</button>

        </div>
        
      </div>
      
      
      
    <div id="deleteSlot" class="modal">

  <!-- Modal content -->
      <div id= "delModal" class="insideModal"  data-backdrop="static" data-keyboard="false">
        <div class = "contentMd">
        <br><br>
        <label id="sTimeD">Start Time: </label>
        <br><br>
       <label id="eTimeD">End Time: </label> 
        <br><br>
        <label>Are you sure you want to remove the time slot? This cannot be undone</label>
        <br><br>

        <button id="cancelB2">Cancel</button>
        <button id ="submitD">Delete</button>

        </div>
        
      </div>
      
      <div id="tableSlots">
          <table id= "avSlots">
  <tr>
    <th>Date</th>
    <th>Start Time</th>
    <th>Duration</th>
    <th>Booked By</th>
    <th><button id="slotA">Add Slot</button></th>
  </tr>
  
</table>
      </div>
<div>              <div id="google"class="g-signin2" data-onsuccess="onSignIn" ><div id="googleS"></div></div>
<a href="#" onclick="signOut();">Sign out</a>
</div>
</div>

    <script>
    function onSignIn(googleUser) {
      
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    var email= profile.getEmail();
    $("#googleS").append(email);
    var array= profile.getName().split(" ");
    var fN= array[0];
    var lN= array[1];
    
    console.log(fN);
    console.log(lN);
    var id_token = googleUser.getAuthResponse().id_token;
        $.post('/server/sign-in', {id_token: id_token})
        .then(function(user) {
            // The user is now signed in on the server too
            // and the user should now have a session cookie
            // for the whole site. 
            document.location.href = 'https://s2019cst336-irismanriquezc.c9users.io/s2019cst336/final/dashboard.php'
        })
        

        
  }
  
  
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
            $("#googleS").html("Signed Out");

      });
    }
    var modal = document.getElementById('wModal');
    var modalDel= document.getElementById("delModal")
    var btn = document.getElementById("slotA");
    var cancel= document.getElementById("cancelB");
    var cancel2= document.getElementById("cancelB2");
    
    var delB = document.getElementById("submitD");


    
    btn.onclick = function() {
    modal.style.display = "block";
    }
    
    cancel.onclick = function() {
    modal.style.display = "none";
    }
    // cancel2.onclick = function() {
    // modalDel.style.display = "none";
    // }
    $( document ).ready(function() {

    $.ajax({
                type: "GET",
                url: "getData.php",
                dataType: "json",
                 data: {
                },
                success: function(data, status) {
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth()+1; //January is 0!
                    var yyyy = today.getFullYear();
                    
                    if(dd<10) {
                        dd = '0'+dd
                    } 
                    
                    if(mm<10) {
                        mm = '0'+mm
                    } 
                    
                    today = mm + '/' + dd + '/' + yyyy;
                    
                    console.log(today);
                    var counter=0;
                   for (let item of data) {
                    
                    if(new Date(today) < new Date(item['date'])){
                        
                          var t= Math.floor(item['duration']/60)+" hours "+ item['duration']%60 + " minutes ";
                          var buttonId= "delete"+counter+1;
                          var info= "info"+counter;
                          console.log(item['id']);
                    // $("#avSlots").last().append("<tr>"+"<td>"+item['date']+"</td>"  +"<td>"+item['start_time']+"</td>" +"<td>"+t+"</td>" +"<td>"+item['booker']+"</td>" +"<td>"+"<button id="+buttonId+">"+"Delete</button>" +"</td>"+"</tr>");

                    $("#avSlots").last().append("<tr>"+"<td class="+buttonId+">"+item['date']+"</td>"  +"<td>"+item['start_time']+"</td>" +"<td>"+t+"</td>" +"<td>"+item['booker']+"</td>"+"<td>"+"<button id="+info+">"+"Details</button>" +"</td>" +"<td>"+"<button id="+buttonId+" value="+item['id']+ " onClick=clicked(this)"+">Delete</button>" +"</td>"+"</tr>");
                    counter++;
                    }
                    
                   

                    }

                },
                complete: function(data, status) { 
                    
                }
                
            });
});

                     function clicked(elem)
                    {
                    var x = document.getElementById(elem.id);
                    var t=x.value;


                            $.ajax({
                        type: "POST",
                        url: "getTimes.php",
                        dataType: "json",
                         data: { "id":t
                        },
                        success: function(data, status) {
                           console.log(data);
                           console.log(data[0]['start_time']);
                           
                            $("#sTimeD").append(data[0]['date']+" "+data[0]['start_time']);

                           $("#eTimeD").append(data[0]['date']+" "+data[0]['end_time']);
                          
                        },
                        complete: function(data, status) { 
                        
                      
                        }
                            });    
                        
                        modalDel.style.display = "block";

                        
                        cancel2.onclick = function() {
                        modalDel.style.display = "none";
                        }

                         delB.onclick = function() {
                        

                        var w= elem.id;
                        var rowPlace= w.slice(-1);

                        document.getElementById("avSlots").deleteRow(rowPlace);

                       
                    
                           $.ajax({
                        type: "POST",
                        url: "delete.php",
                        dataType: "json",
                         data: { "id":t
                        },
                        success: function(data, status) {
                        },
                        complete: function(data, status) { 
                             modalDel.style.display = "none";

                        }
                        
                    });    
                             
                        }

                       
                    }
                  
//     <select name="timestart">
// <option value="00:00:00">12:00 am</option>
// <option value="01:00:00">1:00 am</option>
// <option value="02:00:00">2:00 am</option>
// <option value="03:00:00">3:00 am</option>
// <option value="04:00:00">4:00 am</option>
// <option value="05:00:00">5:00 am</option>
// <option value="06:00:00">6:00 am</option>
// <option value="07:00:00">7:00 am</option>
// <option value="08:00:00">8:00 am</option>
// <option value="09:00:00">9:00 am</option>
// <option value="10:00:00">10:00 am</option>
// <option value="11:00:00">11:00 am</option>
// <option value="12:00:00">12:00 pm</option>
// <option value="13:00:00">1:00 pm</option>
// <option value="14:00:00">2:00 pm</option>
// <option value="15:00:00">3:00 pm</option>
// <option value="16:00:00">4:00 pm</option>
// <option value="17:00:00">5:00 pm</option>
// <option value="18:00:00">6:00 pm</option>
// <option value="19:00:00">7:00 pm</option>
// <option value="20:00:00">8:00 pm</option>
// <option value="21:00:00">9:00 pm</option>
// <option value="22:00:00">10:00 pm</option>
// <option value="23:00:00">11:00 pm</option>
// </select>
   $( "#submit" ).click(function() {
        
        var date = new Date($('#dateI').val());
        console.log(date.toLocaleTimeString()); //gives just time
        console.log(date.toLocaleDateString()); //gives the actual date
        var s= $("#sTime").val();
        var e= $("#eTime").val();
        
         var start = s.split(":");
        var end = e.split(":");

        var startDate = new Date(0, 0, 0, start[0], start[1], 0);
        var endDate = new Date(0, 0, 0, end[0], end[1], 0);
        var diff = endDate.getTime() - startDate.getTime();
        var hours = Math.floor(diff / 1000 / 60 / 60);
        diff -= hours * 1000 * 60 * 60;
        var minutes = Math.floor(diff / 1000 / 60);
        
        console.log(hours+" hours");
        console.log("min "+ minutes);
        
        
        var timeSpan= (hours*60)+ minutes;
        var timeString= hours  + " hours "  + minutes + " minutes";
        var booker= "Not Booked";
        console.log(typeof(start));
       
         $.ajax({
                type: "POST",
                url: "putData.php",
                dataType: "json",
                 data: {
                    "date": date.toLocaleDateString(),
                    "start": s,
                    "end": e,
                    "duration": timeSpan,
                    "booker":booker
                },
                success: function(data, status) {
                    var buttonId= "delete"+1;
                    var info= "info"+2;
                    $("#avSlots").last().append("<tr>"+"<td>"+date.toLocaleDateString()+"</td>" +"<td>"+s+"</td>" +"<td>"+timeString+"</td>" +"<td>"+booker+"</td>"+"<td>"+"<button id="+info+">"+"Details</button>" +"</td>" +"<td>"+"<button id="+buttonId+ " onClick=clicked(this)"+">Delete</button>" +"</td>" +"</tr>");

                  
                },
                complete: function(data, status) { 
                    
                }
                
            });
            
            
            
             modal.style.display = "none";
   });
    </script>

  </body>
  <br><br><br>
  <table>
<thead>
<tr>
<th style="text-align:left">#</th>
<th style="text-align:left">Task Description</th>
<th style="text-align:left">Points</th>
</tr>
</thead>
<tbody>
<tr style="color:green;">
<td style="text-align:left">1</td>
<td style="text-align:left" >You provide a ERD diagram representing the data and its relationships. This may be included in Cloud9 as a picture or from a designer tool</td>
<td style="text-align:left">10</td>
</tr>
<tr style="color:green;">
<td style="text-align:left">2</td>
<td style="text-align:left">Tables in MySQL match the ERD and support the requirements of the application</td>
<td style="text-align:left">20</td>
</tr>
<tr style="color:green;">
<td style="text-align:left">3</td>
<td style="text-align:left">The list of available appointments is pulled from MySQL using the API endpoint and displayed using the specified page design</td>
<td style="text-align:left">20</td>
</tr>
<tr style="color:green;">
<td style="text-align:left">4</td>
<td style="text-align:left">Available times with dates in the past do not show up in the Dashboard list</td>
<td style="text-align:left">5</td>
</tr>
<tr style="color:green;">
<td style="text-align:left">5</td>
<td style="text-align:left">A user can add an available time slot to the MySQL using the API endpoint and displayed using the specified modal design</td>
<td style="text-align:left">20</td>
</tr>
<tr style="color:green;">
<td style="text-align:left">6</td>
<td style="text-align:left">A user can remove an available time slot from MySQL using the API endpoint</td>
<td style="text-align:left">15</td>
</tr>
<tr style="color:green;">
<td style="text-align:left">7</td>
<td style="text-align:left">The user confirms the removal using the specified modal design</td>
<td style="text-align:left">10</td>
</tr>
<tr>
<td style="text-align:left"></td>
<td style="text-align:left">TOTAL</td>
<td style="text-align:left">100</td>
</tr>
<tr style="color:green;">
<td style="text-align:left"></td>
<td style="text-align:left">This rubric is properly included AND UPDATED (BONUS)</td>
<td style="text-align:left">2</td>
</tr>
<tr style="color:red;">
<td style="text-align:left">BD</td>
<td style="text-align:left">Login works with a User table and BCrypt</td>
<td style="text-align:left">20</td>
</tr>
<tr style="color:green;">
<td style="text-align:left">BD</td>
<td style="text-align:left">Add Google Signin for app login</td>
<td style="text-align:left">10</td>
</tr>
<tr>
<td style="text-align:left">BD</td>
<td style="text-align:left">The app is deployed to Heroku</td>
<td style="text-align:left">15</td>
</tr>
<tr>
<td style="text-align:left">BD</td>
<td style="text-align:left">A banner file can be uploaded and displayed</td>
<td style="text-align:left">20</td>
</tr>
<tr>
<td style="text-align:left">BD</td>
<td style="text-align:left">The user can add multiple available time slots as specified</td>
<td style="text-align:left">10</td>
</tr>
<tr>
<td style="text-align:left">BD</td>
<td style="text-align:left">In a separate page, you show the correct list of available time slots to the user who navigates to the correct invitation URL</td>
<td style="text-align:left">10</td>
</tr>
<tr>
<td style="text-align:left">BD</td>
<td style="text-align:left">You correctly implement booking of the appointement, including all side effects</td>
<td style="text-align:left">30</td>
</tr>
</tbody>
</table>
</html>

