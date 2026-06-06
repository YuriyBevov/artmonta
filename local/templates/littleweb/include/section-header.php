<div class="section-header">
  <? if ($arParams["DESCRIPTION"] && $arParams["DESCRIPTION"] !== ""): ?>
    <div class="grid">
      <div class="grid-item">
        <h2 class="title"><?= $arParams["TITLE"] ?></h2>
      </div>
      <div class="grid-item">
        <p><?= $arParams["DESCRIPTION"] ?></p>
      </div>
    </div>
  <? else: ?>
    <h2 class="title"><?= $arParams["TITLE"] ?></h2>
  <? endif; ?>

  <? if (!!$arParams["USE_SLIDER_NAVIGATION"]): ?>
    <div class="swiper-navigation">
      <button class="swiper-button swiper-button--prev" aria-label="Назад">
        <svg width='72' height='24' role='img' aria-hidden='true' focusable='false'>
          <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#long-arrow'></use>
        </svg>
      </button>
      <button class="swiper-button swiper-button--next" aria-label="Вперед">
        <svg width='72' height='24' role='img' aria-hidden='true' focusable='false'>
          <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#long-arrow'></use>
        </svg>
      </button>
    </div>
  <? endif; ?>
</div>