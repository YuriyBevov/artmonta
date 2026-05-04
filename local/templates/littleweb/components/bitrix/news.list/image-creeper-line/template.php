<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if ($arResult["ITEMS"]): ?>
  <section class="section crawl-line">

    <div class="container">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/section-header.php',
        array(
          'TITLE' => $arResult["NAME"],
          'DESCRIPTION' => $arResult["DESCRIPTION"],
          'SHOW_SLIDER_NAVIGATION_BLOCK' => $arParams["USE_SLIDER"] ?? 'N'
        ),
        array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
      );
      ?>
    </div>

    <div class="container">
      <div class="swiper crawl-line-slider">
        <div class="swiper-wrapper">
          <? foreach ($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

          ?>
            <div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
              <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>">
            </div>
          <? endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<? endif; ?>