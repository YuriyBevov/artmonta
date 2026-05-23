import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollSmoother } from "gsap/ScrollSmoother";

// gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

document.addEventListener("DOMContentLoaded", () => {
	gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

	// create the smooth scroller FIRST!
	ScrollSmoother.create({
		smooth: 2,
		effects: true,
		normalizeScroll: false,
	});

	const heroOverlay = document.querySelector(".hero-overlay");

	if (heroOverlay) {
		gsap.to(".hero-overlay", {
			opacity: 1,
			ease: "none",
			scrollTrigger: {
				trigger: ".hero-spacer",
				start: "top top",
				end: "bottom top",
				scrub: true,
			},
		});
	}
});
