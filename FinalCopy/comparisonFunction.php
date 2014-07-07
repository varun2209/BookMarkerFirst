<?php
function cmp($a, $b)
{   
    /**using url for comparison 
	 $aAlias=preg_replace( "((http://(www.))|(https://(www.))|https://|http://)i" , "" , $a->url );
     $bAlias=preg_replace( "((http://(www.))|(https://(www.))|https://|http://)i" , "" , $b->url );
	 return strncasecmp($aAlias, $bAlias, 10);
	 */
	$minLenght=0;
	$aLenght=strlen($a->name);
	$bLenght=strlen($b->name);
	if($aLenght<$bLenght){
	   $minLength=$aLenght;
	}
	else{
	  $minLenght=$bLenght;
	}
	return strncasecmp($a->name, $b->name,10);
}
?>