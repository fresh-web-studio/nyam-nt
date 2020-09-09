<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);



if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_FORM_SUCCESS');
	return;
}
?>

<div class="login__row">
    <div class="login__column">
        <div class="flex-tabs">
            <div class="login__label-row">
                <noindex>
                    <div class="tab active">Вход</div>
                </noindex>
                <noindex>
                <?if ($arResult['AUTH_REGISTER_URL']):?>
                    <div class="tab">
                        <a href="<?= $arResult['AUTH_REGISTER_URL'];?>" rel="nofollow">
                            <?= Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?>
                        </a>
                    </div>
                <?endif;?>
                </noindex>
                <noindex>
                <?if ($arResult['AUTH_FORGOT_PASSWORD_URL']):?>
                    <div class="tab">
                        <a href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'];?>" rel="nofollow">
                            <?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?>
                        </a>
                    </div>
                <?endif;?>
                </noindex>
            </div>
            <div>
                <?if ($arResult['ERRORS']):?>
                    <div class="alert alert-danger">
                        <? foreach ($arResult['ERRORS'] as $error)
                        {
                            echo $error;
                        }
                        ?>
                    </div>
                <?endif;?>

                <form name="<?= $arResult['FORM_ID'];?>" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>">

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-input-container">
                            <input type="text" name="<?= $arResult['FIELDS']['login'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" placeholder="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?>"/>
                        </div>
                    </div>

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-input-container">
                            <?if ($arResult['SECURE_AUTH']):?>
                                <div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
                                    <div class="bx-authform-psw-protected-desc"><span></span>
                                        <?= Loc::getMessage('MAIN_AUTH_FORM_SECURE_NOTE');?>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    document.getElementById('bx_auth_secure').style.display = '';
                                </script>
                            <?endif?>
                            <input type="password" name="<?= $arResult['FIELDS']['password'];?>" maxlength="255" autocomplete="off" placeholder="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?>"/>
                        </div>
                    </div>

                    <?if ($arResult['CAPTCHA_CODE']):?>
                        <input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
                        <div class="bx-authform-formgroup-container dbg_captha">
                            <div class="bx-authform-label-container">
                                <?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_CAPTCHA');?>
                            </div>
                            <div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
                            <div class="bx-authform-input-container">
                                <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
                            </div>
                        </div>
                    <?endif;?>

                    <?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
                        <div class="bx-authform-formgroup-container">
                            <div class="checkbox">
                                <label class="bx-filter-param-label">
                                    <input type="checkbox" id="USER_REMEMBER" name="<?= $arResult['FIELDS']['remember'];?>" value="Y" />
                                    <span class="bx-filter-param-text"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER');?></span>
                                </label>
                            </div>
                        </div>
                    <?endif?>

                    <div class="bx-authform-formgroup-container">
                        <input type="submit" class="btn btn-primary" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>" />
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="login__column">
        <div class="login__contacts">
            <div class="login__title">Контакты</div>
            <div class="login__subtitle">
                Центр
            </div>
            <div class="login__address">
                ул. Карла Маркса, 81/23
            </div>
            <div class="login__phone">+7 (3435) 41-62-60</div>
            <div class="login__phone">+7 (3435) 41-37-47</div>
            <div class="login__time">Доставка: <span>10:00 - 20:00</span></div>
            <div class="login__time">Пиццерия: <span>10:00 - 21:00</span></div>
            <div class="login__subtitle">
                Выя
            </div>
            <div class="login__address">
                ул. Космонавтов, 10
            </div>
            <div class="login__phone">+7 (3435) 34-30-10</div>
            <div class="login__time">Доставка: <span>10:00 - 20:00</span></div>
            <div class="login__time">Пиццерия: <span>10:00 - 21:00</span></div>
        </div>
    </div>
</div>



<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>