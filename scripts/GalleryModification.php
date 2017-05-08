<?php

//action 0:affichage,1:modification,2:nouveau

$action = 0;
$action= $_POST["action"];

if($action== 0){
	$id = $_POST["IdGallery"];
}else if ($action == 1){
	$id = $_POST["IdGallery"];
	$gallery = $_POST["Gallery"];
}else if($action == 2){
	$gallery = $_POST["Gallery"];
}


include ("Gallery.php");

$gallery = new Gallery();

if($action== 0){

	echo $gallery->displayGallery($id);

}else if ($action == 1){
	
}else if ($action == 2){
	$gallery->newGallery($gallery);
}

$gallery = null;

?>