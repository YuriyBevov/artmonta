<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
if ($arResult["ITEMS"]): ?>
  <section class="section features-list">
    <div class="container">
      <h2 class="title">Преимущества работы с нами</h2>

      <ul>
        <? foreach ($arResult["ITEMS"] as $index => $arItem):
          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
          <li>
            <div class="features-list__icon">
              <svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
                <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-check'></use>
              </svg>
            </div>
            <strong><?= $arItem["NAME"] ?></strong>
            <p><?= $arItem["PREVIEW_TEXT"] ?></p>
          </li>
        <? endforeach; ?>
      </ul>
    </div>
  </section>
<? endif; ?>