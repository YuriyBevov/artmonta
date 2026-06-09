import { gsap } from "gsap";

window.addEventListener("load", () => {
	const btn = document.createElement("button");
	btn.classList.add("scroll-up-btn");
	btn.setAttribute("aria-label", "В начало страницы");

	gsap.set(btn, {
		display: "flex",
		alignItems: "center",
		justifyContent: "center",
		position: "fixed",
		bottom: "40px",
		right: "40px",
		width: "50px",
		height: "50px",
		// borderRadius: "50%",
		backgroundColor: "rgb(83 44 249 / 10%)",
		zIndex: 89,
		padding: "5px",
		border: "none",
		transform: "translateY(150px) rotate(-45deg)",
		backgroundImage:
			"url(/local/templates/littleweb/_dist/images/arrow-white.svg)",
		backgroundRepeat: "no-repeat",
		backgroundSize: "16px",
		backgroundPosition: "center",
		border: "2px solid #ffffff",
	});

	document.body.append(btn);

	let isActive = false;
	window.addEventListener("scroll", () => {
		const viewportHeight = document.documentElement.clientHeight;

		if (window.scrollY > viewportHeight * 1.3) {
			if (!isActive) {
				isActive = true;
				gsap.fromTo(
					btn,
					{
						y: "150px",
					},
					{
						y: "0",
						duration: 0.7,
						ease: "back",
					},
				);
			}
		} else {
			if (isActive) {
				isActive = false;
				gsap.fromTo(
					btn,
					{
						y: "0",
					},
					{
						y: "150px",
						duration: 0.5,
						ease: "linear",
					},
				);
			}
		}
	});

	btn.addEventListener("click", () => {
		window.scrollTo({ top: 0, behavior: "smooth" });
	});
});
