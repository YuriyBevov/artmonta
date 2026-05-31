<div class="section preview-text-section">
  <div class="preview-text-section-img">
    <?
    $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . '/include/preview-text-section/image.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'контентное изображение блока', 'SHOW_BORDER' => true)
    );
    ?>
  </div>
  <div class="container">
    <div class="preview-text-section-wrapper">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/preview-text-section/description.php',
        array(),
        array('MODE' => 'html', 'NAME' => 'текст блока', 'SHOW_BORDER' => true)
      );
      ?>
    </div>
  </div>
</div>