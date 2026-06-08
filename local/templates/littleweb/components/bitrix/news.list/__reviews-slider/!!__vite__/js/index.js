const slider = document.querySelector(".reviews-slider");

if (slider) {
	new Swiper(slider, {
		slidesPerView: 1,
		spaceBetween: 24,
		breakpoints: {
			620: {
				slidesPerView: 2,
			},
			1024: {
				slidesPerView: 3,
			},
		},
	});
}
