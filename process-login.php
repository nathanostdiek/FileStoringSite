<?php
            session_start();
            
            $username = trim((string) $_GET['username']);
            $f = fopen("/home/nathanostdiek/users/users.txt", "r"); 
            $_SESSION['username'] = "invalid";
            if(strlen($username) == 0){
                header("Location: login.php");
                fclose($f);
                exit;
            }
            while(!feof($f)) {
                $user = trim(fgets($f));
                
                if ($user == $username) {
                    $_SESSION['username'] = $username;
                    fclose($f);
                    header("Location: view.php");
                    exit;
                }
            }
            header("Location: login.php");
            fclose($f);
?> 
