import "./bootstrap";

/**
 * Render error response
 */
htmx.on("htmx:beforeSwap", (evt) => {
    if (`${evt.detail.xhr.status}`[0] != 2) {
        evt.detail.shouldSwap = true;
        evt.detail.target = htmx.find("body");
    }
});

/**
 * Remember filter value on go back
 */
htmx.on("htmx:afterSwap", () => {
    document.querySelectorAll("[name^='filter']").forEach((el) => {
        const params = new URLSearchParams(window.location.search);
        el.setAttribute("value", params.get(el.getAttribute("name")) ?? "");
    });
});

/**
 * colspan="all"
 */
htmx.on("htmx:afterSwap", () => {
    document.querySelectorAll('[colspan="all"]').forEach((el) => {
        let cols = 0;
        el.closest("table")
            .querySelectorAll("tr")
            .forEach((tr) => {
                cols = Math.max(cols, tr.querySelectorAll("td, th").length);
            });
        el.setAttribute("colspan", cols);
    });
});

/**
 * hx-headers-merge
 */
htmx.on("htmx:afterSwap", () => {
    document.querySelectorAll("[hx-headers-merge]").forEach((el) => {
        el.setAttribute(
            "hx-headers",
            JSON.stringify({
                ...JSON.parse(el.closest("[hx-headers]").getAttribute("hx-headers")),
                ...JSON.parse(el.getAttribute("hx-headers-merge")),
            }),
        );
        el.removeAttribute("hx-headers-merge");
    });
});
