CAREPLUS HOSPITAL WEBSITE - LABORATORY PROJECT

REQUIREMENTS
- XAMPP with Apache, PHP and MySQL
- Browser (Chrome/Edge)

HOW TO RUN
1. Extract the hospital_website folder into C:\xampp\htdocs\
2. Open XAMPP Control Panel.
3. Start Apache and MySQL.
4. Open http://localhost/hospital_website/
5. The database hospital_db and tables are created automatically by db.php.
6. Register a user first, then test Login.
7. Add a patient through Register or CRUD before testing image upload.
8. Open http://localhost/phpmyadmin/ to inspect the MySQL database.

FILES / EXPERIMENTS
Experiment 1: HTML tags are used across all pages.
Experiment 2: index.php (Home), login.php (Login), catalogue.php (Catalogue).
Experiment 3: cart.php (Cart), register.php (Registration).
Experiment 4: script.js (client-side form validation); PHP performs server-side checks too.
Experiment 5: hospital.xml (XML document with elements and attributes).
Experiment 6: db.php (MySQL connection), PHP pages and forms.
Experiment 7: crud.php (Create, Read, Update, Delete), upload.php (image upload).
Experiment 8: patients.php (fetch and display records from MySQL).
Experiment 9 / Case study: Hospital appointment and patient management system.

IMPORTANT NOTES
- This is a learning/demo project, not a production medical system.
- Appointment requests are stored in MySQL. PHP mail() requires a configured mail server; local XAMPP usually does not send email by default.
- The sample contact email is careplus@example.com; replace it with a real address for a real deployment.
- Use test data only. Do not store real patient medical data in this classroom demo.
- For deployment, add stronger access controls, CSRF protection, validation, backups and privacy/security safeguards.
