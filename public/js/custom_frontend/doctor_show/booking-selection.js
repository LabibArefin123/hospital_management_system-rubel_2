/* =========================================================
   FILE: booking-selection.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    /* =====================================================
       DATE SLOT SELECT
    ===================================================== */

    document.querySelectorAll(".date-card").forEach((card) => {
        card.addEventListener("click", function () {
            document.querySelectorAll(".date-card").forEach((c) => {
                c.classList.remove("active");
            });

            this.classList.add("active");

            bookingState.selectedDate = this.dataset.date || "";

            bookingState.selectedTime = this.dataset.time || "";

            /* =========================================
               HIDDEN INPUTS
            ========================================= */

            if (bookingElements.formDate) {
                bookingElements.formDate.value = bookingState.selectedDate;
            }

            if (bookingElements.formTime) {
                bookingElements.formTime.value = bookingState.selectedTime;
            }

            /* =========================================
               DATE UI
            ========================================= */

            if (bookingElements.selectedDateText && bookingState.selectedDate) {
                const formattedDate = new Date(bookingState.selectedDate);

                bookingElements.selectedDateText.innerText =
                    formattedDate.toLocaleDateString("en-GB", {
                        weekday: "long",
                        day: "numeric",
                        month: "long",
                        year: "numeric",
                    });
            }

            /* =========================================
               TIME UI
            ========================================= */

            if (bookingElements.selectedTimeText && bookingState.selectedTime) {
                const formattedTime = new Date(
                    `1970-01-01T${bookingState.selectedTime}`,
                );

                bookingElements.selectedTimeText.innerText =
                    formattedTime.toLocaleTimeString("en-US", {
                        hour: "2-digit",
                        minute: "2-digit",
                        hour12: true,
                    });
            }

            /* =========================================
               HIDE NO SLOT
            ========================================= */

            if (bookingElements.noSlotText) {
                bookingElements.noSlotText.style.display = "none";
            }

            window.validateBookingForm();
        });
    });

    /* =====================================================
       PAYMENT SELECT
    ===================================================== */

    document.querySelectorAll(".pay-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            document.querySelectorAll(".pay-btn").forEach((b) => {
                b.classList.remove("active");
            });

            this.classList.add("active");

            bookingState.selectedPayment = this.dataset.value || "";

            if (bookingElements.paymentInput) {
                bookingElements.paymentInput.value =
                    bookingState.selectedPayment;
            }

            window.validateBookingForm();
        });
    });
});
