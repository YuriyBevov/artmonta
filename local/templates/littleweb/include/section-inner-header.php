<div class="section-inner-header <?= $arParams["CLASS"] ?? '' ?>">
  <div class="container">
    <div class="grid">

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

  </div>
</div>