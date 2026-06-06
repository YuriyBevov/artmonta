import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

const animateOnImageReady = (image, callback) => {
	if (!image) {
		callback();
		return;
	}

	if (image.complete) {
		callback();
		return;
	}

	image.addEventListener("load", callback, { once: true });
	image.addEventListener("error", callback, { once: true });
};

const setPictureMetrics = (picture, image) => {
	const pictureWidth = picture.clientWidth || image.naturalWidth;
	const imageWidth =
		image.naturalWidth || Number(image.getAttribute("width")) || 0;
	const imageHeight =
		image.naturalHeight || Number(image.getAttribute("height")) || 0;

	if (pictureWidth) {
		picture.style.setProperty(
			"--blog-detail-picture-width",
			`${pictureWidth}px`,
		);
	}

	if (imageWidth && imageHeight) {
		picture.style.setProperty(
			"--blog-detail-picture-ratio",
			`${imageWidth} / ${imageHeight}`,
		);
	}
};

document.addEventListener("DOMContentLoaded", () => {
	const picture = document.querySelector(".blog-detail__picture-wrapper");
	const mask = picture?.querySelector(".blog-detail__picture-mask");
	const image = mask?.querySelector(".blog-detail__picture");

	if (!picture || !mask || !image) {
		return;
	}

	gsap.registerPlugin(ScrollTrigger);

	animateOnImageReady(image, () => {
		setPictureMetrics(picture, image);
		gsap.set(picture, { autoAlpha: 1 });
		gsap.fromTo(
			mask,
			{
				width: 0,
			},
			{
				width: "100%",
				duration: 1.3,
				ease: "power3.out",
			},
		);
	});

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

	if (window.ResizeObserver) {
		new ResizeObserver(() => {
			setPictureMetrics(picture, image);
			ScrollTrigger.refresh();
		}).observe(picture);
	}
});
