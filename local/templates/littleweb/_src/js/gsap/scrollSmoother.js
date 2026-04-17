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
});
