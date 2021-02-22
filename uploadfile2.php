<?php
$target_dir = "profil/";
$target_file = basename($_FILES["fileToUpload2"]["name"]);

$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($FileType) {
    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg") {
    //$msg="Sorry, only JPG, JPEG, PNG, DOC, DOCX, PPT, PPTX, XLS, XLSX, RAR, ZIP & PDF files are allowed.";
        //echo "err"; exit();
        ob_start();
    header('location: add_host.php?errfile2');
    exit();
}

        $file_name2 = $target_dir . time() . "." . $FileType;
        move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $file_name2);
}else{
    $file_name2="";
}

    
    // if($FileType){
    // 	$file_name2 = $target_dir . time() . "." . $FileType;
    // 	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_name2);
    // }
    ?>