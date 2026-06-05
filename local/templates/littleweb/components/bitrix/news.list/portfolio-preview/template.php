<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>

	<? if (!$arParams["CONTENT_VIEW"] || $arParams["CONTENT_VIEW"] != 1): ?>
		<section class="section portfolio-preview 2">
			<div class="container">
				<?
				$APPLICATION->IncludeFile(
					SITE_TEMPLATE_PATH . '/include/section-header.php',
					array(
						'TITLE' =>  $arResult["NAME"],
						'DESCRIPTION' => $arResult["DESCRIPTION"],
					),
					array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
				);
				?>
			</div>
		<? else: ?>
			<div class="section portfolio-preview portfolio-preview--content-view">
			<? endif; ?>
			<div class="container-fluid">
				<div class="swiper">
					<div class="swiper-wrapper">
						<? foreach ($arResult["ITEMS"] as $arItem):
							// $previewPicResized = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"] ?? $arItem["DETAIL_PICTURE"]["ID"], array('width' => 420, 'height' => 260), BX_RESIZE_IMAGE_EXACT, true);

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
							<a class="swiper-slide"
								href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
								id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?? $previewPicResized['src'] ?>" alt="<?= $arItem["NAME"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"] ?? 0) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"] ?? 0) ?>">
							</a>
						<? endforeach; ?>
					</div>
				</div>
			</div>

			<? if (!$arParams["CONTENT_VIEW"] || $arParams["CONTENT_VIEW"] != 1): ?>
				<div class="container">
					<div class="portfolio-preview__footer">
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

						<? if ($arParams["NOTE"]): ?>
							<span class="portfolio-preview__note"><?= $arParams["~NOTE"] ?></span>
						<? endif; ?>

						<?
						$APPLICATION->IncludeFile(
							SITE_TEMPLATE_PATH . '/include/arrow-btn.php',
							array(
								'TEXT' => 'Посмотреть больше',
								'LINK' => '/portfolio/',
								'CLASS' => 'portfolio-preview__link'

							),
							array('MODE' => 'html', 'NAME' => 'кнопку', 'SHOW_BORDER' => false)
						);
						?>
					</div>
				</div>
		</section>
	<? else: ?>
		</div>
	<? endif; ?>

<? endif; ?>