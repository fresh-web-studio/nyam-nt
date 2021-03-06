<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>
<div class="login__row">
    <div class="login__column">
        <div class="flex-tabs">
            <div class="login__label-row">
                <noindex>
                    <div class="tab">
                        <a href="../auth/">����</a>
                    </div>
                </noindex>
                <noindex>
                    <div class="tab active">
                        �����������
                    </div>
                </noindex>
                <noindex>
                    <div class="tab">
                        <a href="../backup/">������������</a>
                    </div>
                </noindex>
            </div>

            <div class="bx-auth-reg">

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<div class="login__info"><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></div>
<?endif?>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
<table>
	<tbody>
		<tr>
			<td><?echo GetMessage("main_register_sms")?><span class="starrequired">*1</span></td>
			<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" /></td>
		</tr>
	</tfoot>
</table>
</form>

<script>
new BX.PhoneAuth({
	containerId: 'bx_register_resend',
	errorContainerId: 'bx_register_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_register_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_register_resend"></div>

<?else:?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>


<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
		<div class="bx-authform-formgroup-container">
			<?echo GetMessage("main_profile_time_zones_auto")?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*2</span><?endif?><br>

				<select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
					<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
					<option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
					<option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
				</select>
		</div>

        <div class="bx-authform-formgroup-container"><? echo GetMessage("main_profile_time_zones_zones") ?>
            <br>
            <select name="REGISTER[TIME_ZONE]"<? if (!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"' ?>>
                <? foreach ($arResult["TIME_ZONE_LIST"] as $tz => $tz_name): ?>
                    <option value="<?= htmlspecialcharsbx($tz) ?>"<?= $arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : "" ?>><?= htmlspecialcharsbx($tz_name) ?></option>
                <? endforeach ?>
            </select>
        </div>

	<?else:?>
                <div class="bx-authform-formgroup-container"><?
                    switch ($FIELD) {
                        case "PASSWORD":
                            ?><input size="30" type="password" name="REGISTER[<?= $FIELD ?>]"
                                     value="<?= $arResult["VALUES"][$FIELD] ?>" autocomplete="off" class="bx-auth-input"
                                     placeholder="������"/>
                        <? if ($arResult["SECURE_AUTH"]): ?>
                            <span class="bx-auth-secure" id="bx_auth_secure"
                                  title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                            <noscript>
				<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                            </noscript>
                            <script type="text/javascript">
                                document.getElementById('bx_auth_secure').style.display = 'inline-block';
                            </script>
                        <?endif ?>
                            <?
                            break;
                        case "CONFIRM_PASSWORD":
                            ?><input size="30" type="password" name="REGISTER[<?= $FIELD ?>]"
                                     value="<?= $arResult["VALUES"][$FIELD] ?>" autocomplete="off"
                                     placeholder="������������� ������"/><?
                            break;

                        case "PERSONAL_GENDER":
                            ?><select name="REGISTER[<?= $FIELD ?>]">
                            <option value=""><?= GetMessage("USER_DONT_KNOW") ?></option>
                            <option value="M"<?= $arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : "" ?>><?= GetMessage("USER_MALE") ?></option>
                            <option value="F"<?= $arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : "" ?>><?= GetMessage("USER_FEMALE") ?></option>
                            </select><?
                            break;

                        case "PERSONAL_COUNTRY":
                        case "WORK_COUNTRY":
                            ?><select name="REGISTER[<?= $FIELD ?>]"><?
                            foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value) {
                                ?>
                                <option value="<?= $value ?>"<? if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif ?>><?= $arResult["COUNTRIES"]["reference"][$key] ?></option>
                                <?
                            }
                            ?></select><?
                            break;

                        case "PERSONAL_PHOTO":
                        case "WORK_LOGO":
                            ?><input size="30" type="file" name="REGISTER_FILES_<?= $FIELD ?>" /><?
                            break;

                        case "PERSONAL_NOTES":
                        case "WORK_NOTES":
                            ?><textarea cols="30" rows="5"
                                        name="REGISTER[<?= $FIELD ?>]"><?= $arResult["VALUES"][$FIELD] ?></textarea><?
                            break;
                        default:
                            if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?= $arResult["DATE_FORMAT"] ?></small>
                                <br/><?endif;
                            ?><input size="30" type="text" name="REGISTER[<?= $FIELD ?>]"
                                     value="<?= $arResult["VALUES"][$FIELD] ?>"
                                     placeholder="<?= getMessage('REGISTER_PLACEHOLDER_' . $FIELD); ?>" />
                            <?
                            if ($FIELD == "PERSONAL_BIRTHDAY")
                                $APPLICATION->IncludeComponent(
                                    'bitrix:main.calendar',
                                    '',
                                    array(
                                        'SHOW_INPUT' => 'N',
                                        'FORM_NAME' => 'regform',
                                        'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                        'SHOW_TIME' => 'N'
                                    ),
                                    null,
                                    array("HIDE_ICONS" => "Y")
                                );
                            ?><?
                    } ?></div>
	<?endif?>
<?endforeach?>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
    <div class="bx-authform-formgroup-container"><?= strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB") ?></div>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
        <div class="bx-authform-formgroup-container"><?= $arUserField["EDIT_FORM_LABEL"] ?>:<? if ($arUserField["MANDATORY"] == "Y"): ?><span
                class="starrequired">*4</span><? endif; ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:system.field.edit",
            $arUserField["USER_TYPE"]["USER_TYPE_ID"],
            array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS" => "Y")); ?>
        </div>
    <?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
    <div class="login__info"><?= GetMessage("REGISTER_CAPTCHA_TITLE") ?></div>

    <div class="bx-authform-formgroup-container"><input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40"
             alt="CAPTCHA"/></div>

    <div class="bx-authform-formgroup-container"><input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"
              placeholder="<?= GetMessage("REGISTER_CAPTCHA_PROMT") ?>"/></div>
	<?
}
/* !CAPTCHA */
?>
<div class="bx-authform-formgroup-container"><input type="submit" name="register_submit_button" value="<?= GetMessage("AUTH_REGISTER") ?>"/></div>

</form>

                <div class="login__requirement"><p><? //echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>

                    <? endif //$arResult["SHOW_SMS_FIELD"] == true ?>

                    <span class="starrequired">*</span><?= GetMessage("AUTH_REQ") ?>

                    <? endif ?></div>
</div>

        </div>
    </div>
    
    <div class="login__column">
        <div class="login__contacts">
            <div class="login__title">��������</div>
            <div class="login__subtitle">
                �����
            </div>
            <div class="login__address">
                ��. ����� ������, 81/23
            </div>
            <div class="login__phone">+7 (3435) 41-62-60</div>
            <div class="login__phone">+7 (3435) 41-37-47</div>
            <div class="login__time">��������: <span>10:00 - 20:00</span></div>
            <div class="login__time">��������: <span>10:00 - 21:00</span></div>
            <div class="login__subtitle">
                ���
            </div>
            <div class="login__address">
                ��. �����������, 10
            </div>
            <div class="login__phone">+7 (3435) 34-30-10</div>
            <div class="login__time">��������: <span>10:00 - 20:00</span></div>
            <div class="login__time">��������: <span>10:00 - 21:00</span></div>
        </div>
    </div>
</div>