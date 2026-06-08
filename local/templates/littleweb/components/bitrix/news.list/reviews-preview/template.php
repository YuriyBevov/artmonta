<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$reviewTextLimit = 100;
?>

<? if ($arResult["ITEMS"]): ?>


	<section class="section reviews-preview">
		<div class="reviews-preview__bg" aria-hidden="true">
			<img src="<?= SITE_TEMPLATE_PATH ?>/_dist/images/reviews-bg.png" alt="" loading="lazy">
		</div>

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
				<div class="swiper">
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
							<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="review-card">
									<div class="review-card__header">
										<div class="review-card__user-avatar">
											<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?? SITE_TEMPLATE_PATH . '/_dist/images/user-empty-avatar.svg' ?>" alt="<?= $arItem["NAME"] ?>" width="40" height="40">
										</div>
										<span><?= $arItem["NAME"] ?></span>
										<div class="review-card__rate">
											<? for ($i = 0; $i < $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i++): ?>
												<svg class="review-card__rate-item  review-card__rate-item--filled" width="16" height="16" role="img" aria-hidden="true" focusable="false">
													<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
												</svg>
											<? endfor; ?>
											<? for ($i = $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i < 5; $i++): ?>
												<svg class="review-card__rate-item" width="16" height="16" role="img" aria-hidden="true" focusable="false">
													<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
												</svg>
											<? endfor; ?>
										</div>
									</div>
									<div class="review-card__content">
										<small><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
										<span><?= htmlspecialcharsbx($cardReviewText) ?></span>
									</div>

									<? if ($isLongReview): ?>
										<button
											class="review-card__expander"
											type="button"
											data-review-popup
											data-review-text="<?= htmlspecialcharsbx($reviewText) ?>">
											<span>Читать</span>
										</button>
									<? endif; ?>
								</div>
							</div>
						<? endforeach; ?>
					</div>
				</div>
			</div>
	</section>


<? endif; ?>