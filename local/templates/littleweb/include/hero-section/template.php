<section class="hero-section">
  <div class="container">

    <video loop autoplay muted playsinline preload="auto">
      <source src="<?= SITE_TEMPLATE_PATH . '/_dist/video/hero-video.webm' ?>" type="video/webm">
      <source src="<?= SITE_TEMPLATE_PATH . '/_dist/video/hero-video.mp4' ?>" type="video/mp4">
    </video>

    <div class="hero-section-fh-wrapper">
      <div class="hero-section__title">
        <h1>Выставочная <span>компания</span> <small>с собственным производством</small></h1>
        <a href="/portfolio/">
          <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
            <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
          </svg>
          <span>Посмотреть портфолио</span>
        </a>
      </div>

      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/arrow-btn.php',
        array(
          'TEXT' => 'Оставить заявку',
          'CLASS' => 'hero-section__btn',
          'FORM_ID' => 1
        ),
        array('MODE' => 'html', 'NAME' => 'кнопку', 'SHOW_BORDER' => false)
      );
      ?>
    </div>
  </div>
</section>