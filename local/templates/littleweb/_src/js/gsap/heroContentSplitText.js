import { gsap } from "gsap";
import { SplitText } from "gsap/SplitText";
import { prefersReducedMotion, registerScrollTrigger } from "./utils";

export const initHeroContentSplitText = () => {
	const content = document.querySelector(".hero-section__content");
	const textItem = document.querySelector(".hero-section__content-item--text");

	if (!content || !textItem) {
		return;
	}

	const textElements = Array.from(textItem.children).filter(
		(element) => element.tagName !== "SCRIPT",
	);

	if (!textElements.length) {
		return;
	}

	if (prefersReducedMotion()) {
		return;
	}

	registerScrollTrigger(SplitText);

	const animatedLines = [];

	textElements.forEach((element) => {
		const split = new SplitText(element, {
			type: "lines",
			linesClass: "hero-split-line",
			aria: "none",
		});

		split.lines.forEach((line) => {
			const mask = document.createElement("div");
			mask.className = "hero-split-mask";
			line.parentNode.insertBefore(mask, line);
			mask.appendChild(line);
			animatedLines.push(line);
		});
	});

	if (!animatedLines.length) {
		return;
	}

	gsap.set(".hero-split-mask", {
		overflow: "hidden",
		display: "block",
	});

	gsap.set(animatedLines, {
		autoAlpha: 0,
		yPercent: 110,
	});

	gsap
		.timeline({
			scrollTrigger: {
				trigger: content,
				start: "center center",
				once: true,
			},
		})
		.to(animatedLines, {
			onStart: () => {
				gsap.set(animatedLines, {
					willChange: "transform, opacity",
				});
			},
			autoAlpha: 1,
			yPercent: 0,
			duration: 0.8,
			ease: "linear",
			stagger: 0.005,
			clearProps: "will-change",
		});
};
