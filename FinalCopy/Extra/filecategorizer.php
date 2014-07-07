<?php
  
include 'comparisonFunction.php';

function sortandmerge(){
   
$sessionID=$_SESSION['UID'];
$userDirectory='upload/'.$sessionID;

$wikipediaUrlArray=array();
$acedemiaUrlArray=array();
$videoUrlArray=array();
$socialUrlArray=array();
$otherUrlArray=array();
$resultantArray=array();

$wikipatternName='(wikipedia)i';
$wikipatternURL='((wikipedia.org)|(wikihow.com))i';

$acedemiapatternName='((php)|(jquery)|(html)|(java)|(SQL)|(C++)|(stackoverflow))i';
$acedemiapatternURL='((php.net)|(jquery.com)|(w3schools.com)|(tutorialspoint.com)|(stackoverflow.com))i';

$videopatternName='((video)|(film)|(motion picture))i';
$videopatternURL='((youtube.com)|(vimeo.com))i';

$socialpatternName='((facebook)|(social)|(social networking)|(microblogging)|(tweets)|(pinterest))i';
$socialpatternURL='((facebook.com)|(twitter.com)|(pinterest.com))i';
$id=4;
  
    for($fileIndex=0;$fileIndex<$_SESSION['fileCount'];$fileIndex++){

   $json =file_get_contents($userDirectory."/".$fileIndex."Bookmarks"); 
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
						
					   if((preg_match($wikipatternName,$child->name))||(preg_match($wikipatternURL,$child->url))){
					      array_push($wikipediaUrlArray,$child); 
					   }
					   else if((preg_match($acedemiapatternName,$child->name))||(preg_match($acedemiapatternURL,$child->url))){
					      array_push($acedemiaUrlArray,$child); 
					   }
					   else if((preg_match($socialpatternName,$child->name))||(preg_match($socialpatternURL,$child->url))){
					      array_push($socialUrlArray,$child); 
					   }
					   else{
					       array_push($otherUrlArray,$child); 
					   }
				}
			
			}
	   }
	}
 }
echo'<br><br>';
  
if(!empty($wikipediaUrlArray)){   
   echo'<br><br>';
   $wikipediaArrayFinal=array_unique($wikipediaUrlArray, SORT_REGULAR);
   echo'<br>Sorted WiKis<br>';
   usort($wikipediaArrayFinal, "cmp");
   $tempArrayChildren=array('children'=>$wikipediaArrayFinal,'date_added'=>'13048775623824720','date_modified'=>'0','id'=>$id++,'name'=>'wikipedia','type'=>'folder');
   $tempArray=array('wikipedia'=>$tempArrayChildren);
   array_push($resultantArray,$tempArray);
   //var_dump($wikipediaArrayFinal);
  } 
  
if(!empty($acedemiaUrlArray)){
   echo'<br><br>';
   $acedemiaArrayFinal=array_unique($acedemiaUrlArray, SORT_REGULAR);
   echo'<br>Sorted Acedemia<br>';
   usort($acedemiaArrayFinal, "cmp");
   $tempArrayChildren=array('children'=>$acedemiaArrayFinal,'date_added'=>'13048775623824720','date_modified'=>'0','id'=>$id++,'name'=>'acedemia','type'=>'folder');
   $tempArray=array('acedemia'=>$tempArrayChildren);
   array_push($resultantArray,$tempArray);
   //var_dump($acedemiaArrayFinal);
   }
   
if(!empty($videoUrlArray)){
   echo'<br><br>';
   $videoArrayFinal=array_unique($videoUrlArray, SORT_REGULAR);
   echo'<br>Sorted Videos<br>';
   usort($videoArrayFinal, "cmp");
   $tempArrayChildren=array('children'=>$videoArrayFinal,'date_added'=>'13048775623824720','date_modified'=>'0','id'=>$id++,'name'=>'video','type'=>'folder');
   $tempArray=array('video'=>$tempArrayChildren);
   array_push($resultantArray,$tempArray);
   //var_dump($videoArrayFinal);
   }
   
if(!empty($socialUrlArray)){
   echo'<br><br>';
   $socialArrayFinal=array_unique($socialUrlArray, SORT_REGULAR);
   echo'<br>Sorted Socials<br>';
   usort($socialArrayFinal, "cmp");
   $tempArrayChildren=array('children'=>$socialArrayFinal,'date_added'=>'13048775623824720','date_modified'=>'0','id'=>$id++,'name'=>'social','type'=>'folder');
   $tempArray=array('social'=>$tempArrayChildren);
   array_push($resultantArray,$tempArray);
   //var_dump($socialArrayFinal);
   }
   
if(!empty($otherUrlArray)){
   echo'<br><br>';
   $otherArrayFinal=array_unique($otherUrlArray, SORT_REGULAR);
   echo'<br>Sorted Others<br>';
   usort($otherArrayFinal, "cmp");
   $tempArrayChildren=array('children'=>$otherArrayFinal);
   $tempArray=array('other'=>$tempArrayChildren,'date_added'=>'13048775623824720','date_modified'=>'0','id'=>$id++,'name'=>'other','type'=>'folder');
   array_push($resultantArray,$tempArray);
   //var_dump($otherArrayFinal);
   }
   
$resultFILE = "upload/".$sessionID."/"."Result";
$resultFileHandle = fopen($resultFILE, 'w') or die("can't open file");
$json =file_get_contents($userDirectory."/"."0Bookmarks"); 
$bookmarkFILE=json_decode($json);   
$roots=array('roots'=>$resultantArray);
$uploadFILE = array_merge_recursive((array)$bookmarkFILE,$roots);
fwrite($resultFileHandle, json_encode($uploadFILE));
}
?>