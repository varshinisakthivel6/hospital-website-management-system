<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<header>
  <h1>CarePlus Hospital</h1>
  <div>Your health, our priority</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="catalogue.php">Services</a>
    <a href="cart.php">Cart</a>
    <a href="appointment.php">Appointment</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
    <a href="patients.php">Patients</a>
    <a href="crud.php">Manage Records</a>
    <a href="upload.php">Upload Image</a>
    <?php if (!empty($_SESSION['user_name'])): ?>
      <a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a>
    <?php endif; ?>
  </nav>
</header>