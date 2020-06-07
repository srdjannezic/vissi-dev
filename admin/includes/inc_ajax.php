<?php
if(!defined('SYSBASE')){
	define('SYSBASE', str_replace('\\', '/', realpath(dirname(__FILE__).'/../../').'/'));
}

require_once(SYSBASE.'common/lib.php');
require_once(SYSBASE.'common/define.php');
if($db != false){
	if(isset($_GET['function']) && $_GET['function'] == "getAllTypeItems" && isset($_POST['table'])){

		$selection = db_selectWhere($db,$_POST['table'],' WHERE lang=2');
		if($selection){
			echo json_encode(array('items'=>$selection->fetchAll()));
		}
	} 

}

?>  