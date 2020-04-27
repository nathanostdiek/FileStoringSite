<?php

    session_start();
    $username = $_SESSION['username'];

    $oldname = trim((string)$_POST['file']);
    $newname = trim((string) $_POST['newName']);

    if(!preg_match('/^[\w_\.\-]+$/', $newname) ){
        $_SESSION['error_message'] = "Invalid Filename";
        header("Location: view.php");
        exit;
    }
    
    $oldpath = sprintf("/home/nathanostdiek/users/%s/%s", $username, $oldname);
    $newpath = sprintf("/home/nathanostdiek/users/%s/%s", $username, $newname);

    
    if(substr($oldname, strpos($oldname, '.') + 1) != substr($newname, strpos($newname, '.') + 1)){
        $_SESSION['error_message'] = "Files must have same type.";
        header("Location: view.php");
        exit;
    }

    if(isset($oldname) && isset($newname)){
        if(rename($oldpath, $newpath)){
            $_SESSION['error_message'] = "Rename Successful";
			header("Location: view.php");
			exit;
        }
        else {
            $_SESSION['error_message'] = "Rename Failure";
			header("Location: view.php");
			exit;
        }

    }

?>