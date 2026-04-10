import { Autoplay } from "swiper/modules";

document.addEventListener("DOMContentLoaded", () => {
	const slider = document.querySelector(".portfolio-preview .swiper");

	if (slider) {
		new Swiper(slider, {
			slidesPerView: "auto",
			spaceBetween: 24,
			// speed: 1500,
			// initialSlide: 1,
			// loop: true,

			navigation: {
				prevEl: ".portfolio-preview .swiper-button--prev",
				nextEl: ".portfolio-preview .swiper-button--next",
			},
			// slidesOffsetBefore: -80,
			// slidesOffsetAfter: -1 * 80,

			// autoplay: {
			// 	enabled: true,
			// 	delay: 2000,
			// 	pauseOnMouseEnter: true,
			// 	disableOnInteraction: false,
			// },
		});
	}
});
