<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
	<section class="section portfolio-preview">
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

		<div class="container-fluid">
			<div class="swiper">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem):
						$previewPicResized = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"] ?? $arItem["DETAIL_PICTURE"]["ID"], array('width' => 420, 'height' => 260), BX_RESIZE_IMAGE_EXACT, true);

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
						<div class="swiper-slide"
							href="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?? $previewPicResized['src'] ?>"
							data-fancybox="portfolio"
							data-caption="<?= $arItem["DETAIL_TEXT"] !== '' ? $arItem["DETAIL_TEXT"] : $arItem["NAME"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $previewPicResized['src'] ?>" alt="<?= $arItem["NAME"] ?>" width="420" height="260">
							<span><?= $arItem["NAME"] ?></span>
						</div>
					<? endforeach; ?>
				</div>
			</div>
		</div>

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
<? endif; ?>