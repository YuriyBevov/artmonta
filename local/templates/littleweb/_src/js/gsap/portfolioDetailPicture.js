import { gsap } from "gsap";
import {
	isMobileScrollDevice,
	onImageReady,
	prefersReducedMotion,
	registerScrollTrigger,
} from "./utils";

const clamp = (value, min, max) => Math.max(min, Math.min(value, max));

const createMobilePictureParallax = (picture, image) => {
	const distance = 12;
	const setY = gsap.quickSetter(image, "yPercent");
	let ticking = false;

	gsap.set(image, {
		yPercent: distance / 2,
		scale: 1.12,
		force3D: true,
		willChange: "transform",
	});

	const update = () => {
		const rect = picture.getBoundingClientRect();
		const viewportHeight =
			window.innerHeight || document.documentElement.clientHeight;
		const progress = clamp(
			(viewportHeight - rect.top) / (viewportHeight + rect.height),
			0,
			1,
		);

		setY(distance / 2 - progress * distance * 1.5);
		ticking = false;
	};

	const requestUpdate = () => {
		if (ticking) {
			return;
		}

		ticking = true;
		window.requestAnimationFrame(update);
	};

	update();
	window.addEventListener("scroll", requestUpdate, { passive: true });
	window.addEventListener("resize", requestUpdate, { passive: true });
};

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

	if (prefersReducedMotion()) {
		return;
	}

	if (isMobileScrollDevice()) {
		createMobilePictureParallax(picture, image);
		return;
	}

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
};
