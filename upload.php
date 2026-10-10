<?php
require_once "db.php"; $message="";
if($_SERVER["REQUEST_METHOD"]==="POST") {
 $id=(int)($_POST["patient_id"]??0);
 if(!isset($_FILES["photo"]) || $_FILES["photo"]["error"]!==UPLOAD_ERR_OK) $message="Please choose an image to upload.";
 else {
  $tmp=$_FILES["photo"]["tmp_name"]; $size=(int)$_FILES["photo"]["size"]; $mime=(new finfo(FILEINFO_MIME_TYPE))->file($tmp);
  $types=["image/jpeg"=>"jpg","image/png"=>"png","image/gif"=>"gif","image/webp"=>"webp"];
  if(!isset($types[$mime]) || $size>2*1024*1024) $message="Use a JPG, PNG, GIF or WEBP image up to 2 MB.";
  else {
   $filename="patient_".$id."_".bin2hex(random_bytes(5)).".".$types[$mime];
   if(move_uploaded_file($tmp,__DIR__."/uploads/".$filename)) {
    $stmt=$conn->prepare("UPDATE patients SET image=? WHERE id=?"); $stmt->bind_param("si",$filename,$id);
    if($stmt->execute() && $stmt->affected_rows>=0) $message="Image uploaded. View it on the Patient Records page.";
    else $message="Image uploaded, but the patient record could not be updated.";
   } else $message="Upload failed. Check the uploads folder permissions.";
  }
 }
}
$patients=$conn->query("SELECT id,name,email,image FROM patients ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Upload Patient Image</title><link rel="stylesheet" href="style.css"></head><body><?php include "header.php"; ?><main class="container"><h2>Upload and Display Patient Image</h2><?php if($message) echo '<p class="notice">'.htmlspecialchars($message).'</p>'; ?>
<form method="post" enctype="multipart/form-data"><label>Select Patient</label><select name="patient_id" required><option value="">Choose a patient</option><?php while($p=$patients->fetch_assoc()): ?><option value="<?= (int)$p["id"] ?>"><?= htmlspecialchars($p["name"]." (".$p["email"].")") ?></option><?php endwhile; ?></select><label>Choose Image (max 2 MB)</label><input type="file" name="photo" accept="image/jpeg,image/png,image/gif,image/webp" required><button type="submit">Upload Image</button></form><p><a href="patients.php">View patient records and images</a></p></main><?php include "footer.php"; ?></body></html>