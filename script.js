
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form[data-validate]").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const name = form.querySelector('[name="name"], [name="patient_name"]');
            const email = form.querySelector('[name="email"]');
            const phone = form.querySelector('[name="phone"]');

            if (name && name.value.trim().length < 2) {
                alert("Please enter a valid name.");
                name.focus();
                event.preventDefault();
                return;
            }

            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
                alert("Please enter a valid email address.");
                email.focus();
                event.preventDefault();
                return;
            }

            if (phone && !/^[0-9+()\-\s]{7,20}$/.test(phone.value.trim())) {
                alert("Please enter a valid phone number.");
                phone.focus();
                event.preventDefault();
                return;
            }
        });
    });
});
```