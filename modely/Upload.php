<?php
$target_dir = "Content/covers/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Zkontroluje, zda se jedná o skutečný obrázek
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $this->pridejZpravu("Soubor je obrázek - " . $check["mime"] . ".");
    $uploadOk = 1;
  } else {
    $this->pridejZpravu("Soubor není obrázek");
    $uploadOk = 0;
  }
}

// Zkontroluje, zda již existuje
if (file_exists($target_file)) {
  $this->pridejZpravu("Soubor již existuje.");
  $uploadOk = 0;
}

// Zkontroluje velikost
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $this->pridejZpravu("Soubor je příliš velký.");
  $uploadOk = 0;
}

// Pouze vybrané formáty
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $this->pridejZpravu("Jsou akceptovány pouze .JPG .JPEG .PNG & .GIF soubory.");
  $uploadOk = 0;
}


if ($uploadOk == 0) {
  $_SESSION["ok1"] = 0;
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $_SESSION["obrazek"] = $_FILES["fileToUpload"]["name"];
    $_SESSION["ok1"] = 1;
  } else {
    $_SESSION["ok1"] = 0;
    }
}
?>