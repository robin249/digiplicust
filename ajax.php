<?php
 require_once('database.php');
     $id_country = $_GET['id_country'];
     $state_id = $_GET['state_id'];
     if($id_country!="")
     {
         $res = $database->memberstate($id_country);
    	 if($res) return $res;	else echo "failed to insert data";
     }
     if($state_id!="")
     {
         $resx = $database->membercity($state_id);
	     if($resx) return $resx; else echo "failed to insert data";
	 
     }
	 
	 
	 

?>