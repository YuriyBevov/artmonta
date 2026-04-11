<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
	<section class="section blog-preview">
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

			<div class="swiper blog-preview-slider">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem):
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
						<div class="swiper-slide">
							<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="blog-preview-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="blog-preview-card__header">
									<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . '/_dist/images/no-image.png' ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="260">
									<span class="label"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
								</div>

								<h3 class="subtitle"><?= $arItem["NAME"] ?></h3>
								<p class="text"><?= $arItem["PREVIEW_TEXT"] ?></p>

								<span class="blog-preview-card__arrow">
									Подробнее
									<svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
										<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
									</svg>
								</span>
							</a>
						</div>
					<? endforeach; ?>
				</div>

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
			</div>
		</div>
	</section>
<? endif; ?>