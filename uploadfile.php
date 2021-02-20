<?php
$target_dir = "uploads/";
$target_file = basename($_FILES["fileToUpload"]["name"]);

$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "doc" && $FileType != "docx" && $FileType != "ppt" && $FileType != "pptx" && $FileType != "xls" && $FileType != "xlsx" && $FileType != "pdf" && $FileType != "rar" && $FileType != "zip") {
    //$msg="Sorry, only JPG, JPEG, PNG, DOC, DOCX, PPT, PPTX, XLS, XLSX, RAR, ZIP & PDF files are allowed.";
    	//echo "err"; exit();
    	ob_start();
    header('location: index.php?errfile');
    exit();
}
    if($FileType){
    	$file_name = $target_dir . time() . "." . $FileType;
    	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_name);
    }
    ?>