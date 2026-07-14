<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_FILES["upload"]["tmp_name"])) {
        header("Location: index.php?error=Please upload a file");
        exit;
    }
    else {
        $target_dir="uploads/";
        $orig_name = basename($_FILES["upload"]["name"]);
        $target_file = uniqid() . $orig_name;
        $uploadOk = 1;
        $pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $destination = $target_dir . $target_file;

        if($pdfFileType !== "txt") {
            $uploadOk = 0;
            header("Location: index.php?error=Please upload a txt file");
            exit;
        }

        if($_FILES["upload"]["size"] > 500000) {
            $uploadOk = 0;
            header("Location: index.php?error=File is too big");
            exit;
        }

        if($uploadOk) {
            if(!is_dir('uploads')){
                mkdir('uploads');
            }

            $destination = $target_dir . $target_file;

            if(move_uploaded_file($_FILES["upload"]["tmp_name"], $destination)) {
                $uploadOK=1;
                $text = file_get_contents($destination);
            }
            else {
                header("Location: index.php?error=Upload failed");
                exit;
            }
        }
    }

}

$name_pattern = '/([A-Z][a-z]+(?: [A-Z][a-z]+){1,3})[^\r\n]*/m';
if(preg_match($name_pattern, $text, $matches)) {
    $name = substr($matches[1], 0, 30);
} else {
    $name = "Not found";
}

$email_pattern = '/[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}/';
if (preg_match($email_pattern, $text, $matches)) {
    $email = substr($matches[0], 0, 50);
} else {
    $email = "Not found";
}

$phone_pattern = '/\+?\d[\d\s-]{5,14}\d/';
if (preg_match($phone_pattern, $text, $matches)) {
    $phone = substr($matches[0], 0, 20);
} else {
    $phone = "Not found";
}

$gpa_pattern = '/GPA[ \t]*([0-5](?:\.\d+)?)/i';
if (preg_match($gpa_pattern, $text, $matches)) {
    $gpa = substr($matches[1], 0, 4);
} else {
    $gpa = "Not found";
}

$edu_pattern = '/\b(?:[a-zA-Z]+[ \t]+){1,5}(?:University|College|Institute|School)(?:[ \t]+(?:of|and|&)[ \t]+(?:(?![ \t]{2,})[a-zA-Z])+)*(?=[ \t]{2,}|\r|\n|$)/i';
if(preg_match($edu_pattern, $text, $matches)) {
    $education = substr($matches[0], 0, 100);
} else {
    $education = "Not found";
}

include 'dbManager.php';
saveApplicant($name, $email, $phone, $education, $gpa);

header("Location: index.php");
exit;


?>