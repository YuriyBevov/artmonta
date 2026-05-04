export const setHeaderHeight = () => {
	const header = document.querySelector(".header");
	if (!header) return;

	const observer = new ResizeObserver(([entry]) => {
		document.documentElement.style.setProperty(
			"--header-height",
			`${entry.contentRect.height + 64}px`,
		);
	});

	observer.observe(header);
};
