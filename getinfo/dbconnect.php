<?php
try{
	$dbh = new PDO("mysql:host=localhost;dbname=getinfo;" , "root" , "");
}catch(PDOException $e){
	echo $e->getMessage();
}
?>