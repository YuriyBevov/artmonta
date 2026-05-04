import { gsap } from "gsap";
import { bodyLocker } from "../functions/bodyLocker";

const opener = document.querySelector(".burger-btn--opener");
const closer = document.querySelector(".burger-btn--closer");
const menu = document.querySelector(".menu");

if (opener && closer && menu) {
	const mm = gsap.matchMedia();

	mm.add("(max-width: 1239px)", () => {
		const tl = gsap.timeline().pause();

		tl.fromTo(
			".menu",
			{ opacity: 0, zIndex: -1 },
			{ display: "block", opacity: 1, zIndex: 999, duration: 0.4 },
		);
		tl.fromTo(
			".menu__wrapper",
			{ x: "110vw", opacity: 0 },
			{ opacity: 1, x: 0, duration: 0.4 },
			"-=.2",
		);

		const onClickOpenMenu = () => {
			tl.play();
			bodyLocker(true);
			document.addEventListener("click", onOverlayClickHandler);
			window.addEventListener("keydown", onEscClickHandler);
		};

		const onOverlayClickHandler = (evt) => {
			if (evt.target.classList.contains("menu")) onClickCloseMenu();
		};

		const onEscClickHandler = (evt) => {
			if (evt.key === "Escape" || evt.code === 27) onClickCloseMenu();
		};

		const onClickCloseMenu = () => {
			tl.reverse();
			bodyLocker(false);
			document.removeEventListener("click", onOverlayClickHandler);
			window.removeEventListener("keydown", onEscClickHandler);
		};

		closer.addEventListener("click", onClickCloseMenu);
		opener.addEventListener("click", onClickOpenMenu);

		return () => {
			closer.removeEventListener("click", onClickCloseMenu);
			opener.removeEventListener("click", onClickOpenMenu);
			document.removeEventListener("click", onOverlayClickHandler);
			window.removeEventListener("keydown", onEscClickHandler);
		};
	});
}
