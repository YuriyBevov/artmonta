import { gsap } from "gsap";

const HIDE_DURATION = 0.7;

export const hideSiteLoader = ({ onBeforeHide } = {}) => {
	const loader = document.querySelector("[data-site-loader]");

	document.body.classList.remove("site-loading");
	onBeforeHide?.();

	if (!loader) {
		return Promise.resolve();
	}

	gsap.killTweensOf(loader);

	return new Promise((resolve) => {
		gsap.to(loader, {
			autoAlpha: 0,
			duration: HIDE_DURATION,
			ease: "power2.out",
			pointerEvents: "none",
			onComplete: () => {
				loader.remove();
				resolve();
			},
		});
	});
};
