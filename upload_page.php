<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            width:40%;
            margin:auto;
            padding:10px; 
            border:1px solid;
        }
      
    </style>
</head>
<body>
    
    <form action="handle_upload.php" method="POST" enctype="multipart/form-data"> 
        <input type="text" name="name" placeholder="Enter image name...">
        <br><br>
        <input type="file" name="img"  > 
        <br> <br>
            <?php

                session_start();

                if (!empty($_SESSION['errors'])) {

                    foreach ($_SESSION['errors'] as $key => $value) {
                        echo "errors[ $key ] : $value <br>";
                        unset($_SESSION['errors']);
                    }
                }
            ?>

            <br>


        <button type="submit" name="submit">upload</button> 
    </form>


  
     <h3 style="text-decoration:underline; color:darkblue">The Stored Images:</h3>

    <?php
   
        $files = scandir("uploads",SCANDIR_SORT_NONE);
        for($i=2;$i<count($files);$i++){ 
    ?>
        <a href="uploaded-image/<?php echo $files[$i]?>" download="" > <?php echo $files[$i] ?></a> 
        <br>
 


    <?php }?>


    


  
    
</body>
</html>


