import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

document.addEventListener("DOMContentLoaded", () => {
	const counters = document.querySelectorAll("[data-counter-to]");

	if (!counters.length) return;

	gsap.registerPlugin(ScrollTrigger);

	const items = [];

	counters.forEach((counter) => {
		const rawValue = String(counter.dataset.counterTo || "");
		const endValue = Number(rawValue.replace(/\s+/g, "").replace(",", "."));

		if (!Number.isFinite(endValue)) return;

		const suffix = counter.dataset.counterSuffix || "";
		const startValue = Math.round(endValue * 0.9);
		const finalText = `${Math.round(endValue)}${suffix}`;
		const startText = `${startValue}${suffix}`;
		const card =
			counter.closest(".features__grid-item") || counter.parentElement;

		const initialText = counter.textContent;
		counter.textContent = finalText;
		const rect = card ? card.getBoundingClientRect() : null;

		if (card && rect) {
			card.style.width = `${Math.ceil(rect.width)}px`;
			card.style.height = `${Math.ceil(rect.height)}px`;
		}

		counter.textContent = startText || initialText;

		items.push({ counter, card, finalText });

		const state = { value: startValue };

		gsap.to(state, {
			value: endValue,
			duration: 1.2,
			ease: "ease-in",
			snap: { value: 1 },
			scrollTrigger: {
				trigger: counter,
				start: "top 85%",
				toggleActions: "play none none reverse",
			},
			onUpdate: () => {
				counter.textContent = `${Math.round(state.value)}${suffix}`;
			},
		});
	});

	const refreshCardSizes = () => {
		items.forEach(({ counter, card, finalText }) => {
			if (!card) return;
			const currentText = counter.textContent;
			card.style.width = "";
			card.style.height = "";
			counter.textContent = finalText;
			const rect = card.getBoundingClientRect();
			card.style.width = `${Math.ceil(rect.width)}px`;
			card.style.height = `${Math.ceil(rect.height)}px`;
			counter.textContent = currentText;
		});
		ScrollTrigger.refresh();
	};

	let resizeTimer;
	window.addEventListener("resize", () => {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(refreshCardSizes, 150);
	});
});
