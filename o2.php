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
            color: white;
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
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="button"]:hover 
        {
            background-color: #008CBA;
        }       
        a 
        {
            text-decoration: none;
            color: #0000EE;
        }
        u 
        {
            color: #0000EE;
            align: left;
        }
     
    </style>
    <script>
    function validation()
    {
        var eid=document.getElementById('e').value;
        var pass=document.getElementById('pass').value;
        if(eid==="" || pass==="")
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
        return true;
    }
    </script>
</head>
<body>
    <center>
        <div class="form-container">
            <form action="" method="POST" onsubmit="return validation()">
                <table>
                    <tr>
                        <th>Email Id:</th>
                        <td><input type="text" id="e" name="e" placeholder="enter email id" required></td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td><input type="password" id="pass" name="pass" placeholder="enter password" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="login" value="Login"></td>
                        <td><a href="sign_up.php"><input type="button" name="sign up" value="Sign Up"></a></td>
                    </tr>
                </table>
                <u><a href="forgot_pass.php">Forgot password?</a></u>
            </form>
        </div>
    </center>
    <?php
    session_start();
    include 'database.php';
    if(isset($_POST['login'])) 
    {
        $emailid = trim($_POST['e']);
        $password = trim($_POST['pass']);

        // Debugging step: Check if the email and password variables are set correctly
        echo "<p>Debug: Email entered: $emailid</p>";
        
        // Ensure the connection is successful
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }

        // Debugging step: Display the SQL query
        $sql = "SELECT * FROM login WHERE email = '$emailid'";
        echo "<p>Debug: SQL query: $sql</p>";

        $result = mysqli_query($conn, $sql);

        // Debugging step: Check if the query returned any rows and print the result
        if($result) 
        {
            echo "<p>Debug: Query executed successfully.</p>";
            echo "<p>Debug: Number of rows returned: " . mysqli_num_rows($result) . "</p>";
        } else
        {
            echo "<p>Debug: Query failed: " . mysqli_error($conn) . "</p>";
        }

        if(mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
            echo "<p>Debug: User found. Hashed Password: " . $row['l_password'] . "</p>";
            
            if(password_verify($password, $row['l_password'])) 
            {
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                
                if($row['role'] == 1)
                {
                    header("Location: adminhome.html");
                } 
                else 
                {
                    header("Location: userhome.html");
                }       
            } 
            else
            {
                echo "<h2><center>Invalid Password</center></h2>";
            }
        } 
        else 
        {
            echo "<h2><center>Email not registered</center></h2>";
        }

        // Debugging step: Check if there were any errors with the query
        if(!$result)
        {
            echo "<p>Debug: MySQL Error: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</body>
</html>
