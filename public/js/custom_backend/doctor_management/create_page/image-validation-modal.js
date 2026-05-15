document.addEventListener("DOMContentLoaded", function () {
    let selectedFile = null;

    let currentImage = document.getElementById("oldImagePreview")?.src || null;

    const openBtn = document.getElementById("openImageModal");

    const input = document.getElementById("doctorImageInput");

    const preview = document.getElementById("imagePreview");

    const sizeEl = document.getElementById("imageSize");

    const typeEl = document.getElementById("imageType");

    const dimEl = document.getElementById("imageDimension");

    const shapeEl = document.getElementById("imageShape");

    const finalInput = document.getElementById("finalDoctorImage");

    /*
    |--------------------------------------------------------------------------
    | BLOCK FORM SUBMIT (IMPORTANT)
    |--------------------------------------------------------------------------
    */

    document.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            const active = document.activeElement;

            if (active && active.tagName !== "TEXTAREA") {
                e.preventDefault();
            }
        }
    });

    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    openBtn?.addEventListener("click", function () {
        $("#imageUploadModal").modal("show");
    });

    /*
    |--------------------------------------------------------------------------
    | IMAGE PREVIEW
    |--------------------------------------------------------------------------
    */

    input?.addEventListener("change", function (e) {
        const file = e.target.files[0];

        if (!file) return;

        selectedFile = file;

        const reader = new FileReader();

        reader.onload = function (event) {
            preview.src = event.target.result;

            const img = new Image();

            img.onload = function () {
                dimEl.innerText = `${img.width} x ${img.height}`;

                shapeEl.innerText =
                    img.width > img.height
                        ? "Landscape"
                        : img.width < img.height
                          ? "Portrait"
                          : "Square";
            };

            img.src = event.target.result;
        };

        reader.readAsDataURL(file);

        sizeEl.innerText = (file.size / 1024).toFixed(2) + " KB";

        typeEl.innerText = file.type;
    });

    /*
    |--------------------------------------------------------------------------
    | SAVE IMAGE (OPEN COMPARE MODAL ONLY)
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("saveImageBtn")
        ?.addEventListener("click", function () {
            if (!selectedFile) {
                alert("Please select an image");

                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("newImagePreview").src =
                    e.target.result;

                document.getElementById("oldImagePreview").src =
                    currentImage || "";

                $("#imageUploadModal").modal("hide");

                $("#replaceImageModal").modal("show");
            };

            reader.readAsDataURL(selectedFile);
        });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM REPLACE (NO FORM SUBMIT)
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("confirmReplaceBtn")
        ?.addEventListener("click", function () {
            const reader = new FileReader();

            reader.onload = function (e) {
                finalInput.value = e.target.result;

                currentImage = e.target.result;

                $("#replaceImageModal").modal("hide");
            };

            reader.readAsDataURL(selectedFile);
        });

    /*
    |--------------------------------------------------------------------------
    | CANCEL RESET
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("cancelImageBtn")
        ?.addEventListener("click", function () {
            selectedFile = null;

            input.value = "";

            preview.src = "";

            sizeEl.innerText = "-";

            typeEl.innerText = "-";

            dimEl.innerText = "-";

            shapeEl.innerText = "-";
        });
});
