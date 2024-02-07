import htmx from "htmx.org";
window.htmx = htmx;
htmx.config.getCacheBusterParam = true;

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import.meta.glob(["../images/**"]);
