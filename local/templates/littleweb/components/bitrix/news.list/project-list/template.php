<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
  <section class="section projects">
    <div class="container<?= ($arParams["IS_INNER"] ? '-fluid --inner-grid' : ' --front-grid') ?>">
      <? if (!$arParams["IS_INNER"]) {
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/section-header.php',
          array(
            'TITLE' =>  $arResult["NAME"],
            'DESCRIPTION' => $arResult["DESCRIPTION"],
          ),
          array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
        );
      } else {
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/section-inner-header.php',
          array(
            'BTN' => [
              'TEXT' => 'Оставить заявку',
              'CLASS' => '',
              'FORM_ID' => 1
            ],
            'CLASS' => $arParams["SECTION_HEADER_CLS"],
            'TITLE' => $arResult["NAME"],
            'DESCRIPTION' => $arResult["DESCRIPTION"]
          ),
          array('MODE' => 'html', 'NAME' => 'шапку страницы', 'SHOW_BORDER' => false)
        );
      }
      ?>

      <div class="projects__list-wrapper">
        <ul class="projects__list">
          <? foreach ($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          ?>
            <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
              <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="iconed-link">
                <span class="subtitle"><?= $arItem["NAME"] ?></span>
              </a>
            </li>
          <? endforeach; ?>
        </ul>
      </div>
    </div>
  </section>
<? endif; ?>