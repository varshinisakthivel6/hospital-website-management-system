<?php require_once "db.php";
$services = [
 ["General Medicine","Consultation for common health concerns."],
 ["Cardiology","Heart health consultation and assessment."],
 ["Pediatrics","Healthcare services for children."],
 ["Orthopedics","Bone, joint and mobility consultation."],
 ["Laboratory","Routine laboratory testing information."],
 ["Dermatology","Skin and hair consultation."]
];
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Hospital Services</title><link rel="stylesheet" href="style.css"></head><body><?php include "header.php"; ?><main class="container"><h2>Hospital Services Catalogue</h2><p>Select a service to add it to your cart, or book an appointment.</p><section class="grid">
<?php foreach($services as $service): ?><article class="card"><h3><?= htmlspecialchars($service[0]) ?></h3><p><?= htmlspecialchars($service[1]) ?></p><form method="post" action="cart.php"><input type="hidden" name="service" value="<?= htmlspecialchars($service[0]) ?>"><button type="submit">Add to Cart</button></form><p><a href="appointment.php?department=<?= urlencode($service[0]) ?>">Book appointment</a></p></article><?php endforeach; ?>
</section></main><?php include "footer.php"; ?></body></html>