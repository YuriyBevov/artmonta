import { gsap } from "gsap";
import {
	isMobileScrollDevice,
	prefersReducedMotion,
	registerScrollTrigger,
	scheduleScrollRefresh,
	ScrollTrigger,
} from "./utils";

const DESKTOP_MEDIA = "(min-width: 768px)";
const MIN_COLUMN_WIDTH = 260;
const MAX_COLUMNS = 3;
const GAP = 24;
const MOBILE_PARALLAX_DISTANCE = 14;

const clamp = (value, min, max) => Math.max(min, Math.min(value, max));

const getImageSize = (image) => {
	const width =
		image?.naturalWidth || Number(image?.getAttribute("width")) || 0;
	const height =
		image?.naturalHeight || Number(image?.getAttribute("height")) || 0;

	return { width, height };
};

const getColumnCount = (galleryWidth) => {
	return clamp(
		Math.floor((galleryWidth + GAP) / (MIN_COLUMN_WIDTH + GAP)),
		2,
		MAX_COLUMNS,
	);
};

const resetGallery = (gallery, items) => {
	gallery.style.height = "";

	items.forEach((item) => {
		item.style.position = "";
		item.style.left = "";
		item.style.top = "";
		item.style.width = "";
		item.style.height = "";
	});
};

const setItemWidth = (gallery, items) => {
	const galleryWidth = gallery.clientWidth;
	const columnCount = getColumnCount(galleryWidth);
	const columnWidth = (galleryWidth - GAP * (columnCount - 1)) / columnCount;

	items.forEach((item) => {
		item.style.width = `${columnWidth}px`;
	});

	return columnWidth;
};

const layoutGallery = (gallery) => {
	const items = Array.from(gallery.querySelectorAll(".gallery__item"));

	if (!items.length) {
		return;
	}

	if (!window.matchMedia(DESKTOP_MEDIA).matches) {
		resetGallery(gallery, items);
		return;
	}

	const columnCount = getColumnCount(gallery.clientWidth);
	const columnWidth = setItemWidth(gallery, items);
	const columnHeights = Array(columnCount).fill(0);

	items.forEach((item, index) => {
		const image = item.querySelector("img");
		const { width, height } = getImageSize(image);
		const imageRatio = width && height ? width / height : 4 / 3;
		const itemHeight = columnWidth / imageRatio;
		const columnIndex = index % columnCount;
		const left = columnIndex * (columnWidth + GAP);
		const top = columnHeights[columnIndex];

		item.style.position = "absolute";
		item.style.left = `${left}px`;
		item.style.top = `${top}px`;
		item.style.width = `${columnWidth}px`;
		item.style.height = `${itemHeight}px`;

		columnHeights[columnIndex] = top + itemHeight + GAP;
	});

	gallery.style.height = `${Math.max(...columnHeights) - GAP}px`;
};

const layoutGalleries = (galleries) => {
	galleries.forEach(layoutGallery);
};

const createRevealAnimation = (items) => {
	const mediaItems = items
		.map((item) => item.querySelector(".gallery__item-wrapper"))
		.filter((media) => media);

	gsap.set(mediaItems, {
		autoAlpha: 0,
		y: 40,
		clipPath: "inset(12% 0% 0% 0%)",
		willChange: "transform, opacity, clip-path",
	});

	ScrollTrigger.batch(mediaItems, {
		start: "top 92%",
		onEnter: (batch) => {
			gsap.to(batch, {
				autoAlpha: 1,
				y: 0,
				clipPath: "inset(0% 0% 0% 0%)",
				duration: 0.8,
				ease: "power3.out",
				stagger: 0.08,
				overwrite: true,
				clearProps: "will-change",
			});
		},
		onLeaveBack: (batch) => {
			gsap.to(batch, {
				autoAlpha: 0,
				y: 40,
				clipPath: "inset(12% 0% 0% 0%)",
				duration: 0.45,
				ease: "power2.out",
				overwrite: true,
				clearProps: "will-change",
			});
		},
	});
};

const animateWrapperIn = (wrapper) => {
	gsap.to(wrapper, {
		autoAlpha: 1,
		y: 0,
		clipPath: "inset(0% 0% 0% 0%)",
		duration: 0.8,
		ease: "power3.out",
		overwrite: true,
		clearProps: "will-change",
	});
};

const animateWrapperOut = (wrapper) => {
	gsap.to(wrapper, {
		autoAlpha: 0,
		y: 40,
		clipPath: "inset(12% 0% 0% 0%)",
		duration: 0.45,
		ease: "power2.out",
		overwrite: true,
		clearProps: "will-change",
	});
};

