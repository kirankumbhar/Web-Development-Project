<?php
session_start();
include 'dbconnect.php';
if($_SESSION['username'] != 'admin'){
	header("location: ./");
	exit();
}
$stmt = $dbh->prepare("DELETE from news where id=:id");
$stmt->bindParam("id" , $_GET['id']);
$stmt->execute();
header("location: manage.php");
?>