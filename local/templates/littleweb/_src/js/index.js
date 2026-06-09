import { initSetHeaderHeight } from "./modules/setHeaderHeight";
import { initSwiperInstance } from "./modules/swiper-instance";

import { initScrollSmoother } from "./gsap/scrollSmoother";
import { initFeaturesCounter } from "./gsap/featuresCounter";
import { initMenu } from "./gsap/menu";
import { initTextSectionSplitText } from "./gsap/textSectionSplitText";
import { initSectionImageReveal } from "./gsap/sectionImageReveal";
import { initStickyFigures } from "./gsap/stickyFigures";
import { initBlogDetailPicture } from "./gsap/blogDetailPicture";
import { initPortfolioDetailPicture } from "./gsap/portfolioDetailPicture";
import { initPortfolioListBatch } from "./gsap/portfolioListBatch";
import { initReviewsPreviewBackground } from "./gsap/reviewsPreviewBackground";

import { fancyInit } from "./modules/fancybox-instance";
import { initAccordeon } from "./modules/accordeon";
import { initCrawlLineSlider } from "./modules/crawl-line-slider";
import { initBxAjaxPopup } from "./modules/bx-ajax-popup";
import { initCustomSelect } from "./modules/custom-select";
import { initTableWrapper } from "./modules/table-wrapper";
import { initBaseSlider } from "./modules/base-slider";

import { initPortfolioPreview } from "../../components/bitrix/news.list/portfolio-preview/_src/js/index";
import { initBlogPreview } from "../../components/bitrix/news.list/blog-preview/_src/js/index";
import { initReviewsPreview } from "../../components/bitrix/news.list/reviews-preview/_src/js/index";

const LOADER_HIDE_TIMEOUT = 700;

const waitForDomReady = () => {
	if (document.readyState !== "loading") {
		return Promise.resolve();
	}

	return new Promise((resolve) => {
		document.addEventListener("DOMContentLoaded", resolve, { once: true });
	});
};

const waitForWindowLoad = () => {
	if (document.readyState === "complete") {
		return Promise.resolve();
	}

	return new Promise((resolve) => {
		window.addEventListener("load", resolve, { once: true });
	});
};

const hideLoader = ({ onStart } = {}) => {
	const loader = document.querySelector("[data-site-loader]");

	if (!loader) {
		document.body.classList.remove("site-loading");
		onStart?.();
		return Promise.resolve();
	}

	return new Promise((resolve) => {
		let isResolved = false;

		const finish = () => {
			if (isResolved) {
				return;
			}

			isResolved = true;
			loader.remove();
			resolve();
		};

		loader.addEventListener("transitionend", finish, { once: true });
		window.setTimeout(finish, LOADER_HIDE_TIMEOUT);

		window.requestAnimationFrame(() => {
			document.body.classList.remove("site-loading");
			onStart?.();
			loader.classList.add("is-hidden");
		});
	});
};

const runUiInitializers = () => {
	initSwiperInstance();
	initScrollSmoother();
	initMenu();
	fancyInit();
	initAccordeon();
	initCrawlLineSlider();
	initBxAjaxPopup();
	initCustomSelect();
	initTableWrapper();
	initBaseSlider();
	initPortfolioPreview();
	initBlogPreview();
	initReviewsPreview();
};

const runAnimationInitializers = () => {
	initFeaturesCounter();
	initTextSectionSplitText();
	initSectionImageReveal();
	initStickyFigures();
	initBlogDetailPicture();
	initPortfolioDetailPicture();
	initPortfolioListBatch();
	initReviewsPreviewBackground();

	window.dispatchEvent(new CustomEvent("site:ready"));
};

const bootSite = async () => {
	let headerHeightReady = Promise.resolve(false);

	try {
		await waitForDomReady();

		headerHeightReady = initSetHeaderHeight();
		runUiInitializers();

		await waitForWindowLoad();
		await headerHeightReady;
		await hideLoader({
			onStart: runAnimationInitializers,
		});
	} catch (error) {
		await headerHeightReady;
		await hideLoader();
		console.error("Site initialization failed", error);
	}
};

bootSite();
