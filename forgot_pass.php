<!DOCTYPE html>
<html>
 <head>
    <title>forgot password</title>
    <style>
        body 
        {
            background-image: url(106cc.jpg);
            background-repeat: no-repeat;
            background-size: cover; 
        }
        .form-container
        {
            padding: 20px;
            border: 2px solid white; /* White border to give rectangle appearance */
            border-radius: 10px;
            width: 320px;
             background-color: rgba(255, 255, 255, 0.3); /* transparent background */
             margin-top: 100px;
        }
        form 
        {
            color: white;
        }
        th, td
        {
            padding: 10px;
            text-align: left;
        }
        h2
        {
            color:white;
        }
        input[type="text"], input[type="password"]
        {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }       
        input[type="submit"] 
        {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover 
        {
            background-color: #45a049;
        }
         input[type="reset"] {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="reset"]:hover {
            background-color: #008CBA;
        }       
        </style>
        <script>
        function validation()
    {
        
        var eid=document.getElementById('id').value;
        var pass=document.getElementById('pass').value;
        var pass=document.getElementById('cpass').value;
        
        if(eid==="" || pass==="" || cpass==="")
        {
            alert("All fields are mandatory");
            return false;
        }
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(eid)) 
          {
            alert("Invalid email format");
            return false;
        }
         

    }
    </script>
 </head>
 <body>
 <center>
  <div class="form-container">
  <form action="" method="POST" onsubmit='return validation()'>
  <table>
    <tr>
     <th>Email id:</th>
     <td><input type="text" id="id" name="id" placeholder="enter email id" required></td>
    </tr>
    <tr>
     <th>New Password:</th>
     <td><input type="password" id="pass" name="pass" placeholder="enter new password" required></td>
    </tr>
    <tr>
     <th>Confirm Password:</th>
     <td><input type="password" id="cpass" name="cpass" placeholder="re-enter password" required></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" value="SUBMIT"></td>
      <td><input type="reset" name="sign up" value="Reset"></td>
     </tr>
  </table>
  </form>
  </div>
  </center>
  <?PHP
  include 'database.php';
  if(isset($_POST['submit'])) 
     {
       $emailid = trim($_POST['id']);
       $password = trim($_POST['pass']);
       $cpassword = trim($_POST['cpass']);
       $sql = "SELECT email FROM login";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) 
       {
         $row = $result->fetch_assoc();
         if ($emailid==$row['email']) 
         {
             if($password==$cpassword)
             {
              $sql="UPDATE login SET password='$password' WHERE email='$userid'";
              if(mysqli_query($conn,$sql))
              {
                echo "<h2><center>Password changed</center></h2>";
              }
              else
              {
                 echo "error inserting  record".mysqli_error($conn);
              }
              
             }
             else
             {
                 echo "<h2><center>passwords are not matching...please enter again</center></h2>";
             }
         }
         else
         {
          echo "<h2><center>Invalid userid...please enter again</center></h2>";
         }
       }
     }
  ?>
 </body>
 </html>