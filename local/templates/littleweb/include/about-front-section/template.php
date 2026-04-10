<section class="section about-front-section">
  <div class="container">

    <div class="about-front-section__header-wrapper">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/section-header.php',
        array(
          'TITLE' =>  'ArtMonta — компания застройки стендов',
          'FILE_PATH' => '/include/about-section/image.php'
        ),
        array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
      );
      ?>

      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/about-front-section/image.php',
        array(),
        array('MODE' => 'html', 'NAME' => 'контентное изображение блока', 'SHOW_BORDER' => true)
      );
      ?>
    </div>
    <div class="content">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/about-front-section/content.php',
        array(),
        array('MODE' => 'html', 'NAME' => 'контент блока', 'SHOW_BORDER' => true)
      );
      ?>
    </div>

  </div>
</section>