document.addEventListener("DOMContentLoaded", () => {
	const accordeons = document.querySelectorAll(".accordeon");

	if (accordeons) {
		accordeons.forEach((accordeon) => {
			const items = accordeon.querySelectorAll(".accordeon-header");

			if (accordeon.classList.contains("--first-item-expanded")) {
				accordeon
					.querySelector(".accordeon-item:first-child")
					.classList.add("expanded");
			}

			const onClickHandler = (evt) => {
				if (evt.currentTarget.parentNode.classList.contains("expanded")) return;

				items.forEach((item) => {
					item.parentNode.classList.contains("expanded")
						? item.parentNode.classList.remove("expanded")
						: null;
				});

				evt.currentTarget.parentNode.classList.add("expanded");
			};

			items.forEach((item) => {
				item.addEventListener("click", onClickHandler);
			});
		});
	}
});
