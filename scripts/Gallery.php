<?php 

include ("connection.php");

	class Gallery{
		
		private $db;
		
		 function __construct() {
		 	$this->$db= new QueryDb();
		}
		
		
		private function extractData($galleryData,&$images, &$description, &$details){
			
			$data = explode(",",$galleryData);
			
			if(count($data) != 3){
				die("Data no good , missing values ");
			}
			
			foreach ($data as $element){
				
				$value = explode(":",$element);
				
				if(count($value) > 1){
					
					switch($value[0]) {
						
						case "Description":
							$description = $value[1];
							break;
						case "Images":
							$images = $value[1];
							break;
						case "Details":
							$details= $value[1];
							break;
						default:
							die("Data no good : ".$value[1]);
					}
					
				}else
					die("Data no good , no value ");
					
			}
			
		}
		
		function newGallery($galleryData){
			
			
			/*$data = explode(",",$galleryData);
			
			if(count($data) != 3){
				die("Data no good , missing values ");
			}
			
			foreach ($data as $element){
				
				$value = explode(":",$element);
				
				if(count($value) > 1){
					
					switch($value[0]) {
						
						case "Description":
							$description = $value[1];
							break;
						case "Images":
							$images = $value[1];
							break;
						case "Details":
							$details= $value[1];
							break;
						default:
							die("Data no good : ".$value[1]);
					}
					
				}else 
					die("Data no good , no value ");
				
			}
			
			$this->insertNewGallery($images, $description, $details);*/
				$this->extractData($galleryData, $images, $description, $details);
				$this->insertNewGallery($images, $description, $details);
			
		}
		
		private function insertNewDetails($idGallery, $details){
			
			$sql = "Insert into GalleryDetails (IdGallery,Courriel) Values ($idGallery,$details)";
			$result = $this->$db->queryDb($sql);
			if(!$result){
				die("Failed to insert in Gallery details");
			}
			
		}
		
		private function updateNewDetails($idGallery, $details){
			
			$sql = "Update GalleryDetails (IdGallery,Courriel) Values ($idGallery,$details)";
			$result = $this->$db->queryDb($sql);
			if(!$result){
				die("Failed to update in Gallery details");
			}
		}
		
		private function insertNewImages($idGallery, $images){
			$paths = explode(",",$images);
			
			foreach ($paths as $image){
				$sql = "Insert into Images (path) Values ($image)";
				$result = $this->$db->queryDb($sql);
				
				if(!$result){
					die("Failed to insert in Images");
				}
				
				$sql = "SELECT MAX(IdImg) FROM Images";
				$result = $this->$db->queryDb($sql);
				
				if ($result) {
					$idImag = mysql_result($result, 0, 'IdImg');
					$sql = "Insert into ImageDetails (IdGallery,IdImag) Values ($idGallery,$idImag)";
					$result = $this->$db->queryDb($sql);
					if(!$result){
						die("Failed to insert in Image details");
					}
					
				}else
					die("Failed to get last Images Id");
			}
			
		}
		
		private function insertNewGallery($images,$description,$details){
			$sql = "Insert into Gallery (Description) Values ($description)";
			$result = $this->$db->queryDb($sql);
			
			if($result){
				$sql = "SELECT MAX(IdGallery) FROM Gallery";
				$result = $this->$db->queryDb($sql);
				if ($result) {
					$idGallery = mysql_result($result, 0, 'IdGallery');
					$this->insertNewImages($idGallery,$images);
					$this->insertNewDetails($idGallery,$details);
				}else 
					die("Failed to get last Gallery Id");
				
			}else 
				die("Failed to insert into gallery");
			
			
			
		}
		
		
		function displayGallery($id){
			
			$description = $this->getDescription($id);
			$images = $this->getImages($id);
			$details = $this->getGalleryDetails($id);
			
			return "Description:".$description.", Images:".$images." , Details:".$details;
			
		}
		
		
		private function getGalleryDetails($id){
			$sql = "SELECT IdGallery FROM GalleryDetails where IdGallery = ".$id;
			$result = $this->$db->queryDb($sql);
			$details = "";
			
			if ($result->num_rows > 0) {
				$details = $row["Courriel"];
			}
			
			return $details;
			
		}
		
		
		private function getImages($id){
			$sql = "SELECT IdImg FROM ImageDetails where IdGallery = ".$id." order by IdImg";
			$result = $this->$db->queryDb($sql);
			$images = "";
			
			if ($result->num_rows > 0) {
				
				while($row = $result->fetch_assoc()) {
					$images .= $row["IdImg"].",";
				}
			}
			
			return $images;
			
		}
		
		
		private function getDescription($id){
			$sql = "SELECT IdGallery, Description FROM Gallery where IdGallery = ".$id;
			$result = $this->$db->queryDb($sql);
			$description = "";
			
			if ($result->num_rows > 0) {
				$description = $row["Description"];
			}
			
			return $description;
			
		}
		
		
		
		function __destruct() {
			print "Destroying " . $this->name . "\n";
			$this->$db= null;
		}
		
		
}




?>