<?php
require_once "db.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email); $stmt->execute();
    $result = $stmt->get_result(); $user = $result->fetch_assoc();
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        header("Location: index.php"); exit;
    } else { $message = "Invalid email or password. Please register first."; }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login</title><link rel="stylesheet" href="style.css"></head><body><?php include "header.php"; ?><main class="container"><h2>Patient Login</h2>
<?php if ($message) echo '<p class="error">'.htmlspecialchars($message).'</p>'; ?>
<form method="post" data-validate><label>Email</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button type="submit">Login</button><p class="small">New patient? <a href="register.php">Create an account</a>.</p></form>
</main><?php include "footer.php"; ?></body></html>