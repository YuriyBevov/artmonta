<div class="section">
  <div class="container">
    <div class="preview-text-section__content">
      <div class="preview-text-section__content-item preview-text-section__content-item--text">
        <?
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/preview-text-section/description.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'текст главного блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>

      <div class="preview-text-section__content-item">
        <?
        $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/preview-text-section/image.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'контентное изображение главного блока', 'SHOW_BORDER' => true)
        );
        ?>
      </div>
    </div>
  </div>
</div>