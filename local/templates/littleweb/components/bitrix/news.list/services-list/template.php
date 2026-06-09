<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>


<? if ($arResult["ITEMS"]): ?>
	<section class="section services-list test">
		<div class="container<?= ($arParams["IS_INNER"] ? '-fluid' : '') ?>">

			<? if (!$arParams["IS_INNER"]) {
				if ($arParams["LINKED_SERVICES"] !== "Y") {
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
						SITE_TEMPLATE_PATH . '/include/section-header.php',
						array(
							'TITLE' =>  'Другие услуги'
						),
						array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
					);
				}
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

			<div class="grid<?= ($arParams["IS_INNER"] ? ' container' : '') ?>">
				<? foreach ($arResult["ITEMS"] as $arItem):
					$this->AddEditAction(
						$arItem['ID'],
						$arItem['EDIT_LINK'],
						CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
					);
					$this->AddDeleteAction(
						$arItem['ID'],
						$arItem['DELETE_LINK'],
						CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
						["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]
					);
				?>
					<div class="services-list-card-container">
						<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="services-list-card<?= ($arParams["LINKED_SERVICES"] === "Y") ? ' services-list-card--linked' : '' ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<? if ($arItem["PREVIEW_PICTURE"]["SRC"]): ?>
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="Иконка" width="50" height="50">
							<? endif; ?>
							<span class="subtitle"><?= $arItem["NAME"] ?></span>
							<? if ($arParams["LINKED_SERVICES"] !== "Y"): ?>
								<p><?= $arItem["PREVIEW_TEXT"] ?></p>
							<? endif; ?>
							<div class="services-list-card__icon">
								<svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
									<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
								</svg>
							</div>
						</a>
					</div>
				<? endforeach; ?>
			</div>

		</div>
	</section>
<? endif; ?>