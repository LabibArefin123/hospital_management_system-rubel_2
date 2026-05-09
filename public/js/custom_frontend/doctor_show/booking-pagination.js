/* =========================================================
   FILE: booking-pagination.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    function showPage(index) {
        bookingElements.pages.forEach((page) => {
            page.classList.remove("active");
        });

        if (bookingElements.pages[index]) {
            bookingElements.pages[index].classList.add("active");
        }
    }

    window.showBookingPage = showPage;

    document
        .getElementById("nextSchedule")
        ?.addEventListener("click", function () {
            if (bookingState.currentPage < bookingElements.pages.length - 1) {
                bookingState.currentPage++;

                showPage(bookingState.currentPage);
            }
        });

    document
        .getElementById("prevSchedule")
        ?.addEventListener("click", function () {
            if (bookingState.currentPage > 0) {
                bookingState.currentPage--;

                showPage(bookingState.currentPage);
            }
        });

    showPage(bookingState.currentPage);
});
