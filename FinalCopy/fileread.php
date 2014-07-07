<?php
  
include 'comparisonFunction.php';
   
function sortandmerge(){
   
$sessionID=$_SESSION['UID'];
   
	for($fileIndex=0;$fileIndex<$_SESSION['fileCount'];$fileIndex++){

   $json =file_get_contents("upload/".$sessionID."/".$fileIndex."Bookmarks"); 
   $bookmarkFILE=json_decode($json);
   $urlArray=array();
   
	   if($bookmarkFILE==NULL){
		echo "Jason can't be decoded.";
	   }
	   else{
		$categories=$bookmarkFILE->roots;
		foreach ($categories as $categoryMajor){
			foreach($categoryMajor->children as $child){
					if(!empty($child)){
					   echo "<br>".$child->name."<br>";
					   echo $child->url."<br>";
					   array_push($urlArray,$child); 
					}
			
			}
	   }
	}
   }
   echo'<br><br>';
   //var_dump($urlArray);
   echo'<br><br>';
   $arrayFinal=array_unique($urlArray, SORT_REGULAR);
   //var_dump($arrayFinal);
  
   echo'<br>Sorted<br>';
   usort($arrayFinal, "cmp");
   var_dump($arrayFinal);
   }
?>