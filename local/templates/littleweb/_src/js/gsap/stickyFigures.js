import { gsap } from "gsap";
import {
	prefersReducedMotion,
	registerScrollTrigger,
} from "./utils";

const createStickyFigureAnimation = (figure, distance, scrub) => {
	const direction = figure.classList.contains("sticky-img--right") ? 1 : -1;
	const trigger = figure.closest(".section") || figure;

	gsap.set(figure, {
		force3D: true,
	});

	gsap.fromTo(
		figure,
		{
			yPercent: -50,
			y: distance * direction * -1,
		},
		{
			yPercent: -50,
			y: distance * direction,
			ease: "none",
			scrollTrigger: {
				trigger,
				start: "top bottom",
				end: "bottom top",
				scrub,
				invalidateOnRefresh: false,
				fastScrollEnd: false,
				onToggle: ({ isActive }) => {
					figure.style.willChange = isActive ? "transform" : "auto";
				},
			},
		},
	);
};

export const initStickyFigures = () => {
	const figures = Array.from(document.querySelectorAll(".sticky-img"));

	if (!figures.length || prefersReducedMotion()) {
		return;
	}

	registerScrollTrigger();

	figures.forEach((figure) => {
		createStickyFigureAnimation(figure, 140, 1);
	});
};
