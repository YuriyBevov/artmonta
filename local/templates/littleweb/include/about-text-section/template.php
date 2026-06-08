<div class="section text-split-section">
  <div class="text-split-section__img">
    <?
    $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . '/include/about-text-section/image.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'контентное изображение блока', 'SHOW_BORDER' => true)
    );
    ?>
  </div>
  <div class="container">
    <div class="text-split-section__content">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/about-text-section/description.php',
        array(),
        array('MODE' => 'html', 'NAME' => 'текст блока', 'SHOW_BORDER' => true)
      );
      ?>
    </div>
  </div>
</div>
