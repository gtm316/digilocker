<?php
session_start();
//echo "welcome admin  ".$_SESSION["login"];
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
?>
<html>
<head>
<meta charset="utf-8">
<link href="indexstyle.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style type="text/css">
	html, body { height: 100%; padding: 0; margin: 0; }
	.TFtable{
		margin:150px auto;
		width:20%; 
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:15px; border:#FFFF83 3px solid;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		background: #F2F533;
	}
	/*  Define the background color for all the ODD background rows  */
	.TFtable tr:nth-child(odd){ 
		background: #F2F533;
	}
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #F2F533;
	}
	#i
	{   
	    padding:15px; border:#FFFF83 2px solid;
	    width:100%; 
		border-collapse:collapse;
		background: #E18700;
		 margin-top: 20px;
	}
	/*.container
	{
		max-width:190px;
		height:400px;
		margin-top:20%;
	}*/
	#d1 { 
	      width: 15%; height: 100%; float: left;
		 background: #E1CBD4; }
    #d2 { 
	      width: 80%; height: 100%; float: left;
		  background: #AAA; }
    </style>
	</head>
<body>
<form action="" method="post">

<div id="d1">
<form action="" method="POST">
 <ul class="w3-pagination">
    <li><a href="#"><input type="submit" id="i" name="C" value="CREATE USERS" style="text-align:center; background-color:#ADCDCD;"></a></li>
	<li><a href="#"><input type="submit" id="i" name="P" value="CREATE COMPANY" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="U" value="UPLOAD FILE" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="T" value="TEMPORARY LINK" style="text-align:center; background-color:#ADCDCD;"></a></li>
  </ul>
  </form>
  </div>
  <div id="d2">
  <h2 align="center"><?php echo "welcome admin  ".$_SESSION["login"]; ?></h2>

  </div>
</table>
</form>
</body>
</html>