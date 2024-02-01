import "./bootstrap";

htmx.on("htmx:beforeSwap", function (evt) {
    if (`${evt.detail.xhr.status}`[0] != 2) {
        evt.detail.shouldSwap = true;
        evt.detail.target = htmx.find("body");
    }
});
