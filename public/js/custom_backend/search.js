/* =========================================================
   GLOBAL SEARCH
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    const navbarForms = document.querySelectorAll(".navbar-search-block form");

    navbarForms.forEach((form) => {
        const input = form.querySelector('input[name="term"]');

        if (!input) return;

        const globalSearchUrl = document.body.dataset.globalSearchUrl;

        const resultBox = document.createElement("div");

        resultBox.style.position = "absolute";
        resultBox.style.top = "40px";
        resultBox.style.left = "0";
        resultBox.style.width = "100%";
        resultBox.style.maxHeight = "250px";
        resultBox.style.overflowY = "auto";
        resultBox.style.background = "#fff";
        resultBox.style.border = "1px solid #ddd";
        resultBox.style.borderRadius = "6px";
        resultBox.style.boxShadow = "0 4px 8px rgba(0,0,0,0.08)";
        resultBox.style.zIndex = "99999";
        resultBox.style.display = "none";

        const parentGroup = input.closest(".input-group");

        parentGroup.style.position = "relative";

        parentGroup.appendChild(resultBox);

        let timer = null;

        form.addEventListener("submit", (e) => e.preventDefault());

        input.addEventListener("input", function () {
            const query = this.value.trim();

            clearTimeout(timer);

            if (query.length < 2) {
                resultBox.style.display = "none";

                return;
            }

            timer = setTimeout(() => {
                fetch(`${globalSearchUrl}?term=${encodeURIComponent(query)}`)
                    .then((res) => res.json())

                    .then((data) => {
                        if (!Array.isArray(data) || data.length === 0) {
                            resultBox.innerHTML = `
                                <div class="p-2 text-muted">
                                    No results found
                                </div>
                            `;
                        } else {
                            resultBox.innerHTML = data
                                .map(
                                    (item) => `

                                <div class="search-item"
                                    style="
                                        padding:8px 12px;
                                        cursor:pointer;
                                        display:flex;
                                        justify-content:space-between;
                                        align-items:center;
                                        border-bottom:1px solid #f1f1f1;
                                    "
                                    onclick="window.location='${item.url}'">

                                    <span>
                                        ${item.label}
                                    </span>

                                    <span style="
                                        font-size:11px;
                                        background:#e6f0ff;
                                        padding:2px 6px;
                                        border-radius:4px;
                                    ">
                                        ${
                                            item.type
                                                ? item.type.toUpperCase()
                                                : ""
                                        }
                                    </span>

                                </div>

                            `,
                                )
                                .join("");
                        }

                        resultBox.style.display = "block";
                    })

                    .catch(() => {
                        resultBox.innerHTML = `
                            <div class="p-2 text-danger">
                                Error loading results
                            </div>
                        `;

                        resultBox.style.display = "block";
                    });
            }, 300);
        });

        document.addEventListener("click", function (e) {
            if (!resultBox.contains(e.target) && e.target !== input) {
                resultBox.style.display = "none";
            }
        });
    });
});
