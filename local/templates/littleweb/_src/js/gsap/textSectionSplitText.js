import { gsap } from "gsap";
import { SplitText } from "gsap/SplitText";
import {
	prefersReducedMotion,
	registerScrollTrigger,
	scheduleScrollRefresh,
} from "./utils";

const getTextElements = (wrapper) => {
	const textElements = Array.from(wrapper.children).filter((element) => {
		const tagName = element.tagName;

		return (
			tagName !== "SCRIPT" &&
			tagName !== "STYLE" &&
			element.textContent.trim().length
		);
	});

	if (!textElements.length && wrapper.textContent.trim().length) {
		return [wrapper];
	}

	return textElements;
};

const onFontsReady = (callback) => {
	if (!document.fonts?.ready) {
		callback();
		return;
	}

	let isCalled = false;
	const run = () => {
		if (isCalled) {
			return;
		}

		isCalled = true;
		callback();
	};

	document.fonts.ready.then(run);
	window.setTimeout(run, 200);
};

export const initTextSectionSplitText = () => {
	const wrappers = document.querySelectorAll(".text-split-section__content");

	if (!wrappers.length) {
		return;
	}

	if (prefersReducedMotion()) {
		gsap.set(wrappers, { autoAlpha: 1 });
		return;
	}

	registerScrollTrigger(SplitText);

	const splitText = () => {
		wrappers.forEach((wrapper) => {
			const textElements = getTextElements(wrapper);

			if (!textElements.length) {
				return;
			}

			gsap.set(wrapper, { autoAlpha: 1 });

			const lines = [];

			textElements.forEach((element) => {
				const split = SplitText.create(element, {
					type: "lines",
					mask: "lines",
					linesClass: "text-split-section__line",
				});

				lines.push(...split.lines);
			});

			if (!lines.length) {
				return;
			}

			gsap.set(lines, {
				autoAlpha: 0,
				yPercent: 110,
			});

			gsap
				.timeline({
					scrollTrigger: {
						trigger: wrapper,
						start: "top 72%",
						once: true,
					},
				})
				.to(lines, {
					autoAlpha: 1,
					yPercent: 0,
					duration: 0.75,
					ease: "power3.out",
					stagger: 0.06,
					clearProps: "transform,opacity,visibility",
				});
		});

		scheduleScrollRefresh();
	};

	onFontsReady(splitText);
};
