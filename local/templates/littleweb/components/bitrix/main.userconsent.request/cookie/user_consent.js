(function () {
	var BANNER_SHOW_DELAY = 1000;

	var getCookie = function (name) {
		var matches = document.cookie.match(
			new RegExp(
				"(?:^|; )" +
					name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
					"=([^;]*)",
			),
		);

		return matches ? decodeURIComponent(matches[1]) : null;
	};

	var setCookie = function (name, value, days) {
		var date = new Date();
		date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);

		document.cookie =
			name +
			"=" +
			encodeURIComponent(value) +
			"; expires=" +
			date.toUTCString() +
			"; path=/; SameSite=Lax";
	};

	var hideBanner = function (banner) {
		banner.classList.remove("is-visible");
		banner.style.display = "none";
	};

	var showBanner = function (banner) {
		banner.style.display = "";
		banner.classList.add("is-visible");
	};

	var initBanner = function (banner) {
		var cookieName = banner.getAttribute("data-cookie-consent-name");
		var acceptButton = banner.querySelector("[data-cookie-consent-accept]");
		var controlNode = banner.querySelector("[data-bx-user-consent]");
		var inputNode = banner.querySelector('input[type="checkbox"]');
		var config;

		if (
			!cookieName ||
			!acceptButton ||
			!controlNode ||
			!inputNode ||
			!BX.ajax
		) {
			return;
		}

		if (getCookie(cookieName) === "Y") {
			hideBanner(banner);
			return;
		}

		try {
			config = JSON.parse(controlNode.getAttribute("data-bx-user-consent"));
		} catch (e) {
			return;
		}

		showBanner(banner);

		BX.bind(acceptButton, "click", function () {
			var data = {
				action: "saveConsent",
				sessid: BX.bitrix_sessid(),
				id: config.id,
				sec: config.sec,
				url: window.location.href,
			};

			if (config.originatorId) {
				data.originatorId = config.originatorId;
			}

			inputNode.checked = true;
			acceptButton.disabled = true;

			BX.ajax({
				url: config.actionUrl,
				method: "POST",
				data: data,
				timeout: 10,
				dataType: "json",
				processData: true,
				onsuccess: function (response) {
					response = response || {};
					if (response.error) {
						inputNode.checked = false;
						acceptButton.disabled = false;
						console.error("Не удалось сохранить согласие. Попробуйте еще раз.");
						return;
					}

					setCookie(cookieName, "Y", 365);
					hideBanner(banner);
				},
				onfailure: function () {
					inputNode.checked = false;
					acceptButton.disabled = false;
					console.error("Не удалось сохранить согласие. Попробуйте еще раз.");
				},
			});
		});
	};

	var initBanners = function () {
		var banners = document.querySelectorAll("[data-cookie-consent-banner]");

		for (var i = 0; i < banners.length; i++) {
			initBanner(banners[i]);
		}
	};

	var scheduleInit = function () {
		window.setTimeout(initBanners, BANNER_SHOW_DELAY);
	};

	if (document.readyState === "complete") {
		scheduleInit();
	} else {
		window.addEventListener("load", scheduleInit, { once: true });
	}
})();
