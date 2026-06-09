export const initBlogPreview = () => {
	const slider = document.querySelector(".blog-preview .swiper");

	if (slider) {
		new Swiper(slider, {
			slidesPerView: 1,
			spaceBetween: 50,

			navigation: {
				prevEl: ".blog-preview-slider .swiper-button--prev",
				nextEl: ".blog-preview-slider .swiper-button--next",
			},
			breakpoints: {
				400: {
					slidesPerView: "auto",
				},
			},


		});
	}
};
