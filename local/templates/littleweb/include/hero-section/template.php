<section class="hero-section">
  <div class="container">
    <div class="hero-section__title">
      <h1>Выставочная <span>компания</span> <small>с собственным производством</small></h1>
      <a href="#">
        <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
          <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
        </svg>
        <span>Посмотреть портфолио</span>
      </a>
    </div>

    <!-- <button class="hero-section__btn arrow-btn">
      <span class="arrow-btn__text">Оставить заявку</span>
      <span class="arrow-btn__icon">
        <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
          <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#arrow'></use>
        </svg>
      </span>
    </button> -->

    <?
    $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . '/include/arrow-btn.php',
      array(
        'TEXT' => 'Оставить заявку',
        'CLASS' => 'hero-section__btn'
      ),
      array('MODE' => 'html', 'NAME' => 'кнопку', 'SHOW_BORDER' => false)
    );
    ?>

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
    </div>
  </div>
</section>