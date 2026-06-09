import { gsap } from "gsap";
import { ScrollSmoother } from "gsap/ScrollSmoother";
import { prefersReducedMotion, registerScrollTrigger } from "./utils";

export const initScrollSmoother = () => {
	registerScrollTrigger(ScrollSmoother);

	if (!prefersReducedMotion()) {
		const smootherMedia = gsap.matchMedia();

		smootherMedia.add("(min-width: 1024px) and (hover: hover) and (pointer: fine)", () => {
			const smoother = ScrollSmoother.create({
				wrapper: "#smooth-wrapper",
				content: "#smooth-content",
				smooth: 1.2,
				smoothTouch: false,
				effects: false,
				ignoreMobileResize: true,
				normalizeScroll: false,
			});

			return () => {
				smoother.kill();
			};
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
};
