<?php 
session_start();
	include("config.php");
	include ("functions.php");



	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			//Save to database
			$user_id =  random_num(20); 
			$query = "INSERT INTO users (user_id,user_name,password) VALUES('$user_id','$user_name','$password')";
			mysqli_query($conn,$query);
			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid infomation";
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Sign up Form</h2>

<form method="post">

    <label for="user_name"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user_name">

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password">
        
    <button type="submit" value="signup">Sign Up</button>
    <a href="login.php">Click to login</a>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>

</form>

</body>
</html>
