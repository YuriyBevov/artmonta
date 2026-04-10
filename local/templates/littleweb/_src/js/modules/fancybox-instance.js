import { Fancybox } from "@fancyapps/ui";

export function fancyInit() {
	document.addEventListener("DOMContentLoaded", () => {
		const fancy = document.querySelectorAll("[data-fancybox]");

		if (fancy.length) {
			Fancybox.bind("[data-fancybox]", {
				fadeEffect: true,
				hideScrollbar: true,
			});
		}
	});
}

fancyInit();

window.FancyboxInit = fancyInit;
