<div class="section__header">
  <? if ($arParams["DESCRIPTION"] && $arParams["DESCRIPTION"] !== ""): ?>
    <div class="grid">
      <div class="grid-item">
        <h2 class="title"><?= $arParams["TITLE"] ?></h2>
      </div>
      <div class="grid-item">
        <p><?= $arParams["DESCRIPTION"] ?></p>
      </div>
    </div>
  <? else: ?>
    <h2 class="title"><?= $arParams["TITLE"] ?></h2>
  <? endif; ?>
</div>