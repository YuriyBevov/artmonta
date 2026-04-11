<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
  <section class="section features">
    <div class="container">
      <h2 class="visually-hidden"><?= $arResult["NAME"] ?></h2>


      <div class="features__grid">
        <? foreach ($arResult["ITEMS"] as $index => $arItem):
          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
          <? if ($index < 4 && $arItem["PROPERTIES"]["TITLE"]["VALUE"] && $arItem["PROPERTIES"]["DESCRIPTION"]["VALUE"]): ?>
            <div class="features__grid-item">
              <strong><?= $arItem["PROPERTIES"]["TITLE"]["VALUE"] ?>+</strong>
              <span><?= $arItem["PROPERTIES"]["DESCRIPTION"]["VALUE"] ?></span>
            </div>
          <? endif; ?>
        <? endforeach; ?>
      </div>
    </div>
  </section>
<? endif; ?>