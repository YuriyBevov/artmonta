<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
	<section class="section services-preview">
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

			<div class="grid">
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
					<div class="services-preview-card-container">
						<a href="<?= $arItem["DETAIL_LINK_URL"] ?>" class="services-preview-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<? if ($arItem["PREVIEW_PICTURE"]["SRC"]): ?>
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="Иконка" width="50" height="50">
							<? endif; ?>
							<h3 class="subtitle"><?= $arItem["NAME"] ?></h3>
							<p><?= $arItem["PREVIEW_TEXT"] ?></p>

							<div class="services-preview-card__icon">
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