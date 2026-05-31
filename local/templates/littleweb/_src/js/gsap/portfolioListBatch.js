import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

document.addEventListener("DOMContentLoaded", () => {
	const items = gsap.utils.toArray(
		".portfolio-list .portfolio-list__gallery-item img",
	);

	if (!items.length) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger);
	gsap.set(items, { autoAlpha: 0 });

	ScrollTrigger.batch(items, {
		start: "top 85%",
		onEnter: (batch) => {
			gsap.to(batch, {
				autoAlpha: 1,

				duration: 0.8,
				ease: "linear",
				overwrite: true,
			});
		},
		onLeaveBack: (batch) => {
			gsap.to(batch, {
				autoAlpha: 0,

				duration: 0.8,
				ease: "linear",
				overwrite: true,
			});
		},
	});
});
