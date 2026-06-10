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
import { runWhenDomReady } from "./modules/dom-ready";
import { waitForHeroVideoReady } from "./modules/hero-video-ready";
import { hideSiteLoader } from "./modules/site-loader";
import { initScrollUpBtn } from "./modules/scroll-up-btn";

import { initPortfolioPreview } from "../../components/bitrix/news.list/portfolio-preview/_src/js/index";
import { initBlogPreview } from "../../components/bitrix/news.list/blog-preview/_src/js/index";
import { initReviewsPreview } from "../../components/bitrix/news.list/reviews-preview/_src/js/index";

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
	initScrollUpBtn();

	window.dispatchEvent(new CustomEvent("site:ready"));
};

let areAnimationsInitialized = false;

const initAnimationsOnce = () => {
	if (areAnimationsInitialized) {
		return;
	}

	areAnimationsInitialized = true;
	runAnimationInitializers();
};

const bootSite = async () => {
	try {
		const headerHeightReady = initSetHeaderHeight();
		runUiInitializers();

		await headerHeightReady;
		initAnimationsOnce();
		await waitForHeroVideoReady();
		await hideSiteLoader();
	} catch (error) {
		await hideSiteLoader();
		console.error("Site initialization failed", error);
	}
};

runWhenDomReady(bootSite);
