import Swiper from "swiper";
import { Autoplay } from "swiper/modules";

export const initCrawlLineSlider = () => {
	const sliders = document.querySelectorAll(".crawl-line-slider");

	if (sliders.length) {
		sliders.forEach((slider) => {
			new Swiper(slider, {
				modules: [Autoplay],
				autoplay: {
					enabled: true,
					delay: 0,
					pauseOnMouseEnter: false,
					disableOnInteraction: false,
				},
				loop: true,
				noSwipingClass: "swiper-slide",
				allowTouchMove: false,
				slidesPerView: "auto",
				spaceBetween: 40,
				speed: 5000,
				freeMode: true,
			});
		});
	}
};
