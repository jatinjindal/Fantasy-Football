<?php

	include '_database/database.php';
	session_start();
	$current_user = $_SESSION['user_username'];

	// 	UPDATE table_name
	// SET column1 = value1, column2 = value2, ...
	// WHERE condition; 
	$sql = "UPDATE user SET def = '$def' WHERE user_username = '$current_user'";
	$sql = "UPDATE user SET forw = '$forw' WHERE user_username = '$current_user'";
	$sql = "UPDATE user SET mid = '$mid' WHERE user_username = '$current_user'";
	$sql = "UPDATE user SET gkp = '$gkp' WHERE user_username = '$current_user'";
	
	$result = mysqli_query($database,$sql) or die(mysqli_error($database));
	












	while($rws = mysqli_fetch_array($result)){ 
	?>

	<?php echo "<h1> Your Team </h1>" ; 

	echo $rws['user_id'];

    

    echo $_SESSION['user_username'];
    echo $_SESSION['user_password'];
    echo "Itna to hogya";
    echo $_POST["money"];

    $def = $_POST["def"];       // the array is converted to a string 
    echo $def;
?>
