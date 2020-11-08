<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y") {
    if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
        if (strlen($arResult["REDIRECT_URL"]) > 0) {
            $APPLICATION->RestartBuffer();
            ?>
            <script type="text/javascript">
                window.top.location.href = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            </script>
            <?
            die();
        }

    }
}
?>

<a name="order_form"></a>


<div id="order_form_div">


    <?
    if (!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N") {
        if (!empty($arResult["ERROR"])) {
            foreach ($arResult["ERROR"] as $v) {
                ?>
                <? echo ShowError($v);?>
                <?
            }
        } elseif (!empty($arResult["OK_MESSAGE"])) {
            foreach ($arResult["OK_MESSAGE"] as $v)
                echo ShowNote($v);
        }

        include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/auth.php");
    } else {
        if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
            if (strlen($arResult["REDIRECT_URL"]) == 0) {
                include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/confirm.php");
            }
        } else {
            ?>
            <script type="text/javascript">

                <?if(CSaleLocation::isLocationProEnabled()):?>

                <?
                // spike: for children of cities we place this prompt
                $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
                ?>

                BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
                    'source' => $this->__component->getPath() . '/get.php',
                    'cityTypeId' => intval($city['ID']),
                    'messages' => array(
                        'otherLocation' => '--- ' . GetMessage('SOA_OTHER_LOCATION'),
                        'moreInfoLocation' => '--- ' . GetMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
                        'notFoundPrompt' => '<div class="-bx-popup-special-prompt">' . GetMessage('SOA_LOCATION_NOT_FOUND') . '.<br />' . GetMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                                '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                                '#ANCHOR_END#' => '</a>'
                            )) . '</div>'
                    )
                ))?>);

                <?endif?>

                var BXFormPosting = false;

                function submitForm(val) {
                    if (BXFormPosting === true)
                        return true;

                    BXFormPosting = true;
                    if (val != 'Y')
                        BX('confirmorder').value = 'N';

                    var orderForm = BX('ORDER_FORM');
                    BX.showWait();

                    <?if(CSaleLocation::isLocationProEnabled()):?>
                    BX.saleOrderAjax.cleanUp();
                    <?endif?>

                    BX.ajax.submit(orderForm, ajaxResult);

                    return true;
                }

                function ajaxResult(res) {
                    var orderForm = BX('ORDER_FORM');
                    try {
                        // if json came, it obviously a successfull order submit

                        var json = JSON.parse(res);
                        BX.closeWait();

                        if (json.error) {
                            BXFormPosting = false;
                            return;
                        } else if (json.redirect) {
                            window.top.location.href = json.redirect;
                        }
                    } catch (e) {
                        // json parse failed, so it is a simple chunk of html

                        BXFormPosting = false;
                        BX('order_form_content').innerHTML = res;

                        <?if(CSaleLocation::isLocationProEnabled()):?>
                        BX.saleOrderAjax.initDeferredControl();
                        <?endif?>
                    }

                    BX.closeWait();
                    BX.onCustomEvent(orderForm, 'onAjaxSuccess');
                }

                function SetContact(profileId) {
                    BX("profile_change").value = "Y";
                    submitForm();
                }
            </script>
        <? if ($_POST["is_ajax_post"] != "Y")
        {
        ?>
            <form action="<?= $APPLICATION->GetCurPage(); ?>" method="POST" name="ORDER_FORM" id="ORDER_FORM"
                  enctype="multipart/form-data">
                <?= bitrix_sessid_post() ?>
                <div id="order_form_content" class="order_template">
                    <?
                    }
                    else {
                        $APPLICATION->RestartBuffer();
                    }

                    if ($_REQUEST['PERMANENT_MODE_STEPS'] == 1) {
                        ?>
                        <input type="hidden" name="PERMANENT_MODE_STEPS" value="1"/>
                        <?
                    }

                    if (!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y") {
//                        echo '<pre>';
//                        print_r($arResult["ERROR"]);
//                        echo '</pre>';
                        ?>
                        <div class="order_template_error_col">
                        <?
                        foreach ($arResult["ERROR"] as $Err) {
                            ?>
                            <? echo ShowError($Err);?>
                            <?
                        }
                        ?>
                        </div>
                        <script type="text/javascript">
                            top.BX.scrollToNode(top.BX('ORDER_FORM'));
                        </script>
                        <?
                    }
                    ?>


                        <div class="order_template_col">
                            <?
                            include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/delivery.php");
                            ?>
                            <div class="order_props">
                                <?
                                include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/person_type.php");
                                include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/props.php");
                                include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/related_props.php");
                                ?>
                            </div>
                            <?
                            include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/paysystem.php");
                            if (strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
                                echo $arResult["PREPAY_ADIT_FIELDS"];
                            ?>

                            <?// if ($_POST["is_ajax_post"] != "Y") { ?>
                                <div class="order_footer">
                                    <a class="order_footer_to_cart" href="/personal/cart/">
                                        Назад в корзину
                                    </a>
                                    <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                                    <input type="hidden" name="profile_change" id="profile_change" value="N">
                                    <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                                    <input type="hidden" name="json" value="Y">
                                    <a
                                            class="order_footer_checkut"
                                            href="javascript:void();"
                                            onclick="submitForm('Y'); return false;"
                                            id="ORDER_CONFIRM_BUTTON"
                                    >
                                        <?= GetMessage("SOA_TEMPL_BUTTON") ?>
                                    </a>
                                </div>
                            <?// } ?>
                        </div>
                        <div class="order_template_col_summ">
                            <?
                            include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/summary.php");
                            ?>
                        </div>
                </div>
            </form>
            <?


        }
    }
    ?>

</div>

<?if(CSaleLocation::isLocationProEnabled()):?>

    <div style="display: none">
        <?// we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:sale.location.selector.steps",
            ".default",
            array(
            ),
            false
        );?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:sale.location.selector.search",
            ".default",
            array(
            ),
            false
        );?>
    </div>

<?endif?>


