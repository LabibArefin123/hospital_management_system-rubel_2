/* =========================================================
   FILE: booking-validation.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    /* =========================================
       INPUT VALIDATION
    ========================================== */

    ["name", "age", "phone", "gender"].forEach((id) => {
        const input = document.getElementById(id);

        if (!input) return;

        input.addEventListener("input", checkBookingForm);

        input.addEventListener("change", checkBookingForm);
    });

    window.checkBookingForm = function () {
        const name = document.getElementById("name")?.value.trim();

        const age = document.getElementById("age")?.value.trim();

        const phone = document.getElementById("phone")?.value.trim();

        const gender = document.getElementById("gender")?.value;

        const valid =
            name &&
            age &&
            phone &&
            gender &&
            bookingState.selectedDate &&
            bookingState.selectedTime &&
            bookingState.selectedPayment;

        if (!bookingElements.confirmBtn) return;

        bookingElements.confirmBtn.disabled = !valid;

        bookingElements.confirmBtn.style.background = valid
            ? "#22c55e"
            : "gray";

        bookingElements.confirmBtn.style.cursor = valid
            ? "pointer"
            : "not-allowed";
    };

    /* =========================================
       FORM SUBMIT
    ========================================== */

    if (bookingElements.form) {
        bookingElements.form.addEventListener("submit", function (e) {
            if (
                !bookingState.selectedDate ||
                !bookingState.selectedTime ||
                !bookingState.selectedPayment
            ) {
                e.preventDefault();

                alert("Please select Date, Time & Payment");

                return;
            }

            console.log("Submitting Appointment", {
                date: bookingElements.formDate.value,

                time: bookingElements.formTime.value,

                payment: bookingElements.paymentInput.value,
            });
        });
    }
});
