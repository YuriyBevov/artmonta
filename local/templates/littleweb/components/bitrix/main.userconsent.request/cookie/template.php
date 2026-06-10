<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();




$cookieName = 'ARTMONTA_COOKIE_CONSENT_' . (int)$arParams['ID'];

if (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] === 'Y') {
	return;
}

$config = \Bitrix\Main\Web\Json::encode($arResult['CONFIG']);
?>

<? CUtil::InitJSCore(array('ajax')); ?>
<style>
	.main-user-consent-cookie {
		position: fixed;

		bottom: 24px;
		left: var(--container-offset);
		z-index: 10000;
		display: none;
		flex-direction: column;

		gap: 24px;
		width: calc(100% - var(--container-offset)* 2);
		max-width: 640px;
		padding: 24px 18px;
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
		box-sizing: border-box;

		background-color: rgba(83, 44, 249, 0.1);
		border: 1px solid var(--primary);
		backdrop-filter: blur(15px);
		border-radius: 20px;
	}

	.main-user-consent-cookie.is-visible {
		display: flex;
	}

	.main-user-consent-cookie-control {
		display: none;
	}

	.main-user-consent-cookie-text {
		color: var(--white);
		font-size: 16px;
		line-height: 1.45;
	}

	.main-user-consent-cookie-text a {
		color: var(--white);
		text-decoration: underline;
	}

	.main-user-consent-button {
		display: flex;
		align-items: center;
		justify-content: center;

		padding: 12px 24px;
		border: 1px solid var(--white);
		background-color: var(--primary);
		color: var(--white);
		border-radius: 12px;

		span {
			font-size: 16px;
			font-weight: 600;
		}
	}
</style>

<div class="main-user-consent-cookie" data-cookie-consent-banner data-cookie-consent-name="<?= htmlspecialcharsbx($cookieName) ?>">
	<label data-bx-user-consent="<?= htmlspecialcharsbx($config) ?>" class="main-user-consent-cookie-control">
		<input type="checkbox" value="Y" <?= ($arParams['IS_CHECKED'] ? 'checked' : '') ?> name="<?= htmlspecialcharsbx($arParams['INPUT_NAME']) ?>">
	</label>

	<div class="main-user-consent-cookie-text">
		Мы используем cookies, чтобы сайт работал корректно, а также для аналитики и улучшения сервиса.
		Продолжая пользоваться сайтом, вы соглашаетесь с <a href="/privacy/" target="_blank">политикой конфиденциальности</a>.
	</div>

	<button type="button" class="main-user-consent-button" data-cookie-consent-accept>
		<span>Принять</span>
	</button>
</div>

<script>
	(function() {
		if (!window.BX) {
			return;
		}

		var BANNER_SHOW_DELAY = 1000;

		var getCookie = function(name) {
			var matches = document.cookie.match(
				new RegExp(
					"(?:^|; )" +
					name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
					"=([^;]*)"
				)
			);

			return matches ? decodeURIComponent(matches[1]) : null;
		};

		var setCookie = function(name, value, days) {
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

		var hideBanner = function(banner) {
			banner.classList.remove("is-visible");
			banner.style.display = "none";
		};

		var showBanner = function(banner) {
			banner.style.display = "";
			banner.classList.add("is-visible");
		};

		var initBanner = function(banner) {
			var cookieName = banner.getAttribute("data-cookie-consent-name");
			var acceptButton = banner.querySelector("[data-cookie-consent-accept]");
			var controlNode = banner.querySelector("[data-bx-user-consent]");
			var inputNode = banner.querySelector('input[type="checkbox"]');
			var config;

			if (!cookieName || !acceptButton || !controlNode || !inputNode || !BX.ajax) {
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

			BX.bind(acceptButton, "click", function() {
				var data = {
					action: "saveConsent",
					sessid: BX.bitrix_sessid(),
					id: config.id,
					sec: config.sec,
					url: window.location.href
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
					onsuccess: function(response) {
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
					onfailure: function() {
						inputNode.checked = false;
						acceptButton.disabled = false;
						console.error("Не удалось сохранить согласие. Попробуйте еще раз.");
					}
				});
			});
		};

		var initBanners = function() {
			var banners = document.querySelectorAll("[data-cookie-consent-banner]");

			for (var i = 0; i < banners.length; i++) {
				initBanner(banners[i]);
			}
		};

		var scheduleInit = function() {
			window.setTimeout(initBanners, BANNER_SHOW_DELAY);
		};

		if (document.readyState === "complete") {
			scheduleInit();
		} else {
			window.addEventListener("load", scheduleInit, {
				once: true
			});
		}
	})();
</script>