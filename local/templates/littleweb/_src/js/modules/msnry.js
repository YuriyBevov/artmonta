import Masonry from "masonry-layout";
// import imagesLoaded from "imagesloaded";
// import { setTags } from "./tags.js";

const layout = document.querySelector(".masonry");

if (layout) {
	document.addEventListener("DOMContentLoaded", () => {
		setTimeout(() => {
			new Masonry(layout, {
				itemSelector: ".masonry-item",
				columnWidth: ".masonry-sizer",
				gutter: ".gutter-sizer",
				percentPosition: true,
			});
		}, 3000);
	});
}
