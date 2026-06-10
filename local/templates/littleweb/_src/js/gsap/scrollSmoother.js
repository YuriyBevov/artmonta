import { gsap } from "gsap";
import { ScrollSmoother } from "gsap/ScrollSmoother";
import {
	isMobileScrollDevice,
	prefersReducedMotion,
	registerScrollTrigger,
} from "./utils";

export const initScrollSmoother = () => {
	registerScrollTrigger(ScrollSmoother);

	if (!prefersReducedMotion()) {
		const smootherMedia = gsap.matchMedia();

		smootherMedia.add("(min-width: 1024px) and (hover: hover) and (pointer: fine)", () => {
			const smoother = ScrollSmoother.create({
				wrapper: "#smooth-wrapper",
				content: "#smooth-content",
				smooth: 1.2,
				smoothTouch: false,
				effects: false,
				ignoreMobileResize: true,
				normalizeScroll: false,
			});

			return () => {
				smoother.kill();
			};
		});
	}

	const heroOverlay = document.querySelector(".hero-overlay");
	const heroVideo = document.querySelector(".hero-section video");
	const isMobileScroll = isMobileScrollDevice();
	let isHeroVideoPaused = false;

	if (!heroOverlay || prefersReducedMotion()) {
		return;
	}

	const updateHeroVideoState = (progress) => {
		if (!heroVideo) {
			return;
		}

		if (progress >= 0.98 && !isHeroVideoPaused) {
			heroVideo.pause();
			isHeroVideoPaused = true;
			return;
		}

		if (progress < 0.98 && isHeroVideoPaused) {
			const playPromise = heroVideo.play();

			if (playPromise?.catch) {
				playPromise.catch(() => {});
			}

			isHeroVideoPaused = false;
		}
	};

	gsap.to(heroOverlay, {
		opacity: 1,
		ease: "none",
		scrollTrigger: {
			trigger: ".hero-spacer",
			start: "top top",
			end: "bottom top",
			scrub: isMobileScroll ? true : 0.3,
			onUpdate: ({ progress }) => {
				updateHeroVideoState(progress);
			},
			onLeave: () => {
				updateHeroVideoState(1);
			},
			onEnterBack: ({ progress }) => {
				updateHeroVideoState(progress);
			},
		},
	});
};
