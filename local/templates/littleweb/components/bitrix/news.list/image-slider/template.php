<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$reviewTextLimit = 100;
?>

<? if ($arResult["ITEMS"]): ?>


	<section class="section">
		<div class="container">
			<?
			$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/section-header.php',
				array(
					'TITLE' =>  $arResult["NAME"],
					'DESCRIPTION' => $arResult["DESCRIPTION"],
					'USE_SLIDER_NAVIGATION' => true
				),
				array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
			);
			?>
		</div>

		<div class="container-fluid">
			<div class="container">
				<div class="swiper base-slider">
					<div class="swiper-wrapper">
						<? foreach ($arResult["ITEMS"] as $arItem):
							$reviewText = trim(html_entity_decode(strip_tags($arItem["PREVIEW_TEXT"]), ENT_QUOTES, SITE_CHARSET));
							$isLongReview = mb_strlen($reviewText) > $reviewTextLimit;
							$cardReviewText = $isLongReview ? mb_substr($reviewText, 0, $reviewTextLimit) . '...' : $reviewText;

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
								href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
								data-fancybox="<?= $arResult["ID"] ?>"
								id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"]) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" loading="lazy">
							</div>
							<div class="swiper-slide"
								href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
								data-fancybox="<?= $arResult["ID"] ?>"
								id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"]) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" loading="lazy">
							</div>
							<div class="swiper-slide"
								href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
								data-fancybox="<?= $arResult["ID"] ?>"
								id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"]) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" loading="lazy">
							</div>
						<? endforeach; ?>
					</div>
				</div>
			</div>
	</section>


<? endif; ?>