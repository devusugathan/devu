<html>
 <head>
  <title>grooming</title>
 </head>
 <body>
   <div>
    <center>
         <h1><u>Pet Grooming</u></h1>
         <br>
         <form id="form" onsubmit="return validateform()" method="POST">
          <table>
          <tr>
            <th>ID:</th>
            <td><input type="number" id="b_id" name="b_id" placeholder="enter your id"></td>
           </tr>
           <tr>
            <th>Name:</th>
            <td><input type=text id="owner" name="owner" placeholder="enter owner name"></td>
           </tr>
           <tr>
            <th>Phone:</th>
            <td><input type="number" id='phn' name='phn' pattern="[0-9]{10}" placeholder="enter phone number"></td>
           </tr>
           <tr>
            <th>Breed:</th>
            <td><input type="text" id='breed' name='breed' placeholder="enter breed name"></td>
           </tr>
           <tr>
            <th>Date:</th>
            <td><input type="text" id='b_date' name='b_date' placeholder="enter booking date"></td>
           </tr>
           
           <tr>
             <td><input type="submit" name="submit" value="SUBMIT"></td>
             <td><input type="reset" name="reset" value="RESET"></td>
           </tr>
          </table>
         </form>
    </center>
   </div>
         <script>
             function validateform()
             {
                 var id=document.getElementById("b_id").value;
                var name=document.getElementById("owner").value;
                var phone=document.getElementById("phn").value;
                var breed=document.getElementById("breed").value;
                var date=document.getElementById("b_date").value;
               
                if(id=== "" || name === "" || phone === "" || breed === "" || date === "")
                {
                 alert("All fields are mandatory");
                 return false;
                }
                if(!/^\d{10}$/.test(phone))
                {
                  alert("invalid phone number");
                  return false;
                }
                return true;
             }
         </script>
   <?php
    include 'database.php';
     if(isset($_POST['submit'])) 
     {
         $grm_id = trim($_POST['b_id']);
       $grm_name = trim($_POST['owner']);
       $grm_phn = trim($_POST['phn']);
       $grm_breed = trim($_POST['breed']);
       $grm_date = trim($_POST['b_date']);
       $sql = "insert into grooming(g_id,name,phone,breed,g_date)values('$grm_id','$grm_name','$grm_phn','$grm_breed','$grm_date')";
       
if (mysqli_query($conn, $sql)) {
    echo "record inserted successfully";
} else {
    echo "Error inserting record " . mysqli_error($conn);
       }
       
  }
    mysqli_close($conn);
   ?>
   </body>
</html>
