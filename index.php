<?php require_once "db.php"; ?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>CarePlus Hospital - Home</title><link rel="stylesheet" href="style.css"></head><body>
<?php include "header.php"; ?>
<main class="container">
  <section class="hero">
    <h2>Welcome to CarePlus Hospital</h2>
    <p>Quality healthcare, caring professionals, and convenient patient services in one place.</p>
    <a class="btn" href="appointment.php">Book an Appointment</a>
    <a class="btn secondary" href="catalogue.php">Explore Services</a>
  </section>
  <h2>Why choose us?</h2>
  <section class="grid">
    <article class="card"><h3>Experienced Doctors</h3><p>Care from qualified healthcare professionals.</p></article>
    <article class="card"><h3>Patient Support</h3><p>Helpful information and appointment requests.</p></article>
    <article class="card"><h3>Multiple Departments</h3><p>Choose a department that fits your needs.</p></article>
  </section>
  <section class="panel" style="margin-top:20px"><h2>Contact</h2><p>Email: careplus@example.com | Phone: +91 98765 43210</p><p class="small">This is a student demonstration website. It is not a real medical service.</p></section>
</main><?php include "footer.php"; ?></body></html>