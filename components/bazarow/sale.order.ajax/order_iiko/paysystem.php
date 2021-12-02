<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<script type="text/javascript">
    function changePaySystem(param) {
        if (param == 'account') {
            if (BX("PAY_CURRENT_ACCOUNT")) {
                BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

                if (BX("PAY_CURRENT_ACCOUNT").checked) {
                    BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                    BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                } else {
                    BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                    BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                }
            }
        }
        submitForm();
    }
</script>


<div class="set_payment">
    <div class="set_payment_title">
        Выберите способ оплаты:
    </div>

    <?
    uasort($arResult["PAY_SYSTEM"], "cmpBySort"); // resort arrays according to SORT value
    foreach ($arResult["PAY_SYSTEM"] as $arPaySystem) {
        if (strlen(trim(str_replace("<br />", "", $arPaySystem["DESCRIPTION"]))) > 0 || intval($arPaySystem["PRICE"]) > 0) {
            if (count($arResult["PAY_SYSTEM"]) == 1) {
                ?>
                <div class="set_payment_item">
                    <input type="hidden" name="PAY_SYSTEM_ID" value="<?= $arPaySystem["ID"] ?>">
                    <input type="radio"
                           id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
                           name="PAY_SYSTEM_ID"
                           value="<?= $arPaySystem["ID"] ?>"
                        <? if ($arPaySystem["CHECKED"] == "Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"] == "Y")) echo " checked=\"checked\""; ?>
                           onclick="changePaySystem();"
                    />
                    <label for="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
                           onclick="BX('ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>').checked=true;changePaySystem();">
                        <span></span><?= $arPaySystem["PSA_NAME"]; ?>
                    </label>
                </div>
                <?
            } else // more than one
            {
                ?>
                <div class="set_payment_item">
                    <input type="radio"
                           id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
                           name="PAY_SYSTEM_ID"
                           value="<?= $arPaySystem["ID"] ?>"
                        <? if ($arPaySystem["CHECKED"] == "Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"] == "Y")) echo " checked=\"checked\""; ?>
                           onclick="changePaySystem();"/>
                    <label for="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
                           onclick="BX('ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>').checked=true;changePaySystem();">
                        <span></span> <?= $arPaySystem["PSA_NAME"]; ?>
                    </label>
                </div>
                <?
            }
        }

    }
    ?>
</div>