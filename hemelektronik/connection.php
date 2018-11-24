<?php
$connection =	mysqli_connect('localhost' , 'root' ,'' ,'butik');




if(isset($_POST['exklmoms'])){
	
	$artnmr = $_POST['artnmr'];
	$artnamn = $_POST['artnamn'];
    $beskrivning = $_POST['beskrivning'];
    $kategori = $_POST['kategori'];
    $inklmoms = $_POST['inklmoms'];
    $exklmoms = $_POST['exklmoms'];
	$id = $_POST['id'];


	 
	$result  = mysqli_query($connection , "UPDATE butik SET artnmr='$artnmr' , artnamn='$artnamn' , beskrivning = '$beskrivning'  , kategori = '$kategori' , inklmoms = '$inklmoms' , exklmoms = '$exklmoms'  WHERE id='$id'");
	if($result){
		echo 'data updated';
	}

}
?>
