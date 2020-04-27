
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mod2 - group page</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="view-style.css">

    </head>
    
    <body>
        <?php 
            session_start();
            $username=$_SESSION['username'];
        ?>
        <div class="container p-2">
            <div class="row welcome">
                <div class="col">
                    <h3>Welcome <?php echo $username; ?></h3>
                </div>
                <div class="col-2 align-self-end">
                    <form class="form" enctype="multipart/form-data" action="logout.php">
                        <button class="btn btn-dark" type="submit" name="logout">Log Out</button>
                    </form>
                </div>
               
            </div>
            <hr>
            
            <div class="listfiles">
                <h4>Your Files:</h4>
                <form class="form p-2" enctype="multipart/form-data" action="openfile.php" method="POST">
                <div class="card w-50">
                    <ul class="list-group list-group-flush">
                <?php
                    

                    //LIST FILES
                    if ($handle = opendir('/home/nathanostdiek/users/' .$username)) {

                        while (false !== ($entry = readdir($handle))) {
                    
                            if ($entry != "." && $entry != "..") {
                    
                                ?>
                                
                                <li class="list-group-item">
                                        <p class="float-left px-3 file-name"><?php echo $entry; ?></p>
                                        <button class="btn btn-secondary btn-sm" type="submit" name="viewfile" value="<?php echo $entry; ?>">View File</button>
                                        <button class="btn btn-danger btn-sm" type="submit" name="deletefile" value="<?php echo $entry; ?>">Delete File</button>
                                    
                                </li>
                                
                            <?php

                            }
                        }
                    
                        closedir($handle);
                    }

                ?>
                    </ul>
                </div>
                </form>
                <button class="btn btn-success btn-sm" type="button" name="renamefile" data-toggle="modal" data-target="#renameModal" value="<?php echo $entry; ?>">Rename a File</button>

                



            </div>
            <div id="login-attempt" class="p-3 mx-auto">
                    <?php
                        if(isset($_SESSION['error_message'])){
                            echo '<p id="error-message">' . $_SESSION['error_message']  . '</p>';
                        } 
                    ?>
            </div>

            <div class="uploadfile">
                <h4>Upload a File</h4>
                <form class="form" enctype="multipart/form-data" action="uploadfile.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                        <label for="uploadfile_input">Choose a file to upload:</label> 
                        <input name="uploadedfile" type="file" id="uploadfile_input" />

                    </div>
                    <p>
                        <button type="submit" class="btn btn-sm btn-outline-primary" value="Submit">Submit</button>
                    </p>
                
                </form>
            </div>
        
        </div>
       
        
        


        
        <!-- structure taken from bootstrap documentation -->
        <div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="renameTitle">Rename a File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    <form class="form p-3" action="rename.php" method="POST">
                    <h5>What file?</h5>

                        <?php 
                            if ($handle = opendir('/home/nathanostdiek/users/' .$username)) {

                                while (false !== ($file = readdir($handle))) {
                            
                                    if ($file != "." && $file != "..") {

                                        ?>

                                        <div class="form-check p-1">
                                            <input class="form-check-input" type="radio" name="file" id='<?php echo $file?>' value="<?php echo $file?>" checked>
                                            <label class="form-check-label" >
                                                <?php echo $file ?>
                                            </label>
                                        </div>

                                        <?php
                                    }
                                }
                
                            closedir($handle);
                         }

                        ?>
                        <hr>
                        <div class="form-group">
                            <label for="newFileName">New File Name (must include same file type ex. 'file.txt'): </label>
                            <input type="text" class="form-control" id="newFileName" name="newName">
                            <?php echo substr($file, strpos($file, '.') + 1); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save name</button>
                        </div>
                    </form>
                </div>
                
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
