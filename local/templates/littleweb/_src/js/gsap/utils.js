import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

export { ScrollTrigger };

export const registerScrollTrigger = (...plugins) => {
	gsap.registerPlugin(ScrollTrigger, ...plugins);
	ScrollTrigger.config({
		ignoreMobileResize: true,
	});
};

export const prefersReducedMotion = () =>
	window.matchMedia?.("(prefers-reduced-motion: reduce)").matches;

export const isMobileScrollDevice = () =>
	window.matchMedia?.("(hover: none), (pointer: coarse), (max-width: 1023px)")
		.matches;

let refreshTimer;

export const scheduleScrollRefresh = (delay = 80) => {
	window.clearTimeout(refreshTimer);
	refreshTimer = window.setTimeout(() => {
		window.requestAnimationFrame(() => {
			ScrollTrigger.refresh();
		});
	}, delay);
};

export const onImageReady = (image, callback) => {
	if (!image || image.complete) {
		callback();
		return;
	}

	image.addEventListener("load", callback, { once: true });
	image.addEventListener("error", callback, { once: true });
};
