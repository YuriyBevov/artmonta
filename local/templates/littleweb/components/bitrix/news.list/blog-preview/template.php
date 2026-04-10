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
		</div>

		<ul>
			<? foreach ($arResult["ITEMS"] as $arItem): ?>
				<li>
					<article class="blog-preview-card">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="260">
						<div class="label"><?= $arItem["DATE_ACTIVE_FROM"] ?></div>
						<h3 class="subtitle"><?= $arItem["NAME"] ?></h3>
						<p><?= $arItem["PREVIEW_TEXT"] ?></p>

						<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
							Подробнее
						</a>
					</article>
				</li>
			<? endforeach; ?>
		</ul>
	</section>
<? endif; ?>