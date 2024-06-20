<html>
<head>
<title>login</title>
</head>
<body>
<center>
<h1><u>Woof & Wag</u></h1>
<br>
<form action="" method="POST">
<table>
<tr>
<th>Username:</th>
<td><input type=text id="name" name="name" required></td>
</tr>
<tr>
<th>Password:</th>
<td><input type=password id='pass' name='pass' required></td>
</tr>
<tr>
<td><input type="submit" value="LOGIN" name="submit"></td>
<td><a href="" >forgot password?</a></td>
</tr>
</table>
</form>
</center>
<?php
include 'database.php';
if(isset($_POST['submit']))
{
$username = $_POST['name'];
$password = $_POST['pass'];
$sql = "SELECT * FROM adminlogin WHERE a_name = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
   {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['a_password'])) 
     {
        
        session_start();
        $_SESSION['name'] = $row['a_name'];
                } 
else 
{
   echo "Invalid password";
}
}
else 

{
   echo "No user found";
}
$conn->close();
}
?>
</body>
</html>
