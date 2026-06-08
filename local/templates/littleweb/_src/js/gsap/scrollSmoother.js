import { gsap } from "gsap";
import { ScrollSmoother } from "gsap/ScrollSmoother";
import { prefersReducedMotion, registerScrollTrigger } from "./utils";

document.addEventListener("DOMContentLoaded", () => {
	registerScrollTrigger(ScrollSmoother);

	if (!prefersReducedMotion()) {
		ScrollSmoother.create({
			wrapper: "#smooth-wrapper",
			content: "#smooth-content",
			smooth: 1.2,
			smoothTouch: false,
			effects: false,
			ignoreMobileResize: true,
			normalizeScroll: false,
		});
	}

	const heroOverlay = document.querySelector(".hero-overlay");

	if (!heroOverlay || prefersReducedMotion()) {
		return;
	}

	gsap.to(heroOverlay, {
		opacity: 1,
		ease: "none",
		scrollTrigger: {
			trigger: ".hero-spacer",
			start: "top top",
			end: "bottom top",
			scrub: 0.3,
		},
	});
});
