<?php


	session_start();

	$filename = basename($_FILES['uploadedfile']['name']);
	if(isset($filename)){

		if(!preg_match('/^[\w_\.\-]+$/', $filename) ){
			$_SESSION['error_message'] = "Invalid Filename";
			header("Location: view.php");
			exit;
		}

		$username = $_SESSION['username'];

		if(!preg_match('/^[\w_\-]+$/', $username) ){
			$_SESSION['error_message'] = "Invalid Username";
			header("Location: view.php");
			exit;
		}

		$full_path = sprintf("/home/nathanostdiek/users/%s/%s", $username, $filename);

		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
			$_SESSION['error_message'] = "Upload File Success";
			header("Location: view.php");
			exit;
		}
		else{
			$_SESSION['error_message'] = "Upload File Failure";
			header("Location: view.php");
			exit;
			
		}
	}
?>