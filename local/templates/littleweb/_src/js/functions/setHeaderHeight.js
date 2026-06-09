export const setHeaderHeight = () => {
	const header = document.querySelector(".header");
	if (!header) return Promise.resolve(false);

	const setHeight = (height) => {
		document.documentElement.style.setProperty(
			"--header-height",
			`${height + 24}px`,
		);
	};

	const initialHeight = header.getBoundingClientRect().height;

	if (initialHeight) {
		setHeight(initialHeight);
	}

	const observer = new ResizeObserver(([entry]) => {
		setHeight(entry.contentRect.height);
	});

	observer.observe(header);

	return Promise.resolve(true);
};
