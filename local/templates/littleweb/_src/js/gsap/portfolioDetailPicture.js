import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

const animateOnImageReady = (image, callback) => {
	if (!image) {
		callback();
		return;
	}

	if (image.complete) {
		callback();
		return;
	}

	image.addEventListener("load", callback, { once: true });
	image.addEventListener("error", callback, { once: true });
};

document.addEventListener("DOMContentLoaded", () => {
	const picture = document.querySelector(".portfolio-detail .detail-picture");
	const image = picture?.querySelector("img");

	if (!picture || !image) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger);

	animateOnImageReady(image, () => {
		gsap.fromTo(
			picture,
			{
				autoAlpha: 0,
				y: 72,
			},
			{
				autoAlpha: 1,
				y: 0,
				duration: 1.1,
				ease: "power3.out",
			},
		);
	});

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
});
