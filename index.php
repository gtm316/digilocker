
<?php
session_start();
$loginErr=$passwordErr="";
$login=$password="";
$host='localhost';
$user='root';
$pass='';
if(isset($_POST["submit"]))
{
	if(empty($_POST["login"]))
	{
		$loginErr="username must needed";	
	}
	else
	{
		$login=test_input($_POST["login"]);
		if(!preg_match('/^[a-zA-Z0-9@_]*$/',$login))
         {
         $loginErr=' Re-Enter Your Name! Format Inccorrect!( only alpha, numbers,@_ are allowed)';
         }
		 
	}
	if(empty($_POST["password"]))
	{
		$passwordErr="password must needed";	
	}
	else
	{
		$password=test_input($_POST["password"]);
		 if(!preg_match('/^[a-zA-Z0-9@_]*$/',$password))
            {
             $passwordErr='Invalid Format! Re-Enter Password!';
            }
	}
	$conn=mysqli_connect($host,$user,$pass);
	$u=$_POST["login"];
	$p=md5($_POST["password"]);
	$p1=$_POST["password"];
	if($conn)
          $sql="select * from mydb.login";
         $query=mysqli_query($conn,$sql);
           $row=mysqli_num_rows($query); 
	           while($g=mysqli_fetch_assoc($query))
			   {
				  // echo "username is:".$g["username"];
				  
		         if($u==$g["username"] && $p==$g["password"])
				 {
					 $_SESSION["ulogin"]=$u;
					
					header("Location:user1.php");
				 }
			   }
	  $sql1="select * from mydb.admin";
         $query=mysqli_query($conn,$sql1);
           $row=mysqli_num_rows($query);
            
	           while($g=mysqli_fetch_assoc($query))
			   {
				  // echo "username is:".$g["username"];
		         if($u==$g["username"] && $p1==$g["password"])
				 {
				     $_SESSION["login"]=$u;
					header("Location:admin.php");
				 }
			   }
	 
			echo "login or password is invalid";  
	
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="indexstyle.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style  type="text/css">
#container
{
	position: center;
    width: 25%;
    height: 60%;
    top: 50%;
    left: 40%;
	 margin-top: -180px;
    margin-left: -80px;
	background: #ADD8E6;
    border-radius: 3px;
    border: 3px solid #7e7e7e;
    box-shadow: 0 30px 50px rgba(10, 10, 10, .10);
}
#s {
    width: 30%;  height: 3em; align:center;
}
body{background: 	#C0C0C0;}
	.header{ margin-top: 20px;}

</style>
</head>
<body>
<div id="container">
<form action="" method="POST">
<div class="grad"></div>
<div class="header"></div>
<h3 style="text-align:center"><strong>PLEASE LOGIN</strong></h3>
<font size="5"><input type="text" name="login" placeholder="Enter the username" style="width: 80%; margin-left:5%">
<span class="error">* <?php echo $loginErr;?></span></br>
<br>
<font size="5"></font><input type="password" name="password" placeholder="Enter the password" style="width: 80%; margin-left:5%">
<span class="error">* <?php echo $passwordErr;?></span><br>
<br>
<div style="text-align:center; "><input type="submit" value="LOGIN" name="submit" id="s" style="text-align:center; width: 90%; background-color:#8FBAC8;"></div>
<div>
</form>
</body>
</html>