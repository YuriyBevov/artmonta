<? if ($arParams["LINK"] && $arParams["LINK"] !== ''): ?>
  <a href="<?= $arParams["LINK"] ?>" class="arrow-btn <?= $arParams["CLASS"] ?? '' ?>">
  <? else: ?>
    <button type="button" class="arrow-btn <?= $arParams["CLASS"] ?? '' ?>">
    <? endif; ?>
    <span class="arrow-btn__text"><?= $arParams["TEXT"] ?: 'Подробнее' ?></span>
    <span class="arrow-btn__icon">
      <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
        <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
      </svg>
    </span>
    <? if ($arParams["LINK"] && $arParams["LINK"] !== ''): ?>
  </a>
<? else: ?>
  </button>
<? endif; ?>