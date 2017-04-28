
<?php
session_start();
if(isset($_SESSION["login"]))
{
//echo "welcome admin  ".$_SESSION["login"];
$loginErr=$passwordErr="";
$login=$password="";
$host='localhost';
$user='root';
$pass='';
$cpassword=null;
$t=null;
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(isset($_POST["C"]))
{
	header("Location:adm.php");
}
if(isset($_POST["U"]))
{
	header("Location:adu.php");
}
if(isset($_POST["T"]))
{
	header("Location:display.php");
}
if(isset($_POST["P"]))
{
	header("Location:comp.php");
}
if(isset($_POST["logout"]))
{
	unset($_SESSION["login"]);
header("Location:index.php");
}


if(isset($_POST["submit"]))
{
	if(empty($_POST["login"]))
	{
		$loginErr="username must needed";	
	}
	else
	{
		$login=test_input($_POST["login"]);
		if(!preg_match('/^[a-zA-Z@_]*$/',$login))
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
	if(empty($_POST["cpassword"]))
	{
		$passwordErr="password must needed";	
	}
	else
	{
		$cpassword=test_input($_POST["cpassword"]);
		 if(!preg_match('/^[a-zA-Z0-9@_]*$/',$cpassword))
            {
             $passwordErr='Invalid Format! Re-Enter Password!';
            }
	}    
	  	// $rlogin=mysqli_real_escape_string($_POST["login"]);
	    // $rpassword=mysqli_real_escape_string(hash("sha512",$_POST["password"]));
	 	// $rcpassword=mysqli_real_escape_string(hash("sha512",$_POST["cpassword"]));
	if(empty($_POST["sel"]))
	{
		$passwordErr="password must needed";	
	}
	if("$password"==="$cpassword" && !empty($_POST["password"]) && !empty($_POST["login"]))
	{
	//echo "correct password";
	$conn=mysqli_connect($host,$user,$pass);
	$rlogin=mysqli_real_escape_string($conn,$_POST["login"]);
//$rpassword=mysqli_real_escape_string(hash("sha512",$_POST["password"]));
//  $rcpassword=mysqli_real_escape_string(hash("sha512",$_POST["cpassword"]));
         $rsel=mysqli_real_escape_string($conn,$_POST["sel"]);
         $rpassword=mysqli_real_escape_string($conn,$_POST["password"]);
		 $rpassword=md5($rpassword);
		 $rcpassword=mysqli_real_escape_string($conn,$_POST["cpassword"]);
	//$conn=mysqli_connect($host,$user,$pass);
	if($conn)
 $sql="insert into mydb.login value('$rlogin','$rpassword','$rsel')";
 $query=mysqli_query($conn,$sql);

if($query)
	$t="inserted succesfully";

	}
	/*
else
 echo "value is  not inserted";
	else
	{
		echo "incorrect password";
		
	}*/
 }
if(isset($_POST["logout"]))
{
session_destroy();
header("Location:index.php");
}
if(isset($_POST["Back"]))
{
header("Location:admin.php");
}
}
else{session_destroy();
	header("Location:index.php");}
?>
<!DOCTYPE html>
<html>
<head>
<link href="indexstyle.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<style  type="text/css">
html, body { height: 100%; padding: 0; margin: 0; }
#i
	{   
	    padding:15px; border:#FFFF83 2px solid;
	    width:100%; 
		border-collapse:collapse;
		background: #E18700;
		 margin-top: 20px;
	}
fieldset
{
	 width: 50%;
    height: 70%;
	 margin-top: 80px;
    margin-left: 180px;
	background: #ADCDCD;
	 border: 3px solid #6792A0;
    box-shadow: 0 20px 50px #6792A0;
	
}
#d1 { 
	      width: 20%; height: 98%; float: left;
		 background: #E1CBD4; }
 #d2 { 
	      width: 80%; height: 100%; float: left;
		  background: #AAA; }
    </style>
</head>
<body>
<div id="d1">
<form action="" method="POST">
 <ul class="w3-pagination">
    <li><a href="#"><input type="submit" id="i" name="C" value="CREATE USERS" style="text-align:center; background-color:#ADCDCD"></a></li>
	<li><a href="#"><input type="submit" id="i" name="P" value="CREATE COMPANY" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="U" value="UPLOAD FILE" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="T" value="TEMPORARY LINK" style="text-align:center; background-color:#ADCDCD;"></a></li>
	<li><a href="#"><input type="submit" id="i" name="logout" value="LOGOUT" style="text-align:center; background-color:#ADCDCD;"></a></li>

  </ul>
  </form>
  </div>
  <div id="d2">
  <h3><?php echo "welcome admin ".$_SESSION["login"]; ?></h3>   
    <h4><?php echo $t;?></h4>   

 <fieldset>
<h2 align="center"><b>CREATE USER</b></h2>
<!--<div style="text-align:right;"><input type="submit" name="logout" value="logout" style="text-align:center; color:blue; background-color:#ADCDCD; height:10%; width:20%; border:2px solid #DFFFFF;  margin-top: -320px;"></div>-->
<form action="" method="POST">
<label>NAME OF COMPANY:<label>
<select name="sel" required>
  <option value="pick"></option>
   <?php
      $conn=mysqli_connect($host,$user,$pass);
       $sql1 = "select cname from mydb.company";
	   $query=mysqli_query($conn,$sql1);
	 //  echo "$sql1";
       // echo "<select name='company'>";
         while ($row1 = mysqli_fetch_array($query)){
           echo "<option value='". $row1['cname'] ."'>" .$row1['cname'] ."</option>" ;
             }
           //echo "</select>" ;

        ?>
</select><br>
USERNAME:<input type="text" name="login" placeholder="Enter user name">
<span class="error">* <?php echo $loginErr;?></span></br>
PASSWORD:<input type="password" name="password"  placeholder="Enter password">
<span class="error">* <?php echo $passwordErr;?></span></br>
CONFIRM PASSWORD:<input type="password" name="cpassword" placeholder="Enter again password">
<span class="error">*<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $passwordErr;?></br></span></br>
</br>
<div style="text-align:center;"><input type="submit" name="submit" style="text-align:center; color:blue; background-color:#ADCDCD; height:10%; width:20%; border:2px solid #DFFFFF;"> &nbsp;
<input type="submit" name="Back" value="Back" style="text-align:center; color:blue; background-color:#ADCDCD; height:10%; right:79%; width:20%; border:2px solid #DFFFFF;"></div>
</form>
</fieldset>
</div>
</body>
</html>

