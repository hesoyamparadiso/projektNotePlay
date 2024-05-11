<?php
$target_dir = "Content/hudba/";
$target_file = $target_dir . basename($_FILES["fileToUpload_skladba"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Zkontroluje, zda již existuje
if (file_exists($target_file)) {
  $this->pridejZpravu("Soubor již existuje.");
  $uploadOk = 0;
}

// Zkontroluje velikost
if ($_FILES["fileToUpload_skladba"]["size"] > 50069420) {
  $this->pridejZpravu("Soubor je příliš velký.");
  $uploadOk = 0;
}

// Pouze vybrané formáty
if($imageFileType != "mp3" && $imageFileType != "wav" ) {
  $this->pridejZpravu("Jsou akceptovány pouze .mp3  a .wav soubory.");
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  $_SESSION["ok2"] = 0;
} else {
  if (move_uploaded_file($_FILES["fileToUpload_skladba"]["tmp_name"], $target_file)) {
    $_SESSION["zdroj"] = $_FILES["fileToUpload_skladba"]["name"];
    $_SESSION["ok2"] = 1;
  } else {
    $_SESSION["ok2"] = 0;
  }
}
?>