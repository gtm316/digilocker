
<?php
session_start();
echo "welcome user".$_SESSION["login"];
if(isset($_POST['show'])) 
{
	header("Location:uc.php");
}
	 
	if(isset($_POST["display"]))
	{
	header("Location:display.php");
    }
if(isset($_POST["logout"]))
{
session_destroy();
header("Location:index.php");
}

?>
<html>
<head>
<style>
table, th, tr, td {
    border: 1px solid black;
}
</style>
<link href="indexstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="" method="POST" align="center">
<input type="submit" name="show" value="Display users"></br>
<input type="submit" name="logout" value="logout"></br>
<input type="submit" name="display" value="Display pdf record"></br>
</form>
</table>
</body>
</html>