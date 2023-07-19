<?php
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$msg= "";
if (file_exists($target_file)) {
    $msg = "Sorry, file already exists.";
} // Check file size
elseif ($_FILES["file"]["size"] > 5000000) {
    $msg = "Sorry, your file is too large.";
} elseif (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $msg = "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
}
?>