import "./bootstrap";

/**
 * Render error response
 */
htmx.on("htmx:beforeSwap", (evt) => {
    if (!evt.detail.isError) {
        return;
    }

    evt.detail.shouldSwap = true;
    evt.detail.target = htmx.find("body");
    evt.detail.serverResponse = `<pre>${evt.detail.serverResponse}</pre>`;
});

/**
 * Remember filter value on go back
 */
htmx.on("htmx:afterSwap", () => {
    document.querySelectorAll("[name^='filter']").forEach((el) => {
        el.setAttribute("value", new URLSearchParams(window.location.search).get(el.getAttribute("name")) ?? "");
    });
});

/**
 * colspan="all"
 */
htmx.on("htmx:afterSwap", () => {
    document.querySelectorAll('[colspan="all"]').forEach((el) => {
        el.setAttribute("colspan", Math.max(...Object.values(el.closest("table").querySelectorAll("tr")).map((tr) => tr.querySelectorAll("td, th").length)));
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
