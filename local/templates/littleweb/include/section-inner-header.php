<div class="section-inner-header <?= $arParams["CLASS"] ?? '' ?>">

  <video loop autoplay muted playsinline preload="auto">
    <source src="<?= SITE_TEMPLATE_PATH . '/_dist/video/inner.mp4' ?>" type="video/mp4">
  </video>
  <div class="container">
    <div class="grid">
      <div class="grid-item">
        <h1 class="section-inner-header__title"><?= $arParams["TITLE"] ?></h1>

        <? if ($arParams["DESCRIPTION"]): ?>
          <p class="section-inner-header__description">
            <?= $arParams["DESCRIPTION"] ?>
          </p>
        <? endif; ?>

        <? if ($arParams["BTN"]) {
          $APPLICATION->IncludeFile(
            SITE_TEMPLATE_PATH . '/include/arrow-btn.php',
            array(
              'TEXT' => $arParams["BTN"]["TEXT"],
              'CLASS' => $arParams["BTN"]["CLASS"],
              'FORM_ID' => $arParams["BTN"]["FORM_ID"]
            ),
            array('MODE' => 'html', 'NAME' => 'кнопку', 'SHOW_BORDER' => false)
          );
        } ?>
      </div>
      <? if ($arParams["PICTURE"]): ?>
        <div class="grid-item">
          <img src="<?= $arParams["PICTURE"] ?>" alt="<?= $arParams["TITLE"] ?>" width="400" height="300">
        </div>
      <? endif; ?>
    </div>

  </div>
</div>