/* =========================================================
   FILE: booking-selection.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    /* =========================================
       SLOT SELECT
    ========================================== */

    document.querySelectorAll(".date-card").forEach((card) => {
        card.addEventListener("click", function () {
            document
                .querySelectorAll(".date-card")
                .forEach((c) => c.classList.remove("active"));

            this.classList.add("active");

            bookingState.selectedDate = this.dataset.date;

            bookingState.selectedTime = this.dataset.time;

            if (!bookingState.selectedDate || !bookingState.selectedTime)
                return;

            bookingElements.formDate.value = bookingState.selectedDate;

            bookingElements.formTime.value = bookingState.selectedTime;

            if (bookingElements.noSlotText) {
                bookingElements.noSlotText.classList.add("hidden");
            }

            const fullDate = new Date(
                `${bookingState.selectedDate} ${bookingState.selectedTime}`,
            );

            if (bookingElements.selectedDateText) {
                bookingElements.selectedDateText.innerText =
                    fullDate.toLocaleDateString("en-GB", {
                        weekday: "long",
                        day: "numeric",
                        month: "long",
                        year: "numeric",
                    });
            }

            if (bookingElements.selectedTimeText) {
                bookingElements.selectedTimeText.innerText =
                    fullDate.toLocaleTimeString("en-US", {
                        hour: "2-digit",
                        minute: "2-digit",
                        hour12: true,
                    });
            }

            checkBookingForm();
        });
    });

    /* =========================================
       PAYMENT SELECT
    ========================================== */

    document.querySelectorAll(".pay-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            document
                .querySelectorAll(".pay-btn")
                .forEach((b) => b.classList.remove("active"));

            this.classList.add("active");

            bookingState.selectedPayment = this.dataset.value;

            bookingElements.paymentInput.value = bookingState.selectedPayment;

            checkBookingForm();
        });
    });
});
