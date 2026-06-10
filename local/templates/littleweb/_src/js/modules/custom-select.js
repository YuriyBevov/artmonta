import customSelect from "custom-select";

const initSubmitOnChange = (select) => {
	if (!select.classList.contains("portfolio-list__filter-select")) {
		return;
	}

	if (select.dataset.submitOnChangeInited) {
		return;
	}

	select.addEventListener("change", () => {
		if (select.form?.requestSubmit) {
			select.form.requestSubmit();
		} else {
			select.form?.submit();
		}
	});
	select.dataset.submitOnChangeInited = "1";
};

export function initCustomSelect() {
	const items = document.querySelectorAll(".custom-select");

	items.forEach((select) => {
		if (!select.dataset.customSelectInited) {
			customSelect(select, {});
			select.dataset.customSelectInited = "1";
		}

		initSubmitOnChange(select);
	});
}

window.initCustomSelect = initCustomSelect;
