<?php
require_once "db.php"; $message="";
if($_SERVER["REQUEST_METHOD"]==="POST") {
 $action=$_POST["action"]??"";
 if($action==="create" || $action==="update") {
  $name=trim($_POST["name"]??""); $email=trim($_POST["email"]??""); $phone=trim($_POST["phone"]??"");
  $gender=$_POST["gender"]??""; $address=trim($_POST["address"]??""); $id=(int)($_POST["id"]??0);
  if(strlen($name)<2 || !filter_var($email,FILTER_VALIDATE_EMAIL)) $message="Enter a valid name and email.";
  elseif($action==="create") {
   $stmt=$conn->prepare("INSERT INTO patients(name,email,phone,gender,address) VALUES(?,?,?,?,?)");
   $stmt->bind_param("sssss",$name,$email,$phone,$gender,$address);
   $message=$stmt->execute()?"Patient record created.":"Could not create record. Check whether the email already exists.";
  } else {
   $stmt=$conn->prepare("UPDATE patients SET name=?,email=?,phone=?,gender=?,address=? WHERE id=?");
   $stmt->bind_param("sssssi",$name,$email,$phone,$gender,$address,$id);
   $message=$stmt->execute()?"Patient record updated.":"Could not update record. Check the email.";
  }
 } elseif($action==="delete") {
  $id=(int)($_POST["id"]??0); $stmt=$conn->prepare("DELETE FROM patients WHERE id=?"); $stmt->bind_param("i",$id);
  $message=$stmt->execute()?"Patient record deleted.":"Could not delete record.";
 }
}
$edit=null;
if(isset($_GET["edit"])) { $id=(int)$_GET["edit"]; $stmt=$conn->prepare("SELECT * FROM patients WHERE id=?"); $stmt->bind_param("i",$id); $stmt->execute(); $edit=$stmt->get_result()->fetch_assoc(); }
$result=$conn->query("SELECT id,name,email,phone,gender,address FROM patients ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>CRUD Operations</title><link rel="stylesheet" href="style.css"></head><body><?php include "header.php"; ?><main class="container"><h2>Patient CRUD Operations</h2><?php if($message) echo '<p class="notice">'.htmlspecialchars($message).'</p>'; ?>
<form method="post" data-validate><h3><?= $edit?"Update Patient":"Create Patient" ?></h3><input type="hidden" name="action" value="<?= $edit?"update":"create" ?>"><input type="hidden" name="id" value="<?= (int)($edit["id"]??0) ?>"><label>Name</label><input name="name" required value="<?= htmlspecialchars($edit["name"]??"") ?>"><label>Email</label><input type="email" name="email" required value="<?= htmlspecialchars($edit["email"]??"") ?>"><label>Phone</label><input name="phone" value="<?= htmlspecialchars($edit["phone"]??"") ?>"><label>Gender</label><select name="gender"><option value="">Select</option><?php foreach(["Female","Male","Other","Prefer not to say"] as $g): ?><option <?= (($edit["gender"]??"")===$g)?"selected":"" ?>><?= $g ?></option><?php endforeach; ?></select><label>Address</label><textarea name="address"><?= htmlspecialchars($edit["address"]??"") ?></textarea><button type="submit"><?= $edit?"Update Record":"Create Record" ?></button><?php if($edit): ?> <a class="btn secondary" href="crud.php">Cancel</a><?php endif; ?></form>
<h3>Existing Records</h3><div style="overflow-x:auto"><table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr><?php while($r=$result->fetch_assoc()): ?><tr><td><?= (int)$r["id"] ?></td><td><?= htmlspecialchars($r["name"]) ?></td><td><?= htmlspecialchars($r["email"]) ?></td><td><?= htmlspecialchars($r["phone"]) ?></td><td><a href="crud.php?edit=<?= (int)$r["id"] ?>">Edit</a><form method="post" style="display:inline;padding:0;box-shadow:none" onsubmit="return confirm('Delete this patient record?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$r["id"] ?>"><button type="submit">Delete</button></form></td></tr><?php endwhile; ?></table></div>
</main><?php include "footer.php"; ?></body></html>