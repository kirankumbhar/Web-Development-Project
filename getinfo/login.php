<?php
session_start();
include 'dbconnect.php';
if(isset($_SESSION['username'])){
	header("Location: ./");
}
?>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" type="text/css" href="custom.css">

</head>
<body>
<div class="logo"> 
    <a href="./">
   <img src="logo.png" alt="GetInfo" style="width:400px00px;height:100px;">
    </a>
</div>  
<div class="background">
  <div class="transbox" align=center>
  <p>
  Log In</p>
	<form name="login" class="w3-container w3-card-4" action="" method="post">
	<label>
	Username :</label> 
    <input type="text" placeholder="Enter Username" name="uname" required value='<?php if(isset($_POST['uname'])){echo htmlentities($_POST['uname']);} ?>'>
        <br>
	<label>
        Password :</label> 
    <input type="password"  placeholder="Enter Password" name="pass" required value='<?php if(isset($_POST['pass'])){echo htmlentities($_POST['pass']);} ?>'>
	<br>
    <input type="submit" class="loginbut" value="Login" name="submit">
	</form>
      <br><br>
	
  </div>
</div>

</body>
</html>


<?php
if(isset($_POST['submit'])){
	$stmt = $dbh->prepare("SELECT id from users where username=:uname and password=:pass");
	$stmt->bindParam("uname" , $_POST['uname']);
	$stmt->bindParam("pass" , $_POST['pass']);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		$_SESSION['username']=$_POST['uname'];
		
		if($_POST['uname'] == 'admin'){
			header("Location: manage.php");
		}else{
			header("Location: ./");
		}
	}else{
		echo "<script>alert('Wrong username or password');</script>";
	}
}
?>