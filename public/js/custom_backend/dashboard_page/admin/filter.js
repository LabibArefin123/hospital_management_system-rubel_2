document.addEventListener("DOMContentLoaded", function () {
    /*
    |--------------------------------------------------------------------------
    | FILTER TOGGLE
    |--------------------------------------------------------------------------
    */

    const toggleFilterBtn = document.getElementById("toggleFilterBtn");

    const adminFilterSection = document.getElementById("adminFilterSection");

    const filterArrow = document.getElementById("filterArrow");

    if (toggleFilterBtn && adminFilterSection) {
        toggleFilterBtn.addEventListener("click", function () {
            /*
            |--------------------------------------------------------------------------
            | TOGGLE FILTER
            |--------------------------------------------------------------------------
            */

            adminFilterSection.classList.toggle("d-none");

            /*
            |--------------------------------------------------------------------------
            | ARROW ROTATION
            |--------------------------------------------------------------------------
            */

            if (adminFilterSection.classList.contains("d-none")) {
                filterArrow.classList.remove("fa-chevron-up");

                filterArrow.classList.add("fa-chevron-down");
            } else {
                filterArrow.classList.remove("fa-chevron-down");

                filterArrow.classList.add("fa-chevron-up");
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS CHANGE MODAL
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll(".appointment-status").forEach(function (select) {
        select.addEventListener("change", function () {
            const appointmentId = this.dataset.id;

            const selectedStatus = this.value;

            const currentStatus = this.dataset.current;

            document.getElementById("statusChangeText").innerText =
                `Do you want to change status to "${selectedStatus}" ?`;

            document.getElementById("statusChangeForm").action =
                `/appointments/change-status/${appointmentId}`;

            document.getElementById("selectedStatus").value = selectedStatus;

            $("#statusChangeModal").modal("show");

            $("#statusChangeModal").on("hidden.bs.modal", function () {
                select.value = currentStatus;
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | FILTER ELEMENTS
    |--------------------------------------------------------------------------
    */

    const searchInput = document.getElementById("dashboardSearch");

    const patientInput = document.getElementById("searchPatient");

    const dateFilter = document.getElementById("appointmentDateFilter");

    const typeFilter = document.getElementById("appointmentTypeFilter");

    const statusFilter = document.getElementById("appointmentStatusFilter");

    const cards = document.querySelectorAll(".appointment-card");

    const doctorCountElement = document.getElementById(
        "doctorAppointmentCount",
    );

    const serviceCountElement = document.getElementById(
        "serviceAppointmentCount",
    );

    /*
    |--------------------------------------------------------------------------
    | FILTER FUNCTION
    |--------------------------------------------------------------------------
    */

    function filterAppointments() {
        const search = searchInput.value.toLowerCase();

        const patient = patientInput.value.toLowerCase();

        const date = dateFilter.value;

        const type = typeFilter.value.toLowerCase();

        const status = statusFilter.value.toLowerCase();

        let visibleDoctorCount = 0;

        let visibleServiceCount = 0;

        cards.forEach(function (card) {
            const cardSearch = (card.dataset.search || "").toLowerCase();

            const cardPatient = (card.dataset.patient || "").toLowerCase();

            const cardDate = card.dataset.date || "";

            const cardType = (card.dataset.type || "").toLowerCase();

            const cardStatus = (card.dataset.status || "").toLowerCase();

            const matchSearch = cardSearch.includes(search);

            const matchPatient = cardPatient.includes(patient);

            const matchDate = date === "" || cardDate === date;

            const matchType = type === "" || cardType === type;

            const matchStatus = status === "" || cardStatus === status;

            if (
                matchSearch &&
                matchPatient &&
                matchDate &&
                matchType &&
                matchStatus
            ) {
                /*
                |--------------------------------------------------------------------------
                | SHOW CARD
                |--------------------------------------------------------------------------
                */

                card.style.display = "block";

                /*
                |--------------------------------------------------------------------------
                | COUNT UPDATE
                |--------------------------------------------------------------------------
                */

                if (cardType === "doctor") {
                    visibleDoctorCount++;
                }

                if (cardType === "service") {
                    visibleServiceCount++;
                }
            } else {
                /*
                |--------------------------------------------------------------------------
                | HIDE CARD
                |--------------------------------------------------------------------------
                */

                card.style.display = "none";
            }
        });

        /*
        |--------------------------------------------------------------------------
        | UPDATE BADGES
        |--------------------------------------------------------------------------
        */

        if (doctorCountElement) {
            doctorCountElement.innerText = `${visibleDoctorCount} Appointments`;
        }

        if (serviceCountElement) {
            serviceCountElement.innerText = `${visibleServiceCount} Bookings`;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */

    if (searchInput) {
        searchInput.addEventListener("keyup", filterAppointments);
    }

    if (patientInput) {
        patientInput.addEventListener("keyup", filterAppointments);
    }

    if (dateFilter) {
        dateFilter.addEventListener("change", filterAppointments);
    }

    if (typeFilter) {
        typeFilter.addEventListener("change", filterAppointments);
    }

    if (statusFilter) {
        statusFilter.addEventListener("change", filterAppointments);
    }

    /*
    |--------------------------------------------------------------------------
    | RESET FILTER
    |--------------------------------------------------------------------------
    */

    const resetButton = document.getElementById("resetDashboardFilter");

    if (resetButton) {
        resetButton.addEventListener("click", function () {
            searchInput.value = "";

            patientInput.value = "";

            dateFilter.value = "";

            typeFilter.value = "";

            statusFilter.value = "";

            filterAppointments();
        });
    }
});
