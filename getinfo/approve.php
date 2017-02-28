<?php
session_start();
include 'dbconnect.php';
if(isset($_SESSION['username'])){
	if($_SESSION['username'] == 'admin'){
		$stmt = $dbh->prepare("UPDATE news SET approved=1 WHERE id=:id");
		$stmt->bindParam("id" , $_GET['id']);
		$stmt->execute();
		header("location: manage.php");
		exit();
	}
}
header("Location: ./");
?>