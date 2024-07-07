<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
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
            border: 2px solid white;
            border-radius: 10px;
            width: 320px;
            background-color: rgba(255, 255, 255, 0.3);
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
        var eid = document.getElementById('id').value;
        var pass = document.getElementById('pass').value;
        var cpass = document.getElementById('cpass').value;
        
        if (eid === "" || pass === "" || cpass === "")
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
        if (pass !== cpass) 
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
    $emailid = trim($_POST['id']);
    $password = trim($_POST['pass']);
    $cpassword = trim($_POST['cpass']);
    
    if ($password !== $cpassword) 
    {
        echo "<h2><center>Passwords do not match...please enter again</center></h2>";
        exit();
    }

    $sql = "SELECT * FROM login WHERE email='$emailid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE login SET l_password='$hashed_password' WHERE email='$emailid'";
        if (mysqli_query($conn, $sql))
        {
            echo "<h2><center>Password changed</center></h2>";
        } 
        else
        {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    else 
    {
        echo "<h2><center>Email not registered...please enter again</center></h2>";
    }
    $conn->close();
}
?>
</body>
</html>
