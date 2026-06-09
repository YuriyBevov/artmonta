export const initPortfolioPreview = () => {
	const slider = document.querySelector(".portfolio-preview .swiper");

	if (slider) {
		new Swiper(slider, {
			slidesPerView: "auto",
			spaceBetween: 24,

			navigation: {
				prevEl: ".portfolio-preview .swiper-button--prev",
				nextEl: ".portfolio-preview .swiper-button--next",
			},
		});
	}
};
