/* =========================================================
   FILE: booking-core.js
========================================================= */

window.bookingState = {
    currentPage: 0,

    selectedDate: null,
    selectedTime: null,
    selectedPayment: null,
};

window.bookingElements = {};

document.addEventListener("DOMContentLoaded", function () {
    bookingElements.pages = document.querySelectorAll(".schedule-page");

    bookingElements.confirmBtn = document.getElementById("confirmBtn");

    bookingElements.formDate = document.getElementById("formDate");

    bookingElements.formTime = document.getElementById("formTime");

    bookingElements.paymentInput = document.getElementById("paymentMethod");

    bookingElements.selectedDateText = document.getElementById("selectedDate");

    bookingElements.selectedTimeText = document.getElementById("selectedTime");

    bookingElements.noSlotText = document.getElementById("noSlotText");

    bookingElements.form = document.querySelector("form");
});
