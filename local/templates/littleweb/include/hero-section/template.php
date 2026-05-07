<section class="hero-section">
  <div class="container">

    <video loop="" autoplay="" playsinline="" preload="auto" poster="<?= SITE_TEMPLATE_PATH . '/_dist/images/poster-desktop-2.jpg' ?>">
      <source src="<?= SITE_TEMPLATE_PATH . '/_dist/video/desktop-1.mp4' ?>" type="video/mp4">
    </video>

    <div class="hero-section-fh-wrapper">
      <div class="hero-section__title">
        <h1>Выставочная <span>компания</span> <small>с собственным производством</small></h1>
        <a href="#">
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
    <?/*
    <div class="hero-section__content">
      <div class="hero-section__content-item hero-section__content-item--text">
        <?
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/hero-section/description.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'текст главного блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>

      <div class="hero-section__content-item">
        <?
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/hero-section/image.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'контентное изображение главного блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>

      */ ?>
  </div>
  </div>
</section>