<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</main>

<footer class="footer">
  <div class="footer__section footer__section--main">
    <div class="container">
      <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/logo.php");  ?>


      <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "bottom-menu",
        array(
          "ALLOW_MULTI_SELECT" => "N",
          "CHILD_MENU_TYPE" => "left",
          "DELAY" => "N",
          "MAX_LEVEL" => "1",
          "MENU_CACHE_GET_VARS" => array(),
          "MENU_CACHE_TIME" => "3600",
          "MENU_CACHE_TYPE" => "A",
          "MENU_CACHE_USE_GROUPS" => "Y",
          "ROOT_MENU_TYPE" => "bottom",
          "USE_EXT" => "Y",
          "COMPONENT_TEMPLATE" => "bottom-menu"
        ),
        false
      ); ?>

      <div class="contact-block">
        <address>г. Москва, пр. Ленина, 30 лит.А, офис 7452</address>

        <a href="#">info@artmonta.ru</a>
        <a href="#">+7 499 900 09 90</a>
      </div>

      <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>
    </div>
  </div>
  <div class="footer__section footer__section--info">
    <div class="container">
      <span>Copyright © <?= date('Y') ?> All Rights Reserved.</span>
      <a href="#">Политика конфиденциальности</a>
    </div>
  </div>
</footer>
<!-- <div id="smooth-wrapper"> -->
</div>
<!-- <div id="smooth-content"> -->
</div>
</body>

</html>