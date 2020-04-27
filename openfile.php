<?php

    session_start();

    $username = $_SESSION['username'];
    //$username = "alice";
    if( !preg_match('/^[\w_\-]+$/', $username) && isset($username)){
        $_SESSION['error_message'] = "Invalid Username";
		header("Location: view.php");
        exit;
    }
    $viewfile = true;

    $filename;
    if(isset($_POST['viewfile'])){
        $filename = $_POST['viewfile'];
    }
    if(isset($_POST['deletefile'])){
        $filename = $_POST['deletefile'];
        $viewfile = false;
    }
    
    if(isset($filename)){
        
        if(!preg_match('/^[\w_\.\-]+$/', $filename) ){
            $_SESSION['error_message'] = "Invalid Filename.";
            header("Location: view.php");
            exit;
        }

        $full_path = sprintf("/home/nathanostdiek/users/%s/%s", $username, $filename);

        if($viewfile == true){
            // Finally, set the Content-Type header to the MIME type of the file, and display the file.
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            $mime = $finfo->file($full_path);
            header("Content-Type: ".$mime);
            header('content-disposition: inline; filename="'.$filename.'";');
            readfile($full_path);
        }

        else if ($viewfile == false){
            if(unlink($full_path)){
                $_SESSION['error_message'] = "Delete File Success.";
                header("Location: view.php");
                exit;
            }
            else {
                $_SESSION['error_message'] = "Delete File Failure.";
                header("Location: view.php");
                exit;
            }
        }

    }
?>