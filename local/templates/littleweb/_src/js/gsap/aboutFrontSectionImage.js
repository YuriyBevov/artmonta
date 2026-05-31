import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

document.addEventListener("DOMContentLoaded", () => {
	const section = document.querySelector(".about-front-section");
	const image = section?.querySelector(".about-front-section-img");

	if (!section || !image) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger);

	gsap.from(image, {
		autoAlpha: 0,
		yPercent: 10,
		duration: 4,
		ease: "power3.out",
		scrollTrigger: {
			trigger: section,
			start: "top 50%",
			toggleActions: "play none none reverse",
		},
	});
});
