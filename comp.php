<?php
session_start();
if(isset($_SESSION["login"]))
{
//echo "welcome admin  ".$_SESSION["login"];
$loginErr=$passwordErr=$amountrr="";
$login=$ologin=$amount="";
$host='localhost';
$user='root';
$pass='';
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

if(isset($_POST["submit"]))
{
	if(empty($_POST["login"]))
	{
		$loginErr="Company name must needed";	
	}
	else
	{
		$login=test_input($_POST["login"]);
		if(!preg_match('/^[a-zA-Z0-9@_]*$/',$login))//'/^[a-zA-Z0-9@_]*$/' this means that user insert there name from a to z,A to Z,0 to 9,@ and _  range only anyway symbol or latter are note accpted this is useful for the prevention of SQL INJECTION, so it act as Dilimiter//
         {
         $loginErr=' Re-Enter Your Name! Format Inccorrect!( only alpha, numbers,@_ are allowed)';
         }
		 
	}
	if(empty($_POST["ologin"]))
	{
		$passwordErr="Owner name must needed";	
	}
	else
	{
		$password=test_input($_POST["ologin"]);
		 if(!preg_match('/^[a-zA-Z@_]*$/',$password))
            {
             $passwordErr='Invalid Format! Re-Enter Password!';
            }
	}  
	
	if(empty($_POST["amount"]))
	{
		$amountrr="Amount must needed";	
	}
	else
	{
		$cpassword=test_input($_POST["amount"]);
		 if(!preg_match('/^[0-9@_]*$/',$cpassword))
            {
             $amountrr='Invalid Format! Re-Enter Amount';
            }
	}    

	//if(!empty($_POST["amount"] && $_POST["login"] && $_POST["ologin"] && $_POST["sel"]))  
	$conn=mysqli_connect($host,$user,$pass);
	$rlogin=mysqli_real_escape_string($conn,$_POST["login"]);
//$rpassword=mysqli_real_escape_string(hash("sha512",$_POST["password"]));
//  $rcpassword=mysqli_real_escape_string(hash("sha512",$_POST["cpassword"]));
         $rologin=mysqli_real_escape_string($conn,$_POST["ologin"]);
		 $rsel=mysqli_real_escape_string($conn,$_POST["sel"]);
		 $ramount=mysqli_real_escape_string($conn,$_POST["amount"]);
	//$conn=mysqli_connect($host,$user,$pass);
	if($conn)
 $sql="insert ignore into mydb.company value('','$rlogin','$rologin','$rsel',$ramount)";
 $query=mysqli_query($conn,$sql);
 if($query)
	$t="inserted succesfully";
/*if($query)
	echo "inserted succesfully";
else
 echo "$sql";
	}
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
	 width: 60%;
    height: 80%;
	 margin-top: -10px;
    margin-left: 180px;
	background: #ADD8E6;
	 border: 3px solid #6792A0;
    box-shadow: 0 20px 50px #6792A0;
	
}
#d1 { 
	      width: 20%; height: 100%; float: left;
		 background: #DDD; }
 #d2 { 
	      width: 80%; height: 100%; float: left;
		  background: #AAA; }
    </style>
</head>
<body>
<div id="d1">
<form action="" method="POST">
 <ul class="w3-pagination">
     <li><a href="#"><input type="submit" id="i" name="C" value="CREATE USERS" style="text-align:center; background-color:#ADCDCD;"></a></li>
	<li><a href="#"><input type="submit" id="i" name="P" value="CREATE COMPANY" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="U" value="UPLOAD FILE" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="T" value="TEMPORARY LINK" style="text-align:center; background-color:#ADCDCD;"></a></li>
	<li><a href="#"><input type="submit" id="i" name="logout" value="LOGOUT" style="text-align:center; background-color:#ADCDCD;"></a></li>

  </ul>
  </form>
  </div> 
  <div id="d2">
  <h3><?php try{echo "welcome admin  ".$_SESSION["login"];} catch(Exception $ex){} ?></h3>
    <h4><?php echo $t; ?></h4>
  <fieldset>
<h2 align="center">Create Company</h2>
<form action="" method="POST" align="center">
Name of Company:<input type="text" name="login"  placeholder="Enter Company name"></input>
<span class="error">* <br><?php echo $loginErr;?></br></span></br>
Name of Owner:<input type="text" name="ologin" placeholder="Enter Owner name"></input>
<span class="error">* <br><?php echo $passwordErr;?></br></span></br>
Payment Mode:
<select name="sel">
  <option value="Cash">Cash Payment</option>
  <option value="MO">Money Orders</option>
  <option value="Cheque">Cheque</option>
  <option value="BD">Bank Draft</option>
</select><br>
Amount Paid:<input type="text" name="amount" placeholder="Enter amount">
<span class="error">* <br><?php echo $amountrr;?></br></span></br>
<input type="submit" align="center"name="submit" value="Create Company" style="text-align:center; color:blue; background-color:#C1ECFA; height:12%; width:25%; border:2px solid #DFFFFF;"></input>
<br>
<input type="submit" name="logout" value="logout" style="text-align:center; position:absolute; color:blue; background-color:#C1ECFA; height:12%; width:20%; margin-left:80%; margin-top:-370px; border:2px solid #DFFFFF;"></input>
<br>
<input type="submit" name="Back" value="Back" style="text-align:center; position:absolute; color:blue; background-color:#C1ECFA; height:12%; margin-left:80%; margin-top:-30px; width:20%; border:2px solid #DFFFFF;"></input>
<br>
</fieldset>
</form>
</div>
</body>
</html>
