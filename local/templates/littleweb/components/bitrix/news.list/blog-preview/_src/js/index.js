document.addEventListener("DOMContentLoaded", () => {
	const slider = document.querySelector(".blog-preview .swiper");

	console.log(slider);
	if (slider) {
		new Swiper(slider, {
			slidesPerView: 1,
			spaceBetween: 50,
			// speed: 1500,
			// initialSlide: 1,
			// loop: true,

			navigation: {
				prevEl: ".blog-preview-slider .swiper-button--prev",
				nextEl: ".blog-preview-slider .swiper-button--next",
			},
			breakpoints: {
				400: {
					slidesPerView: "auto",
				},
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
