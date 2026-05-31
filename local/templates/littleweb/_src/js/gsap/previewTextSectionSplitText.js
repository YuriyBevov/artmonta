import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { SplitText } from "gsap/SplitText";

document.addEventListener("DOMContentLoaded", () => {
	const wrapper = document.querySelector(".preview-text-section-wrapper");

	if (!wrapper) {
		return;
	}

	const textElements = Array.from(wrapper.children).filter((element) => {
		const tagName = element.tagName;

		return (
			tagName !== "SCRIPT" &&
			tagName !== "STYLE" &&
			element.textContent.trim().length
		);
	});

	if (!textElements.length) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger, SplitText);

	gsap.set(wrapper, { autoAlpha: 1 });

	const splitText = () => {
		textElements.forEach((element) => {
			SplitText.create(element, {
				type: "words,lines",
				mask: "lines",
				linesClass: "preview-text-section-line",
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
	};

	if (document.fonts?.ready) {
		document.fonts.ready.then(splitText);
		return;
	}

	splitText();
});
