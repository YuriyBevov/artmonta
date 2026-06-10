<div class="section-inner-header <?= $arParams["CLASS"] ?? '' ?>">
  <video loop autoplay muted playsinline preload="auto">
    <source src="<?= SITE_TEMPLATE_PATH . '/_dist/video/inner.webm' ?>" type="video/webm">
    <source src="<?= SITE_TEMPLATE_PATH . '/_dist/video/inner.mp4' ?>" type="video/mp4">
  </video>

  <div class="container">
    <div class="section-inner-header__wrapper">
      <h1 class="section-inner-header__title"><?= $arParams["TITLE"] ?></h1>

      <? if ($arParams["DESCRIPTION"] && !empty($arParams["DESCRIPTION"])): ?>
        <?= $arParams["DESCRIPTION"] ?>
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

      <? if ($arParams["BADGE"]): ?>
        <div class="circle-badge">
          <strong><?= $arParams["BADGE"]["STRONG"] ?></strong>
          <span><?= $arParams["BADGE"]["TEXT"] ?></span>
        </div>
      <? endif; ?>
    </div>


  </div>
</div>
