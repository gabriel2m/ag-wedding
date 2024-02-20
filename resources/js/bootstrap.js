import htmx from "htmx.org";
window.htmx = htmx;
htmx.config.getCacheBusterParam = true;
htmx.config.scrollIntoViewOnBoost = false;

import Alpine from "alpinejs";
window.Alpine = Alpine;

import.meta.glob(["../images/**"]);
