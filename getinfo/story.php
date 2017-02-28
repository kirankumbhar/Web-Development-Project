<?php
session_start();
include 'dbconnect.php';
?>
<html>
<head>
<title>Article</title>
    <link rel="stylesheet" type="text/css" href="custom.css">
	<style>
			div.headline {
		margin: 5%;
		font-size: 30;
		weight: bold;
		color: white;
		font-family: "Times New Roman", Times, serif;
	}
		pre
	{
		padding: 20px 20px;
		font-family: Bell MT;
	    font-size: 24px;
		white-space: pre-wrap;
		color:white;
	}
		a
	{
		text-decoration: none;
		color:white;
	}
	div.background {
  background: url(bg.jpg) no-repeat;
  border: 0.5px transparent black;
  background-attachment: fixed;
}
div.img
{
	float: left;
    margin: 5px 10px 20px 20px;
}



	</style>
</head>
<body>
<div class="logo"> 
    <a href="./">
   <img src="logo.png" alt="GetInfo" style="width:400px00px;height:100px;">
    </a>
</div>  
    
<?php
if(!isset($_SESSION['username'])) : 
?>
    
<form action="login.php" method="post">
<button class="signin">Sign in</button>
</form>
<form action="register.php" method="post">
<button class="signup">Sign up</button>
</form>
<?php
    else : 
?>
<div class="welcome">
<div id="divid" style="position:absolute; top:120;right:105;"><?php echo 'welcome '.htmlentities($_SESSION['username'])?></div>
</div>
<form action="logout.php" method="post">
<input type="submit" class="logout" value="Log Out">
</form><?php
if($_SESSION['username'] != 'admin') {
?>
<form action="addstory.php" method="post">
<input type="submit" class="addstory" value="Add Article">
</form>
<?php
}else{
?>

<form action="manage.php" method="post">
<input type="submit" class="manage" value="Manage Articles">
</form>
<?php
}
   endif; 
?>

 
  

<div class="background">
  <div class="transbox">

  <ul>
  <li><a  href="./">Home</a></li>
  <li><a  href="sci.php">Sci-fi</a></li>
  <li><a  href="sports.php">Sports</a></li>
  <li><a  href="tech.php">Technology</a></li>
  <li><a  href="others.php">Others</a></li>
</ul>
<?php
      $stmt = $dbh->prepare("SELECT * from news where id=:id");
      $stmt->bindParam("id" , $_GET['id']);
      $res = $stmt->execute();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  
		  ?>
		
		<div class="headline">
		<strong>
		<?php
          echo "<h2><a href=story.php?id=".$row['id'].">".htmlentities($row['headline'])."</a></h2>";
		  
		  ?>
		</strong>
		</div>
		<?php
		echo "<div class='img'>";
          echo '<img src="data:image/jpeg;base64,'.
		  base64_encode($row['thumbnail']).
		'" width="400" height="220" style="vertical-align:top">';
		echo "</div>";
          
	  ?>
	  <div class="edit">
		<?php
		echo $row['timestamp'];
		echo '<br>';
		echo 'Edited by :- '.htmlentities($row['username']);
		echo '<br>';
		?>
		</div>
		<?php
		echo'<pre>'.htmlentities($row['story']).'</pre>';

		?>
		<hr style="border-style:solid;color:black; border-bottom-width: 10px;"></hr>
		<?php
		echo "<script>document.title='".htmlentities($row['headline'])."';</script>";
      }
      ?>
  </div>
</div>

</body>
</html>
