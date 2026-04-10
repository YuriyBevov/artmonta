<section class="section pricelist-download">
  <div class="container">
    <?
    $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . '/include/section-header.php',
      array(
        'TITLE' =>  'Цены на выставочные стенды',
      ),
      array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
    );
    ?>

    <div class="pricelist-download__grid">
      <div class="pricelist-download__grid-item">
        <?
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/pricelist-download/image.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'контентное изображение блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>

      <div class="pricelist-download__grid-item content">
        <?
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/pricelist-download/content.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'контент блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>
    </div>

    <?
    $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . '/include/pricelist-download/download-btn.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'файл для скачивания', 'SHOW_BORDER' => true)
    );
    ?>

  </div>
</section>