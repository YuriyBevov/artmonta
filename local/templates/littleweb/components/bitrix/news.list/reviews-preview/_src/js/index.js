document.addEventListener("DOMContentLoaded", () => {
	const slider = document.querySelector(".reviews-preview .swiper");

	if (slider) {
		new Swiper(slider, {
			slidesPerView: "auto",
			spaceBetween: 24,

			navigation: {
				prevEl: ".reviews-preview .swiper-button--prev",
				nextEl: ".reviews-preview .swiper-button--next",
			},
		});
	}
});
