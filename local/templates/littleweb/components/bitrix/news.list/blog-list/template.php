<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
	<section class="section">
		<div class="container<?= ($arParams["IS_INNER"] ? '-fluid' : '') ?>">
			<?
			$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/section-inner-header.php',
				array(
					'TITLE' => $arResult["NAME"],
					'DESCRIPTION' => $arResult["DESCRIPTION"]
				),
				array('MODE' => 'html', 'NAME' => 'шапку страницы', 'SHOW_BORDER' => false)
			);
			?>

			<div class="blog-list">
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
					<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
					</a>
				<? endforeach; ?>
			</div>
		</div>
	</section>
<? endif; ?>