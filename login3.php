<!DOCTYPE html>
<html>
 <head>
    <title>Login</title>
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
            width: 300px;
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
        input[type="button"] 
        {
            background-color: #C23B22;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="button"]:hover 
        {
            background-color: #C23B22;
        }       
        
        a
        {
            text-decoration: none;
            color: #0000EE;
            align:right;
        }   
        u{
         color: #0000EE;
        }
       
    </style>
 </head>
 <body>
  <center>
    <div class="form-container">
      <form action="" method="POST">
                <table>
                    <tr>
                        <th>Username:</th>
                        <td><input type="text" id="name" name="name" placeholder="enter username" required></td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td><input type="password" id="pass" name="pass" placeholder="enter password" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Login"></td>
                        <td><a href=""><input type="button" name="sign up" value="Sign Up"></a></td>
                    </tr>
                </table>
                <u><a href="">Forgot password?</a></u>
      </form>
    </div>
  </center>
  <?php
    include 'database.php';
     if(isset($_POST['submit'])) 
     {
       $username = trim($_POST['name']);
       $password = trim($_POST['pass']);
       $sql = "SELECT * FROM login WHERE l_name = '$username'";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) 
       {
         $row = $result->fetch_assoc();
         if ($password==$row['l_password']) 
         {
            session_start();
            $_SESSION['name'] = $row['l_name'];
            $_SESSION['role'] = $row['role'];
            echo "<h2><center>login successful</center></h2>";
            if($row['role']=='admin')
            {
                
                echo "<h2><center>admin login successful</center></h2>";
            }
            else 
            {
	                      echo "<h2><center>user login successful</center></h2>";
            }
         } 
         else 
         {
            echo "<h2><center>invalid login</center></h2>";
         }
       } 
       else 
       {
        echo "<h2><center>No user found</center></h2>";
       }
       $conn->close();
    }
   ?>
 </body>
</html>
