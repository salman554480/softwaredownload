<?php 
require_once('parts/db.php');
if(isset($_GET['del'])){
	$del_id =  $_GET['del'];
	$table =  $_GET['table'];
	
	$id = $table."_id";
	
	 $delete = "DELETE from $table WHERE $id='$del_id'";
	$run_delete =  mysqli_query($conn,$delete);
	if($run_delete === true){
		echo "Deleted";
		echo "<script>window.history.back();</script>";
	}
	
	 
}
?>