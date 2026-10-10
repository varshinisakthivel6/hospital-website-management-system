<?php
require_once "db.php"; $message = ""; $success = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name=trim($_POST["name"]??""); $email=trim($_POST["email"]??""); $phone=trim($_POST["phone"]??"");
    $gender=$_POST["gender"]??""; $address=trim($_POST["address"]??""); $password=$_POST["password"]??"";
    if (strlen($name)<2 || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<6) {
        $message="Enter a valid name/email and a password of at least 6 characters.";
    } else {
        $stmt=$conn->prepare("INSERT INTO patients(name,email,phone,gender,address) VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss",$name,$email,$phone,$gender,$address);
        if ($stmt->execute()) {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $u=$conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
            $u->bind_param("sss",$name,$email,$hash);
            if ($u->execute()) { $message="Registration successful. You can now log in."; $success=true; }
            else { $message="Patient saved, but this email may already have a login account."; }
        } else { $message="Registration failed. This email may already be registered."; }
    }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Patient Registration</title><link rel="stylesheet" href="style.css"></head><body><?php include "header.php"; ?><main class="container"><h2>Patient Registration</h2>
<?php if($message) echo '<p class="'.($success?'notice':'error').'">'.htmlspecialchars($message).'</p>'; ?>
<form method="post" data-validate><label>Full Name</label><input name="name" required minlength="2"><label>Email</label><input type="email" name="email" required><label>Phone</label><input name="phone" required><label>Gender</label><select name="gender"><option value="">Select</option><option>Female</option><option>Male</option><option>Other</option><option>Prefer not to say</option></select><label>Address</label><textarea name="address" rows="3"></textarea><label>Password (minimum 6 characters)</label><input type="password" name="password" minlength="6" required><button type="submit">Register</button></form>
</main><?php include "footer.php"; ?></body></html>