const createMobileRevealAnimation = (wrappers) => {
	gsap.set(wrappers, {
		autoAlpha: 0,
		y: 40,
		clipPath: "inset(12% 0% 0% 0%)",
		willChange: "transform, opacity, clip-path",
	});

	if (!("IntersectionObserver" in window)) {
		wrappers.forEach(animateWrapperIn);
		return;
	}

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					animateWrapperIn(entry.target);
					return;
				}

				if (entry.boundingClientRect.top > 0) {
					animateWrapperOut(entry.target);
				}
			});
		},
		{
			rootMargin: "0px 0px -8% 0px",
			threshold: 0.01,
		},
	);

	wrappers.forEach((wrapper) => observer.observe(wrapper));
};

const createImageParallax = (items) => {
	if (prefersReducedMotion()) {
		return;
	}

	items.forEach((item, index) => {
		const image = item.querySelector("img");

		if (!image) {
			return;
		}

		const distance = 24 + (index % 3) * 8;

		gsap.fromTo(
			image,
			{
				y: -distance,
			},
			{
				y: distance,
				ease: "none",
				scrollTrigger: {
					trigger: item,
					start: "top bottom",
					end: "bottom top",
					scrub: 1,
					invalidateOnRefresh: true,
				},
			},
		);
	});
};

const createMobileImageParallax = (items) => {
	if (prefersReducedMotion()) {
		return;
	}

	const parallaxItems = items
		.map((item) => {
			const image = item.querySelector("img");

			if (!image) {
				return null;
			}

			gsap.set(image, {
				y: -MOBILE_PARALLAX_DISTANCE,
				force3D: true,
				willChange: "transform",
			});

			return {
				item,
				setY: gsap.quickSetter(image, "y", "px"),
			};
		})
		.filter((item) => item);

	if (!parallaxItems.length) {
		return;
	}

	let ticking = false;

	const update = () => {
		const viewportHeight =
			window.innerHeight || document.documentElement.clientHeight;

		parallaxItems.forEach(({ item, setY }) => {
			const rect = item.getBoundingClientRect();

			if (rect.bottom < 0 || rect.top > viewportHeight) {
				return;
			}

			const progress = clamp(
				(viewportHeight - rect.top) / (viewportHeight + rect.height),
				0,
				1,
			);
			const y =
				-MOBILE_PARALLAX_DISTANCE +
				progress * MOBILE_PARALLAX_DISTANCE * 2;

			setY(y);
		});

		ticking = false;
	};

	const requestUpdate = () => {
		if (ticking) {
			return;
		}

		ticking = true;
		window.requestAnimationFrame(update);
	};

	update();
	window.addEventListener("scroll", requestUpdate, { passive: true });
	window.addEventListener("resize", requestUpdate, { passive: true });
};

export const initPortfolioListBatch = () => {
	const galleries = Array.from(document.querySelectorAll(".gallery"));

	if (!galleries.length) {
		return;
	}

	registerScrollTrigger();

	const items = Array.from(document.querySelectorAll(".gallery__item"));
	const wrappers = items
		.map((item) => item.querySelector(".gallery__item-wrapper"))
		.filter((media) => media);
	const shouldUseMobileAnimations = isMobileScrollDevice();

	layoutGalleries(galleries);

	if (prefersReducedMotion()) {
		gsap.set(wrappers, { autoAlpha: 1, y: 0, clipPath: "none" });
	} else if (shouldUseMobileAnimations) {
		createMobileRevealAnimation(wrappers);
	} else {
		createRevealAnimation(items);
	}

	if (shouldUseMobileAnimations) {
		createMobileImageParallax(items);
	} else {
		createImageParallax(items);
	}
	scheduleScrollRefresh();

	let layoutTimer;
	const pendingGalleries = new Set();

	const scheduleLayout = (gallery) => {
		pendingGalleries.add(gallery);
		window.clearTimeout(layoutTimer);
		layoutTimer = window.setTimeout(() => {
			pendingGalleries.forEach(layoutGallery);
			pendingGalleries.clear();
			scheduleScrollRefresh();
		}, 80);
	};

	galleries.forEach((gallery) => {
		gallery.querySelectorAll("img").forEach((image) => {
			if (!image.complete) {
				image.addEventListener(
					"load",
					() => {
						scheduleLayout(gallery);
					},
					{ once: true },
				);
				image.addEventListener(
					"error",
					() => {
						scheduleLayout(gallery);
					},
					{ once: true },
				);
			}
		});
	});

	let resizeTimeout;
	let previousViewportWidth = window.innerWidth;

	window.addEventListener("resize", () => {
		if (isMobileScrollDevice() && window.innerWidth === previousViewportWidth) {
			return;
		}

		previousViewportWidth = window.innerWidth;

		window.clearTimeout(resizeTimeout);
		resizeTimeout = window.setTimeout(() => {
			layoutGalleries(galleries);
			scheduleScrollRefresh();
		}, 150);
	});
};
