/* =========================================================
   SWEET ALERT HELPERS
========================================================= */

function showSuccess(message) {
    Swal.fire({
        icon: "success",
        title: "Success",
        text: message,
        timer: 2000,
        showConfirmButton: false,
    });
}

function showError(message) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
        timer: 2500,
        showConfirmButton: false,
    });
}

function showWarning(message) {
    Swal.fire({
        icon: "warning",
        title: "Warning",
        text: message,
        timer: 2500,
        showConfirmButton: false,
    });
}

function showInfo(message) {
    Swal.fire({
        icon: "info",
        title: "Info",
        text: message,
        timer: 2500,
        showConfirmButton: false,
    });
}
