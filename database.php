<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
    include('header.php');
// class Database{
	
// 	private $connection;
 
// 	function __construct()
// 	{
// 		$this->connect_db();
// 	}
 
// 	public function connect_db(){
// 		$this->connection = mysqli_connect('localhost', 'rambvmjj_diji', 'diji123', 'rambvmjj_dijipay');
// 		if(mysqli_connect_error()){
// 		die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
// 		}
// 	}
    
//     public function url()
//     {
//         $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
//         $pageURL .= "://";
//      return   $pageURL  =$protocol . "://" . $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] ;
//     }
// 	public function create($fname,$lname,$email,$gender,$age){
// 		$sql = "INSERT INTO `crud` (firstname, lastname, email, gender, age) VALUES ('$fname', '$lname', '$email', '$gender', '$age')";
// 		$res = mysqli_query($this->connection, $sql);
// 		if($res){
// 		return true;
// 		}else{
// 		return false;
// 		}
// 	}
   
   
//    public function memberstate($id_country){
// 		 $sql = "select * from states where country_id = '$id_country'";
//  	     $result = mysqli_query($this->connection, $sql);
//  	    // echo "<pre>";print_r($result);die;
// 		 $output='<option value="">Please Select State</option>';
//          foreach($result as $row)
// 			 {
// 			 echo $output = '<option value="'.$row['id'].'">'.$row['name'].'</option>';
// 			 }
//           return $output;
//    }
   
//    public function membercity($state_id){
     
// 		 $sql = "select * from cities where state_id = '$state_id'";
//  	     $result = mysqli_query($this->connection, $sql);
// 		 $output='<option value="">Please Select City</option>';
//          foreach($result as $row)
// 			 {
// 			 echo $output = '<option value="'.$row['id'].'">'.$row['name'].'</option>';
// 			 }
//           return $output;
//    }
// // 	public function read($id=null){
// // 		$sql = "SELECT * FROM `countries`";
// // 		if($id){ $sql .= " WHERE id=$id";}
// //  	$res = mysqli_query($this->connection, $sql);
// //  	return $res;
// // 	}
// 	public function read(){
// 		$sql = "SELECT * FROM `tbl_countries`";
//  	   $res = mysqli_query($this->connection, $sql);
//  	  return $res;
// 	}
 
//    	public function state(){
// 		$sql = "SELECT * FROM `states` where country_id = '231'";
//  	   $res = mysqli_query($this->connection, $sql);
//  	  return $res;
// 	}
 
// 	public function update($fname,$lname,$email,$gender,$age, $id){
// 		$sql = "UPDATE `crud` SET firstname='$fname', lastname='$lname', email='$email', gender='$gender', age='$age' WHERE id=$id";
// 		$res = mysqli_query($this->connection, $sql);
// 		if($res){
// 		return true;
// 		}else{
// 		return false;
// 		}
// 	}
 
// 	public function delete($id){
// 		$sql = "DELETE FROM `crud` WHERE id=$id";
//  	$res = mysqli_query($this->connection, $sql);
//  	if($res){
//  	return true;
//  	}else{
//  	return false;
//  	}
// 	}
 
// 	public function sanitize($var){
// 		$return = mysqli_real_escape_string($this->connection, $var);
// 		return $return;
// 	}
 
// }
 
// $database = new Database();
//      include('footer.php'); 
?>