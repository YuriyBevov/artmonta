document.addEventListener("DOMContentLoaded", () => {
	const sliders = document.querySelectorAll(".base-slider");

	if (sliders) {
		sliders.forEach((slider) => {
			const nextBtn = slider
				.closest("section")
				.querySelector(".swiper-button--next");

			const prevBtn = slider
				.closest("section")
				.querySelector(".swiper-button--prev");
			new Swiper(slider, {
				slidesPerView: "auto",
				spaceBetween: 24,

				navigation: {
					prevEl: prevBtn ?? null,
					nextEl: nextBtn ?? null,
				},
			});
		});
	}
});
