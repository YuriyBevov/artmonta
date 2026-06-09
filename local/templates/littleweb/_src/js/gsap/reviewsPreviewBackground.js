import { gsap } from "gsap";
import { prefersReducedMotion, registerScrollTrigger } from "./utils";

export const initReviewsPreviewBackground = () => {
	const section = document.querySelector(".reviews-preview");
	const image = section?.querySelector(".reviews-preview__bg img");

	if (!section || !image) {
		return;
	}

	if (prefersReducedMotion()) {
		return;
	}

	registerScrollTrigger();

	gsap.fromTo(
		image,
		{
			yPercent: -8,
		},
		{
			yPercent: 8,
			ease: "none",
			scrollTrigger: {
				trigger: section,
				start: "top bottom",
				end: "bottom top",
				scrub: 0.8,
				invalidateOnRefresh: true,
			},
		},
	);
};
