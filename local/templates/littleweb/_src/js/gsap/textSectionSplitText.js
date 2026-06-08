import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { SplitText } from "gsap/SplitText";

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

document.addEventListener("DOMContentLoaded", () => {
	const wrappers = document.querySelectorAll(".text-split-section__content");

	if (!wrappers.length) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger, SplitText);

	const splitText = () => {
		wrappers.forEach((wrapper) => {
			const textElements = getTextElements(wrapper);

			if (!textElements.length) {
				return;
			}

			gsap.set(wrapper, { autoAlpha: 1 });

			textElements.forEach((element) => {
				SplitText.create(element, {
					type: "words,lines",
					mask: "lines",
					linesClass: "text-split-section__line",
					autoSplit: true,
					onSplit: (instance) =>
						gsap.from(instance.lines, {
							autoAlpha: 0,
							yPercent: 120,
							duration: 0.8,
							ease: "power3.out",
							stagger: 0.08,
							scrollTrigger: {
								trigger: wrapper,
								start: "top 70%",
								toggleActions: "play none none reverse",
							},
						}),
				});
			});
		});
	};

	if (document.fonts?.ready) {
		document.fonts.ready.then(splitText);
		return;
	}

	splitText();
});
