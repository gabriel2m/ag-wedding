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
