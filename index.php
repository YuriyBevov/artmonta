<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");
?>

<section class="hero">
  <div class="container">
    <div class="hero__title">
      <h1>Выставочная <span>компания</span> <small>с собственным производством</small></h1>
      <a href="#">
        <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
          <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
        </svg>
        <span>Посмотреть портфолио</span>
      </a>
    </div>

    <button class="hero__btn arrow-btn">
      <span class="arrow-btn__text">Оставить заявку</span>
      <span class="arrow-btn__icon">
        <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
          <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
        </svg>
      </span>
    </button>

    <div class="hero__content">
      <div class="hero__content-item">
        <?
        $APPLICATION->IncludeFile(
          SITE_DIR . 'include/hero-section/description.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'текст главного блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>

      <div class="hero__content-item">
        <?
        $APPLICATION->IncludeFile(
          SITE_DIR . 'include/hero-section/image.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'контентное изображение главного блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>
    </div>
  </div>
</section>

<div class="" style="margin-top:300px;">1</div>
<div class="" style="margin-top:300px;">1</div>
<div class="" style="margin-top:300px;" data-speed="3">3</div>
<div class="" style="margin-top:300px;" data-lag=".4">4</div>
<div class="" style="margin-top:300px;">1</div>
<div class="" style="margin-top:300px;">1</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>