<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</main>


<? $APPLICATION->IncludeComponent(
  "bitrix:form.result.new",
  "callback-form",
  array(
    "AJAX_MODE" => "Y",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "N",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TIME" => "3600",
    "CACHE_TYPE" => "A",
    "CHAIN_ITEM_LINK" => "",
    "CHAIN_ITEM_TEXT" => "",
    "EDIT_URL" => "",
    "IGNORE_CUSTOM_TEMPLATE" => "N",
    "LIST_URL" => "",
    "SEF_MODE" => "N",
    "SUCCESS_URL" => "",
    "USE_EXTENDED_ERRORS" => "Y",
    "WEB_FORM_ID" => "1",
    "COMPONENT_TEMPLATE" => "callback-form",
    "VARIABLE_ALIASES" => array(
      "WEB_FORM_ID" => "WEB_FORM_ID",
      "RESULT_ID" => "RESULT_ID",
    )
  ),
  false
); ?>

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
        <?
        $APPLICATION->IncludeFile(
          SITE_DIR . 'include/address.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'адрес', 'SHOW_BORDER' => true)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
          SITE_DIR . 'include/mail.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'адрес электронной почты', 'SHOW_BORDER' => true)
        );
        ?>
        <?
        $APPLICATION->IncludeFile(
          SITE_DIR . 'include/phone.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'телефон', 'SHOW_BORDER' => true)
        );
        ?>
      </div>

      <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>
    </div>
  </div>
  <div class="footer__section footer__section--info">
    <div class="container">
      <span>Copyright © <?= date('Y') ?> All Rights Reserved.</span>
      <a href="/privacy/">Политика конфиденциальности</a>
    </div>
  </div>
</footer>

<!-- <div id="smooth-wrapper"> -->
</div>
<!-- <div id="smooth-content"> -->
</div>

<? $APPLICATION->IncludeComponent(
  'bitrix:main.userconsent.request',
  'cookie',
  array(
    'ID' => 1,
    'IS_CHECKED' => 'N',
    'IS_LOADED' => 'Y',
    'AUTO_SAVE' => 'Y',
    'INPUT_NAME' => 'COOKIE_CONSENT',
    'REPLACE' => array()
  )
); ?>
</body>

</html>