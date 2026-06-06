const bodyLocker = (isLocked) => {
	document.body.style.overflow = isLocked ? "hidden" : "auto";
};

const createReviewPopupContent = (opener) => {
	const wrapper = document.createElement("div");
	wrapper.className = "review-popup";

	const card = opener.closest(".review-card")?.cloneNode(true);

	if (!card) return wrapper;

	const expander = card.querySelector(".review-card__expander");
	const text = card.querySelector(".review-card__content span");

	if (expander) {
		expander.remove();
	}

	if (text) {
		text.textContent = opener.dataset.reviewText || text.textContent;
	}

	wrapper.append(card);

	return wrapper;
};

const animatePopup = (popup, opener) => {
	const originalShow = popup.show.bind(popup);

	popup.show = function () {
		const overlayEl = this.overlay.element;
		const popupEl = this.popupContainer;

		if (!popupEl) return;

		bodyLocker(true);

		if (overlayEl) {
			overlayEl.style.opacity = "0";
			overlayEl.style.transition = "opacity 0.4s ease";
		}

		popupEl.style.opacity = "0";
		popupEl.style.transform = "translateY(20px)";
		popupEl.style.transition = "none";

		if (overlayEl) overlayEl.offsetHeight;
		popupEl.offsetHeight;

		originalShow();

		if (overlayEl) {
			overlayEl.style.opacity = "1";
		}

		popupEl.style.transition = "opacity 0.4s ease, transform 0.4s ease";
		popupEl.style.opacity = "1";
		popupEl.style.transform = "translateY(0)";
	};

	const originalClose = popup.close.bind(popup);

	popup.close = function () {
		const overlayEl = this.overlay.element;
		const popupEl = this.popupContainer;

		if (!popupEl || (overlayEl && overlayEl.style.opacity === "0")) {
			return originalClose();
		}

		if (overlayEl) {
			overlayEl.style.transition = "opacity .4s ease";
			overlayEl.style.opacity = "0";
		}

		popupEl.style.transition = "opacity 0.3s ease, transform 0.3s ease";
		popupEl.style.opacity = "0";
		popupEl.style.transform = "translateY(20px)";

		setTimeout(() => {
			bodyLocker(false);
			originalClose();
			if (opener) opener.style.pointerEvents = "";
		}, 450);
	};
};

const initReviewPopups = () => {
	if (!window.BX?.PopupWindow) return;

	document.querySelectorAll("[data-review-popup]").forEach((opener) => {
		BX.bind(BX(opener), "click", (evt) => {
			evt.preventDefault();
			opener.style.pointerEvents = "none";

			const popup = new BX.PopupWindow(
				`review_popup_${Date.now()}`,
				null,
				{
					content: createReviewPopupContent(opener),
					closeIcon: true,
					overlay: true,
					autoHide: true,
					zIndex: 1000,
					events: {
						onPopupClose() {
							bodyLocker(false);
							opener.style.pointerEvents = "";
							this.destroy();
						},
					},
				},
			);

			animatePopup(popup, opener);
			popup.show();
		});
	});
};

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

	if (window.BX) {
		BX.ready(initReviewPopups);
	} else {
		initReviewPopups();
	}
});
