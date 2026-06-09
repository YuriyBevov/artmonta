import { gsap } from "gsap";
import {
	isMobileScrollDevice,
	onImageReady,
	prefersReducedMotion,
	registerScrollTrigger,
	scheduleScrollRefresh,
} from "./utils";

const setPictureMetrics = (picture, image) => {
	const pictureWidth = picture.clientWidth || image.naturalWidth;
	const imageWidth =
		image.naturalWidth || Number(image.getAttribute("width")) || 0;
	const imageHeight =
		image.naturalHeight || Number(image.getAttribute("height")) || 0;
	let changed = false;

	if (pictureWidth) {
		const value = `${pictureWidth}px`;

		if (picture.style.getPropertyValue("--blog-detail-picture-width") !== value) {
			picture.style.setProperty("--blog-detail-picture-width", value);
			changed = true;
		}
	}

	if (imageWidth && imageHeight) {
		const value = `${imageWidth} / ${imageHeight}`;

		if (picture.style.getPropertyValue("--blog-detail-picture-ratio") !== value) {
			picture.style.setProperty("--blog-detail-picture-ratio", value);
			changed = true;
		}
	}

	return changed;
};

export const initBlogDetailPicture = () => {
	const picture = document.querySelector(".blog-detail__picture-wrapper");
	const mask = picture?.querySelector(".blog-detail__picture-mask");
	const image = mask?.querySelector(".blog-detail__picture");

	if (!picture || !mask || !image) {
		return;
	}

	registerScrollTrigger();

	onImageReady(image, () => {
		const metricsChanged = setPictureMetrics(picture, image);
		gsap.set(picture, { autoAlpha: 1 });
		if (metricsChanged) {
			scheduleScrollRefresh();
		}

		if (prefersReducedMotion()) {
			gsap.set(mask, { width: "100%" });
			return;
		}

		gsap.fromTo(
			mask,
			{
				width: 0,
			},
			{
				width: "100%",
				duration: 1.3,
				ease: "power3.out",
				clearProps: "will-change",
			},
		);
	});

	if (!prefersReducedMotion() && !isMobileScrollDevice()) {
		gsap.fromTo(
			image,
			{
				xPercent: -50,
				yPercent: -8,
				scale: 1.2,
			},
			{
				xPercent: -50,
				yPercent: 8,
				scale: 1.2,
				ease: "none",
				scrollTrigger: {
					trigger: picture,
					start: "top bottom",
					end: "bottom top",
					scrub: 0.8,
					invalidateOnRefresh: true,
				},
			},
		);
	}

	if (window.ResizeObserver) {
		new ResizeObserver(() => {
			if (setPictureMetrics(picture, image)) {
				scheduleScrollRefresh();
			}
		}).observe(picture);
	}
};
