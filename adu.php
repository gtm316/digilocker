<?php
session_start();
if(isset($_SESSION["login"]))
{
//echo "welcome admin  ".$_SESSION["login"];
$host='localhost';
$user='root';
$pass='';
$check=null;
$r=null;
if(isset($_POST["submit"]))
{
	//$tid=uniqid();
//$id='1';
$conn=mysqli_connect($host,$user,$pass);
 if($conn)
// echo "connected succesfully";

$target_dir = "uploads/";//once file are uploaded then file will going to store in "uploads" folder
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//$name= . basename($_FILES["fileToUpload"]["name"]);
$name=$_FILES["fileToUpload"]["name"];//name of file
$type=$_FILES["fileToUpload"]["type"]; //types of file whether it is image or pdf or doc or any type of file.
$size=$_FILES["fileToUpload"]["size"];//size of  file
$temp=$_FILES["fileToUpload"]["tmp_name"];//location of file
$error=$_FILES["fileToUpload"]["error"];// error if 0 it means there is no error and if 1 there is error.
// Check if image file is a actual image or fake image
if(isset($_POST["expiry"],$_FILES["fileToUpload"])) {
	$file_name=mysql_real_escape_string($_FILES["fileToUpload"]["name"]);
	$expiry=time()+((int)$_POST["expiry"]*60);
	//$target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    /*$sql="insert into mydb.files(name,Location) value('$name','$target_file')";
        $query=mysqli_query($conn,$sql);
        if($query)
	    echo "inserted succesfully";*/
	    
   // $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
	//$finfo = finfo_open(FILEINFO_MIME_TYPE);   
    //$mime = finfo_file($finfo, $_FILES["fileToUpload"]["tmp_name"]); 
    
  /*if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }*/
}
// Check if file already exists
if (file_exists($target_file)) {
  // echo "Sorry, file already exists.";
  $sry="Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000)//if file greater than 50MB then file will not get uploaded  {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
/*if($type != "jpg" && $type != "png" && $type != "jpeg"
&& $type != "pdf" && $type != "mp4") {
    echo "Sorry, only JPG, JPEG, pdf,mp4 & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //" move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) " is use for copy file from source($_FILES["fileToUpload"]["tmp_name"] or $temp ) to destination($target_file)
		$rsel=mysqli_real_escape_string($conn,$_POST["sel"]);
		$rdetail=mysqli_real_escape_string($conn,$_POST["detail"]);
		$sql="insert into mydb.files values('','$name','$target_file',$expiry,'$rsel','$rdetail')";
        $query=mysqli_query($conn,$sql);
		//echo  "$sql";
        if($query)
	     $r="Inserted succesfully";
		//echo "The file " .'$name' ." has been uploaded.";
       echo $name;
	}	
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
//if user click on create users(c)button then they navigate to create users page
if(isset($_POST["C"]))
{
	header("Location:adm.php");
}
//if user click on upload(u)button then they navigate to upload page
if(isset($_POST["U"]))
{
	header("Location:adu.php");
}

//if user click on temporary(T)button then they navigate to to download page where user enter file name and based on expiry they can dowwnload the file.
if(isset($_POST["T"]))
{
	header("Location:display.php");
}

//if user click on create company(p)button then they navigate to create company page
if(isset($_POST["P"]))
{
	header("Location:comp.php");
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
#d1 { 
	      width: 20%; height: 98%; padding:15px; float: left;
		 background: #DDD; }
 #d2 { 
	      width: 80%; height: 100%; float: left;
		  background: #AAA; }
 #d { 
	       float: left;
		   width: 50%;
    height: 65%;
	 margin-top: 80px;
    margin-left: 180px;
	background: #ADD8E6;
 border: 3px solid #6792A0;
    box-shadow: 0 20px 50px #6792A0;	}
#j{ 
	      
		   width: 100%;
    height: 100%;
	 margin-top: 60px;
    margin-left: 30px;
       }
    </style>
</head>
<body>
<div id="d1">
<form action=" " method="POST" enctype="multipart/form-data">
 <ul class="w3-pagination">
    <li><a href="#"><input type="submit" id="i" name="C" value="CREATE USERS" style="text-align:center; background-color:#ADCDCD;"></a></li>
	<li><a href="#"><input type="submit" id="i" name="P" value="CREATE COMPANY" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="U" value="UPLOAD FILE" style="text-align:center; background-color:#ADCDCD;"></a></li>
    <li><a href="#"><input type="submit" id="i" name="T" value="TEMPORARY LINK" style="text-align:center; background-color:#ADCDCD;"></a></li>
	<li><a href="#"><input type="submit" id="i" name="logout" value="LOGOUT" style="text-align:center; background-color:#ADCDCD;"></a></li>

  </ul>

  </div>
<div id="d2">
<head>
<link href="indexstyle.css" rel="stylesheet" type="text/css">
</head>
<h2><?php echo "welcome admin  ".$_SESSION["login"]; ?></h2>
<h4><?php echo $r; ?></h4>
<div id="d">
<div id="j">
   <label for="pictures"> Select File to upload: </label>
	<input type="text" name="expiry" align="center"  placeholder="Enter expiry period"><br>
	<br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
	<br>
	Name of Company:
<select name="sel">
  <option value="pick"></option>
   <?php
   //following code is for fetching the company name from database.
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
   Detail about file:<input type="text" placeholder="Detail about file" name="detail">
<br><br>
    <div style="text-align:center;"><input type="submit" value="Upload" name="submit" style="text-align:center; color:blue; background-color:#C1ECFA; height:12%; width:20%; border:2px solid #DFFFFF;"> &nbsp;
	<input type="submit" name="Back" value="Back" style="text-align:center; color:blue; background-color:#C1ECFA; height:12%; width:20%; border:2px solid #DFFFFF;"></div>
	</div>
</form>
</div>
</body>
</html>