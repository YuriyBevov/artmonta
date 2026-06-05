<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section class="section portfolio-detail" <?/*= $USER->isAdmin() ? 'style="margin-top:200px;"' : '' */ ?>>
	<div class="container<?= ($arParams["IS_INNER"] ? '-fluid' : '') ?>">
		<?
		$APPLICATION->IncludeFile(
			SITE_TEMPLATE_PATH . '/include/section-inner-header.php',
			array(
				'TITLE' => $arResult["NAME"],
				'DESCRIPTION' => $arResult["PREVIEW_TEXT"] ?? '',

			),
			array('MODE' => 'html', 'NAME' => 'шапку страницы', 'SHOW_BORDER' => false)
		);
		?>

		<div class="detail-picture">
			<img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?>" width="1920" height="640">
		</div>

		<div class="container">
			<div class="prop-list">
				<? if ($arResult["ACTIVE_FROM"]): ?>
					<div class="prop-list-item">
						<strong>Год:</strong>
						<span><?= FormatDate('Y', MakeTimeStamp($arResult["ACTIVE_FROM"])) ?></span>
					</div>
				<? endif; ?>
				<? if ($arResult["PROPERTIES"]["EVENT"]["VALUE"]): ?>
					<div class="prop-list-item">
						<strong><?= $arResult["PROPERTIES"]["EVENT"]["NAME"] ?>:</strong>
						<span><?= $arResult["PROPERTIES"]["TYPE"]["VALUE"] ?></span>
					</div>
				<? endif; ?>



				<? if ($arResult["PROPERTIES"]["TECH"]["VALUE"]): ?>
					<div class="prop-list-item">
						<strong><?= $arResult["PROPERTIES"]["TECH"]["NAME"] ?>:</strong>
						<ul>
							<? foreach ($arResult["PROPERTIES"]["TECH"]["VALUE"] as $tech): ?>
								<li><span><?= $tech ?></span></li>
							<? endforeach; ?>
						</ul>
					</div>
				<? endif; ?>

				<? if ($arResult["PROPERTIES"]["TYPE"]["VALUE"]): ?>
					<div class="prop-list-item">
						<strong><?= $arResult["PROPERTIES"]["TYPE"]["NAME"] ?>:</strong>
						<span><?= $arResult["PROPERTIES"]["TYPE"]["VALUE"] ?></span>
					</div>
				<? endif; ?>

			</div>

			<div class="content">
				<?= $arResult["DETAIL_TEXT"] ?>
			</div>

			<? $APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/arrow-btn.php',
				array(
					'TEXT' => 'Оставить заявку',
					'CLASS' => 'portfolio-detail-offer-btn',
					'FORM_ID' => '1'
				),
				array('MODE' => 'html', 'NAME' => 'кнопку', 'SHOW_BORDER' => false)
			); ?>

			<? if ($arResult["PROPERTIES"]["GALLERY"]["VALUE"]): ?>
				<div class="gallery">
					<? foreach ((array) $arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $galleryImageId):
						$galleryImage = CFile::GetFileArray($galleryImageId);
						if (!$galleryImage) {
							continue;
						}
					?>
						<div class="gallery__item">
							<div class="gallery__item-wrapper"
								href="<?= $galleryImage["SRC"] ?>"
								data-fancybox="<?= $arResult["ID"] ?>">
								<img src="<?= $galleryImage["SRC"] ?>" width="<?= intval($galleryImage["WIDTH"]) ?>" height="<?= intval($galleryImage["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" loading="lazy">
							</div>


						</div>
					<? endforeach; ?>
				</div>
			<? endif; ?>

			<? $APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/arrow-btn.php',
				array(
					'LINK' => '/portfolio/',
					'CLASS' => 'portfolio-detail-back-btn',
					'TEXT' => 'Cмотреть все проекты',
				),
				array('MODE' => 'html', 'NAME' => 'кнопку', 'SHOW_BORDER' => false)
			); ?>


		</div>
	</div>
</section>