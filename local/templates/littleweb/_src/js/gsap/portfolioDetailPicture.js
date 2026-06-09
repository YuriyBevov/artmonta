import { gsap } from "gsap";
import {
	isMobileScrollDevice,
	onImageReady,
	prefersReducedMotion,
	registerScrollTrigger,
} from "./utils";

export const initPortfolioDetailPicture = () => {
	const picture = document.querySelector(".portfolio-detail .detail-picture");
	const image = picture?.querySelector("img");

	if (!picture || !image) {
		return;
	}

	registerScrollTrigger();

	onImageReady(image, () => {
		if (prefersReducedMotion()) {
			gsap.set(picture, { autoAlpha: 1 });
			return;
		}

		gsap.fromTo(
			picture,
			{ autoAlpha: 0, y: 72 },
			{
				autoAlpha: 1,
				y: 0,
				duration: 1.1,
				ease: "power3.out",
				clearProps: "will-change",
			},
		);
	});

	if (!prefersReducedMotion() && !isMobileScrollDevice()) {
		gsap.fromTo(
			image,
			{
				yPercent: 14,
				scale: 1.12,
			},
			{
				yPercent: -28,
				scale: 1.12,
				ease: "none",
				scrollTrigger: {
					trigger: picture,
					start: "top bottom",
					end: "bottom top",
					scrub: 0.8,
					invalidateOnRefresh: true,
				},
			},
		);
	}
};
