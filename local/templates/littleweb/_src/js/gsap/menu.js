import { gsap } from "gsap";
import { bodyLocker } from "../functions/bodyLocker";

export const initMenu = () => {
	const opener = document.querySelector(".burger-btn--opener");
	const closer = document.querySelector(".burger-btn--closer");
	const menu = document.querySelector(".menu");
	const menuLinks = Array.from(menu?.querySelectorAll("a[href]") || []);

	if (opener && closer && menu) {
		const mm = gsap.matchMedia();

		mm.add("(max-width: 1239px)", () => {
			const tl = gsap.timeline().pause();

			tl.fromTo(
				".menu",
				{
					opacity: 0,
					zIndex: -1,
					visibility: "hidden",
					pointerEvents: "none",
				},
				{
					display: "block",
					opacity: 1,
					zIndex: 999,
					visibility: "visible",
					pointerEvents: "auto",
					duration: 0.4,
				},
			);
			tl.fromTo(
				".menu__wrapper",
				{ x: "110vw", opacity: 0 },
				{ opacity: 1, x: 0, duration: 0.4 },
				"-=.2",
			);

			const resetCloseCallback = () => {
				tl.eventCallback("onReverseComplete", null);
			};

			const onClickOpenMenu = () => {
				resetCloseCallback();
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

			const onClickCloseMenu = (afterClose) => {
				tl.eventCallback("onReverseComplete", () => {
					resetCloseCallback();

					if (typeof afterClose === "function") {
						afterClose();
					}
				});
				tl.reverse();
				bodyLocker(false);
				document.removeEventListener("click", onOverlayClickHandler);
				window.removeEventListener("keydown", onEscClickHandler);
			};

			const onMenuLinkClick = (evt) => {
				const link = evt.currentTarget;
				const href = link.href;

				if (
					evt.defaultPrevented ||
					evt.button !== 0 ||
					evt.metaKey ||
					evt.ctrlKey ||
					evt.shiftKey ||
					evt.altKey ||
					link.target === "_blank" ||
					!href
				) {
					return;
				}

				evt.preventDefault();
				onClickCloseMenu(() => {
					if (href !== window.location.href) {
						window.location.href = href;
					}
				});
			};

			closer.addEventListener("click", onClickCloseMenu);
			opener.addEventListener("click", onClickOpenMenu);
			menuLinks.forEach((link) => {
				link.addEventListener("click", onMenuLinkClick);
			});

			return () => {
				closer.removeEventListener("click", onClickCloseMenu);
				opener.removeEventListener("click", onClickOpenMenu);
				menuLinks.forEach((link) => {
					link.removeEventListener("click", onMenuLinkClick);
				});
				document.removeEventListener("click", onOverlayClickHandler);
				window.removeEventListener("keydown", onEscClickHandler);
			};
		});
	}
};
