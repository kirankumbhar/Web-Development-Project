<?php
session_start();
include 'dbconnect.php';
if(isset($_SESSION['username'])){
	header("Location: ./");
}
?>
<html>
<head>
<title>Register</title>
    <script>
function validateForm() {
var x = document.forms['signup']['email'].value;
var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
alert("Not a valid e-mail address");
return false;
}
x = document.forms['signup']['password'].value;
if(x.length() < 6){
alert('Password should be atleast 6 characters');
return false;
}
if(x != document.forms['signup']['repassword'].value){
alert('Password do not match');
return false;
}


}
    </script>
<title>Register</title>
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
  Sign Up</p>
	<form name=signup class="w3-container w3-card-4"  onSubmit="return validateForm()" action="" method="post">
	<label>
        First Name : </label>  
    <input type="text" pattern=".{4,}" title="First Name need to be atleast 4 character long" placeholder="Enter First Name" name="firstname" required value='<?php if(isset($_POST['firstname'])){echo htmlentities($_POST['firstname']);} ?>' >
		
	<br>
	<label>
        Last Name : </label>  
    <input type="text" pattern=".{4,}" title="Last Name need to be atleast 4 character long" placeholder="Enter Last Name" name="lastname" required value='<?php if(isset($_POST['lastname'])){echo htmlentities($_POST['lastname']);} ?>'>
	<br>
	<label>
        Username : </label>  
    <input type="text" pattern=".{4,}" title="Username need to be atleast 4 character long" placeholder="Enter Username" name="username" required value='<?php if(isset($_POST['username'])){echo htmlentities($_POST['username']);} ?>'>
	<br>
	<label>
        Email : </label>  
    <input type="text" placeholder="Enter Email" name="email" required value='<?php if(isset($_POST['email'])){echo htmlentities($_POST['email']);} ?>'>
	<br>
	<label>Password : </label>
    <input type="password" pattern=".{6,}" title="Password need to be atleast 6 characters" placeholder="Enter Password" name="password" required>
	  <br>
	<label>Password : </label>
    <input type="password" pattern=".{6,}" title="Password need to be atleast 6 characters" placeholder="Re-enter Password" name="repassword" required>
        <br>
    <input type="submit" class="signupbut" value="SignUp" name="submit">
        <br><br><br>
	</form>
	
  </div>
</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
	if($_POST['password'] != $_POST['repassword']){
		echo "<script>alert('password do not match');</script>";
		die();
	}
	$checkmail = $dbh->prepare("SELECT id FROM users where email=:mail");
	$checkmail->bindParam(":mail" , $_POST['email']);
	$checkmail->execute();
	if($checkmail->rowCount() > 0){
		echo "<script>alert('Email already used');</script>";
		die();
	}
	$checkuser = $dbh->prepare("SELECT id FROM users where username=:uname");
	$checkuser->bindParam(":uname" , $_POST['username']);
	$checkuser->execute();
	if($checkuser->rowCount() > 0){
		echo "<script>alert('username already used');</script>";
		die();
	}
	
	$stmt=$dbh->prepare("INSERT into users(fname , lname , username , email , password) VALUES(:fname , :lname , :username , :email , :password)");
	$stmt->bindParam("fname" , $_POST['firstname']);
	$stmt->bindParam("lname" , $_POST['lastname']);
	$stmt->bindParam("username" , $_POST['username']);
	$stmt->bindParam("email" , $_POST['email']);
	$stmt->bindParam("password" , $_POST['password']);
	$res = $stmt->execute();
	if($res){
		echo '<script type="text/javascript">'; 
		echo 'alert("Registartion Succesfull");'; 
		echo 'window.location.href = "./";';
		echo '</script>';
	}
}

?>