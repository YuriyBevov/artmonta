import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

document.addEventListener("DOMContentLoaded", () => {
	const counters = document.querySelectorAll("[data-counter-to]");

	if (!counters.length) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger);

	counters.forEach((counter) => {
		const rawValue = String(counter.dataset.counterTo || "");
		const endValue = Number(rawValue.replace(/\s+/g, "").replace(",", "."));

		if (!Number.isFinite(endValue)) {
			return;
		}

		const suffix = counter.dataset.counterSuffix || "";
		const startValue = Math.round(endValue * 0.9);
		const finalText = `${Math.round(endValue)}${suffix}`;
		const startText = `${startValue}${suffix}`;
		const card =
			counter.closest(".features__grid-item") || counter.parentElement;

		// Reserve the final card footprint before animation to avoid layout shifts.
		const initialText = counter.textContent;
		counter.textContent = finalText;
		const rect = card ? card.getBoundingClientRect() : null;

		if (card && rect) {
			card.style.width = `${Math.ceil(rect.width)}px`;
			card.style.height = `${Math.ceil(rect.height)}px`;
		}

		counter.textContent = startText || initialText;

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
});
