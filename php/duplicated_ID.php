<?php
// for ajax check duplicated ID
	require 'sql.php';
	$ID = $_GET['id'];

	$result = sqlDuplicatedID($ID);

	if(mysqli_num_rows($result) == 0){
		echo true;
	}
	else{
		echo false;
	}
?>
