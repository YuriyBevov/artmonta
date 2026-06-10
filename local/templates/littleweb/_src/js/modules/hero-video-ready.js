const hasPlayableSource = (video) => {
	const sources = Array.from(video.querySelectorAll("source"));

	if (!sources.length) {
		return Boolean(video.currentSrc || video.src);
	}

	return sources.some((source) => {
		const media = source.getAttribute("media");
		return !media || window.matchMedia(media).matches;
	});
};

export const waitForHeroVideoReady = () => {
	const video = document.querySelector(".hero-section video");

	if (!video || !hasPlayableSource(video) || video.readyState >= 2) {
		return Promise.resolve();
	}

	return new Promise((resolve) => {
		const finish = () => {
			video.removeEventListener("loadeddata", finish);
			video.removeEventListener("canplay", finish);
			video.removeEventListener("error", finish);
			resolve();
		};

		video.addEventListener("loadeddata", finish, { once: true });
		video.addEventListener("canplay", finish, { once: true });
		video.addEventListener("error", finish, { once: true });
	});
};
