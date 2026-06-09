import { gsap } from "gsap";
import { prefersReducedMotion, registerScrollTrigger } from "./utils";

const reveals = [
	{
		section: ".pricelist-download",
		target: ".pricelist-download-img",
		from: { autoAlpha: 0, xPercent: -5 },
		duration: 2,
	},
	{
		section: ".about-front-section",
		target: ".about-front-section-img",
		from: { autoAlpha: 0, yPercent: 10 },
		duration: 2.4,
	},
];

export const initSectionImageReveal = () => {
	if (prefersReducedMotion()) {
		return;
	}

	registerScrollTrigger();

	reveals.forEach(({ section: sectionSelector, target, from, duration }) => {
		const section = document.querySelector(sectionSelector);
		const element = section?.querySelector(target);

		if (!section || !element) {
			return;
		}

		gsap.from(element, {
			...from,
			duration,
			ease: "power3.out",
			clearProps: "will-change",
			scrollTrigger: {
				trigger: section,
				start: "top 55%",
				once: true,
			},
		});
	});
};
