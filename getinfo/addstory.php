<?php
session_start();
include 'dbconnect.php';
if(!isset($_SESSION['username'])){
	header("Location: ./");
}
?>
<html>
<head>
<title>Add article</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
</head>
<body>
<div class="logo"> 
    <a href="./">
   <img src="logo.png" alt="GetInfo" style="width:400px00px;height:100px;">
    </a>
</div>
<form action="logout.php">
<input type="submit" class="logout" value="Log Out">
</form> 
<div class="background">
  <div class="transbox">

    <p>
	Add New Story:
	</p>
	<form class="w3-container w3-card-4" action="" method="post" enctype="multipart/form-data">

      <p>Select New Category:
  <select class="w3-select w3-border" name="category" required>
    <option value="" disabled selected>Choose your option</option>
    <option value="sc">Sci-fi</option>
    <option value="s">Sports</option>
    <option value="t">Technology</option>
    <option value="o">Other</option>	
  </select>
        </p>
	    <p>HeadLine for your Story:
		<input size="70" maxlength="100" type="text"	id="headline" name="headline" required>
	    </p>
	    <p>Thumbnail for your Story:
        <input name="image" type="file" required> 
		</p>
		<p>Write your Story:
	    <textarea cols="70" rows="30" name="story" required></textarea>
		</p>
		<p><input name="submit" value="Submit" type="submit">
		</p>
</form>
	
  </div>
</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
    $tmpName  = $_FILES['image']['tmp_name'];  
    $fp = fopen($_FILES['image']['tmp_name'], 'rb');
    $stmt = $dbh->prepare("INSERT INTO news (category , headline , imgname , thumbnail , story , username , timestamp) VALUES ( :category,:headline,:imgname,:image, :story,:username, NOW() )");
    $stmt->bindParam("category" , $_POST['category']);
    $stmt->bindParam("headline" , $_POST['headline']);
    $stmt->bindParam("imgname" , $_FILES['image']['name']);
    $stmt->bindParam("story" , $_POST['story']);
    $stmt->bindParam("username" , $_SESSION['username']);
    $stmt->bindParam("image", $fp, PDO::PARAM_LOB);
    if($stmt->execute()){
    echo "<script>alert('Story added succesfully');</script>";
    }
}
?>