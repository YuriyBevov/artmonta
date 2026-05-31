import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

document.addEventListener("DOMContentLoaded", () => {
	const section = document.querySelector(".pricelist-download");
	const image = section?.querySelector(".pricelist-download-img img");

	if (!section || !image) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger);

	gsap.from(image, {
		autoAlpha: 0,
		xPercent: -10,
		duration: 0.9,
		ease: "power3.out",
		scrollTrigger: {
			trigger: section,
			start: "top 50%",
			toggleActions: "play none none reverse",
		},
	});
});
