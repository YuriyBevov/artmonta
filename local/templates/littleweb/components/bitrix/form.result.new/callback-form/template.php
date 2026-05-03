<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<section class="section">
	<div class="container">

		<div class="callback-form">
			<?= $arResult["FORM_HEADER"] ?>

			<? if ($arResult["FORM_NOTE"]): ?>
				<div class="callback-form__note">
					<span class="title">Заявка отправлена успешно!</span>
					<p>Спасибо, мы скоро свяжемся с Вами!</p>
				</div>
			<? else: ?>

				<div class="callback-form__section">
					<span class="title"><?= $arResult["FORM_TITLE"] ?></span>
					<span class="text"><?= $arResult["FORM_DESCRIPTION"] ?></span>
				</div>

				<div class="callback-form__section">
					<div class="callback-form__content">
						<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
							<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "text"): ?>
								<div class="main-input-wrapper <?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? 'invalid-fld' : '') ?>">
									<label>
										<?= $arQuestion["HTML_CODE"] ?>
									</label>
								</div>
							<? endif; ?>
							<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "checkbox"): ?>
								<div class="main-checkbox-wrapper <?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? 'invalid-fld' : '') ?>">
									<input type="checkbox" id="<?= $arQuestion["STRUCTURE"][0]["ID"] . ($arParams["IS_MODAL"] ? '_modal' : null) ?>" name="form_checkbox_<?= $FIELD_SID ?>[]" value="<?= $arQuestion["STRUCTURE"][0]["ID"] ?>">
									<label class="main-checkbox" for="<?= $arQuestion["STRUCTURE"][0]["ID"] . ($arParams["IS_MODAL"] ? '_modal' : null) ?>">
										<span><?= $arQuestion["CAPTION"] ?><?= ($arQuestion["REQUIRED"] == "Y" ? '*' : '') ?></span>
									</label>
								</div>
							<? endif; ?>

							<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "textarea"): ?>
								<div class="main-textarea-wrapper <?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? 'invalid-fld' : '') ?>">
									<label>
										<?= $arQuestion["HTML_CODE"] ?>
									</label>
								</div>
							<? endif; ?>
							<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "hidden"): ?>
								<?= $arQuestion["HTML_CODE"] ?>
							<? endif; ?>
						<? endforeach; ?>
					</div>

					<? if ($arResult["isUseCaptcha"] == "Y"): ?>
						<div class="captcha-block-container">
							<input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" />

							<div class="captcha-block <?= ($arResult["FORM_ERRORS"][0] ? 'invalid-fld' : '') ?>">
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" width="180" height="40" alt="" />
								<input type="text" placeholder="Введите символы" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
							</div>
						</div>
					<? endif; ?>

					<input class="main-btn"
						<?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?>
						type="submit" name="web_form_submit"
						value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? 'Отправить' : $arResult["arForm"]["BUTTON"]); ?>" />
				</div>
			<? endif; ?>
			<?= $arResult["FORM_FOOTER"] ?>
		</div>
	</div>
</section>

<? if ($_REQUEST['AJAX_CALL'] == 'Y'): ?>
	<script src="https://unpkg.com/imask"></script>
	<script>
		// BX.UserConsent.loadFromForms();
		var fields = document.querySelectorAll('[data-type="tel"]');
		var options = {
			mask: '+{7}(000) 000-00-00'
		};

		fields.forEach(field => {
			IMask(field, options);
		});
	</script>
<? endif; ?>