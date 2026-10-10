<?php
require_once "db.php"; $message=""; $success=false;
$department=$_GET["department"]??"General Medicine";
$allowed=["General Medicine","Cardiology","Pediatrics","Orthopedics","Laboratory","Dermatology"];
if(!in_array($department,$allowed,true)) $department="General Medicine";
if($_SERVER["REQUEST_METHOD"]==="POST") {
 $name=trim($_POST["patient_name"]??""); $email=trim($_POST["email"]??""); $phone=trim($_POST["phone"]??"");
 $department=$_POST["department"]??"General Medicine"; $date=$_POST["appointment_date"]??""; $note=trim($_POST["message"]??"");
 if(!in_array($department,$allowed,true) || !filter_var($email,FILTER_VALIDATE_EMAIL) || $date<date("Y-m-d") || strlen($name)<2) {
  $message="Please check the name, email, department and appointment date.";
 } else {
  $stmt=$conn->prepare("INSERT INTO appointments(patient_name,email,phone,department,appointment_date,message) VALUES(?,?,?,?,?,?)");
  $stmt->bind_param("ssssss",$name,$email,$phone,$department,$date,$note);
  if($stmt->execute()) {
   $success=true; $message="Appointment request saved successfully. A hospital representative can contact you to confirm it.";
   // PHP mail() requires mail-server configuration. If configured, this sends a notification.
   $to="careplus@example.com"; $subject="New appointment request";
   $body="Patient: $name\nEmail: $email\nPhone: $phone\nDepartment: $department\nDate: $date\nMessage: $note";
   $headers="From: noreply@example.com";
   @mail($to,$subject,$body,$headers);
  } else { $message="Unable to save appointment request. Please try again."; }
 }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Book Appointment</title><link rel="stylesheet" href="style.css"></head><body><?php include "header.php"; ?><main class="container"><h2>Appointment Booking</h2>
<?php if($message) echo '<p class="'.($success?'notice':'error').'">'.htmlspecialchars($message).'</p>'; ?>
<form method="post" data-validate><label>Patient Name</label><input name="patient_name" required minlength="2"><label>Email</label><input type="email" name="email" required><label>Phone</label><input name="phone" required><label>Department</label><select name="department"><?php foreach($allowed as $d): ?><option value="<?= htmlspecialchars($d) ?>" <?= $department===$d?'selected':'' ?>><?= htmlspecialchars($d) ?></option><?php endforeach; ?></select><label>Preferred Date</label><input type="date" name="appointment_date" min="<?= date("Y-m-d") ?>" required><label>Message (optional)</label><textarea name="message" rows="4"></textarea><button type="submit">Submit Appointment Request</button></form>
<p class="small">The request is stored in MySQL. Email delivery via PHP mail() works only when a mail server is configured.</p></main><?php include "footer.php"; ?></body></html>