<?php
session_start();
if(isset($_SESSION["ulogin"]))
{
//echo "welcome admin  ".$_SESSION["login"];
$host='localhost';
$user='root';
$pass='';
$g=null;
$f=null;
$t=null;
mysql_select_db("mydb");
mysql_connect($host,$user,$pass);
$chunk=null;
if(isset($_POST["search"]))
{
if(!empty($_POST['sendmsg']))
$f=$_POST['sendmsg'];
$sql1="select * from mydb.files where Name='$f' limit 1";
//echo "$sql1";
$query1=mysql_query($sql1);
while($r=mysql_fetch_array($query1))  
{
	$g=$r['Name'];
	$t=$r['Location'];
}
}
if(isset($_POST["v"]))
{
	header("Location:user2.php");
}
if(isset($_POST["t"]))
{
	header("Location:user3.php");
}
if(isset($_POST["logout"]))
{
unset($_SESSION["ulogin"]);
header("Location:index.php");
}
if(isset($_POST["Back"]))
{
header("Location:user1.php");
}
}
else{session_destroy();
	header("Location:index.php");}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link href="indexstyle.css" rel="stylesheet" type="text/css">
<style type="text/css">
	html, body { height: 100%; padding: 0; margin: 0; }
table, th, tr, td {
    border: 1px solid black;
	background: #00D5FF;
}
	
	#i
	{   
	    padding:15px; border:#FFFF83 3px solid;
	    width:100%; 
		border-collapse:collapse;
		background: #E18700;
		 margin-top: 20px;
	}
	#sendmsg
   {
	 position: absolute; 
	}
	#t{
		margin-top:50px;
	}
	#l{
		margin-top:80px;
	}
	#b{
		margin-top:40px;
		right:80%;
		margin-left:75%;
	}
	 #d { 
	       float: left;
		   width: 70%;
    height: 80%;
	 margin-top: 80px;
    margin-left: 180px;
	background: #ADD8E6;
    border: 3px solid #6792A0;
    box-shadow: 0 20px 50px #6792A0;	}
	#d1 { 
	      width: 15%; height: 100%; float: left;
		 background: #DDD; }
    #d2 { 
	      width: 85%; height: 100%; float: left;
		  background: #AAA; }
    
	<head>
</style>
<body>
<div id="d1">
<form action="" method="POST">
 <ul class="w3-pagination">
    <li><a href="#"><input type="submit" id="i" name="v" value="VIEW" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="t" value="TEMPORARY LINK" style="text-align:center; background-color:#ADCDCD;"></a></li>
	<li><a href="#"><input type="submit" id="i" name="logout" value="LOGOUT" style="text-align:center; background-color:#ADCDCD;"></a></li>
  </ul>
  <!--</form>-->
  </div>
 <div id="d2">
 <div id="d">
<table align="center">
  <tr>
    <th>File names</th>
    <th>File Location</th>
  </tr>
  <br>
</div>
<?php
$host='localhost';
$user='root';
$pass='';
mysql_select_db("mydb");
mysql_connect($host,$user,$pass);
$sql="select * from mydb.files limit 1";
$query=mysql_query($sql);
	while($row=mysql_fetch_array($query))
	{
	
		$path=$row['ID'];
		//echo "<a href='download.php?dow=$path'><strong>download</strong></a></br>";
	?>
	<tr style="width:50px">
	<td><?php echo $g; ?></br></td>
	<td><?php echo $t; ?></br></td>
	</tr>
	<?php
	/*$id=$row['id'];
	    echo "<a href='download.php?dow=$path'> Download</a>";
		echo date('d/m/y H:i:S',$row['expiry']);*/
	}
	?>
	<!--<form action="" method="POST">-->
	<h3><?php echo "welcome admin ".$_SESSION["ulogin"]; ?></h3>
<div style="color:blue;"> <input type="submit" name="logout" value="logout"  style="text-align:center; color:blue; margin-left:85%; background-color:#C1ECFA; width:15%; border:2px solid #DFFFFF;"></div>
<div style="text-align:right; color:blue;"><input type="submit" name="Back" value="Back" style="text-align:center; color:blue; margin-left:75%; background-color:#C1ECFA; width:15%; border:2px solid #DFFFFF;"></div>
 <div><input type="text" class='w3-input w3-border' name='sendmsg' id='sendmsg' style="width:20%;  top:30%;  right:30%;"  placeholder="type search here"><input type="submit" value="search files" name="search" class="w3-btn w3-blue w3-border  w3-round-xlarge " style=" position: absolute; height:8%; top:30%; width:10%;"></div><br>
 </form>
</div>
</table>
</body>
</html>
