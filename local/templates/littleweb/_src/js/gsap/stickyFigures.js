import { gsap } from "gsap";
import {
	prefersReducedMotion,
	registerScrollTrigger,
	ScrollTrigger,
} from "./utils";

export const initStickyFigures = () => {
	const figures = Array.from(document.querySelectorAll(".sticky-img"));

	if (!figures.length || prefersReducedMotion()) {
		return;
	}

	registerScrollTrigger();

	figures.forEach((figure) => {
		const direction = figure.classList.contains("sticky-img--right") ? 1 : -1;
		const distance = 140;

		gsap.fromTo(
			figure,
			{
				"--sticky-img-y": `${distance * direction * -1}px`,
			},
			{
				"--sticky-img-y": `${distance * direction}px`,
				ease: "none",
				scrollTrigger: {
					trigger: figure.closest(".section") || figure,
					start: "top bottom",
					end: "bottom top",
					scrub: 1,
					invalidateOnRefresh: true,
					onToggle: ({ isActive }) => {
						figure.style.willChange = isActive ? "transform" : "auto";
					},
				},
			},
		);
	});
};
