<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["PORTFOLIO_FILTER"]["SOURCE_ITEMS_COUNT"] || $arResult["ITEMS"]): ?>
	<section class="section portfolio-list" <? ?>>
		<div class="container<?= ($arParams["IS_INNER"] ? '-fluid' : '') ?>">
			<?
			$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/section-inner-header.php',
				array(
					'BTN' => [
						'TEXT' => 'Оставить заявку',
						'CLASS' => '',
						'FORM_ID' => 1
					],
					'TITLE' => $arResult["NAME"],
					'DESCRIPTION' => $arResult["DESCRIPTION"],
					'BADGE' => [
						'STRONG' => '800+',
						'TEXT' => 'проектов'
					]
				),
				array('MODE' => 'html', 'NAME' => 'шапку страницы', 'SHOW_BORDER' => false)
			);
			?>

			<div class="container">
				<?
				$portfolioFilter = $arResult["PORTFOLIO_FILTER"];
				$portfolioFilterParams = $portfolioFilter["PARAMS"];
				$portfolioFilterSelected = $portfolioFilter["SELECTED"];
				$portfolioFilterOptions = $portfolioFilter["OPTIONS"];
				$portfolioFilterNames = array_values($portfolioFilterParams);
				?>
				<form class="sort-row portfolio-list__filter" method="get" action="<?= $APPLICATION->GetCurPage(false) ?>">
					<? foreach ($_GET as $key => $value):
						if (in_array($key, $portfolioFilterNames, true) || is_array($value)) {
							continue;
						}
					?>
						<input type="hidden" name="<?= htmlspecialcharsbx($key) ?>" value="<?= htmlspecialcharsbx($value) ?>">
					<? endforeach; ?>

					<select class="custom-select portfolio-list__filter-select" name="<?= htmlspecialcharsbx($portfolioFilterParams["TYPE"]) ?>" onchange="this.form.submit()">
						<option value="">Все типы</option>
						<? foreach ($portfolioFilterOptions["TYPE"] as $option): ?>
							<option value="<?= htmlspecialcharsbx($option) ?>" <?= ($portfolioFilterSelected["TYPE"] === $option ? 'selected' : '') ?>>
								<?= htmlspecialcharsbx($option) ?>
							</option>
						<? endforeach; ?>
					</select>

					<select class="custom-select portfolio-list__filter-select" name="<?= htmlspecialcharsbx($portfolioFilterParams["CAT"]) ?>" onchange="this.form.submit()">
						<option value="">Все категории</option>
						<? foreach ($portfolioFilterOptions["CAT"] as $option): ?>
							<option value="<?= htmlspecialcharsbx($option) ?>" <?= ($portfolioFilterSelected["CAT"] === $option ? 'selected' : '') ?>>
								<?= htmlspecialcharsbx($option) ?>
							</option>
						<? endforeach; ?>
					</select>

					<select class="custom-select portfolio-list__filter-select" name="<?= htmlspecialcharsbx($portfolioFilterParams["YEAR"]) ?>" onchange="this.form.submit()">
						<option value="">Все&nbsp;года</option>
						<? foreach ($portfolioFilterOptions["YEAR"] as $option): ?>
							<option value="<?= htmlspecialcharsbx($option) ?>" <?= ($portfolioFilterSelected["YEAR"] === $option ? 'selected' : '') ?>>
								<?= htmlspecialcharsbx($option) ?>
							</option>
						<? endforeach; ?>
					</select>

					<noscript>
						<button type="submit">Показать</button>
					</noscript>
				</form>

				<? if ($arResult["ITEMS"]): ?>
					<div class="gallery">
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
							<a class="gallery__item" href="<?= $arItem["DETAIL_PAGE_URL"] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="gallery__item-wrapper">
									<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"]) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" loading="lazy">
								</div>
							</a>
						<? endforeach; ?>
					</div>
				<? else: ?>
					<div class="portfolio-list__empty">Проекты по выбранным параметрам не найдены.</div>
				<? endif; ?>
			</div>
		</div>
	</section>
<? endif; ?>
