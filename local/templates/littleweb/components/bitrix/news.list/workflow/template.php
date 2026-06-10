<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
  <section class="section workflow">
    <noindex>
      <picture>
        <source srcset="<?= SITE_TEMPLATE_PATH . '/_dist/images/left-sticky-img-424.webp' ?> 424w, <?= SITE_TEMPLATE_PATH . '/_dist/images/left-sticky-img-640.webp' ?> 640w, <?= SITE_TEMPLATE_PATH . '/_dist/images/left-sticky-img.webp' ?> 847w" sizes="(max-width: 767px) 412px, 50vw" type="image/webp">
        <img class="sticky-img sticky-img--left" src="<?= SITE_TEMPLATE_PATH . '/_dist/images/left-sticky-img-640.png' ?>" srcset="<?= SITE_TEMPLATE_PATH . '/_dist/images/left-sticky-img-424.png' ?> 424w, <?= SITE_TEMPLATE_PATH . '/_dist/images/left-sticky-img-640.png' ?> 640w, <?= SITE_TEMPLATE_PATH . '/_dist/images/left-sticky-img.png' ?> 847w" sizes="(max-width: 767px) 412px, 50vw" alt="" width="640" height="640">
      </picture>
    </noindex>
    <div class="container">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/section-header.php',
        array(
          'TITLE' => $arResult["NAME"],
          'DESCRIPTION' => $arResult["DESCRIPTION"],
        ),
        array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
      );
      ?>

      <ul class="workflow__list">
        <? foreach ($arResult["ITEMS"] as $index => $arItem):
          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

          $numbers = str_split($index + 1);
        ?>

          <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="outlined-icon">
              <? foreach ($numbers as $number): ?>
                <? if (count($numbers) === 1): ?>
                  <?= $arResult["SVG_NUMBERS"][0] . $arResult["SVG_NUMBERS"][$number]; ?>
                <? else: ?>
                  <?= $arResult["SVG_NUMBERS"][$number] ?>
                <? endif; ?>
              <? endforeach; ?>
            </div>
            <span class="subtitle"><?= $arItem["NAME"] ?></span>
          </li>
        <? endforeach; ?>
      </ul>

    </div>
  </section>
<? endif; ?>
