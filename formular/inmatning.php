<!DOCTYPE html>
<?php
?>
<html>
<head>
	<title>Inmatning</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "butik";

try{
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
	die("ERROR: Could not connect. " . $e->getMessage());
} 
try{

	$sql = "INSERT INTO butik (artnmr,artnamn,beskrivning,kategori,inklmoms,exklmoms) VALUES (:artnmr, :artnamn, :beskrivning, :kategori, :inklmoms, :exklmoms)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':artnmr', $_REQUEST['artnmr']);
 	$stmt->bindParam(':artnamn', $_REQUEST['artnamn']);
    $stmt->bindParam(':beskrivning', $_REQUEST['beskrivning']);
    $stmt->bindParam(':kategori', $_REQUEST['kategori']);
    $stmt->bindParam(':inklmoms', $_REQUEST['inklmoms']);
    $stmt->bindParam(':exklmoms', $_REQUEST['exklmoms']);

 	$stmt->execute();
 	echo header('location: index.php');
} catch(PDOException $e){
 	die ('location: index.php');

}
unset($pdo);
?>
</body>
</html>
