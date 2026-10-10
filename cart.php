<?php
require_once "db.php";
if (!isset($_SESSION["cart"])) $_SESSION["cart"] = [];
if ($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["service"])) {
  $allowed=["General Medicine","Cardiology","Pediatrics","Orthopedics","Laboratory","Dermatology"];
  $service=$_POST["service"];
  if (in_array($service,$allowed,true)) $_SESSION["cart"][]=$service;
}
if (isset($_GET["clear"])) $_SESSION["cart"]=[];
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Service Cart</title><link rel="stylesheet" href="style.css"></head><body><?php include "header.php"; ?><main class="container"><h2>Selected Services</h2>
<?php if(empty($_SESSION["cart"])): ?><p>Your cart is empty. Visit the <a href="catalogue.php">services catalogue</a> to add a service.</p><?php else: ?><ul><?php foreach($_SESSION["cart"] as $item): ?><li><?= htmlspecialchars($item) ?></li><?php endforeach; ?></ul><a class="btn" href="appointment.php">Continue to Appointment</a> <a class="btn secondary" href="cart.php?clear=1">Clear Cart</a><?php endif; ?>
</main><?php include "footer.php"; ?></body></html>