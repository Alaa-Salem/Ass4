<?php

session_start();


if(isset($_POST['submit'])){


  

    $name = $_POST['name'];
    $img = $_FILES['img'];

    // print_r($img);

    echo '<pre>';
    print_r($img);
    echo '</pre'>



    $imgName = $img['name'];
    $imgType = $img['type'];
    $imgTmpName = $img['tmp_name'];
    $imgError = $img['error'];
    $imgSize = $img['size'];

    $imgSizemb = $imgSize / (1024**2);
    $imgExtension = pathinfo($imgName , PATHINFO_EXTENSION);

    $errors=[];

    // validation on name input 
        if (empty($name)) {
            $errors[]='image name is requried';
        }else if(is_numeric($name) || ! is_string($name)){
            $errors[] = "image name must be string";
        }
        elseif (strlen($name)<4 || strlen($name)>50 ) {
            $errors[]='image name must be between [4-50]';
        }

   
    // validation on image   
        if($imgError >0 ){
            $errors[] = "there is error while uploading";
        }else if(! in_array($imgExtension,['jpg','png','gif','jpeg'])){
            $errors[] = "must be error";
        }else if($imgSizemb >1){
            $errors[] = "image size must less than 1mb ";
        }
   
   
    // if there no errors
        if (empty($errors)) {  
            $randStr = uniqid();
            $imgNewName = "$randStr.$imgExtension";
            move_uploaded_file($imgTmpName,"uploads/$imgNewName");
            header("location:upload_page.php");



        }
    // if there are errors
        else{
            session_start();
            $_SESSION['errors']=$errors;
            header("location:upload_page.php");
        }


}
else{
    header("location:upload_page.php");

}




?>