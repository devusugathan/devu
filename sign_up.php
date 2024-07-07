<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
    
    </style>
    <script>
    function validation() 
    {
        var firstname = document.getElementById('f').value;
        var lastname = document.getElementById('l').value;
        var eid = document.getElementById('e').value;
        var pass = document.getElementById('pass').value;
        var con_pass = document.getElementById('cpass').value;
        if (firstname === "" || lastname === "" || eid === "" || pass === "" || con_pass === "") 
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
        if (pass !== con_pass) 
        {
            alert("Passwords do not match");
            return false;
        }
    }
    </script>
</head>
<body>
    <center>
        <div class="form-container">
            <form action="" method="POST" onsubmit="return validation()">
                <table>
                    <tr>
                        <th>First name:</th>
                        <td><input type="text" id="f" name="f" placeholder="enter first name" required></td>
                    </tr>
                    <tr>
                        <th>Last name:</th>
                        <td><input type="text" id="l" name="l" placeholder="enter last name" required></td>
                    </tr>
                    <tr>
                        <th>Email Id:</th>
                        <td><input type="text" id="e" name="e" placeholder="enter email id" required></td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td><input type="password" id="pass" name="pass" placeholder="enter password" required></td>
                    </tr>
                    <tr>
                        <th>Confirm password:</th>
                        <td><input type="password" id="cpass" name="cpass" placeholder="re-enter password" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Sign Up"></td>
                        <td><a href="o2.php"><input type="button" name="login" value="Back To Login"></a></td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
    <?php
    include 'database.php';
    if (isset($_POST['submit'])) 
    {
        $fname = trim($_POST['f']);
        $lname = trim($_POST['l']);
        $emailid = trim($_POST['e']);
        $password = trim($_POST['pass']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Debugging step: Display the email and hashed password being inserted
        echo "<p>Debug: Email to be inserted: $emailid</p>";
        echo "<p>Debug: Hashed Password to be inserted: $hashed_password</p>";

        $sql = "INSERT INTO login (f_name, l_name, email, l_password) VALUES ('$fname', '$lname', '$emailid', '$hashed_password')";

        if (mysqli_query($conn, $sql)) 
        {
            echo "<h2><center>Registered Successfully</center></h2>";
        } else 
        {
            echo "Error inserting record: " . mysqli_error($conn);
        }

        $conn->close();
    }
    ?>
</body>
</html>
