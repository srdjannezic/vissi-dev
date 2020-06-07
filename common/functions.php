<?php
 
function checkIsset(&$var){
	if(isset($var) && '' != $var){
		return $var;
	}
	else{
		return NULL;
	}
}

?>